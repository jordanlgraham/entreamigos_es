<?php
/*
  Plugin name: Entreamigos Calendar
  Description: Display events from google calendar.
  Version: 0.1
 */

/* @error_reporting(E_ALL | E_STRICT); // NOT FOR PRODUCTION SERVERS! */
/* @ini_set('display_errors', '1'); */

defined('ABSPATH') or die("No script kiddies please!");

register_activation_hook(__FILE__, 'ea_install_database');

add_action('wp_enqueue_scripts', 'ea_plugin_init');
add_action('admin_enqueue_scripts', 'ea_plugin_admin_init');
add_action('admin_menu', 'ea_menu');

require_once( ABSPATH . "wp-includes/pluggable.php" );

add_shortcode('ea_calendar', 'ea_render_calendar');

$plugin_dir = plugin_dir_path(__FILE__);

global $wpdb;

//global $calendarList;
//

function ea_menu() {
    //add_options_page('Google calendar options', 'ea_calendar', 'administrator', 'ea_calendar', 'ea_render_menu');
    add_menu_page('Manage Calendar', 'EA Calendar', 'administrator', 'ea_manage_calendar', 'ea_render_menu');
}

function ea_plugin_init() {
//    wp_enqueue_script('ea-calendar.js', plugins_url('js/ea-calendar.js', __FILE__));
}

function ea_plugin_admin_init() {
    wp_register_script(
            'colorpick', plugin_dir_url(__FILE__) . 'js/colorpick.js', array('jquery'), false, false
    );
    wp_enqueue_script('colorpick');
    wp_register_style('colorpick', plugin_dir_url(__FILE__) . 'css/colorpick.css');
    wp_enqueue_style('colorpick');
}

function ea_get_calendar($feed_url) {
    libxml_use_internal_errors(true);
    try {
        $feed_xml = new SimpleXMLElement($feed_url, NULL, true);
        return $feed_xml;
    } catch (Exception $e) {
        var_dump($e);
        exit;
    }
}

function ea_get_events($xml_feed, $cid) {
    $result = array();
    foreach ($xml_feed->entry as $event) {

        // get current year or it'll parse events since the beginning of world
        $current_year = date('Y');
        $gd_nodes = $event->children('http://schemas.google.com/g/' . $current_year); // found in attribute of feed node
        $gcal_nodes = $event->children('http://schemas.google.com/gCal/' . $current_year); // found in attribute of feed node

        $res = array('id' => $cid,
            'title' => $event->title,
            'description' => $event->content,
            'summary' => $event->summary,
            'location' => $event->location,
            'startTime' => $event->startTime);

        array_push($result, $res);
    }

    return $result;
}

function ea_display_events($xml_feed) {
    // TODO: Instead of 'Calendar 1' there should be a custom name
    ?>
    <input type="checkbox" id="calendar" checked /> Calendar 1
    <?php
    foreach ($xml_feed->entry as $event) {

        // get current year or it'll parse events since the beginning of world
        $current_year = date('Y');
        $gd_nodes = $event->children('http://schemas.google.com/g/' . $current_year); // found in attribute of feed node
        $gcal_nodes = $event->children('http://schemas.google.com/gCal/' . $current_year); // found in attribute of feed node

        $title = $event->title;
        $description = $event->content;
        $summary = $event->summary; // TODO consider whether this is redundant
        $location = $event->location;
        $start_time = $event->startTime;
        ?>
        <div id="ea_cal" class="ea_cal"><h2><?php echo $title; ?></h2></div>
        <div id="ea_cal" class="ea_cal"><?php echo $description; ?></div><br>
        <?php
    }
}

function wpb_adding_scripts() {

    wp_register_script(
            'eajquery', plugin_dir_url(__FILE__) . 'js/ea-jquery.js', array('jquery'), false, false
    );
    
    wp_register_script(
            'moment', plugin_dir_url(__FILE__) . 'js/moment.min.js', array('jquery'), false, false
    );
    wp_register_script(
            'fullcalendar', plugin_dir_url(__FILE__) . 'js/fullcalendar.js', array('jquery'), false, false
    );
    wp_register_script(
            'gcal', plugin_dir_url(__FILE__) . 'js/gcal.js', array('jquery'), false, false
    );

    wp_register_style('fullcalendar-css', plugin_dir_url(__FILE__) . 'css/fullcalendar.min.css');

    wp_enqueue_style('fullcalendar-css');

    wp_enqueue_script('eajquery');
    wp_enqueue_script('moment');
    wp_enqueue_script('fullcalendar');
    wp_enqueue_script('gcal');
    wp_enqueue_script('ea-calendar.js', plugins_url('js/ea-calendar.js', __FILE__));
}

add_action('wp_enqueue_scripts', 'wpb_adding_scripts');

function ea_render_calendar() {
    global $wpdb;
    $table_name = $wpdb->prefix . "ea_calendar";
    $apiKey = get_option('ea-cal-gapi-key');
    // TODO: check if this isn't null/empty
    // check if it's viable url/gcalendar url?
    $db_query = $wpdb->get_results("SELECT * FROM $table_name ");

    $calendarIds = array();
    $result = "";
    foreach ($db_query as $res) {
        preg_match('~feeds/(.+?)/~', urldecode($res->calendar_url), $matches);
        array_push($calendarIds, $matches[1]);
        $result.=<<<EOT
        <label for="chk_{$res->id}">
                <input type="checkbox" id="chk_{$res->id}" class="toggleCalendar"
                       data-url="{$res->calendar_url}" data-id ="{$matches[1]}" 
                       data-limit="{$res->posts_number}"
                       data-color="{$res->color}"/>{$res->name}
            </label> <br>
EOT;
    }
    $result.=<<<HTML
        <div id="ea_gal_calender" data-key="{$apiKey}"></div>
HTML;
    
    return $result;
          
}

function ea_install_database() {
    global $wpdb;
    $table_name = $wpdb->prefix . "ea_calendar";
    // TODO: add another function that will set default options
    // i.e. posts_number to 5
    $drop = "DROP TABLE $table_name";
    $wpdb->query($drop);
    $sql = "CREATE TABLE  $table_name (
        id mediumint(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        calendar_url text NOT NULL,
        posts_number text NOT NULL,
        name text NOT NULL,
        color text NOT NULL
    );";


    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

if (isset($_POST['submit']) && $_POST['name'] != "" && $_POST['calendar'] != "") {
    $table_name = $wpdb->prefix . "ea_calendar";


    $posts_number = 125;
    $calendar_url = $_POST['calendar'];

    $wpdb->insert(
            $table_name, array(
        'calendar_url' => $calendar_url,
        'posts_number' => $posts_number,
        'name' => $_POST['name'],
        'color' => $_POST['color']
            )
    );
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $table = $wpdb->prefix . "ea_calendar";
    $id = $_GET['id'];
    $wpdb->query(
            "DELETE FROM  $table 
		WHERE id = $id "
    );

    header('Location:plugins.php?page=ea_manage_calendar');
}
if (isset($_POST['eaKey']) && !empty($_POST['eaKey'])) {
    update_option('ea-cal-gapi-key', $_POST['eaKey']);
}

function ea_manage_calendar() {

    $table = $wpdb->prefix . "ea_calendar";
    $calendarList = $wpdb->get_results("SELECT * FROM $table");
    ?>
    <h2>Calendar options</h2>
    <div class="wrap">
        <form method="post">
            Name : <input type="text" name="name" value="" /> </br></br>
            Link to calendar: <input type="text" name="calendar" value="" /> </br></br>
            Number of posts displayed: <input type="text" name="posts_number" value=""/> </br></br>
            <input type="submit" name="submit" value="submit" />
        </form>
    </div>
    <?php
}

function ea_render_menu() {
    global $wpdb;
    $table = $wpdb->prefix . "ea_calendar";
    $calendarList = $wpdb->get_results("SELECT * FROM $table");
    $apiKey = get_option('ea-cal-gapi-key');
    ?>


    <div class="wrap">
        <div style="float: left">
            <h2>Manage EA Calendar</h2>
        </div>
        <div style="width: 63%; float: right">
            <form method="post" style="padding-top: 9px" >
                Google API Key : <input type="text" value="<?php echo $apiKey; ?>" style="width: 60%"  name="eaKey"/>
                <button class="add-new-h2" type="submit" style="top:0">Update</button>
            </form>
        </div>
        <div style="clear: both"></div>

        <br>

        <form method="post" style="margin-bottom: 15px">
            Name : <input type="text" name="name" value="" /> 
            Calendar Link: <input type="text" name="calendar" value="" placeholder="https://www.google.com/calendar/feeds/xxxxxxxx/public/basic"
                                  style="width: 35%" />

            Color: <input type="text" id="color" name="color" value="" autocomplete="off"  />
            <input type="submit" name="submit" class="add-new-h2" value="Add New"  style="top:0" />
        </form>


        <table class="widefat page fixed" style="width:98%" cellpadding="3" cellspacing="3">
            <thead>
                <tr>
                    <th class="manage-column" style="width: 70%" scope="col">Calendar Url</th>
                    <th class="manage-column" scope="col">Name</th>
                    <th class="manage-column" scope="col">Color</th>
                    <th class="manage-column" scope="col">Options</th>
                </tr>
            </thead>
            <?php foreach ($calendarList as $cal) {
                ?>
                <tr>
                    <td><?php echo $cal->calendar_url; ?></td>
                    <td><?php echo $cal->name; ?></td>
                    <td><span style="display: block; height: 15px;  width: 52px;background: <?php echo $cal->color; ?>;"></span></td>
                    <td><a href="plugins.php?page=ea_manage_calendar&action=delete&id=<?php echo $cal->id; ?>">Delete</a></td>
                </tr>
            <?php }
            ?>
        </table>


        <br><br>
    </div>
    <script type="text/javascript">
        jQuery(function() {
            jQuery('input#color').simpleColorPicker();
        });
    </script>
    <?php
}

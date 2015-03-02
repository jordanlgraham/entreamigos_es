$eajQ(window).load(function() {
    $eajQ('#ea_gal_calender table:not(".fixTab")').addClass('fixTab');
});
$eajQ(function() {
    var sources = [];
    var checkedInfo = JSON.parse(window.localStorage.getItem('ea_cal_chkd'));
    $eajQ('.toggleCalendar').each(function() {
        if (checkedInfo === null || (checkedInfo && checkedInfo.length > 0 && checkedInfo.indexOf($eajQ(this).attr('id')) !== -1)) {
            $eajQ(this).prop('checked', true);
            sources.push({url: $eajQ(this).attr('data-url'), maxResults: $eajQ(this).attr('data-limit'), color: $eajQ(this).attr('data-color')});
        } else if (checkedInfo !== null) {
            $eajQ(this).prop('checked', false);
        }

    });

    $eajQ('#ea_gal_calender').fullCalendar({
        googleCalendarApiKey: $eajQ('#ea_gal_calender').data('key'),
        eventSources: sources,
        eventClick: function(event) {
            // opens events in a popup window
            window.open(event.url, 'gcalevent', 'width=700,height=600');
            return false;
        },
        loading: function(bool) {
            if (!bool)
                $eajQ('#ea_gal_calender table:not(".fixTab")').addClass('fixTab')
        },
        eventRender: function(event, element) {
            $eajQ(element).attr('title', event.title);
        }
    });
    
    $eajQ('.toggleCalendar').click(function() {
    $eajQ('.toggleCalendar').each(function() {
        if ($eajQ(this).is(':checked')) {
            checked.push($eajQ(this).attr('id'));
        } else {
            checked.pop($eajQ(this).attr('id'));
        }
    });
    window.localStorage.setItem('ea_cal_chkd', JSON.stringify(checked));
    if (!$eajQ(this).is(':checked')) {
        $eajQ('#ea_gal_calender').fullCalendar('removeEventSource', $eajQ(this).attr('data-id'));

    } else {
        $eajQ('#ea_gal_calender').fullCalendar('addEventSource', {url: $eajQ(this).attr('data-url'), maxResults: $eajQ(this).attr('data-limit'), color: $eajQ(this).attr('data-color')})
    }
});
});
var checked = [];

var pastEvents = 4;

function loadPastEvents() {
    var data = {
        'action': 'get_past_events',
        'pastEvents': pastEvents
    };
    jQuery.post("wp-admin/admin-ajax.php", data, function(response) {
        $("#past-events-container section").append(response);
        pastEvents += 4;
    });
    return false;
}

window.addEventListener('popstate', function (event) {
    if ((event.state != null) && (event.state.single_event == 1)) {
        $('#upcoming-events-container').hide();
        $('#past-events-container').hide();
        $('#single-event-container').show();
    }
    else {
        $('#upcoming-events-container').show();
        $('#past-events-container').show();
        $('#single-event-container').hide();
    }
});

history.replaceState({single_event: 0}, null, null);

function loadEvent(event_id) {
    history.pushState({single_event: 1}, null, null);
    var data = {
        'action': 'get_event',
        'event_id': event_id
    };
    jQuery.post("wp-admin/admin-ajax.php", data, function(response) {
        $("#single-event-container").html(response);
        $('#upcoming-events-container').hide();
        $('#past-events-container').hide();
        $('#single-event-container').show();
        $('html, body').animate({
            scrollTop: $("#events-container").offset().top - $("#menu-container").height()
        }, 1000);
    });
    return false;
}

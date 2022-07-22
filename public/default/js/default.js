function deleteConfirm(eventId) {
    $(".event-id").slideUp();
    $("#event-details-" . eventId).slideUp();
    $(eventId).slideDown();
}

function deleteCancel() {
    $(".event-id").slideUp();
}

function toggleEventPopup(eventId) {
    $(eventId).slideToggle();
}

function delay(callback, ms) {
    var timer = 0;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0)
    }
}

$(document).ready(function () {
    $('#calendar_div').delegate('.date_cell', 'mouseenter', function () {
        date = $(this).attr('date');
        $(".date_popup_wrap").fadeOut();
        $("#date_popup_" + date).fadeIn('fast');
    });
    $('#calendar_div').delegate('.date_cell', 'mouseleave', function () {
        //$(".date_popup_wrap").fadeOut('fast');
        $(".date_popup_wrap").hide();
    });
    $('#calendar_div').delegate('.month_dropdown', 'change', function () {
        getCalendar('calendar_div', $('.year_dropdown').val(), $('.month_dropdown').val());
    });
    $('#calendar_div').delegate('.year_dropdown', 'change', function () {
        getCalendar('calendar_div', $('.year_dropdown').val(), $('.month_dropdown').val());
    });
    $(document).click(function (e) {
        if( $(e.target).closest("#event_list").length > 0 ) {
            return false;
        } else {
            $('#event_list').slideUp('fast');
        }
        if( $(e.target).closest("#add_event_section, #add_event_icon").length > 0 ) {
            return false;
        } else {
            $('#add_event_section').slideUp('fast');
        }
    });
});
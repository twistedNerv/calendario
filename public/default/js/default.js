function getCalendar(target_div, year, month) {
    $.ajax({
        type: 'GET',
        url: URL + 'api/getCalendar/' + year + '/' + month,
        success: function (html) {
            $('#' + target_div).html(html);
        }
    });
}

function getEvents(date) {
    $.ajax({
        type: 'GET',
        url: URL + 'api/getEvents/' + date,
        success: function (html) {
            $('#event_list').html(html);
            $('#event_list').slideDown('fast');
        }
    });
}

function addEvent() {
    section = $("#event-section").val();
    title = $("#event-title").val();
    description = $("#event-description").val();
    eventlocation = $("#event-location").val();
    pickup_location = $("#event-pickup_location").val();
    date_from = $("#event-date-from").val();
    date_to = $("#event-date-to").val();
    if(date_to == "") date_to = date_from;
    start = $("#event-start").val();
    duration = $("#event-duration").val();
    price = $("#event-price").val();
    comment = $("#event-comment").val();
    if(date_from != "" && date_to != "") {
        $.ajax({
            type: 'POST',
            url: URL + 'api/setNewEvent/',
            data: ({func:"addEvent", section:section, title:title, description:description, eventlocation:eventlocation, pickup_location:pickup_location, date_from:date_from, date_to:date_to, start:start, duration:duration, price:price, comment:comment}),
            success: function (data) {
                var newDisplayDates = date_from.split("-");
                getCalendar('calendar_div', newDisplayDates[0], newDisplayDates[1]);
                $("#event-title").val("");
                $("#event-description").val("");
                $("#event-location").val("");
                $("#event-pickup_location").val("");
                $("#event-date-from").val("");
                $("#event-date-to").val("");
                $("#event-start").val("");
                $("#event-duration").val("");
                $("#event-price").val("");
                $("#event-comment").val("");
                $("#event-add-notification").html("Event added.").show().delay(3000).fadeOut('slow');;
            }
        });
    } else {
        $("#event-add-notification").html("Enter start date.");//.show().delay(3000).fadeOut('slow');
    }
}

function deleteEvent(eventId, date) {
    $.ajax({
        type: 'POST',
        url: 'include/functions.php',
        data: 'func=deleteEvent&eventid=' + eventId,
        success: function () {
            var newDisplayDates = date.split("-");
            getCalendar('calendar_div', newDisplayDates[0], newDisplayDates[1]);
        }
    });
}

function run() {
    $.ajax({
        type: 'POST',
        url: 'include/functions.php',
        data: 'func=runEvent',
        success: function () {
            $("#run-btn").fadeOut('slow');
        }
    });
}

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
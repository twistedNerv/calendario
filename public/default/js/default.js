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
    location = $("#event-location").val();
    date_from = $("#event-date-from").val();
    date_to = $("#event-date-to").val();
    if(date_to == "") date_to = date_from;
    start = $("#event-start").val();
    duration = $("#event-duration").val();
    discount = $("#event-discount").val();
    price = $("#event-price").val();
    comment = $("#event-comment").val();
    console.log(date_from);
    if(date_from != "" && date_to != "") {
        console.log("bla2");
        $.ajax({
            type: 'POST',
            url: URL + 'api/setNewEvent/',
            data: ({func:"addEvent", section:section, title:title, description:description, date_from:date_from, date_to:date_to, start:start, duration:duration, discount:discount, price:price, comment:comment}),
            success: function (data) {
                console.log(data);
                var newDisplayDates = date_from.split("-");
                getCalendar('calendar_div', newDisplayDates[0], newDisplayDates[1]);
                $("#event-date-from").val("");
                $("#event-date-to").val("");
                $("#event-notice").val("");
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
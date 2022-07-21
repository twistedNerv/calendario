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
    user_id = $("#user-picker").val();
    date_from = $("#event-date-from").val();
    date_to = $("#event-date-to").val();
    if(date_to == "") date_to = date_from;
    notice = $("#event-notice").val();
    console.log(date_from);
    if(date_from != "" && date_to != "") {
        $.ajax({
            type: 'POST',
            url: 'include/functions.php',
            data: ({func:"addEvent", user_id:user_id, date_from:date_from, date_to:date_to, notice:notice}),
            success: function () {
                var newDisplayDates = date_from.split("-");
                getCalendar('calendar_div', newDisplayDates[0], newDisplayDates[1]);
                $("#event-date-from").val("");
                $("#event-date-to").val("");
                $("#event-notice").val("");
                $("#event-add-notification").html("Odsotnost dodana.").show().delay(3000).fadeOut('slow');;
            }
        });
    } else {
        $("#event-add-notification").html("Vnesi prvi datum.").show().delay(3000).fadeOut('slow');
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
    console.log(eventId);
    $(eventId).toggle();
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
        }
        $('#event_list').slideUp('fast');
    });
});
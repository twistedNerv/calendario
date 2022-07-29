function getCalendar(target_div, year, month) {
    $.ajax({
        type: 'GET',
        url: URL + 'api/getCalendar/' + year + '/' + month,
        success: function (html) {
            $('#' + target_div).html(html);
        }
    });
}

function getAccomodationCalendar(target_div, year, month) {
    $.ajax({
        type: 'GET',
        url: URL + 'api/getAccomodationCalendar/' + year + '/' + month,
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

function getAccomodations(date) {
    $.ajax({
        type: 'GET',
        url: URL + 'api/getAccomodations/' + date,
        success: function (html) {
            $('#accomodation_list').html(html);
            $('#accomodation_list').slideDown('fast');
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
    var customervalues = $("input[name='customertoeventid[]']").map(function(){return $(this).val();}).get();
    var instructorvalues = $("input[name='instructortoeventid[]']").map(function(){return $(this).val();}).get();
    if(date_from != "" && date_to != "") {
        $.ajax({
            type: 'POST',
            url: URL + 'api/setNewEvent/',
            data: ({func:"addEvent", section:section, title:title, description:description, eventlocation:eventlocation, pickup_location:pickup_location, date_from:date_from, date_to:date_to, start:start, duration:duration, price:price, comment:comment, customervalues:customervalues, instructorvalues:instructorvalues}),
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
                $('#event-customers').find('div').remove()
                $('#event-instructors').find('div').remove()
                $("#event-add-notification").html("Event added.").show().delay(3000).fadeOut('slow');;
            }
        });
    } else {
        $("#event-add-notification").html("Enter start date.");//.show().delay(3000).fadeOut('slow');
    }
}

function editEvent(event) {
    $('#event_list').slideUp('fast');
    $('#add_event_section').slideUp('fast');
    $('#add_event_section').slideToggle()
    if (event != "") {
        $.ajax({
            type: 'GET',
            url: URL + 'event/getEvent/' + event,
            success: function (data) {
                event_data = $.parseJSON(data);
                console.log(event_data);
                $("#event-title").val(event_data.title);
                $("#event-description").append(event_data.description);
                $("#event-location").val(event_data.location);
                $("#event-pickup_location").val(event_data.pickup_location);
                $("#event-date-from").val(event_data.date);
                $("#event-date-to").val('');
                $("#event-start").val(event_data.start);
                $("#event-duration").val(event_data.duration);
                $("#event-price").val(event_data.price);
                $("#event-comment").val(event_data.comment);
                jQuery.each(event_data.customers, function(key, val) {
                    selectCustomer(val.name + " " + val.surname + "_" + val.id)
                });
            }
        });
    }
}

function deleteEvent(eventId, date) {
    $.ajax({
        type: 'POST',
        url: URL + 'api/removeEvent/' + eventId + '/' + date,
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

$(document).ready(function () {
    $("#event-customer-search").on('keyup', delay(function() {
        search_string = $("#event-customer-search").val();
        $.ajax({
            type: 'POST',
            url: URL + 'api/searchCustomer',
            data: ({search_string:search_string}),
            success: function (data) {
                $('.list-event-customer').hide().html(data).fadeIn("slow");
            }
        });
    }, 500))
    
    $("#event-instructor-search").on('keyup', delay(function() {
        search_string = $("#event-instructor-search").val();
        $.ajax({
            type: 'POST',
            url: URL + 'api/searchInstructor',
            data: ({search_string:search_string}),
            success: function (data) {
                $('.list-event-instructor').hide().html(data).fadeIn("slow");
            }
        });
    }, 500))
});
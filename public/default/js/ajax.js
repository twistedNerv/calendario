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

function openAdder(element) {
    clearEventAdder();
    $("#" + element).slideToggle();
}

function addEvent() {
    event_id = $("#event-id").val();
    section = $("#event-section").val();
    title = $("#event-title").val();
    description = $("#event-description").val();
    eventlocation = $("#event-location").val();
    pickup_location = $("#event-pickup_location").val();
    date_from = $("#event-date-from").val();
    start = $("#event-start").val();
    duration = $("#event-duration").val();
    price = $("#event-price").val();
    comment = $("#event-comment").val();
    var customervalues = $("input[name='customertoeventid[]']").map(function(){return $(this).val();}).get();
    var instructorvalues = $("input[name='instructortoeventid[]']").map(function(){return $(this).val();}).get();
    if(date_from != "") {
        $.ajax({
            type: 'POST',
            url: URL + 'api/setNewEvent/',
            data: ({func:"addEvent", event_id:event_id, section:section, title:title, description:description, eventlocation:eventlocation, pickup_location:pickup_location, date_from:date_from, start:start, duration:duration, price:price, comment:comment, customervalues:customervalues, instructorvalues:instructorvalues}),
            success: function (data) {
                var newDisplayDates = date_from.split("-");
                getCalendar('calendar_div', newDisplayDates[0], newDisplayDates[1]);
                clearEventAdder();
                $("#event-add-notification").html("Event added.").show().delay(3000).fadeOut('slow');
                $('#add_event_section').slideUp('fast');
            }
        });
    } else {
        $("#event-add-notification").html("Enter start date.");//.show().delay(3000).fadeOut('slow');
    }
}

function addAccomodation() {
    customer = $("#selected-customer-id").val();
    price = $("#accomodation-price").val();
    room = $("#accomodation-room").val();
    bed = $("#accomodation-bed").val();
    date_from = $("#accomodation-date-from").val();
    date_to = $("#accomodation-date-to").val();
    if(date_to == "") date_to = date_from;
    comment = $("#accomodation-comment").val();
    if(date_from != "" && date_to != "") {
        $.ajax({
            type: 'POST',
            url: URL + 'api/setNewAccomodation/',
            data: ({customer:customer, price:price, room:room, bed:bed, date_from:date_from, date_to:date_to, comment:comment}),
            success: function (data) {
                var newDisplayDates = date_from.split("-");
                getAccomodationCalendar('accomodation_calendar_div', newDisplayDates[0], newDisplayDates[1]);
                clearAccomodationAdder();
                $('#add_accomodation_section').slideUp('fast');
            }
        });
    } else {
        $("#event-add-notification").html("Enter start date.");
    }
}

function editEvent(event) {
    clearEventAdder();
    $('#event_list').slideUp('fast');
    $('#add_event_section').slideUp('fast');
    $('#add_event_section').slideToggle()
    if (event != "") {
        $.ajax({
            type: 'GET',
            url: URL + 'event/getEvent/' + event,
            success: function (data) {
                event_data = $.parseJSON(data);
                $("#event-id").val(event_data.id);
                $("#event-section").val(event_data.section).change();
                $("#event-title").val(event_data.title);
                $("#event-description").val(event_data.description);
                $("#event-location").val(event_data.location);
                $("#event-pickup_location").val(event_data.pickup_location);
                $("#event-date-from").val(event_data.date);
                $("#event-start").val(event_data.start);
                $("#event-duration").val(event_data.duration);
                $("#event-price").val(event_data.price);
                $("#event-comment").val(event_data.comment);
                jQuery.each(event_data.customers, function(key, val) {
                    selectCustomer(val.name + " " + val.surname + "_" + val.id)
                });
                jQuery.each(event_data.instructors, function(key, val) {
                    selectInstructor(val.name + " " + val.surname + "_" + val.id)
                });
            }
        });
    }
}

function clearEventAdder() {
    $("#event-id").val("");
    $("#event-title").val("");
    $("#event-description").val("");
    $("#event-location").val("");
    $("#event-pickup_location").val("");
    $("#event-date-from").val("");
    $("#event-start").val("");
    $("#event-duration").val("");
    $("#event-price").val("");
    $("#event-comment").val("");
    $('#event-customers').empty()
    $('#event-instructors').empty()
}

function clearAccomodationAdder() {
    $("#selected-customer-id").val('');
    $("#accomodation-customer-search").val('');
    $("#accomodation-price").val('');
    $("#accomodation-room").val('');
    $("#accomodation-bed").val('');
    $("#accomodation-date-from").val('');
    $("#accomodation-date-to").val('');
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

function deleteAccomodation(accomodationId, date) {
    console.log(accomodationId);
    $.ajax({
        type: 'POST',
        url: URL + 'api/removeAccomodation/' + accomodationId,
        success: function () {
            var newDisplayDates = date.split("-");
            getAccomodationCalendar('accomodation_calendar_div', newDisplayDates[0], newDisplayDates[1]);
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
    
    $("#accomodation-customer-search").on('keyup', delay(function() {
        search_string = $("#accomodation-customer-search").val();
        $.ajax({
            type: 'POST',
            url: URL + 'api/searchAccomodationCustomer',
            data: ({search_string:search_string}),
            success: function (data) {
                $('.list-accomodation-customer').hide().html(data).fadeIn("slow");
            }
        });
    }, 500))
    
    $("#accomodation-room").on('change', function(){
        optionSelected = $("option:selected", this).val();
        $.ajax({
            type: 'POST',
            url: URL + 'api/getSelectedBeds',
            data: ({room_id:optionSelected}),
            success: function (data) {
                $("#accomodation-bed").html('');
                $.each(data, function(key, val){
                    $("#accomodation-bed").append('<option value="'+val['id']+'">'+val['title']+'</option>');
                });
            }
        });
    });
});
function deleteConfirm(eventId) {
    $(".event-id").slideUp();
    $("#event-details-" . eventId).slideUp();
    $(eventId).slideDown();
}

function deleteAccomodationConfirm(accomodationId) {
    $(".accomodation-id").slideUp();
    $("#accomodation-details-" . accomodationId).slideUp();
    $(accomodationId).slideDown();
}

function deleteCancel() {
    $(".event-id").slideUp();
}

function deleteAccomodationCancel() {
    $(".accomodation-id").slideUp();
}

function toggleEventPopup(eventId) {
    $(eventId).slideToggle();
}

function toggleAccomodationPopup(accomodationId) {
    $(accomodationId).slideToggle();
}

function selectInstructor(instructor) {
    var instructorArray = instructor.split("_");
    var instructor_name = instructorArray[0];
    var instructor_id = instructorArray[1];
    $("#event-instructor-search").val("");
    $('.list-event-instructor').hide();
    code = "<div class='col-sm-12'>";
    code += "<div class='row'>";
    code += "<div class='col-sm-1 text-right'>";
    code += "<span onclick='removeinstructor( & quot;<?= $tempId ?> & quot; )' class='deletespan'><i class='fas fa-times' title='Remove instructor'></i></span></div>";
    code += "<div class='col-sm-10'><strong><input type='text' name='instructortoevent[]' class='readonlyinput' value='" + instructor_name + "' readonly></strong></div>";
    code += "<input type='hidden' name='instructortoeventid[]' class='readonlyinput' value='" + instructor_id + "' readonly></strong></div>";
    code += "</div></div>";
    $("#event-instructors").append(code);
}

function selectCustomer(customer) {
    var customerArray = customer.split("_");
    var customer_name = customerArray[0];
    var customer_id = customerArray[1];
    $("#event-customer-search").val("");
    $('.list-event-customer').hide();
    code = "<div class='col-sm-12'>";
    code += "<div class='row'>";
    code += "<div class='col-sm-1 text-right'>";
    code += "<span onclick='removecustomer( & quot;<?= $tempId ?> & quot; )' class='deletespan'><i class='fas fa-times' title='Remove customer'></i></span></div>";
    code += "<div class='col-sm-10'><strong><input type='text' name='customertoevent[]' class='diagnozaitem readonlyinput' value='" + customer_name + "' readonly></strong></div>";
    code += "<input type='hidden' name='customertoeventid[]' class='diagnozaitem readonlyinput' value='" + customer_id + "' readonly></strong></div>";
    code += "</div></div>";
    $("#event-customers").append(code);
}

function selectAccomodationCustomer(customer) {
    var customerArray = customer.split("_");
    var customer_name = customerArray[0];
    var customer_id = customerArray[1];
    $("#accomodation-customer-search").val(customer_name);
    $("#selected-customer-id").val(customer_id);
    $('.list-accomodation-customer').hide();
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
    /**************** accomodation ******************/
    $('#accomodation_calendar_div').delegate('.date_cell', 'mouseenter', function () {
        date = $(this).attr('date');
        $(".date_popup_wrap").fadeOut();
        $("#date_popup_" + date).fadeIn('fast');
    });
    $('#accomodation_calendar_div').delegate('.date_cell', 'mouseleave', function () {
        //$(".date_popup_wrap").fadeOut('fast');
        $(".date_popup_wrap").hide();
    });
    $('#accomodation_calendar_div').delegate('.accomodation_month_dropdown', 'change', function () {
        getAccomodationCalendar('accomodation_calendar_div', $('.accomodation_year_dropdown').val(), $('.accomodation_month_dropdown').val());
    });
    $('#accomodation_calendar_div').delegate('.accomodation_year_dropdown', 'change', function () {
        getAccomodationCalendar('accomodation_calendar_div', $('.accomodation_year_dropdown').val(), $('.accomodation_month_dropdown').val());
    });
    $(document).click(function (e) {
        if( $(e.target).closest("#event_list").length > 0 ) {
            return false;
        } else {
            $('#event_list').slideUp('fast');
        }
        if( $(e.target).closest("#accomodation_list").length > 0 ) {
            return false;
        } else {
            $('#accomodation_list').slideUp('fast');
        }
        if( $(e.target).closest("#add_event_section, #add_event_icon").length > 0 ) {
            return false;
        } else {
            $('#add_event_section').slideUp('fast');
        }
        if( $(e.target).closest("#add_accomodation_section").length > 0 ) {
            return false;
        } else {
            $('#add_accomodation_section').slideUp('fast');
        }
        
    });
});
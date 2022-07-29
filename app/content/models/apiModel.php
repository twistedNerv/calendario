<?php

//not really a model :P

class apiModel extends model {

    public function __construct() {
        parent::__construct();
    }
    
    private function displaySections() {
        $result = $this->db->prepare("SELECT * FROM section");
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCalendar($year = '', $month = '') {
        $dateYear = ($year != '') ? $year : date("Y");
        $dateMonth = ($month != '') ? sprintf("%02d", $month) : date("m");
        $date = $dateYear . '-' . $dateMonth . '-01';
        $currentMonthFirstDay = date("N", strtotime($date)) - 1;
        $totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN, $dateMonth, $dateYear);
        $totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7) ? ($totalDaysOfMonth) : ($totalDaysOfMonth + $currentMonthFirstDay);
        $boxDisplay = ($totalDaysOfMonthDisplay <= 35) ? 35 : 42;

        $calendar = "<div id='calender_section'>
                        <div class='col-sm-12'>
                            <div class='row'>
                                <div class='col-sm-3 text-left'>
                                    <a href='" . URL . "home/accomodation' id='swich_calendar_icon'>
                                        <i class='fa fa-bed'></i> accomodations
                                    </a>
                                </div>
                                <div class='col-sm-6 calendar-title'>
                                    Events
                                </div>
                                <div class='col-sm-3 text-right'>
                                    <a href='javascript:void(0);' id='add_event_icon' onclick='$(&quot;#add_event_section&quot;).slideToggle()'>
                                        add <i class='fa fa-calendar-plus'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class='h2custom'>
                        <a href='javascript:void(0);' onclick='getCalendar(&quot;calendar_div&quot;, &quot;" . date('Y', strtotime($date . ' - 1 Month')) . "&quot;, &quot;" . date('m', strtotime($date . ' - 1 Month')) . "&quot;);'>&lt;&lt;</a>
                        <select name='month_dropdown' class='month_dropdown dropdown'>" . $this->tools->getAllMonths($dateMonth) . "</select>
                        <select name='year_dropdown' class='year_dropdown dropdown'>" . $this->tools->getYearList($dateYear) . "</select>
                        <a href='javascript:void(0);' onclick='getCalendar(&quot;calendar_div&quot;, &quot;" . date("Y", strtotime($date . ' + 1 Month')) . "&quot;, &quot;" . date("m", strtotime($date . ' + 1 Month')) . "&quot;);'>&gt;&gt;</a>
                    </h2>
                    <div id='event_list' class='none'></div>
                    <div id='calender_section_top'>
                        <ul>
                            <li>Mon</li>
                            <li>Tue</li>
                            <li>Wed</li>
                            <li>Thu</li>
                            <li>Fri</li>
                            <li>Sat</li>
                            <li>Sun</li>
                        </ul>
                    </div>
                    <div id='calender_section_bot'>
                        <ul>";

        $dayCount = 1;
        for ($cb = 1; $cb <= $boxDisplay; $cb++) {
            if (($cb >= $currentMonthFirstDay + 1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)) {
                $currentDate = $dateYear . '-' . $dateMonth . '-' . sprintf("%02d", $dayCount);
                $eventNum = 0;
                $result = $this->db->prepare("SELECT * FROM event 
                                                INNER JOIN section ON event.section = section.id 
                                                WHERE date = :currentDate 
                                                ORDER BY date, start;");
                $result->bindParam(':currentDate', $currentDate);
                $result->execute();
                $result = $result->fetchAll(PDO::FETCH_ASSOC);
                $eventNum = count($result);
                if (strtotime($currentDate) == strtotime(date("Y-m-d"))) {
                    $calendar .= '<li date="' . $currentDate . '" class="grey date_cell">';
                } elseif ($eventNum > 0) {
                    $calendar .= '<li date="' . $currentDate . '" class="light_sky date_cell">';
                } else {
                    $calendar .= '<li date="' . $currentDate . '" class="date_cell">';
                }
                //Date cell
                $calendar .= '<span>';
                $calendar .= $dayCount;
                $calendar .= '</span>';
                if ($eventNum > 0) {
                    $counter = 1;
                    foreach ($result as $row) {
                        if ($counter <= 4) {
                            $hasNotice = ($row['comment'] != "") ? "*" : "";
                            $calendar .= '<span class="namespan" style="background-color:' . $row['color'] . ';color:' . $this->template->readableColour($row['color']) . ';">';
                            $calendar .= $row['start'] . '<br>' . $row['title'] . $hasNotice;
                            $calendar .= '</span>';
                        } else {
                            $calendar .= '<span class="namespan" style="font-size:20px;font-weight:bold;line-height:0px;position:relative;top:-2px;">...</span>';
                            break;
                        }
                        $counter++;
                    }
                }

                //Hover event popup

                if ($eventNum > 0) {
                    $odsotnostGrammar = ($eventNum != 1) ? "events" : "event";
                    $calendar .= '<div id="date_popup_' . $currentDate . '" class="date_popup_wrap none" onclick="getEvents(\'' . $currentDate . '\');">';
                    $calendar .= '<div class="date_window">';
                    $calendar .= '<div class="popup_event">' . $eventNum . ' ' . $odsotnostGrammar . '</div>';
                } else {
                    $calendar .= '<div id="date_popup_' . $currentDate . '" class="date_popup_wrap none" onclick="getEvents(\'' . $currentDate . '\');">';
                    $calendar .= '<div class="date_window">';
                    $calendar .= '<div class="popup_event">No events</div>';
                }
                //echo ($eventNum > 0) ? '<a href="javascript:;" onclick="getEvents(\'' . $currentDate . '\');">view events</a>' : '';
                $calendar .= '</div></div>';

                $calendar .= '</li>';
                $dayCount++;
            } else {
                $calendar .= "<li><span>&nbsp;</span></li>";
            }
        }
        $calendar .= "
                </ul>
            </div>
        </div>";
        return $calendar;
    }

    public function getEvents($date) {
        $eventListHTML = '';
        $date = $date ? $date : date("Y-m-d");
        $result = $this->db->prepare("SELECT event.id as event_id,
                                        event.title as event_title,
                                        event.description as description,
                                        event.start as event_start, 
                                        event.duration as event_duration, 
                                        event.location as event_location, 
                                        event.price as event_price, 
                                        event.comment as event_comment, 
                                        event.pickup_location as event_pickup_location, 
                                        section.color as color,
                                        section.title as section_title
                                        FROM event 
                                        INNER JOIN section ON event.section = section.id
                                        WHERE date = '" . $date . "' ORDER BY event_start");
        $result->execute();
        //echo "<pre>";$result->debugDumpParams();die;
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $eventNum = count($result);
        $eventListHTML = '<div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 text-left">
                                    <!--a href="' . URL . 'event/update" target="_blank">
                                        <i class="fa fa-plus-circle event-icon"></i></a -->
                                </div>
                                <div class="col-sm-6 text-center">
                                    <strong>Events: ' . date("d M Y", strtotime($date)) . '</strong>
                                </div>
                                <div class="col-sm-3 text-right">
                                    
                                </div>
                            </div>
                        </div>';
        if ($eventNum <= 0) {
            $eventListHTML .= '<div style="margin: 60px 0;text-align: center;">
                                    No events on selected day
                                </div>';
        } else {
            foreach ($result as $row) {
                $customers = $this->db->prepare('SELECT customer.name as name, customer.surname as surname
                                                    FROM event_customer 
                                                    INNER JOIN customer ON customer.id = event_customer.customer_id
                                                    WHERE event_id = :event_id
                                                    ORDER BY name');
                $customers->bindParam(':event_id', $row['event_id']);
                $customers->execute();
                $customers = $customers->fetchAll(PDO::FETCH_ASSOC);
                
                $instructors = $this->db->prepare('SELECT instructor.name as name, instructor.surname as surname
                                                    FROM event_instructor 
                                                    INNER JOIN instructor ON instructor.id = event_instructor.instructor_id
                                                    WHERE event_id = :event_id
                                                    ORDER BY name');
                $instructors->bindParam(':event_id', $row['event_id']);
                $instructors->execute();
                $instructors = $instructors->fetchAll(PDO::FETCH_ASSOC);
                
                $dateString = "'" . $date . "'";
                $event = "'#event-" . $row['event_id'] . "'";
                $eventListHTML .= '<div class="col-sm-12" style="background-color:' . $row['color'] . ';line-height:30px;">
                                        <div class="row">
                                            <div class="col-sm-12 event-list-content-section">
                                                <a href="javascript:" onclick="deleteConfirm(' . $event . ');" class="delete-btn-style" style="float:left; padding-top: 2px;">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                                <a href="javascript:" onclick="editEvent(' . $row['event_id'] . ');" class="delete-btn-style" style="float:left; padding-top: 0px;">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <div class="event-details-popup-wrapper text-left" style="float:left" onclick="toggleEventPopup(&#39;#event-details-' . $row['event_id'] . '&#39;)">
                                                    <strong class="lower-3">' . $row['event_title'] . '</strong> <i style="font-size: 12px;" class="lower-3"> at ' . $row['event_start'] . '</i>
                                                    <div id="event-details-' . $row['event_id'] . '" class="event-details-popup col-sm-12"><hr>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class=" text-left">
                                                                    <strong>Event:</strong><br>
                                                                    ' . $row['description'] . '<br><br>
                                                                    Pickup location: <strong>' . $row['event_pickup_location'] . '</strong><br>
                                                                    Location: <strong>' . $row['event_location'] . '</strong><br>
                                                                    Duration: <strong>' . $row['event_duration'] . ' hour(s)</strong><br>
                                                                    Price: <strong>' . $row['event_price'] . ' €</strong><br>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 text-left">
                                                                <strong>Participants:</strong><br>';
                                                                foreach ($customers as $singleCustomer)    {
                                                                    $eventListHTML .= '<a href="">' . $singleCustomer['name'] . ' ' . $singleCustomer['surname'] . '</a><br>';
                                                                }
                $eventListHTML .=                           '</div>
                                                            <div class="col-sm-4 text-left">
                                                                <strong>Instructors:</strong><br>';
                                                               foreach ($instructors as $singleInstructor)    {
                                                                    $eventListHTML .= '<a href="">' . $singleInstructor['name'] . ' ' . $singleInstructor['surname'] . '</a><br>';
                                                                }
                $eventListHTML .=                           '</div>
                                                            <div class="col-sm-12">
                                                                <hr>
                                                                Comment:<br>' . $row['event_comment'] . '<br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="event-' . $row['event_id'] . '" class="event-id none">
                                        <div style="padding:10px;">Res želiš brisat? <span class="delete-dialog" onclick="deleteEvent(' . $row['event_id'] . ', ' . $dateString . ');">DA</span> <span class="delete-dialog" onclick="deleteCancel();">NE</span></div>
                                    </div>';
            }
        }
        return $eventListHTML;
    }
    
    public function setNewEvent() {
        return $_POST;
    }
    
    public function searchCustomer($searchString) {
        $result = $this->db->prepare("SELECT * FROM customer WHERE name LIKE :searchstring OR surname LIKE :searchstring LIMIT 10");
        $result->bindParam(':searchstring', $searchString);
        $result->execute();
        //echo "<pre>";$result->debugDumpParams();die;
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $count = count($result);
        //echo $count;
        $output = "<div id='tmpbox' class='tmpbox'>";
        $output .= "<ul class='tmpbox-wrapper'>";
        foreach ($result as $singleRow) {
        //while($singleRow = $result->fetchAll(PDO::FETCH_ASSOC)) {
            $output .= "<li class='tmpbox-single-result' onclick='selectCustomer(&#39;" . $singleRow['name'] . " " . $singleRow['surname'] . "_" . $singleRow['id'] . "&#39;)'>" . $singleRow['name'] . " " . $singleRow['surname'] . "</li>";
        }
        $output .= "</ul></div>";
        return $output;
    }
    
    public function searchInstructor($searchString) {
        $result = $this->db->prepare("SELECT * FROM instructor WHERE name LIKE :searchstring OR surname LIKE :searchstring LIMIT 10");
        $result->bindParam(':searchstring', $searchString);
        $result->execute();
        //echo "<pre>";$result->debugDumpParams();die;
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $count = count($result);
        //echo $count;
        $output = "<div id='tmpbox' class='tmpbox'>";
        $output .= "<ul class='tmpbox-wrapper'>";
        foreach ($result as $singleRow) {
        //while($singleRow = $result->fetchAll(PDO::FETCH_ASSOC)) {
            $output .= "<li class='tmpbox-single-result' onclick='selectInstructor(&#39;" . $singleRow['name'] . " " . $singleRow['surname'] . "_" . $singleRow['id'] . "&#39;)'>" . $singleRow['name'] . " " . $singleRow['surname'] . "</li>";
        }
        $output .= "</ul></div>";
        return $output;
    }
    
    public function deleteEvent($event_id) {
        $result = $this->db->prepare('DELETE FROM event WHERE id = :event_id');
        $result->bindParam(':event_id', $event_id);
        $result->execute();
        $result = $this->db->prepare('DELETE FROM event_customer WHERE event_id = :event_id');
        $result->bindParam(':event_id', $event_id);
        $result->execute();
        $result = $this->db->prepare('DELETE FROM event_instructor WHERE event_id = :event_id');
        $result->bindParam(':event_id', $event_id);
        $result->execute();
    }
    
    /**************************** ACCOMODATION **********************************/
    public function getAccomodationCalendar($year = '', $month = '') {
        $dateYear = ($year != '') ? $year : date("Y");
        $dateMonth = ($month != '') ? sprintf("%02d", $month) : date("m");
        $date = $dateYear . '-' . $dateMonth . '-01';
        $currentMonthFirstDay = date("N", strtotime($date)) - 1;
        $totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN, $dateMonth, $dateYear);
        $totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7) ? ($totalDaysOfMonth) : ($totalDaysOfMonth + $currentMonthFirstDay);
        $boxDisplay = ($totalDaysOfMonthDisplay <= 35) ? 35 : 42;

        $calendar = "<div id='calender_section'>
                        <div class='col-sm-12'>
                            <div class='row'>
                                <div class='col-sm-3 text-left'>
                                    <a href='" . URL . "home/index' id='swich_calendar_icon'>
                                        <i class='fa fa-spa'></i> events
                                    </a>
                                </div>
                                <div class='col-sm-6 calendar-title'>
                                    Accomodation
                                </div>
                                <div class='col-sm-3 text-right'>
                                    <a href='javascript:void(0);' id='add_event_icon' onclick='$(&quot;#add_accomodation_section&quot;).slideToggle()'>
                                        <i class='fa fa-calendar-plus'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            <h2 class='h2custom'>
                <a href='javascript:void(0);' onclick='getAccomodationCalendar(&quot;calendar_div&quot;, &quot;" . date('Y', strtotime($date . ' - 1 Month')) . "&quot;, &quot;" . date('m', strtotime($date . ' - 1 Month')) . "&quot;);'>&lt;&lt;</a>
                <select name='month_dropdown' class='month_dropdown dropdown'>" . $this->tools->getAllMonths($dateMonth) . "</select>
                <select name='year_dropdown' class='year_dropdown dropdown'>" . $this->tools->getYearList($dateYear) . "</select>
                <a href='javascript:void(0);' onclick='getAccomodationCalendar(&quot;calendar_div&quot;, &quot;" . date("Y", strtotime($date . ' + 1 Month')) . "&quot;, &quot;" . date("m", strtotime($date . ' + 1 Month')) . "&quot;);'>&gt;&gt;</a>
                
            </h2>
            <div id='accomodation_list' class='none'></div>
            <div id='calender_section_top'>
                <ul>
                    <li>Mon</li>
                    <li>Tue</li>
                    <li>Wed</li>
                    <li>Thu</li>
                    <li>Fri</li>
                    <li>Sat</li>
                    <li>Sun</li>
                </ul>
            </div>
            <div id='calender_section_bot'>
                <ul>";

        $dayCount = 1;
        for ($cb = 1; $cb <= $boxDisplay; $cb++) {
            if (($cb >= $currentMonthFirstDay + 1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)) {
                $currentDate = $dateYear . '-' . $dateMonth . '-' . sprintf("%02d", $dayCount);
                $eventNum = 0;
                $result = $this->db->prepare("SELECT * FROM accomodation
                                                INNER JOIN customer ON accomodation.customer_id = customer.id
                                                INNER JOIN bed ON bed.id = accomodation.bed_id
                                                INNER JOIN room ON bed.room_id = room.id
                                                WHERE '" . $currentDate . "' between date_start and date_end;");
                $result->execute();
                $result = $result->fetchAll(PDO::FETCH_ASSOC);
                $eventNum = count($result);
                if (strtotime($currentDate) == strtotime(date("Y-m-d"))) {
                    $calendar .= '<li date="' . $currentDate . '" class="grey date_cell">';
                } elseif ($eventNum > 0) {
                    $calendar .= '<li date="' . $currentDate . '" class="light_sky date_cell">';
                } else {
                    $calendar .= '<li date="' . $currentDate . '" class="date_cell">';
                }
                //Date cell
                $calendar .= '<span>';
                $calendar .= $dayCount;
                $calendar .= '</span>';
                if ($eventNum > 0) {
                    $counter = 1;
                    foreach ($result as $row) {
                        if ($counter <= 8) {
                            $hasNotice = ($row['comment'] != "") ? "*" : "";
                            $calendar .= '<span class="namespan" style="background-color:' . $row['color'] . ';color:' . $this->template->readableColour($row['color']) . ';">';
                            $calendar .= $row['name'] . ' ' . $row['surname'] . $hasNotice;
                            $calendar .= '</span>';
                        } else {
                            $calendar .= '<span class="namespan" style="font-size:20px;font-weight:bold;line-height:0px;position:relative;top:-2px;">...</span>';
                            break;
                        }
                        $counter++;
                    }
                }

                //Hover event popup

                if ($eventNum > 0) {
                    $odsotnostGrammar = ($eventNum != 1) ? "beds full" : "bed full";
                    $calendar .= '<div id="date_popup_' . $currentDate . '" class="date_popup_wrap none" onclick="getAccomodations(\'' . $currentDate . '\');">';
                    $calendar .= '<div class="date_window">';
                    $calendar .= '<div class="popup_event">' . $eventNum . ' ' . $odsotnostGrammar . '</div>';
                } else {
                    $calendar .= '<div id="date_popup_' . $currentDate . '" class="date_popup_wrap none" onclick="getAccomodations(\'' . $currentDate . '\');">';
                    $calendar .= '<div class="date_window">';
                    $calendar .= '<div class="popup_event">Empty</div>';
                }
                //echo ($eventNum > 0) ? '<a href="javascript:;" onclick="getEvents(\'' . $currentDate . '\');">view events</a>' : '';
                $calendar .= '</div></div>';

                $calendar .= '</li>';
                $dayCount++;
            } else {
                $calendar .= "<li><span>&nbsp;</span></li>";
            }
        }
        $calendar .= "
                </ul>
            </div>
        </div>";
        return $calendar;
    }
    
    public function getAccomodations($date) {
        $eventListHTML = '';
        $date = $date ? $date : date("Y-m-d");
        $result = $this->db->prepare("SELECT * FROM accomodation
                                        INNER JOIN customer ON accomodation.customer_id = customer.id
                                        INNER JOIN bed ON bed.id = accomodation.bed_id
                                        INNER JOIN room ON bed.room_id = room.id
                                        WHERE '" . $date . "' between date_start and date_end;");
        $result->execute();
        //echo "<pre>";$result->debugDumpParams();die;
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $accomodationNum = count($result);
        $accomodationListHTML = '<div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 text-left">
                                    <!--a href="' . URL . 'accomodation/update" target="_blank">
                                        <i class="fa fa-plus-circle accomodation-icon"></i></a -->
                                </div>
                                <div class="col-sm-6 text-center">
                                    <strong>Accomodations on ' . date("d M Y", strtotime($date)) . '</strong>
                                </div>
                                <div class="col-sm-3 text-right">
                                    
                                </div>
                            </div>
                        </div>';
        if ($accomodationNum <= 0) {
            $accomodationListHTML .= '<div style="margin: 60px 0;text-align: center;">
                                    No accomodations on selected day
                                </div>';
        } else {
            foreach ($result as $row) {
                $dateString = "'" . $date . "'";
                $accomodation = "'#accomodation-" . $row['id'] . "'";
                $accomodationListHTML .= '<div class="col-sm-12" style="background-color:' . $row['color'] . ';line-height:30px;">
                                        <div class="row">
                                            <div class="col-sm-12 accomodation-list-content-section">
                                                <a href="javascript:" onclick="deleteAccomodationConfirm(' . $accomodation . ');" class="delete-btn-style" style="float:left; padding-top: 2px;">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                                <a href="javascript:" onclick="editAccomodation(' . $row['id'] . ');" class="delete-btn-style" style="float:left; padding-top: 0px;">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <div class="accomodation-details-popup-wrapper text-left" style="float:left" onclick="toggleAccomodationPopup(&#39;#accomodation-details-' . $row['id'] . '&#39;)">
                                                    <strong class="lower-3">' . $row['name'] . " " . $row['surname'] . '</strong>
                                                    <div id="accomodation-details-' . $row['id'] . '" class="accomodation-details-popup col-sm-12"><hr>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class=" text-left">
                                                                    <strong>Accomodation:</strong><br>
                                                                    ' . $row['description'] . '<br><br>
                                                                    
                                                                </div>
                                                            </div>';
                $accomodationListHTML .=                           '</div>
                                                            <div class="col-sm-12">
                                                                <hr>
                                                                Comment:<br>' . $row['comment'] . '<br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accomodation-' . $row['id'] . '" class="accomodation-id none">
                                        <div style="padding:10px;">Res želiš brisat? <span class="delete-dialog" onclick="deleteAccomodation(' . $row['id'] . ', ' . $dateString . ');">DA</span> <span class="delete-dialog" onclick="deleteCancel();">NE</span></div>
                                    </div>';
            }
        }
        return $accomodationListHTML;
    }
}

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
            <h2>
                <a href='javascript:void(0);' onclick='getCalendar(&quot;calendar_div&quot;, &quot;" . date('Y', strtotime($date . ' - 1 Month')) . "&quot;, &quot;" . date('m', strtotime($date . ' - 1 Month')) . "&quot;);'>&lt;&lt;</a>
                <select name='month_dropdown' class='month_dropdown dropdown'>" . $this->tools->getAllMonths($dateMonth) . "</select>
                <select name='year_dropdown' class='year_dropdown dropdown'>" . $this->tools->getYearList($dateYear) . "</select>
                <a href='javascript:void(0);' onclick='getCalendar(&quot;calendar_div&quot;, &quot;" . date("Y", strtotime($date . ' + 1 Month')) . "&quot;, &quot;" . date("m", strtotime($date . ' + 1 Month')) . "&quot;);'>&gt;&gt;</a>
                <a href='javascript:void(0);' id='add_event_icon' onclick='$(&quot;#add_event_section&quot;).slideToggle()'>Add event</a>
                
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
                $result = $this->db->prepare("SELECT * FROM event INNER JOIN section ON event.section = section.title WHERE date = :currentDate ORDER BY date, start;");
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
                        if ($counter <= 5) {
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
        /*
         * customer.id as cust_id, 
                                    customer.hash as cust_hash, 
                                    customer.name as cust_name, 
                                    customer.surname as cust_surname, 
                                    customer.gender as cust_gender, 
                                    customer.address as cust_address, 
                                    customer.city as cust_city, 
                                    customer.country as cust_country, 
                                    customer.phone as cust_phone, 
                                    customer.email as cust_email, 
                                    customer.comment as cust_comment, 
         */
        $result = $this->db->prepare("SELECT event.id as event_id,
                                        event.title as event_title,
                                        event.description as description,
                                        event.start as event_start, 
                                        event.duration as event_duration, 
                                        event.location as event_location, 
                                        event.discount as event_discount, 
                                        event.price as event_price, 
                                        event.comment as event_comment, 
                                        event.pickup_location as event_pickup_location, 
                                        section.color as color
                                        FROM event 
                                        INNER JOIN section ON event.section = section.title
                                        WHERE date = '" . $date . "'");
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $eventNum = count($result);
        
        $eventListHTML = '<div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 text-left">
                                    <a href="' . URL . 'event/update" target="_blank">
                                        <i class="fa fa-plus-circle event-icon"></i></a>Add event
                                </div>
                                <div class="col-sm-6 text-center">
                                    <strong>Events: ' . date("d M Y", strtotime($date)) . '</strong>
                                </div>
                                <div class="col-sm-3 text-right">
                                    here be views
                                </div>
                            </div>
                        </div>';
        if ($eventNum <= 0) {
            $eventListHTML .= '<div style="margin: 60px 0;text-align: center;">
                                    No events on selected day
                                </div>';
        } else {
            foreach ($result as $row) {
                $dateString = "'" . $date . "'";
                $event = "'#event-" . $row['event_id'] . "'";
                $eventListHTML .= '<div style="background-color:' . $row['color'] . ';line-height:30px;">
                                        <a href="javascript:" onclick="deleteConfirm(' . $event . ');" class="delete-btn-style" style="float:left; padding-top: 2px;">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <div class="event-details-popup-wrapper" style="float:left" onclick="toggleEventPopup(&#39;#event-details-' . $row['event_id'] . '&#39;)">
                                            <strong>' . $row['event_title'] . '</strong> <i style="font-size: 12px;"> at ' . $row['event_start'] . '</i>
                                            <div id="event-details-' . $row['event_id'] . '" class="event-details-popup">
                                                <hr><i>' . $row['description'] . '<br></i>
                                                Pickup location: <strong>' . $row['event_pickup_location'] . '</strong><br>
                                                Location: <strong>' . $row['event_location'] . '</strong><br>
                                                Duration: <strong>' . $row['event_duration'] . ' hour(s)</strong><br>
                                                Discount: <strong>' . $row['event_discount'] . ' %</strong><br>
                                                Price: <strong>' . $row['event_price'] . ' €</strong><br>
                                                <hr>
                                                Comment:<br>' . $row['event_comment'] . '<br>
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
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

}

<?php

//not really a model :P

class apiModel extends model {

    public function __construct() {
        parent::__construct();
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
                $result = $this->db->prepare("SELECT * FROM event WHERE date = :currentDate ORDER BY date, start;");
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
                            $calendar .= '<span class="namespan" style="background-color:#' . $this->config->section[$row['section']] . ';color:' . $this->template->readableColour($this->config->section[$row['section']]) . ';">';
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
                    $calendar .= '<div id="date_popup_' . $currentDate . '" class="date_popup_wrap none">';
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
                                        event.title as event_title
                                        FROM event 
                                        WHERE date = '" . $date . "'");
         $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $eventNum = count($result);
        echo $eventNum . "<---";
        if ($eventNum > 0) {
            $eventListHTML = '<h2>Odsotnosti: ' . date("d M Y", strtotime($date)) . '</h2>';
            $eventListHTML .= '<ul style="list-style-type: none;padding:0;">';
            foreach ($result as $row) {
                $dateString = "'" . $date . "'";
                $event = "'#event-" . $row['event_id'] . "'";
                $eventListHTML .= '<li style="background-color:' . $row['bg'] . ';line-height:30px;color:' . $row['font'] . '" class="font-light-' . $row['fontlight'] . '"><a href="javascript:" onclick="deleteConfirm(' . $event . ');" class="delete-btn-style" style="background-color: white;box-shadow: inset 0 0 7px 6px ' . $row['bg'] . ';">
                            <img src="public/img/del.png" style="width:20px;margin-right:5px;margin-left:6px;" title="Briši odsotnost"></a>
                            <strong>' . $row['username'] . '</strong> <i style="font-size: 13px;">' . nl2br($row['enotice']) . '</i></li>
                            <li id="event-' . $row['eventId'] . '" class="event-id none">
                                <div style="padding:10px;">Res želiš brisat? <span class="delete-dialog" onclick="deleteEvent(' . $row['eventId'] . ', ' . $dateString . ');">DA</span> <span class="delete-dialog" onclick="deleteCancel();">NE</span></div>
                            </li>
                            ';
            }
            $eventListHTML .= '</ul>';
        }
        return $eventListHTML;
    }

}

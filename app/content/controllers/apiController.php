<?php

class apiController extends controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function getCalendarAction($year = '', $month = '') {
        $apiModel = $this->loadModel('api');
        echo $apiModel->getCalendar($year, $month);
    }
    
    public function getAccomodationCalendarAction($year = '', $month = '') {
        $apiModel = $this->loadModel('api');
        echo $apiModel->getAccomodationCalendar($year, $month);
    }
    
    public function getEventsAction($date) {
        $apiModel = $this->loadModel('api');
        echo $apiModel->getEvents($date);
    }
    
    public function getAccomodationsAction($date) {
        $apiModel = $this->loadModel('api');
        echo $apiModel->getAccomodations($date);
    }
    
    public function setNewEventAction () {
        $eventModel = $this->loadModel('event');
        if ($this->tools->getPost("event_id") != "") {
            $eventModel->getOneBy("id", $this->tools->getPost("event_id"));
        }
        if (isset($_POST['title']) && $_POST['title'] != "") {
            $eventModel->setSection($this->tools->getPost("section"));
            $eventModel->setTitle($this->tools->getPost("title"));
            $eventModel->setDescription($this->tools->getPost("description"));
            $eventModel->setDate($this->tools->getPost("date_from"));
            $eventModel->setStart($this->tools->getPost("start"));
            $eventModel->setDuration($this->tools->getPost("duration"));
            $eventModel->setLocation($this->tools->getPost("eventlocation"));
            $eventModel->setPickup_location($this->tools->getPost("pickup_location"));
            $eventModel->setPrice($this->tools->getPost("price"));
            $eventModel->setComment($this->tools->getPost("comment"));
            $eventModel->flush();
            $this->tools->log("api", "Event element with title:" . $this->tools->getPost("title") . " event successfully added.");
            
            $lastEventId = (isset($_POST['event_id']) && !empty($_POST['event_id'])) ? $_POST['event_id'] : $eventModel->getLast('id');
            
            $apiModel = $this->loadModel('api');
            $apiModel->deleteCustomersFromEvent($lastEventId);
            $apiModel->deleteInstructorsFromEvent($lastEventId);
            $customerValues = array_unique($_POST['customervalues']);
            $instructorValues = array_unique($_POST['instructorvalues']);
            if (isset($customerValues) && !empty($customerValues)) {
                $event_customerModel = $this->loadModel('event_customer');
                foreach ($customerValues as $singleCustomerId) {
                    $event_customerModel->setEvent_id($lastEventId);
                    $event_customerModel->setCustomer_id($singleCustomerId);
                    $event_customerModel->flush();
                }
            }
            if (isset($instructorValues) && !empty($instructorValues)) {
                $event_instructorModel = $this->loadModel('event_instructor');
                foreach ($instructorValues as $singleInstructorId) {
                    $event_instructorModel->setEvent_id($lastEventId);
                    $event_instructorModel->setInstructor_id($singleInstructorId);
                    $event_instructorModel->flush();
                }
            }
        }
        //echo $apiModel->setNewEvent();
    }
    
    public function setNewAccomodationAction() {
        $accomodationModel = $this->loadModel('accomodation');
        if (isset($_POST['customer']) && $_POST['customer'] != '') {
            $accomodationModel->setCustomer_id($this->tools->getPost("customer"));
            $accomodationModel->setPrice($this->tools->getPost("price"));
            $accomodationModel->setRoom_id($this->tools->getPost("room"));
            $accomodationModel->setBed_id($this->tools->getPost("bed"));
            $accomodationModel->setDate_start($this->tools->getPost("date_from"));
            $accomodationModel->setDate_end($this->tools->getPost("date_to"));
            $accomodationModel->setComment($this->tools->getPost("comment"));
            $accomodationModel->flush();
            $this->tools->log("api", "Accomodation from " . $this->tools->getPost("date_from") . " to " . $this->tools->getPost("date_to") . " successfully added.");
        }
    }

    public function searchCustomerAction () {
        $apiModel = $this->loadModel('api');
        $searchString = "%" . $this->tools->getPost('search_string') . "%";
        echo $apiModel->searchCustomer($searchString);
    }
    
    public function searchInstructorAction () {
        $apiModel = $this->loadModel('api');
        $searchString = "%" . $this->tools->getPost('search_string') . "%";
        echo $apiModel->searchInstructor($searchString);
    }
    
    public function searchAccomodationCustomerAction () {
        $apiModel = $this->loadModel('api');
        $searchString = "%" . $this->tools->getPost('search_string') . "%";
        echo $apiModel->searchAccomodationCustomer($searchString);
    }
    
    public function removeEventAction($event_id) {
        $apiModel = $this->loadModel('api');
        $apiModel->deleteEvent($event_id);
    }
    
    public function removeAccomodationAction($accomodation_id) {
        $accomodationModel = $this->loadModel('accomodation');
        $accomodation = $accomodationModel->getOneBy('id', $accomodation_id);
        $accomodation->remove();
    }
    
    public function getSelectedBedsAction() {
        $room_id = $this->tools->getPost('room_id');
        $bedModel = $this->loadModel('bed');
        $beds = $bedModel->getAllBy('room_id', $room_id);
        header('Content-type: application/json');
        echo json_encode((array)$beds);
    }
}

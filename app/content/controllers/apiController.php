<?php

class apiController extends controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function getCalendarAction($year = '', $month = '') {
        $apiModel = $this->loadModel('api');
        echo $apiModel->getCalendar($year, $month);
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
            
            $lastEventId = $eventModel->getLast('id');
            if (isset($_POST['customervalues']) && !empty($_POST['customervalues'])) {
                $event_customerModel = $this->loadModel('event_customer');
                foreach ($_POST['customervalues'] as $singleCustomerId) {
                    $event_customerModel->setEvent_id($lastEventId);
                    $event_customerModel->setCustomer_id($singleCustomerId);
                    $event_customerModel->flush();
                }
            }
            if (isset($_POST['instructorvalues']) && !empty($_POST['instructorvalues'])) {
                $event_instructorModel = $this->loadModel('event_instructor');
                foreach ($_POST['instructorvalues'] as $singleInstructorId) {
                    $event_instructorModel->setEvent_id($lastEventId);
                    $event_instructorModel->setInstructor_id($singleInstructorId);
                    $event_instructorModel->flush();
                }
            }
        }
        //echo $apiModel->setNewEvent();
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
    
    public function removeEventAction($event_id) {
        $apiModel = $this->loadModel('api');
        $apiModel->deleteEvent($event_id);
    }
}

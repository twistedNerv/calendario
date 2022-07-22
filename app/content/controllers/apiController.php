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
    
    public function setNewEventAction () {
        $eventModel = $this->loadModel('event');
        var_dump($_POST);
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
        }
        echo $apiModel->setNewEvent();
    }

    public function searchCustomerAction () {
        $searchString = "%" . $this->tools->getPost('search_string') . "%";
        echo $searchString;
    }
}

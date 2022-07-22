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
        $apiModel = $this->loadModel('api');
        $this->loadModel('event');
        if (isset($_POST['title']) && $_POST['title'] != "") {
            
        }
        echo $apiModel->setNewEvent();
    }

}

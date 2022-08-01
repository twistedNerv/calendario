<?php

class homeController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function indexAction() {
        $sectionModel = $this->loadModel('section');
        $sections = $sectionModel->getAll();
        $apiModel = $this->loadModel('api');
        $calendar = $apiModel->getCalendar();
        $this->view->assign("sections", $sections);
        $this->view->assign("calendar", $calendar);
        $this->view->render("home/index");
        //$this->view->render("api/getCalendarAction/2022/07", false);
    }
    
    public function accomodationAction() {
        $accomodationModel = $this->loadModel('accomodation');
        $accomodations = $accomodationModel->getAll();
        $apiModel = $this->loadModel('api');
        $accomodationCalendar = $apiModel->getAccomodationCalendar();
        $roomModel = $this->loadModel('room');
        $rooms = $roomModel->getAll();
        $this->view->assign("rooms", $rooms);
        $this->view->assign("accomodations", $accomodations);
        $this->view->assign("accomodation_calendar", $accomodationCalendar);
        $this->view->render("home/accomodation");
        //$this->view->render("api/getCalendarAction/2022/07", false);
    }
    
    public function guestAction($hash) {
        $customerModel = $this->loadModel('customer');
        $customer = $customerModel->getOneBy('hash', $hash);
        $event_customerModel = $this->loadModel('event_customer');
        $events_cust = $event_customerModel->getAllBy('customer_id', $customer->id);
        $events = [];
        foreach ($events_cust as $singleEvent) {
            $eventModel = $this->loadModel('event');
            array_push($events, $eventModel->getOneBy('id', $singleEvent['event_id']));
        }
        $this->view->assign("events", $events);
        $this->view->assign("sections", $this->setSectionArray());
        $this->view->render("home/guest", false);
    }
    
    private function setSectionArray() {
        $sectionModel = $this->loadModel('section');
        $sections = $sectionModel->getAll();
        $result = [];
        foreach ($sections as $singleSection) {
            $result[$singleSection['id']] = $singleSection;
        }
        return $result;
    }
}

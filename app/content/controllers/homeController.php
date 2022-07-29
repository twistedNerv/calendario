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
        $this->view->assign("accomodations", $accomodations);
        $this->view->assign("accomodation_calendar", $accomodationCalendar);
        $this->view->render("home/accomodation");
        //$this->view->render("api/getCalendarAction/2022/07", false);
    }
}

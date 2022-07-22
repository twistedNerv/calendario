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

    

}

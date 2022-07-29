<?php

class bedController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function indexAction($id = 0) {
        $bedModel = $this->loadModel('bed');
        $bedObj = $bedModel->getAll();
        $this->view->assign('vars', get_class_vars('bedModel'));
        $this->view->assign('items', $bedObj);
        $this->view->render("bed/index");
    }

    public function updateAction($id = 0) {
        $this->tools->checkPageRights(4);
        $bedModel = $this->loadModel('bed');
        $roomModel = $this->loadModel('room');
        $rooms = $roomModel->getAll();

        if ($id != 0) {
            $bedModel->getOneBy("id", $id);
        }
        if ($this->tools->getPost("action") == "handlebed") {
            $bedModel->setRoom_id($this->tools->getPost("bed-room_id"));
            $bedModel->setTitle($this->tools->getPost("bed-title"));
            $bedModel->setDescription($this->tools->getPost("bed-description"));
            $bedModel->setBed_type($this->tools->getPost("bed-bed_type"));
            $bedModel->flush();
            $action = ($id != 0) ? "Bed element with id: $id updated successfully." : "bed successfully added.";
            $this->tools->log("bed", $action);
            if ($id == 0)
                $this->tools->redirect(URL . "bed/update");
        }
        $allItems = $bedModel->getAllWithRoomData();
        $this->view->assign("items", $allItems);
        $this->view->assign("rooms", $rooms);
        $this->view->assign("selectedBed", $bedModel);
        $this->view->render("bed/update");
    }

    public function removeAction($id) {
        if ($id) {
            $bedModel = $this->loadModel("bed");
            $bedModel->getOneBy("id", $id);
            $bedModel->remove();
            $this->tools->log("bed", "Bed element with id: $id removed.");
            $this->tools->redirect(URL . "bed/update");
        } else {
            echo "No bed element id selected!";
        }
    }

}

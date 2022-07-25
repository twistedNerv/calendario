<?php

class sectionController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function indexAction($id = 0) {
        $sectionModel = $this->loadModel('section');
        $sectionObj = $sectionModel->getAll();
        $this->view->assign('vars', get_class_vars('sectionModel'));
        $this->view->assign('items', $sectionObj);
        $this->view->render("section/index");
    }

    public function updateAction($id = 0) {
        $this->tools->checkPageRights(4);
        $sectionModel = $this->loadModel("section");
        if ($id != 0) {
            $sectionModel->getOneBy("id", $id);
        }
        if ($this->tools->getPost("action") == "handlesection") {
            $sectionModel->setTitle($this->tools->getPost("section-title"));
            $sectionModel->setColor($this->tools->getPost("section-color"));
            $sectionModel->setDescription($this->tools->getPost("section-description"));
            $sectionModel->flush();
            $action = ($id != 0) ? "Section element with id: $id updated successfully." : "section successfully added.";
            $this->tools->log("section", $action);
            if ($id == 0)
                $this->tools->redirect(URL . "section/update");
        }
        $allItems = $sectionModel->getAll();
        $this->view->assign("items", $allItems);
        $this->view->assign("selectedSection", $sectionModel);
        $this->view->render("section/update");
    }

    public function removeAction($id) {
        if ($id) {
            $sectionModel = $this->loadModel("section");
            $sectionModel->getOneBy("id", $id);
            $sectionModel->remove();
            $this->tools->log("section", "Section element with id: $id removed.");
            $this->tools->redirect(URL . "section/update");
        } else {
            echo "No section element id selected!";
        }
    }

}

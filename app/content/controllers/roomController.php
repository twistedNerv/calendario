<?php

class roomController extends controller {

	public function __construct() { 
		parent::__construct();
	}

	public function indexAction($id=0) {
		$roomModel = $this->loadModel('room');
		$roomObj = $roomModel->getAll();
		$this->view->assign('vars', get_class_vars('roomModel'));
		$this->view->assign('items', $roomObj);
		$this->view->render("room/index");
	}

	public function updateAction($id=0) {
		$this->tools->checkPageRights(4);
		$roomModel = $this->loadModel("room");
		if($id != 0) {
			$roomModel->getOneBy("id", $id);
		}
		if($this->tools->getPost("action") == "handleroom") {
			$roomModel->setTitle($this->tools->getPost("room-title"));
			$roomModel->setDescription($this->tools->getPost("room-description"));
			$roomModel->setTotal_beds($this->tools->getPost("room-total_beds"));
			$roomModel->setColor($this->tools->getPost("room-color"));
			$roomModel->flush();
			$action = ($id != 0) ? "Room element with id: $id updated successfully." : "room successfully added.";
			$this->tools->log("room", $action);
			if ($id == 0)
				$this->tools->redirect(URL . "room/update");
		}
		$allItems = $roomModel->getAll();
		$this->view->assign("items", $allItems);
		$this->view->assign("selectedRoom", $roomModel);
		$this->view->render("room/update");
	}

	public function removeAction($id) {
		if ($id) {
			$roomModel = $this->loadModel("room");
			$roomModel->getOneBy("id", $id);
			$roomModel->remove();
			$this->tools->log("room", "Room element with id: $id removed.");
			$this->tools->redirect(URL . "room/update");
		} else {
			echo "No room element id selected!";
		}
	}
}
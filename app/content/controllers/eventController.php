<?php

class eventController extends controller {

	public function __construct() { 
		parent::__construct();
	}

	public function indexAction($id=0) {
		$eventModel = $this->loadModel('event');
		$eventObj = $eventModel->getAll();
		$this->view->assign('vars', get_class_vars('eventModel'));
		$this->view->assign('items', $eventObj);
		$this->view->render("event/index");
	}

	public function updateAction($id=0) {
		$this->tools->checkPageRights(4);
		$eventModel = $this->loadModel("event");
		if($id != 0) {
			$eventModel->getOneBy("id", $id);
		}
		if($this->tools->getPost("action") == "handleevent") {
			$eventModel->setSection($this->tools->getPost("event-section"));
			$eventModel->setDate($this->tools->getPost("event-date"));
			$eventModel->setStart($this->tools->getPost("event-start"));
			$eventModel->setDuration($this->tools->getPost("event-duration"));
			$eventModel->setLocation($this->tools->getPost("event-location"));
			$eventModel->setTitle($this->tools->getPost("event-title"));
			$eventModel->setDescription($this->tools->getPost("event-description"));
			$eventModel->setDiscount($this->tools->getPost("event-discount"));
			$eventModel->setPrice($this->tools->getPost("event-price"));
			$eventModel->setComment($this->tools->getPost("event-comment"));
			$eventModel->flush();
			$action = ($id != 0) ? "Event element with id: $id updated successfully." : "event successfully added.";
			$this->tools->log("event", $action);
			if ($id == 0)
				$this->tools->redirect(URL . "event/update");
		}
		$allItems = $eventModel->getAll();
		$this->view->assign("items", $allItems);
		$this->view->assign("selectedEvent", $eventModel);
		$this->view->render("event/update");
	}

	public function removeAction($id) {
		if ($id) {
			$eventModel = $this->loadModel("event");
			$eventModel->getOneBy("id", $id);
			$eventModel->remove();
			$this->tools->log("event", "Event element with id: $id removed.");
			$this->tools->redirect(URL . "event/update");
		} else {
			echo "No event element id selected!";
		}
	}
}
<?php

class event_instructorController extends controller {

	public function __construct() { 
		parent::__construct();
	}

	public function indexAction($id=0) {
		$event_instructorModel = $this->loadModel('event_instructor');
		$event_instructorObj = $event_instructorModel->getAll();
		$this->view->assign('vars', get_class_vars('event_instructorModel'));
		$this->view->assign('items', $event_instructorObj);
		$this->view->render("event_instructor/index");
	}

	public function updateAction($id=0) {
		$this->tools->checkPageRights(4);
		$event_instructorModel = $this->loadModel("event_instructor");
		if($id != 0) {
			$event_instructorModel->getOneBy("id", $id);
		}
		if($this->tools->getPost("action") == "handleevent_instructor") {
			$event_instructorModel->setEvent_id($this->tools->getPost("event_instructor-event_id"));
			$event_instructorModel->setInstructor_id($this->tools->getPost("event_instructor-instructor_id"));
			$event_instructorModel->flush();
			$action = ($id != 0) ? "Event_instructor element with id: $id updated successfully." : "event_instructor successfully added.";
			$this->tools->log("event_instructor", $action);
			if ($id == 0)
				$this->tools->redirect(URL . "event_instructor/update");
		}
		$allItems = $event_instructorModel->getAll();
		$this->view->assign("items", $allItems);
		$this->view->assign("selectedEvent_instructor", $event_instructorModel);
		$this->view->render("event_instructor/update");
	}

	public function removeAction($id) {
		if ($id) {
			$event_instructorModel = $this->loadModel("event_instructor");
			$event_instructorModel->getOneBy("id", $id);
			$event_instructorModel->remove();
			$this->tools->log("event_instructor", "Event_instructor element with id: $id removed.");
			$this->tools->redirect(URL . "event_instructor/update");
		} else {
			echo "No event_instructor element id selected!";
		}
	}
}
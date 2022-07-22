<?php

class event_customerController extends controller {

	public function __construct() { 
		parent::__construct();
	}

	public function indexAction($id=0) {
		$event_customerModel = $this->loadModel('event_customer');
		$event_customerObj = $event_customerModel->getAll();
		$this->view->assign('vars', get_class_vars('event_customerModel'));
		$this->view->assign('items', $event_customerObj);
		$this->view->render("event_customer/index");
	}

	public function updateAction($id=0) {
		$this->tools->checkPageRights(4);
		$event_customerModel = $this->loadModel("event_customer");
		if($id != 0) {
			$event_customerModel->getOneBy("id", $id);
		}
		if($this->tools->getPost("action") == "handleevent_customer") {
			$event_customerModel->setEvent_id($this->tools->getPost("event_customer-event_id"));
			$event_customerModel->setCustomer_id($this->tools->getPost("event_customer-customer_id"));
			$event_customerModel->flush();
			$action = ($id != 0) ? "Event_customer element with id: $id updated successfully." : "event_customer successfully added.";
			$this->tools->log("event_customer", $action);
			if ($id == 0)
				$this->tools->redirect(URL . "event_customer/update");
		}
		$allItems = $event_customerModel->getAll();
		$this->view->assign("items", $allItems);
		$this->view->assign("selectedEvent_customer", $event_customerModel);
		$this->view->render("event_customer/update");
	}

	public function removeAction($id) {
		if ($id) {
			$event_customerModel = $this->loadModel("event_customer");
			$event_customerModel->getOneBy("id", $id);
			$event_customerModel->remove();
			$this->tools->log("event_customer", "Event_customer element with id: $id removed.");
			$this->tools->redirect(URL . "event_customer/update");
		} else {
			echo "No event_customer element id selected!";
		}
	}
}
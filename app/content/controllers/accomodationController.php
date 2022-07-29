<?php

class accomodationController extends controller {

	public function __construct() { 
		parent::__construct();
	}

	public function indexAction($id=0) {
		$accomodationModel = $this->loadModel('accomodation');
		$accomodationObj = $accomodationModel->getAll();
		$this->view->assign('vars', get_class_vars('accomodationModel'));
		$this->view->assign('items', $accomodationObj);
		$this->view->render("accomodation/index");
	}

	public function updateAction($id=0) {
		$this->tools->checkPageRights(4);
		$accomodationModel = $this->loadModel("accomodation");
		if($id != 0) {
			$accomodationModel->getOneBy("id", $id);
		}
		if($this->tools->getPost("action") == "handleaccomodation") {
			$accomodationModel->setCustomer_id($this->tools->getPost("accomodation-customer_id"));
			$accomodationModel->setRoom_id($this->tools->getPost("accomodation-room_id"));
			$accomodationModel->setBed_id($this->tools->getPost("accomodation-bed_id"));
			$accomodationModel->setDate_start($this->tools->getPost("accomodation-date_start"));
			$accomodationModel->setDate_end($this->tools->getPost("accomodation-date_end"));
			$accomodationModel->setPrice($this->tools->getPost("accomodation-price"));
			$accomodationModel->setComment($this->tools->getPost("accomodation-comment"));
			$accomodationModel->flush();
			$action = ($id != 0) ? "Accomodation element with id: $id updated successfully." : "accomodation successfully added.";
			$this->tools->log("accomodation", $action);
			if ($id == 0)
				$this->tools->redirect(URL . "accomodation/update");
		}
		$allItems = $accomodationModel->getAll();
		$this->view->assign("items", $allItems);
		$this->view->assign("selectedAccomodation", $accomodationModel);
		$this->view->render("accomodation/update");
	}

	public function removeAction($id) {
		if ($id) {
			$accomodationModel = $this->loadModel("accomodation");
			$accomodationModel->getOneBy("id", $id);
			$accomodationModel->remove();
			$this->tools->log("accomodation", "Accomodation element with id: $id removed.");
			$this->tools->redirect(URL . "accomodation/update");
		} else {
			echo "No accomodation element id selected!";
		}
	}
}
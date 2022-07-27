<?php

class instructorController extends controller {

	public function __construct() { 
		parent::__construct();
	}

	public function indexAction($id=0) {
		$instructorModel = $this->loadModel('instructor');
		$instructorObj = $instructorModel->getAll();
		$this->view->assign('vars', get_class_vars('instructorModel'));
		$this->view->assign('items', $instructorObj);
		$this->view->render("instructor/index");
	}

	public function updateAction($id=0) {
		$this->tools->checkPageRights(4);
		$instructorModel = $this->loadModel("instructor");
		if($id != 0) {
			$instructorModel->getOneBy("id", $id);
		}
		if($this->tools->getPost("action") == "handleinstructor") {
			$instructorModel->setName($this->tools->getPost("instructor-name"));
			$instructorModel->setSurname($this->tools->getPost("instructor-surname"));
			$instructorModel->setGender($this->tools->getPost("instructor-gender"));
			$instructorModel->setAddress($this->tools->getPost("instructor-address"));
			$instructorModel->setCity($this->tools->getPost("instructor-city"));
			$instructorModel->setCountry($this->tools->getPost("instructor-country"));
			$instructorModel->setPhone($this->tools->getPost("instructor-phone"));
			$instructorModel->setEmail($this->tools->getPost("instructor-email"));
			$instructorModel->setComment($this->tools->getPost("instructor-comment"));
			$instructorModel->flush();
			$action = ($id != 0) ? "Instructor element with id: $id updated successfully." : "instructor successfully added.";
			$this->tools->log("instructor", $action);
			if ($id == 0)
				$this->tools->redirect(URL . "instructor/update");
		}
		$allItems = $instructorModel->getAll();
		$this->view->assign("items", $allItems);
		$this->view->assign("selectedInstructor", $instructorModel);
		$this->view->render("instructor/update");
	}

	public function removeAction($id) {
		if ($id) {
			$instructorModel = $this->loadModel("instructor");
			$instructorModel->getOneBy("id", $id);
			$instructorModel->remove();
			$this->tools->log("instructor", "Instructor element with id: $id removed.");
			$this->tools->redirect(URL . "instructor/update");
		} else {
			echo "No instructor element id selected!";
		}
	}
}
<?php

class memberController extends controller {

	public function __construct() { 
		parent::__construct();
	}

	public function indexAction($id=0) {
		$memberModel = $this->loadModel('member');
		$memberObj = $memberModel->getAll();
		$this->view->assign('vars', get_class_vars('memberModel'));
		$this->view->assign('items', $memberObj);
		$this->view->render("member/index");
	}

	public function updateAction($id=0) {
		$this->tools->checkPageRights(4);
		$memberModel = $this->loadModel("member");
		if($id != 0) {
			$memberModel->getOneBy("id", $id);
		}
		if($this->tools->getPost("action") == "handlemember") {
			$memberModel->setEvent_id($this->tools->getPost("member-event_id"));
			$memberModel->setCustomer_id($this->tools->getPost("member-customer_id"));
			$memberModel->flush();
			$action = ($id != 0) ? "Member element with id: $id updated successfully." : "member successfully added.";
			$this->tools->log("member", $action);
			if ($id == 0)
				$this->tools->redirect(URL . "member/update");
		}
		$allItems = $memberModel->getAll();
		$this->view->assign("items", $allItems);
		$this->view->assign("selectedMember", $memberModel);
		$this->view->render("member/update");
	}

	public function removeAction($id) {
		if ($id) {
			$memberModel = $this->loadModel("member");
			$memberModel->getOneBy("id", $id);
			$memberModel->remove();
			$this->tools->log("member", "Member element with id: $id removed.");
			$this->tools->redirect(URL . "member/update");
		} else {
			echo "No member element id selected!";
		}
	}
}
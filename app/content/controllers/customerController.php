<?php

class customerController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function indexAction($id = 0) {
        $customerModel = $this->loadModel('customer');
        $customerObj = $customerModel->getAll();
        $this->view->assign('vars', get_class_vars('customerModel'));
        $this->view->assign('items', $customerObj);
        $this->view->render("customer/index");
    }

    public function updateAction($id = 0) {
        $this->tools->checkPageRights(4);
        $customerModel = $this->loadModel("customer");
        if ($id != 0) {
            $customerModel->getOneBy("id", $id);
        }
        if ($this->tools->getPost("action") == "handlecustomer") {
            if ($id == 0) {
                if ($customerModel->getHash() === null)
                    $customerModel->setHash(uniqid());
            }
            $customerModel->setName($this->tools->getPost("customer-name"));
            $customerModel->setSurname($this->tools->getPost("customer-surname"));
            $customerModel->setGender($this->tools->getPost("customer-gender"));
            $customerModel->setAddress($this->tools->getPost("customer-address"));
            $customerModel->setCity($this->tools->getPost("customer-city"));
            $customerModel->setCountry($this->tools->getPost("customer-country"));
            $customerModel->setPhone($this->tools->getPost("customer-phone"));
            $customerModel->setEmail($this->tools->getPost("customer-email"));
            $customerModel->setComment($this->tools->getPost("customer-comment"));
            $customerModel->flush();
            $action = ($id != 0) ? "Customer element with id: $id updated successfully." : "customer successfully added.";
            $this->tools->log("customer", $action);
            if ($id == 0)
                $this->tools->redirect(URL . "customer/update");
        }
        $allItems = $customerModel->getAll();
        $this->view->assign("items", $allItems);
        $this->view->assign("selectedCustomer", $customerModel);
        $this->view->render("customer/update");
    }

    public function removeAction($id) {
        if ($id) {
            $customerModel = $this->loadModel("customer");
            $customerModel->getOneBy("id", $id);
            $customerModel->remove();
            $this->tools->log("customer", "Customer element with id: $id removed.");
            $this->tools->redirect(URL . "customer/update");
        } else {
            echo "No customer element id selected!";
        }
    }

}

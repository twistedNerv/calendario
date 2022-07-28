<?php

class event_customerModel extends model {

    public $id;
    public $event_id;
    public $customer_id;

    public function __construct() {
        parent::__construct();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getEvent_id() {
        return $this->event_id;
    }

    public function setEvent_id($event_id) {
        $this->event_id = $event_id;
        return $this;
    }

    public function getCustomer_id() {
        return $this->customer_id;
    }

    public function setCustomer_id($customer_id) {
        $this->customer_id = $customer_id;
        return $this;
    }

    public function getOneBy($ident, $value) {
        $result = $this->db->getOneByParam($ident, $value, 'event_customer');
        $this->fillObject('event_customer', $result);
        return $this;
    }

    public function getAll($orderBy = null, $order = null, $limit = null) {
        return $this->db->getAll($orderBy, $order, $limit, 'event_customer');
    }

    public function getAllBy($ident, $identVal, $orderBy = null, $orderDirection = 'ASC', $limit = null) {
        return $this->db->getAllByParam($ident, $identVal, 'event_customer', $orderBy, $orderDirection, $limit);
    }

    public function flush($sqlDump = 0) {
        $this->db->flush($this, 'event_customer', $sqlDump);
    }

    public function remove() {
        $this->db->delete($this, 'event_customer');
    }

}

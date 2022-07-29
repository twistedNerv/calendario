<?php

class accomodationModel extends model {

    public $id;
    public $customer_id;
    public $room_id;
    public $bed_id;
    public $date_start;
    public $date_end;
    public $price;
    public $comment;

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

    public function getCustomer_id() {
        return $this->customer_id;
    }

    public function setCustomer_id($customer_id) {
        $this->customer_id = $customer_id;
        return $this;
    }

    public function getRoom_id() {
        return $this->room_id;
    }

    public function setRoom_id($room_id) {
        $this->room_id = $room_id;
        return $this;
    }

    public function getBed_id() {
        return $this->bed_id;
    }

    public function setBed_id($bed_id) {
        $this->bed_id = $bed_id;
        return $this;
    }

    public function getDate_start() {
        return $this->date_start;
    }

    public function setDate_start($date_start) {
        $this->date_start = $date_start;
        return $this;
    }

    public function getDate_end() {
        return $this->date_end;
    }

    public function setDate_end($date_end) {
        $this->date_end = $date_end;
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        $this->comment = $comment;
        return $this;
    }

    public function getOneBy($ident, $value) {
        $result = $this->db->getOneByParam($ident, $value, 'accomodation');
        $this->fillObject('accomodation', $result);
        return $this;
    }

    public function getAll($orderBy = null, $order = null, $limit = null) {
        return $this->db->getAll($orderBy, $order, $limit, 'accomodation');
    }

    public function getAllBy($ident, $identVal, $orderBy = null, $orderDirection = 'ASC', $limit = null) {
        return $this->db->getAllByParam($ident, $identVal, 'accomodation', $orderBy, $orderDirection, $limit);
    }

    public function flush($sqlDump = 0) {
        $this->db->flush($this, 'accomodation', $sqlDump);
    }

    public function remove() {
        $this->db->delete($this, 'accomodation');
    }

}

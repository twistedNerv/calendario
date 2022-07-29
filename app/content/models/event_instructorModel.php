<?php

class event_instructorModel extends model {

    public $id;
    public $event_id;
    public $instructor_id;

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

    public function getInstructor_id() {
        return $this->instructor_id;
    }

    public function setInstructor_id($instructor_id) {
        $this->instructor_id = $instructor_id;
        return $this;
    }

    public function getOneBy($ident, $value) {
        $result = $this->db->getOneByParam($ident, $value, 'event_instructor');
        $this->fillObject('event_instructor', $result);
        return $this;
    }

    public function getAll($orderBy = null, $order = null, $limit = null) {
        return $this->db->getAll($orderBy, $order, $limit, 'event_instructor');
    }

    public function getAllBy($ident, $identVal, $orderBy = null, $orderDirection = 'ASC', $limit = null) {
        return $this->db->getAllByParam($ident, $identVal, 'event_instructor', $orderBy, $orderDirection, $limit);
    }

    public function flush($sqlDump = 0) {
        $this->db->flush($this, 'event_instructor', $sqlDump);
    }

    public function remove() {
        $this->db->delete($this, 'event_instructor');
    }

}

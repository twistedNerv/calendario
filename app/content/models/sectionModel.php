<?php

class sectionModel extends model {

	public $id;
	public $title;
	public $color;
	public $description;


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

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	public function getColor() {
		return $this->color;
	}

	public function setColor($color) {
		$this->color = $color;
		return $this;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}

	public function getOneBy($ident, $value) {
		$result = $this->db->getOneByParam($ident, $value, 'section');
		$this->fillObject('section', $result);
		return $this;
	}

	public function getAll($orderBy = null, $order = null, $limit = null) {
		return $this->db->getAll($orderBy, $order, $limit, 'section');
	}

public function getAllBy($ident, $identVal, $orderBy = null, $orderDirection = 'ASC', $limit=null) {
return $this->db->getAllByParam($ident, $identVal, 'section', $orderBy, $orderDirection, $limit);
	}

	public function flush($sqlDump=0) {
		$this->db->flush($this, 'section', $sqlDump);
	}

	public function remove() {
		$this->db->delete($this, 'section');
	}


}
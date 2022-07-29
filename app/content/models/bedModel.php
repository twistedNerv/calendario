<?php

class bedModel extends model {

    public $id;
    public $room_id;
    public $title;
    public $description;
    public $bed_type;

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

    public function getRoom_id() {
        return $this->room_id;
    }

    public function setRoom_id($room_id) {
        $this->room_id = $room_id;
        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function getBed_type() {
        return $this->bed_type;
    }

    public function setBed_type($bed_type) {
        $this->bed_type = $bed_type;
        return $this;
    }

    public function getOneBy($ident, $value) {
        $result = $this->db->getOneByParam($ident, $value, 'bed');
        $this->fillObject('bed', $result);
        return $this;
    }

    public function getAll($orderBy = null, $order = null, $limit = null) {
        return $this->db->getAll($orderBy, $order, $limit, 'bed');
    }

    public function getAllBy($ident, $identVal, $orderBy = null, $orderDirection = 'ASC', $limit = null) {
        return $this->db->getAllByParam($ident, $identVal, 'bed', $orderBy, $orderDirection, $limit);
    }

    public function flush($sqlDump = 0) {
        $this->db->flush($this, 'bed', $sqlDump);
    }

    public function remove() {
        $this->db->delete($this, 'bed');
    }
    
    public function getAllWithRoomData() {
        $sql = "SELECT 
                bed.id as id, 
                bed.room_id as roomid,
                bed.title as title,
                bed.description as description,
                bed.bed_type as bed_type,
                room.id as room_id,
                room.title as room_title,
                room.description as room_description,
                room.color as color
                FROM bed 
                INNER JOIN room 
                        ON bed.room_id = room.id;";
        $result = $this->db->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

}

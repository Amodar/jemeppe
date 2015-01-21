<?php
global $mysqli;
include_once( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/includes/backend/model/db_connect.php' );

class RoomOverview{
    private $room_name = null;
    private $lang_language = null;
    private $room_id = null;

    function __construct($mysqli, $lang_language) {
        if($stmt = $mysqli->prepare("SELECT DISTINCT room_name, room_specification_id_room_specification "
                . "FROM `rooms`, `room_specification` "
                . "WHERE rooms.lang_language = ?;")) {
            
            if (!$stmt->bind_param("s", $lang_language)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->bind_result($db_room_name, $db_room_specification);
            
            $room_name = array();
            $room_id = array();
            
            while ($stmt->fetch()) {
                $this->room_name = array_push($room_name, $db_room_name);
                $this->room_id = array_push($room_id, $db_room_specification);
            }
            $this->room_id = $room_id;
            $this->room_name = $room_name;
        } else {
            return false;
        }
    }
    
    function getRoom_id() {
        return $this->room_id;
    }
    function getRoom_name() {
        return $this->room_name;
    }



}
<?php
global $mysqli;
include_once( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/includes/backend/model/db_connect.php' );

class Room {
    private $room_name = null;
    private $lang_language = null;
    private $price = null;
    private $capacity = null;
    private $toilet = null;
    private $shower = null;
    private $sink = null;
    private $available_rooms = null;

function __construct($mysqli, $room_name, $lang_language) {
        if($stmt = $mysqli->prepare("SELECT rooms.room_name, lang_language, room_specification.price, room_specification.capacity, room_specification.toilet, room_specification.shower, room_specification.sink, room_specification.available_rooms "
                . "FROM rooms, room_specification "
                . "WHERE rooms.room_specification_id_room_specification = room_specification.id_room_specification "
                . "AND rooms.room_specification_id_room_specification = ? "
                . "AND rooms.lang_language = ?;")) {
            
            $stmt2 = $mysqli->prepare("SELECT url FROM url_image WHERE room_specification_id_room_specification = ?;");


            if (!$stmt->bind_param("ss", $room_name, $lang_language)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->store_result();
            
            if (!$stmt2->bind_param("s", $room_name)) {
                echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
            }
            
            if (!$stmt2->execute()) {
                echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
            }
            
            $stmt->bind_result($room_name, $lang_language, $price, $capacity, $toilet, $shower, $sink, $available_rooms);
            $stmt->fetch();
            $stmt2->bind_result($url_image);
            $urlArray = array();
            while ($stmt2->fetch()) {
                $this->urlArray = array_push($urlArray, $url_image);
            }
            
            $this->room_name = $room_name;
            $this->lang_language = $lang_language;
            $this->price = $price;
            $this->capacity = $capacity;
            $this->toilet = $toilet;
            $this->shower = $shower;
            $this->sink = $sink;
            $this->available_rooms = $available_rooms;
            
            $this->urlArray = $urlArray;
            } else {
            return false;
        }
    }
    
    
    function getRoom_name() {
        return $this->room_name;
    }

    function getLang_language() {
        return $this->lang_language;
    }

    function getPrice() {
        return $this->price;
    }

    function getCapacity() {
        return $this->capacity;
    }

    function getToilet() {
        return $this->toilet;
    }

    function getShower() {
        return $this->shower;
    }

    function getSink() {
        return $this->sink;
    }
    
    function getUrlArray() {
        return $this->urlArray;
    }
    
    function getAvailable_rooms() {
        return $this->available_rooms;
    }
    
}
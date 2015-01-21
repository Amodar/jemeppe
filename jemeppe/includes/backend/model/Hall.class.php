<?php
include_once 'db_connect.php';
//retrieving content through ID as parameter
//different methods(different parameters) in retrieving content

class Room {
    private $hallName = null;

function __construct($mysqli, $hallName) {
        if($stmt = $mysqli->prepare("select * from image where halls_hall_name = ?")) {
            
            if (!$stmt->bind_param("ss", $room_name, $lang_language)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->bind_result($hallName);
            $stmt->fetch();
            
            $this->room_name = $room_name;
            $this->lang_language = $lang_language;
            $this->price = $price;
            $this->capacity = $capacity;
            $this->toilet = $toilet;
            $this->shower = $shower;
            $this->sink = $sink;
            
        } else {
            echo "error";
        }
    }
    
    function getHallImage() {
        $query = 'select * from image where halls_hall_name = $hallname';
        //make array
    }
}


?>
<?php
global $mysqli;
include_once( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/includes/backend/model/db_connect.php' );

function getAllRoomNames($lang, $mysqli) {
    if($stmt = $mysqli->prepare("SELECT room_name FROM `rooms` WHERE lang_language = ?")) {
        $stmt->bind_param('s', $lang);
        
        $stmt->execute();
        $stmt->store_result();
        
        $stmt->bind_result($roomName);
        while ($stmt->fetch()) {
            echo '<option name=$roomName>';
                echo $roomName;
            echo '</option>';
        }
    }
}

function getRoomName($lang, $mysqli) {
    
}

?>
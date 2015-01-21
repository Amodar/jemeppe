<?php
global $mysqli;
include_once 'db_connect.php';


class ContentRoom {
    
    function __construct($mysqli, $room_name, $lang_language) {
        if($stmt = $mysqli->prepare("SELECT title, content FROM `content` WHERE `category` = ? AND `lang_language` = ?")) {
            
            if (!$stmt->bind_param("ss", $room_name, $lang_language)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->bind_result($db_title, $db_content);
            
            $title = array();
            $content = array();
            
            while ($stmt->fetch()) {
                $this->title = array_push($title, $db_title);
                $this->content = array_push($content, $db_content);
            }
            
            $this->title = $title;
            $this->content = $content;
        } else {
            return false;
        }
    }
    
    function getTitle() {
        return $this->title;
    }

    function getContent() {
        return $this->content;
    }
}
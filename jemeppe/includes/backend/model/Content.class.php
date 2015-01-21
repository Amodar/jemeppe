<?php
global $mysqli;
include_once 'db_connect.php';
//retrieving content through ID as parameter
//different methods(different parameters) in retrieving content

class Content {
    private $id_content = null;
    private $hall = null;
    private $room = null;
    private $language = null;
    private $category = null;
    private $title = null;
    private $content = null;
    
    private $url_image = null;

    function __construct($mysqli, $id_content) {
        if($stmt = $mysqli->prepare("SELECT `id_content`, "
                . "`hall_specification_id_hall_specification`, "
                . "`room_specification_id_room_specification`, `lang_language`, "
                . "`category`, `title`, `content` "
                . "FROM `content` "
                . "WHERE id_content = ?;")) {
            
            if (!$stmt->bind_param("i", $id_content)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->bind_result($id_content, $hall, $room, $language, $category, $title, $content);
            $stmt->fetch();
            
            $this->id_content = $title;
            $this->hall = $hall;
            $this->room = $room;
            $this->language = $language;
            $this->category = $category;
            $this->title = $title;
            $this->content = $content;
            
        } else {
            return false;
        }
    }
    
    function getId_content() {
        return $this->id_content;
    }

    function getHall() {
        return $this->hall;
    }

    function getRoom() {
        return $this->room;
    }

    function getLanguage() {
        return $this->language;
    }

    function getCategory() {
        return $this->category;
    }

    function getTitle() {
        return $this->title;
    }

    function getContent() {
        return $this->content;
    }

    function setId_content($id_content) {
        $this->id_content = $id_content;
    }

    function setHall($hall) {
        $this->hall = $hall;
    }

    function setRoom($room) {
        $this->room = $room;
    }

    function setLanguage($language) {
        $this->language = $language;
    }

    function setCategory($category) {
        $this->category = $category;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function getUrlRoomImages($mysqli, $id_room) {
        if($stmt = $mysqli->prepare("SELECT url FROM url_image "
                . "WHERE room_specification_id_room_specification = ?")) {
            
            if (!$stmt->bind_param("s", $id_room)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->bind_result($url);
            $url_image = array();
            
            while($stmt->fetch()){
                $this->id_content = array_push($url_image, $url);
            }
            
            $this->url_image = $url_image;
            
        } else {
            return false;
        }
    }
    
    function getUrl_image() {
        return $this->url_image;
    }
}
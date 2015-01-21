<?php
global $mysqli;
include_once 'db_connect.php';

class ContentOverview {
    private $id_content;
    
    function __construct($mysqli, $category, $language) {
        if($stmt = $mysqli->prepare("SELECT id_content "
                . "FROM `content` "
                . "WHERE `category` = ? "
                . "AND `lang_language` = ?")) {
            
            if (!$stmt->bind_param("ss", $category, $language)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->bind_result($db_id_content);
            
            $id_content = array();
            
            while ($stmt->fetch()) {
                $this->id_content = array_push($id_content, $db_id_content);
            }
            
            $this->id_content = $id_content;
        } else {
            return false;
        }
    }
    
    function getId_content() {
        return $this->id_content;
    }

    function setId_content($id_content) {
        $this->id_content = $id_content;
    }
}
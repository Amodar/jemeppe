<?php
global $mysqli;
include_once 'db_connect.php';
//retrieving content through ID as parameter
//different methods(different parameters) in retrieving content

class Review {
    private $id_review = NULL;
    private $id_user = NULL;
    private $language = NULL;
    private $published = NULL;
    private $rating = NULL;
    private $review = NULL;

    function __construct($mysqli, $language, $id_user) {
        if($stmt = $mysqli->prepare("SELECT id_review, user_id_user, lang_language, "
                . "published, rating, review "
                . "FROM review "
                . "WHERE user_id_user = ?")) {
            
            if (!$stmt->bind_param("i", $id_user)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->bind_result($id_review, $id_user, $language, 
                    $published, $rating, $review);
            $stmt->fetch();
            
            $this->id_review = $id_review;
            $this->id_user = $id_user;
            $this->language = $language;
            $this->published = $published;
            $this->rating = $rating;
            $this->review = $review;
            
        } else {
            return false;
        }
    }
    
    function getId_review() {
        return $this->id_review;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getLanguage() {
        return $this->language;
    }

    function getPublished() {
        return $this->published;
    }

    function getRating() {
        return $this->rating;
    }

    function getReview() {
        return $this->review;
    }

    function setId_review($id_review) {
        $this->id_review = $id_review;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setLanguage($language) {
        $this->language = $language;
    }

    function setPublished($published) {
        $this->published = $published;
    }

    function setRating($rating) {
        $this->rating = $rating;
    }

    function setReview($review) {
        $this->review = $review;
    }
    
    function insertReview($mysqli, $id_user) {
        $language = $this->language;
        $rating = $this->rating;
        $review = $this->review;
        
        if($stmt = $mysqli->prepare("INSERT INTO `review`(`user_id_user`, `lang_language`, `rating`, `review`) "
                . "VALUES (?,?,?,?)")) {
            
            if (!$stmt->bind_param("isds", $id_user, $language, $rating, $review)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            } else {
                return true;
            }
        }
    }
    
    function updateReview($mysqli) {
        $id_review = $this->id_review;
        $language = $this->language;
        $rating = $this->rating;
        $review = $this->review;
        
        if($stmt = $mysqli->prepare("UPDATE `review` SET `lang_language`=?,`rating`=?,
                `review`=? WHERE id_review = ?")) {
            
            if (!$stmt->bind_param("sdsi", $language, $rating, $review, $id_review)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            } else {
                return true;
            }
        }
    }
}
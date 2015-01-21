<?php
global $mysqli;

class ReviewOverview {
    private $id_review = NULL;
    private $id_user = NULL;
    private $language = NULL;
    private $published = NULL;
    private $rating = NULL;
    private $review = NULL;
    
    function __construct($mysqli, $lowestRating, $highestRating) {
        if($stmt = $mysqli->prepare("SELECT id_review, user_id_user, lang_language, published, rating, review FROM review WHERE `rating` >= ? AND `rating` <= ?")) {
            
            if (!$stmt->bind_param("dd", $lowestRating, $highestRating)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->bind_result($db_id_review, $db_id_user, $db_lang, $db_published, 
                    $db_rating, $db_review);
            
            $id_review = array();
            $id_user = array();
            $language = array();
            $published = array();
            $rating = array();
            $review = array();
            
            while ($stmt->fetch()) {
                $this->id_review = array_push($id_review, $db_id_review);
                $this->id_user = array_push($id_user, $db_id_user);
                $this->language = array_push($language, $db_lang);
                $this->published = array_push($published, $db_published);
                $this->rating = array_push($rating, $db_rating);
                $this->review = array_push($review, $db_review);
            }
            
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


}
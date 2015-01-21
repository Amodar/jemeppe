<?php
global $mysqli;
include_once( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/includes/backend/model/db_connect.php' );

function createUser($mysqli) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $dob = $_POST['dob'];
    
    $country = $_POST['country'];
    $city = $_POST['city'];
    $adres = $_POST['adres'];
    $zipcode = $_POST['zipcode'];
    
    if(!isset($telHouse)) {
        $telHouse = null;   
    }
    if(!isset($telMobile)) {
        $telMobile = null;
    }
    if(!isset($telAdditional)) {
        $telAdditional = null;
    }
    $telHouse = $_POST['houseNumber'];
    $telMobile = $_POST['mobileNumber'];
    $telAdditional = $_POST['additionalNumber'];
    
        
    if($stmt = $mysqli->prepare("INSERT INTO `jemeppe`.`user` (`email`, `password`, `gender`, `first_name`, `middle_name`, `last_name`, `date_of_birth`) VALUES (?, ?, ?, ?, ?, ?, ?);")) {
        $stmt->bind_param('sssssss', $email, $password, $gender, $firstname, $middlename, $lastname, $dob);
        
        $stmt->execute();
    }
    if($stmt = $mysqli->prepare("select id_user from user where email = ?")) {
        $stmt->bind_param('s', $email);
        
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id);
        $stmt->fetch();
    }
   if($stmt = $mysqli->prepare("INSERT INTO `jemeppe`.`adres` (`user_id_user`, `countries_country_name`, `city`, `adres`, `zipcode`) VALUES (?, ?, ?, ?, ?);")) {
        $stmt->bind_param('issss', $id, $country, $city, $adres, $zipcode);
       
       $stmt->execute();
   }
   if($stmt = $mysqli->prepare("INSERT INTO `jemeppe`.`telephone` (`user_id_user`, `house_number`, `mobile_number`, `additional_number`) VALUES (?, ?, ?, ?);")) {
        $stmt->bind_param('isss', $id, $telHouse, $telMobile, $telAddtional);
       
       $stmt->execute();
   }
    echo $id . "wd";
}

function updateUser($mysqli) {
    
}


?>
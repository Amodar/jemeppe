<?php
global $mysqli;
include_once 'db_connect.php';

class Country {
    private $countryCode = NULL;
    private $countryName = NULL;
    
    function __construct($mysqli) {
        if($stmt = $mysqli->prepare("SELECT country_code, country_name FROM countries")) {
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            $stmt->bind_result($db_country_code, $db_country_name);
            
            $countryCode = array();
            $countryName = array();
            
            while($stmt->fetch()){
                $this->countryCode = array_push($countryCode, $db_country_code);
                $this->countryName = array_push($countryName, $db_country_name);
            }
            $this->countryCode = $countryCode;
            $this->countryName = $countryName;
            
        } else {
            return false;
        }
    }
    

    function getCountryCode() {
        return $this->countryCode;
    }

     function getCountryName() {
        return $this->countryName;
    }
}
<?php
global $mysqli;
include_once 'db_connect.php';

class User {
    private $id_user = null;
    private $email = null;
    private $password = null;
    private $firstName = null;
    private $middleName = null;
    private $lastName = null;
    private $gender = null;
    private $dob = null;
    
    private $activation = null;
    private $newsletter = null;
    private $account_deletion = null;
    
    private $country = null;
    private $city = null;
    private $adres = null;
    private $zipcode = null;
    private $houseNumber = null;
    private $mobileNumber = null;
    private $additionalNumber = null;
    
    /*
     * ---------------------------------------------------
     * - CONSTRUCTOR
     * ---------------------------------------------------
     */
    
    function __construct($mysqli, $email) {
        if($stmt = $mysqli->prepare("SELECT user.id_user, user.email, user.password, user.first_name, "
                . "user.middle_name, user.last_name, user.gender, user.date_of_birth, user.activation, "
                . "user.newsletter, user.account_deletion, adres.countries_country_name,  adres.city, "
                . "adres.adres, adres.zipcode, telephone.house_number, telephone.mobile_number, "
                . "telephone.additional_number FROM `user`, `adres`, `telephone` "
                . "WHERE email = ? "
                . "AND user.id_user = adres.user_id_user "
                . "AND user.id_user = telephone.user_id_user;")) {
            
            if (!$stmt->bind_param("s", $email)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            $stmt->bind_result($id_user, $email, $password, $firstName, $middleName, 
                    $lastName, $gender, $dob, $activation, $newsletter, $account_deletion, 
                    $country, $city, $adres, $zipcode, $houseNumber, $mobileNumber, $additionalNumber);
            
            $stmt->fetch();
            
            $this->id_user = $id_user;
            $this->email = $email;
            $this->password = $password;
            $this->firstName = $firstName;
            $this->middleName = $middleName;
            $this->lastName = $lastName;
            $this->gender = $gender;
            $this->dob = $dob;
            
            $this->activation = $activation;
            $this->newsletter = $newsletter;
            $this->account_deletion = $account_deletion;
            
            $this->country = $country;
            $this->city = $city;
            $this->adres = $adres;
            $this->zipcode = $zipcode;
            $this->houseNumber = $houseNumber;
            $this->mobileNumber = $mobileNumber;
            $this->additionalNumber = $additionalNumber;
        } else {
            return false;
        }
    }
    
    /*
     * ---------------------------------------------------
     * - GETTERS
     * ---------------------------------------------------
     */
    function getId_user() {
        return $this->id_user;
    }
        
    function getEmail() {
        return $this->email;
    }
    
    function getPassword() {
        return $this->password;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getMiddleName() {
        return $this->middleName;
    }

    function getLastName() {
        return $this->lastName;
    }
    
    function getFullName() {
        if (empty($this->middleName)) {
            return $this->firstName . " " . $this->lastName;
        }
        if (!empty($this->middleName)){
            return $this->firstName . " " . $this->middleName . " " . $this->lastName;
        }
    }

    function getGender() {
        return $this->gender;
    }

    function getDob() {
        return $this->dob;
    }
    
    function getActivation() {
        return $this->activation;
    }

    function getNewsletter() {
        return $this->newsletter;
    }

    function getAccount_deletion() {
        return $this->account_deletion;
    }
    
    function getCountry() {
        return $this->country;
    }

    function getCity() {
        return $this->city;
    }

    function getAdres() {
        return $this->adres;
    }

    function getZipcode() {
        return $this->zipcode;
    }

    function getHouseNumber() {
        return $this->houseNumber;
    }

    function getMobileNumber() {
        return $this->mobileNumber;
    }

    function getAdditionalNumber() {
        return $this->additionalNumber;
    }
    
    /*
     * ---------------------------------------------------
     * - SETTERS
     * ---------------------------------------------------
     */
    function setId_user($id_user) {
        $this->id_user = $id_user;
    }
    
    function setEmail($email) {
        $this->email = $email;
    }
    
    function setPassword($password) {
        $this->password = $password;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setMiddleName($middleName) {
        $this->middleName = $middleName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setGender($gender) {
        $this->gender = $gender;
    }

    function setDob($dob) {
        $this->dob = $dob;
    }

    function setActivation($activation) {
        $this->activation = $activation;
    }

    function setNewsletter($newsletter) {
        $this->newsletter = $newsletter;
    }

    function setAccount_deletion($account_deletion) {
        $this->account_deletion = $account_deletion;
    }

    function setCountry($country) {
        $this->country = $country;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setAdres($adres) {
        $this->adres = $adres;
    }

    function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
    }

    function setHouseNumber($houseNumber) {
        $this->houseNumber = $houseNumber;
    }

    function setMobileNumber($mobileNumber) {
        $this->mobileNumber = $mobileNumber;
    }

    function setAdditionalNumber($additionalNumber) {
        $this->additionalNumber = $additionalNumber;
    }

        
    /*
     * ---------------------------------------------------
     * - FUNCTIONS
     * ---------------------------------------------------
     */
    
    function insertUser($mysqli) {
        $email = $this->getEmail();
        $password = $this->getPassword();
        $gender = $this->getGender();
        $firstName = $this->getFirstName();
        $middleName = $this->getMiddleName();
        $lastName = $this->getLastName();
        $dob = $this->getDob();

        $id_user = $this->getId_user();
        $country = $this->getCountry();
        $city = $this->getCity();
        $adres = $this->getAdres();
        $zipcode = $this->getZipcode();

        $houseNumber = $this->getHouseNumber();
        $mobileNumber = $this->getMobileNumber();
        $additionalNumber = $this->getAdditionalNumber();
        
        if($stmt = $mysqli->prepare("INSERT INTO `jemeppe`.`user` (`email`, `password`, `gender`, "
                . "`first_name`, `middle_name`, `last_name`, `date_of_birth`) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            
            if (!$stmt->bind_param("sssssss", $email , $password, $gender, $firstName, 
                    $middleName, $lastName, $dob)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            } else {
                    if($stmt2 = $mysqli->prepare("SELECT user.id_user FROM user WHERE email = ?")){
                    if (!$stmt2->bind_param("s", $email)) {
                        echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
                    }

                    if (!$stmt2->execute()) {
                        echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
                    }

                    $stmt2->bind_result($id_user);
                    $stmt2->fetch();

                    $this->id_user = $id_user;
                    
                    $stmt2->store_result();
                    
                    if($stmt3 = $mysqli->prepare("INSERT INTO `jemeppe`.`telephone` "
                            . "(`user_id_user`, `house_number`, `mobile_number`, `additional_number`) "
                            . "VALUES (?, ?, ?, ?);")) {
                        
                        if (!$stmt3->bind_param("isss", $id_user, $houseNumber, $mobileNumber, $additionalNumber)) {
                            echo "Binding parameters failed: (" . $stmt3->errno . ") " . $stmt3->error;
                        }

                        if (!$stmt3->execute()) {
                            echo "Execute failed: (" . $stmt3->errno . ") " . $stmt3->error;
                        }
                    }
                    
                    if($stmt4 = $mysqli->prepare("INSERT INTO `jemeppe`.`adres` "
                            . "(`user_id_user`, `countries_country_name`, `city`, `adres`, `zipcode`) "
                            . "VALUES (?, ?, ?, ?, ?);")) {
                        
                            if (!$stmt4->bind_param("issss", $id_user, $country, $city, $adres, $zipcode)) {
                                echo "Binding parameters failed: (" . $stmt4->errno . ") " . $stmt4->error;
                            }

                            if (!$stmt4->execute()) {
                                echo "Execute failed: (" . $stmt4->errno . ") " . $stmt4->error;
                            } else {
                                return true;
                            }
                    }
                }
            }
        }
    }
    
    function updateUser($email) {
        
    }
    
    function populateById($mysqli, $id_user) {
        if($stmt = $mysqli->prepare("SELECT user.id_user, user.email, user.password, "
                . "user.first_name, user.middle_name, user.last_name, "
                . "user.gender, user.date_of_birth, user.activation, user.newsletter, "
                . "user.account_deletion, adres.countries_country_name, "
                . "adres.city, adres.adres, adres.zipcode, telephone.house_number, "
                . "telephone.mobile_number, telephone.additional_number "
                . "FROM `user`, `adres`, `telephone` "
                . "WHERE user.id_user = ? "
                . "AND user.id_user = adres.user_id_user "
                . "AND user.id_user = telephone.user_id_user;")) {
            
            if (!$stmt->bind_param("s", $id_user)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            $stmt->bind_result($id_user, $email, $password, $firstName, $middleName, 
                    $lastName, $gender, $dob, $activation, $newsletter, $account_deletion, 
                    $country, $city, $adres, $zipcode, $houseNumber, $mobileNumber, $additionalNumber);
            
            $stmt->fetch();
            
            $this->id_user = $id_user;
            $this->email = $email;
            $this->password = $password;
            $this->firstName = $firstName;
            $this->middleName = $middleName;
            $this->lastName = $lastName;
            $this->gender = $gender;
            $this->dob = $dob;
            
            $this->activation = $activation;
            $this->newsletter = $newsletter;
            $this->account_deletion = $account_deletion;
            
            $this->country = $country;
            $this->city = $city;
            $this->adres = $adres;
            $this->zipcode = $zipcode;
            $this->houseNumber = $houseNumber;
            $this->mobileNumber = $mobileNumber;
            $this->additionalNumber = $additionalNumber;
        } else {
            return false;
        }
    }

}

?>
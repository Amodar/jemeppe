<?php
session_start();
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/User.class.php');

//if user already logged in, unset all his login credentials
if (isset($_SESSION['login_string'])) {
    unset($_SESSION['email']);
    unset($_SESSION['login_string']);
}

$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$firstName = $_POST['firstname'];
$middleName = (!isset($_POST['middlename'])) ? null : $_POST['middlename'];
$lastName = $_POST['lastname'];
$dob = $_POST['dob'];

$country = $_POST['country'];
$city = $_POST['city'];
$adres = $_POST['adres'];
$zipcode = $_POST['zipcode'];

$telHouse = (!isset($_POST['houseNumber'])) ? null : $_POST['houseNumber'];
$telMobile = (!isset($_POST['mobileNumber'])) ? null : $_POST['mobileNumber'];
$telAdditional = (!isset($_POST['additionalNumber'])) ? null : $_POST['additionalNumber'];

$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$user = new User($mysqli, $email);

$user->setEmail($email);
$user->setPassword($password);
$user->setGender($gender);
$user->setFirstName($firstName);
if ($middleName == null ? false : $user->setMiddleName($middleName));
$user->setLastName($lastName);
$user->setDob($dob);

$user->setCountry($country);
$user->setCity($city);
$user->setAdres($adres);
$user->setZipcode($zipcode);

if ($telHouse == null ? false : $user->setHouseNumber($telHouse));
if ($telMobile == null ? false : $user->setMobileNumber($telMobile));
if ($telAdditional == null ? false : $user->setAdditionalNumber($telAdditional));

if ($user->insertUser($mysqli)) {
    header('Location: ../account');
} else {
    header('Location: ../registration?error=1');
}
?>
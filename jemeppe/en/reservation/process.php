<?php
session_start();
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
includeFile('backend/model/Room.class.php');
includeFile('backend/model/RoomOverview.class.php');
includeFile('backend/model/Booking.class.php');
includeFile('backend/model/BookingOverview.class.php');

$room = (!isset($_POST['room'])             ? $error= 2 : $_POST['room']);
$arrivalDate = (!isset($_POST['arrival'])   ? $error= 2 : $_POST['arrival']);
$departureDate = (!isset($_POST['departure']) ? $error= 2 : $_POST['departure']);
$adults = (!isset($_POST['adults'])         ? $error= 2 : $_POST['adults']);
$children = (!isset($_POST['children'])     ? $error= 2 : $_POST['children']);

//sanitize
$room = filter_var($room, FILTER_SANITIZE_STRING);
$arrivalDate = preg_replace("([^0-9-])", "", $_POST['arrival']);
$departureDate = preg_replace("([^0-9-])", "", $_POST['departure']);
$adults = filter_var($adults, FILTER_SANITIZE_NUMBER_INT);
$children = filter_var($children, FILTER_SANITIZE_NUMBER_INT);

$aborted = 0;

if(isset($error) == 1) {
    header('location: http://www.broowse.com/jemeppe/en/reservation?error=1');
}
$o_booking = new BookingOverview($mysqli, $arrivalDate, $departureDate);
$roomClass = new Room($mysqli, $room, $language);
$capacity = $roomClass->getCapacity();

if( !empty($arrivalDate) && !empty($departureDate) ) {
    $o_booking = new BookingOverview($mysqli, $arrivalDate, $departureDate);

    if($o_booking->checkAvailability($room, $arrivalDate, $departureDate)) {
    } else {
        $aborted++;
    }
}
if(!empty($adults)) {
    if($adults > $capacity) {
        $aborted++;
    }
    if($adults <= $capacity) {
        if(!empty($children)) {
            if ($children > 0) {
                $totalPeople = $adults + ($children - 1);

                if($totalPeople > $capacity) {
                    $aborted++;
                }
            }
        }
    }
}
if($aborted > 0){
    header("location: http://www.broowse.com/jemeppe/en/reservation?error=2&room=$room&arrival=$arrivalDate&departure=$departureDate&adults=$adults&children=$children");
}
if($aborted === 0) {
    $_SESSION['room'] = $room;
    $_SESSION['arrival'] = $arrivalDate;
    $_SESSION['departure'] = $departureDate;
    $_SESSION['adults'] = $adults;
    $_SESSION['children'] = $children;
    $_SESSION['bookMode'] = '1';
    
    header("location: http://www.broowse.com/jemeppe/en/account/");
}

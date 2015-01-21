<?php
global $mysqli;
include_once( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/includes/backend/model/db_connect.php' );

class BookingOverview {
    private $id_booking = NULL;
    
    function __construct($mysqli, $arrival_date, $departure_date) {
        if($stmt = $mysqli->prepare("SELECT `id_booking` FROM `booking` "
                . "WHERE `arrival_date` > ? AND `departure_date` < ?")){
        
            if (!$stmt->bind_param("ss", $arrival_date, $departure_date)) {
                    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->bind_result($db_id_booking);
            $id_booking = array();
            
            while ($stmt->fetch()) {
                $this->id_booking = array_push($id_booking, $db_id_booking);
            }
            
            $this->id_booking = $id_booking;
            
        } else {
            return false;
        }
    }
    
    function getId_booking() {
        return $this->id_booking;
    }

    function setId_booking($id_booking) {
        $this->id_booking = $id_booking;
    }
    
    function checkAvailability($room, $arrival_date, $departure_date){
        global $mysqli;
        if($stmt = $mysqli->prepare("SELECT id_booking, room_specification.capacity, "
                . "booking.room_specification_id_room_specification, booking.arrival_date, "
                . "booking.departure_date FROM booking, "
                . "room_specification "
                . "WHERE ? < arrival_date AND ? > departure_date "
                . "AND booking.room_specification_id_room_specification = ? "
                . "AND booking.room_specification_id_room_specification = room_specification.id_room_specification")){
            
            if (!$stmt->bind_param("sss", $arrival_date, $departure_date, $room)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            
            $stmt->bind_result($id_booking, $capacity, $room, $arrival_date, $departure_date);
            
            $stmt->store_result();
            
            $total_booked = $stmt->num_rows();
            
            $stmt->fetch();
            
            if($total_booked > 0) {
                if($total_booked >= $capacity) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return true;
            }
        }
    }
}

/*
 * class BookingOverview {
    private $id_booking = NULL;
    private $room = NULL;
    private $id_user = NULL;
    
    private $arrival_date = NULL;
    private $departure_date = NULL;
    private $total_adults = NULL;
    private $total_children = NULL;
    private $booking_date = NULL;
    private $nett_price = NULL;
    private $payment_received = NULL;
    
    function __construct($mysqli, $arrival_date, $departure_date) {
        if($stmt = $mysqli->prepare("SELECT `id_booking`, `room_specification_id_room_specification`, "
                . "`user_id_user`, `arrival_date`, `departure_date`, `total_adults`, "
                . "`total_children`, `booking_date`, `nett_price`, `payment_received` "
                . "FROM `booking` WHERE `arrival_date` > ? AND `departure_date` < ?")){
        
            if (!$stmt->bind_param("ss", $arrival_date, $departure_date)) {
                    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            $stmt->bind_result($db_id_booking, $db_room, $db_id_user, $db_arrival_date, 
                    $db_departure_date, $db_total_adults, $db_total_children, $db_booking_date, 
                    $db_nett_price, $db_payment_received);

            $id_booking = array();
            $room = array();
            $id_user = array();
            $arrival_date = array();
            $departure_date = array();
            $total_adults = array();
            $total_children = array();
            $booking_date = array();
            $nett_price = array();
            $payment_received = array();
            
            while ($stmt->fetch()) {
                $this->id_booking = array_push($id_booking, $db_id_booking);
                $this->room = array_push($room, $db_room);
                $this->id_user = array_push($id_user, $db_id_user);
                $this->arrival_date = array_push($arrival_date, $db_arrival_date);
                $this->departure_date = array_push($departure_date, $db_departure_date);
                $this->total_adults = array_push($total_adults, $db_total_adults);
                $this->total_children = array_push($total_children, $db_total_children);
                $this->booking_date = array_push($booking_date, $db_booking_date);
                $this->nett_price = array_push($nett_price, $db_nett_price);
                $this->payment_received = array_push($payment_received, $db_payment_received);
            }
            
            $this->id_booking = $id_booking;
            $this->room = $room;
            $this->id_user = $id_user;
            $this->arrival_date = $arrival_date;
            $this->departure_date = $departure_date;
            $this->total_adults = $total_adults;
            $this->total_children = $total_children;
            $this->booking_date = $booking_date;
            $this->nett_price = $nett_price;
            $this->payment_received = $payment_received;
            
        } else {
            return false;
        }
    }
    
    function getId_booking() {
        return $this->id_booking;
    }

    function getRoom() {
        return $this->room;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getArrival_date() {
        return $this->arrival_date;
    }

    function getDeparture_date() {
        return $this->departure_date;
    }

    function getTotal_adults() {
        return $this->total_adults;
    }

    function getTotal_children() {
        return $this->total_children;
    }

    function getBooking_date() {
        return $this->booking_date;
    }

    function getNett_price() {
        return $this->nett_price;
    }

    function getPayment_received() {
        return $this->payment_received;
    }

    function setId_booking($id_booking) {
        $this->id_booking = $id_booking;
    }

    function setRoom($room) {
        $this->room = $room;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setArrival_date($arrival_date) {
        $this->arrival_date = $arrival_date;
    }

    function setDeparture_date($departure_date) {
        $this->departure_date = $departure_date;
    }

    function setTotal_adults($total_adults) {
        $this->total_adults = $total_adults;
    }

    function setTotal_children($total_children) {
        $this->total_children = $total_children;
    }

    function setBooking_date($booking_date) {
        $this->booking_date = $booking_date;
    }

    function setNett_price($nett_price) {
        $this->nett_price = $nett_price;
    }

    function setPayment_received($payment_received) {
        $this->payment_received = $payment_received;
    }



}
 * 
 */
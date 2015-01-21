<?php
global $mysqli;
include_once( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/includes/backend/model/db_connect.php' );
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Booking {
    private $id_booking = null;
    private $id_room = null;
    private $id_user = null;
    
    private $arrivalDate = null;
    private $departureDate = null;
    private $totalAdults = null;
    private $totalChildren = null;
    private $booking_date = null;
    private $nett_price = null;
    private $payment_received = null;
    /*
     * ---------------------------------------------------
     * - CONSTRUCTOR
     * ---------------------------------------------------
     */
    
    function __construct($mysqli, $id_booking) {
        
        if($stmt = $mysqli->prepare("SELECT `id_booking`, "
                . "`room_specification_id_room_specification`, `user_id_user`, "
                . "`arrival_date`, `departure_date`, `total_adults`, `total_children`, "
                . "`booking_date`, `nett_price`, `payment_received` "
                . "FROM `booking` "
                . "WHERE id_booking = ?"));
        
        if (!$stmt->bind_param("s", $id_booking)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
            
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        $stmt->bind_result($id_booking, $id_room, $id_user, $arrivalDate, 
                $departureDate, $totalAdults, $totalchildren, $bookingDate, 
                $nett_price, $payment_received);
        
        $stmt->fetch();

        $this->id_booking = $id_booking;
        $this->id_room = $id_room;
        $this->id_user = $id_user;
        $this->arrivalDate = $arrivalDate;
        $this->departureDate = $departureDate;
        $this->totalAdults = $totalAdults;
        $this->totalChildren = $totalchildren;
        $this->booking_date = $bookingDate;
        $this->nett_price = $nett_price;
        $this->payment_received = $payment_received;
    }
    
     /*
     * ---------------------------------------------------
     * - GETTERS
     * ---------------------------------------------------
     */
     function getId_booking() {
         return $this->id_booking;
     }
     
     function getId_room() {
         return $this->id_room;
     }

     function getId_user() {
         return $this->id_user;
     }

     function getArrivalDate() {
         return $this->arrivalDate;
     }

     function getDepartureDate() {
         return $this->departureDate;
     }

     function getTotalAdults() {
         return $this->totalAdults;
     }

     function getTotalChildren() {
         return $this->totalChildren;
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
    /*
     * ---------------------------------------------------
     * - SETTERS
     * ---------------------------------------------------
     */
    function setId_booking($id_booking) {
        $this->id_booking = $id_booking;
    }
    
    function setId_room($id_room) {
        $this->id_room = $id_room;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setArrivalDate($arrivalDate) {
        $this->arrivalDate = $arrivalDate;
    }

    function setDepartureDate($departureDate) {
        $this->departureDate = $departureDate;
    }

    function setTotalAdults($totalAdults) {
        $this->totalAdults = $totalAdults;
    }

    function setTotalChildren($totalChildren) {
        $this->totalChildren = $totalChildren;
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
    /*
     * ---------------------------------------------------
     * - FUNCTIONS
     * ---------------------------------------------------
     */
    
    
    function insertBooking($mysqli){
        $id_user = $this->id_user;
        $id_room = $this->id_room;
        $arrivalDate = $this->arrivalDate;
        $departureDate = $this->departureDate;
        $totalAdults = $this->totalAdults;
        $totalChildren = $this->totalChildren;
        $nett_price = $this->nett_price;
        
        if($stmt = $mysqli->prepare("INSERT INTO `booking`(`room_specification_id_room_specification`, "
                . "`user_id_user`, `arrival_date`, `departure_date`, `total_adults`, "
                . "`total_children`, `nett_price`) "
                . "VALUES (?,?,?,?,?,?,?)")){
            
            if (!$stmt->bind_param("sissiid", $id_room, $id_user,
                    $arrivalDate, $departureDate, $totalAdults, 
                    $totalChildren, $nett_price)) {
                    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
                }
            if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            } else {
                return true;
            }
        }
    }
    
    function setToLastBooking($mysqli, $id_user) {
        if($stmt = $mysqli->prepare("SELECT `booking_date` , id_booking, 
            `room_specification_id_room_specification`, `user_id_user`, `arrival_date`, 
            `departure_date`, `total_adults`, `total_children`, `nett_price`, `payment_received` 
            FROM booking, user 
            WHERE user_id_user = ?
            AND user_id_user = user.id_user
            ORDER BY booking_date DESC
            LIMIT 1")){
            
            if (!$stmt->bind_param("i", $id_user)) {
                    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            } else {
                $stmt->bind_result($bookingDate, $id_booking, $id_room, $id_user, $arrivalDate,
                        $departureDate, $totalAdults, $totalchildren, $nett_price, $payment_received);
                
                $stmt->fetch();
                
                $this->id_booking = $id_booking;
                $this->id_room = $id_room;
                $this->id_user = $id_user;
                $this->arrivalDate = $arrivalDate;
                $this->departureDate = $departureDate;
                $this->totalAdults = $totalAdults;
                $this->totalChildren = $totalchildren;
                $this->booking_date = $bookingDate;
                $this->nett_price = $nett_price;
                $this->payment_received = $payment_received;
            }
        }
    }
}
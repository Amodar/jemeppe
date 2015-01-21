<?php
session_start();
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
includeFile('backend/model/validation.php');
includeFile('backend/model/Price.class.php');
includeFile('backend/model/User.class.php');
includeFile('backend/model/Room.class.php');
includeFile('backend/model/Booking.class.php');
includeFile('backend/model/BookingOverview.class.php');
includeFile('backend/model/Content.class.php');
includeFile('backend/model/ContentOverview.class.php');
includeFile('backend/functions.php');

date_default_timezone_set('europe/amsterdam');
$twoYearsFromNow = date('Y-m-d', strtotime('+2 year'));
echo $twoYearsFromNow;

$email = $_SESSION['email'];

$id_booking = NULL;

$fixed_price = new Price($mysqli);
$additionalCost = $fixed_price->getAdditional_cost();
$administrationCost = $fixed_price->getAdministration_cost();
$tax = $fixed_price->getTax();

$user = new User($mysqli, $email);
$id_user = $user->getId_user();
$fullName = $user->getFullName();
$country = $user->getCountry();
$zipcode = $user->getZipcode();
$adres = $user->getAdres();
$city = $user->getCity();
$houseNumber = $user->getHouseNumber();
$mobileNumber = $user->getMobileNumber();
$additionalNumber = $user->getAdditionalNumber();

$o_booking = new BookingOverview($mysqli, "2014-1-1", $twoYearsFromNow);
$o_booking_ids = $o_booking->getId_booking();


$category = 'reservation_success';
$o_content = new ContentOverview($mysqli, $category, $language);
$o_contentId = $o_content->getId_content();
$contentTitle = array();
$contentContent = array();

foreach($o_contentId as $o_contentId) {
    $content = new Content($mysqli, $o_contentId);

    $title = $content->getTitle();
    $content = $content->getContent();

    array_push($contentTitle, $title);
    array_push($contentContent, $content);
}
?>
<html>
    <head>
        <?php includeFile('frontend/standard.php'); ?>
    </head>
    <body>
        <?php 
            includeFile('frontend/navigation.php');
            if (login_check($mysqli) == true) {
        ?>
        <br>
        <div class="container">
                <form action="en/account/invoices" method="POST">
                    <div class='col-md-6'>
                    <select class="form-control" name="id">
                        <?php
                        foreach($o_booking_ids as $o_booking_ids){
                            $booking = new Booking($mysqli, $o_booking_ids);
                            $booking_id_user = $booking->getId_user();
                            $booking_id_booking = $booking->getId_booking();

                            $arrivalDate = $booking->getArrivalDate();
                            $departureDate = $booking->getDepartureDate();
                            if($booking_id_user !== $id_user){
                                continue;
                            }
                            echo $booking_id_booking == $_POST['id'] ? $grammarAdult = "<option selected value=$booking_id_booking>" : "<option value=$booking_id_booking>";
                            echo $arrivalDate . " - " . $departureDate;
                            echo "</option>";
                        }
                        ?>
                    </select>
                    </div>
                    <div class='col-md-6'>
                    <input class="form-control btn btn-info" type="submit">
                    </div>
                </form>
        </div>
        <br>
        <?php
        if(isset($_POST['id'])){
            $booking = new Booking($mysqli, $_POST['id']);
            $bookingDate = $booking->getBooking_date();
            $id_room = $booking->getId_room();
            $arrivalDate = $booking->getArrivalDate();
            $departureDate = $booking->getDepartureDate();
            $totalAdults = $booking->getTotalAdults();
            $totalAdults == 1 ? $grammarAdult = "adult" : $grammarAdult = "adults";
            $totalChildren = $booking->getTotalChildren();
            $totalChildren == 1 ? $grammarChild = "child" : $grammarChild = "children";
            $nett_price = $booking->getNett_price();
            $dateRange = iterator_count(returnDateRange($arrivalDate, $departureDate));
            
            $room = new Room($mysqli, $id_room, $language);
            $roomName = $room->getRoom_name();
            $roomPrice = $room->getPrice();
            $capacity = $room->getCapacity();

            $totalAdultCost = number_format((float)(($totalAdults) * $roomPrice), 2, '.', '');
            $totalChildrenCost = number_format((float)(($totalChildren) * $roomPrice) / 2, 2, '.', '');
            $bruto = number_format((float)($totalAdultCost + $totalChildrenCost) * $dateRange, 2, '.', '');
            $netto = number_format((float)($bruto / 100 * $tax + $bruto), 2, '.', '');
            $total = number_format((float)$netto + $additionalCost + $administrationCost, 2, '.', '');
        ?>
        <div class='container'>
            <div class='container' style='border: 1px solid black; margin: 0; padding: 0;' >    
                <div class='container centered'>
                <img src='../jemeppe/media/image/logo/jemeppe_logo.png' style='height: 100px; width: auto;'>
                </div>

                <div class='container'>
                    <p class='margin-padding-off pull-right'>Booked on: <?= $bookingDate ?></p>
                </div>

                <div class='container' style='border-top: 1px solid black; border-bottom: 1px solid black; width: auto;'>
                    
                    <div class='col-md-4 centered'>
                        <label>Name</label><p><?= $fullName ?></p>
                        <label>Country</label><p><?= $country ?></p>
                        <label>City</label><p><?= $city ?></p>
                        <label>Zipcode</label><p><?= $zipcode ?></p>
                        <label>Address</label><p><?= $adres ?></p>
                    </div>
                    <div class='col-md-4 centered'>
                        <label>COMPANY</label><p>Castle Jemeppe</p>
                        <label>MEMBERSHIP NO.</label><p><?= $id_user ?></p>
                        <label>INVOICE NO.</label><p><?= $booking->getId_booking() ?></p>
                    </div>
                    <div class='col-md-4 centered'>
                        <label>ROOM.</label><p><?= $roomName ?></p>
                        <label>ARRIVAL</label>
                        <p><?= $arrivalDate ?></p>
                        <label>DEPARTURE</label>
                        <p><?= $departureDate ?></p>
                        
                    </div>
                </div>
                <div class='container'>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>
                                    DATE
                                </th>
                                <th>
                                    DESCRIPTION
                                </th>
                                <th>
                                    CHARGES
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?= date("Y-m-d", strtotime($bookingDate)); ?>
                                </td>
                                <td>
                                    
                                    <?= $totalAdults . " " . $grammarAdult ?> staying in <?= $roomName ?>
                                </td>
                                <td>
                                    <i class="fa fa-eur"></i><?= $totalAdultCost ?>
                                </td>
                            </tr>
                            <?php if($totalChildren > 0) { ?>
                            <tr>
                                <td>
                                    <?= date("Y-m-d", strtotime($bookingDate)); ?>
                                </td>
                                <td>
                                    <?= $totalChildren . " " . $grammarChild ?> staying in <?= $roomName ?>
                                </td>
                                <td>
                                    <i class="fa fa-eur"></i><?= $totalChildrenCost ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tr style="border-top: 3px solid #000 !important;">
                            <td>
                            </td>
                            <td style='text-align: right;'>
                                TOTAL NIGHTS
                            </td>
                            <td>
                                <?= $dateRange ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td style='text-align: right;'>
                                SUBTOTAL
                            </td>
                            <td>
                                <i class="fa fa-eur"></i><?= $bruto ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td style='text-align: right;'>ADMINISTRATION COSTS</td>
                            <td><i class="fa fa-eur"></i><?= $administrationCost ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style='text-align: right;'>ADDITIONAL COSTS</td>
                            <td><i class="fa fa-eur"></i><?= $additionalCost ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style='text-align: right;'>TAX</td>
                            <td><?= $tax ?>%</td>
                        </tr>
                        <tr style="border: 3px dashed #000 !important;">
                            <td></td>
                            <td style='text-align: right;'>TOTAL</td>
                            <td><i class="fa fa-eur"></i><?= $nett_price ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12" style="border-top: 2px solid black;">
                    
                <p class="lead centered">For questions, please contact us</p>
                    <div class="col-md-4 centered">
                        <p>
                            Additional Costs contains {insert items}.
                        </p>
                    </div>
                    <div class="col-md-4 centered">
                        <label>JEMEPPE ADRES</label>
                        <p>Chateau Jemeppe</p>
                        <p>Oude Waterlandseweg 29</p>
                        <p>1358 BT Almere, Netherlands</p>
                        <p>T [+32] (0)84 22 59 01</p>
                        <p>F [+32] (0)84 22 59 00</p>
                        <p>Email: info@chateaujemeppe.eu</p>
                    </div>
                    <div class="col-md-4 centered">
                        <i>disclaimers</i>
                        <p><?= $contentContent[1] ?></p>
                    </div>
                    
                </div>
                

            </div>
        </div>
        <?php
            }
        } else {
            header("location: http://broowse.com/jemeppe/en/account/");
        }
        ?>
        
        
        <?php 
            includeFile('frontend/footer.php');
        ?>
    </body>
</html>
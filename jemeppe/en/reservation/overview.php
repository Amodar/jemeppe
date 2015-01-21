<?php
session_start();
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
includeFile('backend/functions.php');

includeFile('backend/model/Price.class.php');
includeFIle('backend/model/User.class.php');
includeFile('backend/model/Room.class.php');
includeFile('backend/model/Booking.class.php');
includeFile('backend/model/Content.class.php');
includeFile('backend/model/ContentOverview.class.php');

$email = $_SESSION['email'];
$roomId = $_SESSION['room'];

$arrivalDate = $_SESSION['arrival'];
$departureDate = $_SESSION['departure'];
$adults = $_SESSION['adults'];
$children = $_SESSION['children'];

$price = new Price($mysqli);
$priceTax = $price->getTax();
$priceAdministration = number_format((float)$price->getAdministration_cost(), 2, '.', '');
$priceAdditional = number_format((float)$price->getAdditional_cost(), 2, '.', '');

$user = new User($mysqli, $email);
$id_user = $user->getId_user();
$name = $user->getFullName();


$room = new Room($mysqli, $roomId, $language);
$roomName = $room->getRoom_name();
$roomPrice = $room->getPrice();

$dateRange = iterator_count(returnDateRange($arrivalDate, $departureDate));
$totalAdultCost = number_format((float)(($adults) * $roomPrice), 2, '.', '');
$totalChildrenCost = number_format((float)(($children) * $roomPrice) / 2, 2, '.', '');
$bruto = number_format((float)($totalAdultCost + $totalChildrenCost) * $dateRange, 2, '.', '');
$netto = number_format((float)($bruto / 100 * $priceTax + $bruto), 2, '.', '');
$total = number_format((float)$netto + $priceAdditional + $priceAdministration, 2, '.', '');

if(isset($_POST['success'])){
    if($_POST['success'] == 1){
        $bookingID = NULL;
        $booking = new Booking($mysqli, $bookingID);
        
        $booking->setId_user($id_user);
        $booking->setId_room($roomId);
        $booking->setArrivalDate($arrivalDate);
        $booking->setDepartureDate($departureDate);
        $booking->setTotalAdults($adults);
        $booking->setTotalChildren($children);
        $booking->setNett_price($total);
        
        if($booking->insertBooking($mysqli)) {
            header('location: http://www.broowse.com/jemeppe/en/reservation/success');
        }
    }
    if($_POST['success'] == 0){
        unset($_SESSION['room']);
        unset($_SESSION['arrival']);
        unset($_SESSION['departure']);
        unset($_SESSION['adults']);
        unset($_SESSION['children']);
        unset($_SESSION['bookMode']);
        header('location: http://www.broowse.com/jemeppe/en/rooms/');
    }
}
$category = 'reservation_overview';
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
        ?>
        <br>
        <div class='container'>
            <p class='lead centered'><?= $contentTitle[0] ?> <?= $name ?>, <?= $contentContent[0] ?></p>
            <div class="container col-md-6">
                <div class="form-group">
                  <label class="control-label">Room</label>
                  <div>
                      <input type="text" disabled  class="form-control" value="<?= $roomName ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Arrival</label>
                  <div>
                      <input type="text" disabled  class="form-control" value="<?= $arrivalDate?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Departure</label>
                  <div>
                      <input type="text" disabled  class="form-control" value="<?= $departureDate ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Total nights</label>
                  <div>
                      <input type="text" disabled  class="form-control" value="<?= $dateRange ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Adults & Total Cost</label>
                  <div>
                      <div class="form-group col-md-6">
                      <input type="text" disabled  class="form-control" value="<?= $adults ?>">
                      </div>
                    <div class="form-group col-md-6">
                        
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-eur"></i></div>
                        <input type="text" disabled  class="form-control" value="<?= $totalAdultCost ?>">
                      </div>
                    </div>
                      
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Children</label>
                  <div>
                      <div class="form-group col-md-6">
                      <input type="text" disabled  class="form-control" value="<?= $children ?>">
                      </div>
                    <div class="form-group col-md-6">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-eur"></i></div>
                        <input type="text" disabled  class="form-control" value="<?= $totalChildrenCost ?>">
                      </div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="container  col-md-6">
                <div class="form-group">
                  <label class="control-label">TAX</label>
                  <div>
                      <div class="input-group">
                        <div class="input-group-addon">%</div>
                      <input type="text" disabled  class="form-control" value="<?= $priceTax ?>">
                  </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label">BRUTO</label>
                  <div>
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-eur"></i></div>
                        <input type="text" disabled  class="form-control" value="<?= $bruto ?>">
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">NETTO</label>
                  <div>
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-eur"></i></div>
                        <input type="text" disabled  class="form-control" value="<?= $netto ?>">
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Administration costs</label>
                  <div>
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-eur"></i></div>
                      <input type="text" disabled  class="form-control" value="<?= $priceAdministration ?>">
                    </div>
                    </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Additional costs</label>
                  <div>
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-eur"></i></div>
                      <input type="text" disabled  class="form-control" value="<?= $priceAdditional ?>">
                  </div>
                      </div>
                </div>
                <div class="form-group">
                  <label class="control-label">TOTAL</label>
                  <div>
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-eur"></i></div>
                      <input type="text" disabled  class="form-control" value="<?= $total ?>">
                      </div>
                      </div>
                </div>
            </div>
            
            <div class='btn-toolbar'>
                <form action="en/reservation/overview" method="POST">
                    <button name="success" value="0" type="submit" class='btn btn-danger pull-left'>Cancel</button>
                    <button name="success" value="1" type="submit" class='btn btn-info pull-right'>Continue with Payment</button>
                </form>
            </div>
        </div>
        
        
        
    </body>
</html>
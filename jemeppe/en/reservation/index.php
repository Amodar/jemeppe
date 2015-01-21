<?php
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
includeFile('backend/model/Room.class.php');
includeFile('backend/model/RoomOverview.class.php');
includeFile('backend/model/Content.class.php');
includeFile('backend/model/ContentOverview.class.php');



$room =         (empty($_POST['room'])      ? $error = 1 : $_POST['room']);
$arrivalDate =  (empty($_POST['arrival'])   ? $error = 1 : $_POST['arrival']);
$departureDate =(empty($_POST['departure']) ? $error = 1 : $_POST['departure']);
$adults =       (empty($_POST['adults'])    ? $error = 1 : $_POST['adults']);
$children =     (!isset($_POST['children'])  ? $error = 1 : $_POST['children']);



if(isset($_GET['room']) && isset($_GET['arrival']) && isset($_GET['departure']) 
        && isset($_GET['adults']) && isset($_GET['children'])) {
        $room = $_GET['room'];
        $arrivalDate = $_GET['arrival'];
        $departureDate = $_GET['departure'];
        $adults = $_GET['adults'];
        $children = $_GET['children'];
        $error = 0;
}

if(!empty($error) == 1) {
    header('location: http://www.broowse.com/jemeppe/en/rooms?error=1');
}

$category = 'reservation_index';
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
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker.min.css">
    
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker3.min.css">

        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/locales/bootstrap-datepicker.en-GB.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/locales/bootstrap-datepicker.nl.min.js"></script>

        <script defer="defer">
            $(function() {
                $('#datepicker').datepicker({
                    format: "yyyy-mm-dd",
                    startDate: "today",
                    endDate: "+2y",
                    todayBtn: true,
                    multidateSeparator: ",",
                    todayHighlight: true,
                    clearBtn: true
                });
            });
        </script>
    </head>
    <body>
        <?php 
            includeFile('frontend/navigation.php');
            $o_room = new RoomOverview($mysqli, $language);
            $o_roomId = $o_room->getRoom_id();
            $o_roomName = $o_room->getRoom_name();
            
            
        ?>
        <br>
        <div class="container centered">
            <div class="col-md-12">
                <?php
                    
                    if(isset($_GET['error']) == 2) {
                        echo "<p class='mark'>The dates or the amount of people is invalid, please try again.</p>";
                    }
                ?> 
                <p class="lead"><?= $contentContent[0] ?></p>
            </div>
            
            <div class="col-md-12">
                <form action="en/reservation/process" method="post" role="form">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="rooms">Your room</label> 
                            <select class="form-control" name="room">
                                <?php
                                    foreach ($o_roomId as $o_roomId) {
                                        $room1 = new Room($mysqli, $o_roomId, $language);
                                        echo ($room == $o_roomId ? "<option value='$o_roomId' selected>" : "<option value='$o_roomId'>");
                                        echo "(room name: " . $room1->getRoom_name() . ") ( price per night per person: &euro;" . $room1->getPrice() . ") ( capacity: " . $room1->getCapacity() . " + 1 child)";
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-daterange" id="datepicker">
                            <div class="form-group col-sm-6"> 
                                <label for="arrival">Arrival date</label>       <input style="cursor:pointer" readonly="true" type="text" value="<?= $arrivalDate ?>" class="input-sm-2 form-control" name="arrival"  id="arrival">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="departure">Departure date</label>   <input style="cursor:pointer" readonly="true" type="text" value="<?= $departureDate ?>" class="input-sm-2 form-control" name="departure"  id="departure" >
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="adults">Adults</label>              <input type="number" min="1" max="5" step="1" value="<?= $adults ?>" id="adults" name="adults" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                                <label for="children">Children(0-3)</label>        <input type="number" min="0" max="5" step="1" value="<?= $children ?>" id="children" name="children" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" value="CONFIRMED & PROCEED" class="form-control btn btn-danger">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
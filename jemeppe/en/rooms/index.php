<?php
session_start();
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
includeFile('backend/model/Room.class.php');
includeFile('backend/model/RoomOverview.class.php');
includeFile('backend/model/Content.class.php');
includeFile('backend/model/ContentOverview.class.php');
includeFile('backend/model/Booking.class.php');
includeFile('backend/model/BookingOverview.class.php');

$room = (!isset($_POST['room'])             ? $_POST['room'] = 'all'     : $_POST['room']);
$arrivalDate = (!isset($_POST['arrival'])   ? $_POST['arrival'] = NULL   : $_POST['arrival']);
$departureDate = (!isset($_POST['departure']) ? $_POST['departure'] = NULL : $_POST['departure']);
$adults = (!isset($_POST['adults'])         ? $_POST['adults'] = '1'     : $_POST['adults']);
$children = (!isset($_POST['children'])     ? $_POST['children'] = '0'   : $_POST['children']);

$o_room = new RoomOverview($mysqli, $language);
$o_roomId = $o_room->getRoom_id();
$o_roomName = $o_room->getRoom_name();


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
            
    
            function validateAvailable(){
                
                var arrivalDate=document.forms["formAvailable"]["arrival"].value;
                var departureDate=document.forms["formAvailable"]["departure"].value;
                
                if(!arrivalDate || !departureDate) {
                    alert("Please fill in your desired Arrival date and Departure date and click on 'check availability'.");
                    return false;
                } else {
                    return true;
                }
            }
            
            
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
                
                $('#myModal').on('shown.bs.modal', function () {
                    $('#myInput').focus()
                });
                
            });
        </script>
    </head>
    <body>
        <?php 
            includeFile('frontend/navigation.php');
        ?>
        <br>
               
        <div class="container">
            <form action="en/rooms/" method="post" role="form" id="formAvailable">
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="rooms">Choose room</label> 
                        <select class="form-control" name="room">
                            <option value="all" selected>All</option>
                            <?php
                                foreach (array_combine($o_roomId, $o_roomName) as $id => $name) {
                                    echo (($_POST['room']) == $id ? "<option value='$id' selected>" : "<option value='$id'>");
                                    echo $name;
                                    echo "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="input-daterange" id="datepicker">
                        <div class="form-group col-sm-3"> 
                            <label for="arrival">Arrival date</label>       <input style="cursor:pointer" readonly="true" type="text" value="<?= $arrivalDate ?>" class="input-sm-2 form-control" name="arrival"  id="arrival">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="departure">Departure date</label>   <input style="cursor:pointer" readonly="true" type="text" value="<?= $departureDate ?>" class="input-sm-2 form-control" name="departure"  id="departure" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="adults">Adults</label>              <input type="number" min="1" max="5" step="1" value="<?= $adults ?>" id="adults" name="adults" class="form-control">
                        
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="children">Children(0-3)</label>        <input type="number" min="0" max="5" step="1" value="<?= $children ?>" id="children" name="children" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <input type="submit" value="Check availability" class="form-control btn btn-danger" id="checkAvailable">
                    </div>
                </div>
            </form>
        </div>
        <?php if (isset($_GET['error'])== 1) { echo "<p class='mark centered'>*You have not clicked on 'Check availability' after inputting dates.*</p>"; } ?>
        <hr class="margin-padding-off" >
        <div class="container">
            <div class="row">
                    <?php
                    $aborted = 0;
                    $totalRoomObjects = count($o_roomId);
                        foreach ($o_roomId as $o_roomId) {
                            $room = new Room($mysqli, $o_roomId, $language);
                            
                            $roomName = $room->getRoom_name();
                            $price = $room->getPrice();
                            $capacity = $room->getCapacity();
                            $shower = $room->getShower();
                            $toilet = $room->getToilet();
                            $sink = $room->getSink();

                            $o_content = new ContentOverview($mysqli, 'room', $language);
                            $o_contentId = $o_content->getId_content();
                            
                            
                            foreach($o_contentId as $o_contentId){
                                $content = new Content($mysqli, $o_contentId);
                                
                                if($content->getRoom() == $o_roomId) {
                                    $contentTitle = $content->getTitle();
                                    $contentContent = $content->getContent();
                                }
                            }
                            
                            if($_POST['room'] !== 'all') {
                               if($_POST['room'] !== $o_roomId) {
                                   $aborted++;
                                   continue;
                               }
                            }
                            if( !empty($arrivalDate) && !empty($departureDate) ) {
                                $o_booking = new BookingOverview($mysqli, $arrivalDate, $departureDate);
                                
                                if($o_booking->checkAvailability($o_roomId, $arrivalDate, $departureDate)) {
                                } else {
                                    $aborted++;
                                    continue;
                                }
                            }
                            
                            if(!empty($adults)) {
                                if($adults > $capacity) {
                                    $aborted++;
                                    continue;
                                }
                                if($adults <= $capacity) {
                                    if(!empty($children)) {
                                        if ($children > 0) {
                                            $totalPeople = $adults + ($children - 1);

                                            if($totalPeople > $capacity) {
                                                $aborted++;
                                                continue;
                                            }
                                        }
                                    }
                                }
                            }
                            $content->getUrlRoomImages($mysqli, $o_roomId);
                            $trim_o_roomId = str_replace(' ', '', $o_roomId);
                    ?>
                    <div class="col-md-12">
                        <h1 class='centered'><?= $contentTitle ?></h1>
                        <div class="col-md-6 img-col-md-6 centered">
                            <img src="<?= $content->getUrl_image()[0] ?>">
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Price</th>
                                    <th>Capacity</th>
                                    <th>Shower</th>
                                    <th>Toilet</th>
                                    <th>Sink</th>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-eur"></i><?= $price ?></td>
                                    <td>
                                        <?php
                                            for( $i = 0; $i < $capacity; $i++ ) {
                                                echo '<i class="fa fa-user"></i>';
                                            }
                                        ?>
                                         <i class="fa fa-plus"></i> <i class="fa fa-child"></i>
                                    </td>
                                    <td><?php echo $shower == 0 ? '<i class="fa fa-square-o"></i>' : '<i class="fa fa-check-square-o"></i>'; ?></td>
                                    <td><?php echo $toilet == 0 ? '<i class="fa fa-square-o"></i>' : '<i class="fa fa-check-square-o"></i>'; ?></td>
                                    <td><?php echo $sink == 0 ? '<i class="fa fa-square-o"></i>' : '<i class="fa fa-check-square-o"></i>'; ?></td>
                                </tr>
                            </table>
                            <h3><?= $contentContent ?></h3>
                            <form role="form" action="en/reservation/" method="POST" id="submitBooking">
                                <div class="btn-toolbar">
                                    <input type="hidden" name="room"        value="<?= $o_roomId ?>">
                                    <input type="hidden" name="arrival"     value="<?= $arrivalDate ?>">
                                    <input type="hidden" name="departure"   value="<?= $departureDate ?>">
                                    <input type="hidden" name="adults"      value="<?= $adults ?>">
                                    <input type="hidden" name="children"    value="<?= $children ?>">
                                    <input type="submit" onclick="return validateAvailable();" value="Book this room" class="btn btn-primary pull-right" />
                                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target='#<?= $trim_o_roomId ?>'>More info</button>
                                </div>
                            </form>
                                
                                               
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="<?= $trim_o_roomId ?>" role="dialog" >
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?= $roomName ?></h4>
                          </div>
                          <div class="modal-body">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <?php
                                $i=0;
                                foreach($content->getUrl_image() as $url) {
                                    $i++;
                                    if($i == 1) {
                                        echo '<div class="item active">';
                                        echo "<img src='$url'>";
                                        echo '</div>';
                                        continue;
                                    }
                                        echo '<div class="item">';
                                        echo "<img src='$url'>";
                                        echo '</div>';
                                }
                                ?>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                              <p>More information, if required</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                
                    <?php
                    } if($totalRoomObjects == $aborted) {
                        echo "Sorry there are 0 rooms available.";
                    }
                    ?>
                
            </div>
        </div>
    </body>
    <?php
         includeFile('frontend/footer.php');
    ?>
</html>
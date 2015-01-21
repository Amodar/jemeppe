<?php
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/url_translator.php');
includeFile('backend/model/Booking.class.php');
includeFile('backend/model/BookingOverview.class.php');
includeFile('backend/functions.php');

?>

<html>
    <head>
        <?php includeFile('frontend/standard.php'); ?>
        <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>
      
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css">
    <script>
    $(function() {
        var array = ["2015-01-01", "2015-01-15", "2015-01-16"]
        $('#dp').datepicker({
            beforeShowDay: test
        });
        
        function test(date) {
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [ array.indexOf(string) == -1 ];
        }
    });
    </script>
    </head>
    
    <body>
        
        <input type="text" id="dp">
        <?php
        echo phpinfo();
        $id_booking = 1;
        
        $room = 'blue room';
        $arrival_date = '2014-10-10';
        $departure_date = '2016-10-10';
        
        $booking = new Booking($mysqli, $id_booking);
        
        $o_booking = new BookingOverview($mysqli, $arrival_date, $departure_date);
        
        
        if($o_booking->checkAvailability($room, $arrival_date, $departure_date)) {
            echo "rooms available";
        } else {
            echo "nope";
        }
            
        //echo $booking->getRoom();
        
        foreach($o_booking->getId_booking() as $bookingID) {
            $booking = new Booking($mysqli, $bookingID);
            if($booking->getTotalAdults() == 2) {
                echo $booking->getId_user();
            }
        }
        
        $fromdate = $arrival_date;
        $todate = $departure_date;
        
        //echo "<br>";
        //returnDateRange($arrival_date, $departure_date);
    
        ?>
        <br>///////////////////////
        
        <form action="#" method="get">
            <div class="form-group col-md-12">
                    <div class="checkbox">
                        <label>
                          <input type="radio" value="male"> <b>Male</b>
                        </label>
                        <label>
                          <input type="radio" value="female"> <b>Female</b>
                        </label>
                    </div>
            <input type="submit">
        </div>
                    
        </form>
    </body>
    
  
</html>
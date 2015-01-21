<?php
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
?>

<html>
    <head>
        <?php includeFile('frontend/standard.php'); ?>
        
        <style>
        #map-canvas {
          width: 100%;
          height: 300px;
        }
        
        @media all and (max-width: 770px) {
                #map-canvas {
                    width: 100%;
                    height: 150px;
                  }

            }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script defer='defer'>
      function initialize() {
        var myLatlng = new google.maps.LatLng(52.348226, 5.247298);
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
            center: myLatlng,
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);
        
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Hello World!'
        });
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    </head>
    <body>
        <?php 
            includeFile('frontend/navigation.php');
        ?>
        <h1 class='centered'>Vragen of feedback zijn zeer gewaardeerd.</h1>
        <form action="en/contact" method="post">
        <div class="container">
            <div class="col-md-6 form-group">
                <label>Naam</label>
                <input type="text" class="form-control" placeholder="Uw naam">
            </div>
            <div class="col-md-6 form-group">
                <label>Email</label>
                <input type="text" class="form-control" placeholder="Uw email">
            </div>
            <div class="col-md-12 form-group">
                <label>Bericht</label>
                <textarea rows="6" class="form-control form-group" rows="6" placeholder="Uw bericht"></textarea>
                <input type="submit" class="form-control form-group" value="send">
            </div>
        </div>
        </form>
        <br>
        
        <h1 class='centered'>Locatie</h1>
        <div id="map-canvas"></div>
        <h1 class='centered'>Adres</h1>
        <div class='centered'>
            <p>Chateau Jemeppe</p>
            <p>Oude Waterlandseweg 29</p>
            <p>1358 BT Almere, Netherlands</p>
            <p>T [+32] (0)84 22 59 01</p>
            <p>F [+32] (0)84 22 59 00</p>
            <p>Email: info@chateaujemeppe.eu</p>
        </div>
        <?= includeFile('frontend/footer.php'); ?>
    </body>
</html>
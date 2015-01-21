<?php
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
?>

<html>
    <head>
        <?php includeFile('frontend/standard.php'); ?>
    </head>
    <body>
        <?php 
            includeFile('frontend/navigation.php');
        ?>
        
        <div class='container'>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <img src="../../jemeppe/media/image/leisure/hot_air_balloon/home_1.jpg">
                </div>
            </div>
        </div>
        
        <?php 
            includeFile('frontend/footer.php');
        ?>
    </body>
</html>
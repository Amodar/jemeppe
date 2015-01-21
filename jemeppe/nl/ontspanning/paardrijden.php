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
        
        
        <div class='container centered'>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <img style="height: 300px;" src="../../jemeppe/media/image/leisure/horse_riding/333.jpg">
                    <img style="height: 300px;" src="../../jemeppe/media/image/leisure/horse_riding/337.jpg">
                </div>
            </div>
        </div>
        <div class="container">
            
        </div>
        <?php 
            includeFile('frontend/footer.php');
        ?>
    </body>
</html>
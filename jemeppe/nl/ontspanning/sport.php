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
                    <img style="height: 300px;" src="../../jemeppe/media/image/leisure/sport/332.jpg">
                    <img style="height: 300px;" src="../../jemeppe/media/image/leisure/sport/458.jpg">
                    <img style="height: 300px;" src="../../jemeppe/media/image/leisure/sport/459.jpg">
                    <img style="height: 300px;" src="../../jemeppe/media/image/leisure/sport/460.jpg">
                    <img style="height: 300px;" src="../../jemeppe/media/image/leisure/sport/465.jpg">
                </div>
            </div>
        </div>
        <?php 
            includeFile('frontend/footer.php');
        ?>
    </body>
</html>
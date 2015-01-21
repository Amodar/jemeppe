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
        
        <p>Conferences</p>
        <p>Conventions</p>
        <p>Weddings</p>
        <p>Reservations</p>
        <?php 
            includeFile('frontend/footer.php');
        ?>
    </body>
</html>
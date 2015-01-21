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
        
        <p>Conventies</p>
        <p>Vergaderingen</p>
        <p>Trouwerij</p>
        <p>Reservaties</p>
        <?php 
            includeFile('frontend/footer.php');
        ?>
    </body>
</html>
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
        <p>Horse Riding</p>
        <p>Hot air balloon</p>
        <p>Library</p>
        <p>Sport</p>
        <p>Swimming Pool</p>
        <?php 
            includeFile('frontend/footer.php');
        ?>
    </body>
</html>
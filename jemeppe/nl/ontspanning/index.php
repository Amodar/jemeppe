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
        <p>Paardrijden</p>
        <p>Hete luchtballon</p>
        <p>Bibliotheek</p>
        <p>Sport</p>
        <p>Zwembad</p>
        <?php 
            includeFile('frontend/footer.php');
        ?>
    </body>
</html>
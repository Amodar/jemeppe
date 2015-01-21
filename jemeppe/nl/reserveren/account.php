<?php
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');

session_start();
$_SESSION['room'] = $_POST['room'];
$_SESSION['arrival'] = $_POST['arrival'];
$_SESSION['departure'] = $_POST['departure'];
$_SESSION['adults'] = $_POST['adults'];
$_SESSION['childrens'] = $_POST['childrens'];
?>

<html>
    <head>
        <?php includeFile('frontend/standard.php'); ?>
    </head>
    <body>
        <?php 
            includeFile('frontend/navigation.php');
        ?>
        <br>
        <div class="container mid">
            <a href="nl/account"><input type="button" value="Reserveer met een bestaande account" class="btn btn-default"></a><br><br>
            <a href="nl/registreren"><input type="button" value="Maak een nieuwe account aan" class="btn btn-default"></a>
        </div>
    </body>
</html>
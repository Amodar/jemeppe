<?php
session_start();
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
/*
$_SESSION['room'] = $_POST['room'];
$_SESSION['arrival'] = $_POST['arrival'];
$_SESSION['departure'] = $_POST['departure'];
$_SESSION['adults'] = $_POST['adults'];
$_SESSION['childrens'] = $_POST['childrens'];*/
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
            <a href="en/login"><input type="button" value="Book with existing account" class="btn btn-default"></a><br><br>
            <a href="en/registration"><input type="button" value="Create new account" class="btn btn-default"></a>
        </div>
    </body>
</html>
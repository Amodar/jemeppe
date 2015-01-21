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
        <br>
        <p class="lead centered">
            Voor reserveringen kunt u ons contacteren via telefoon of e-mail.
        </p>
        
        
        <?php 
            includeFile('frontend/footer.php');
        ?>
    </body>
</html>
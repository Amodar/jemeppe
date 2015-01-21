<?php
session_start();
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/validation.php');


if(login($mysqli)) {
    header('Location: http://www.broowse.com/jemeppe/nl/account/');
} else {
    header('Location: http://www.broowse.com/jemeppe/nl/account?error=1');
}
?>
<!--[if IE]><!doctype html><![endif]-->
<?php 
//DEBUG
//ini_set('display_errors', 'On');
//error_reporting(E_ALL);
//print_r($_POST);
//echo "<br>";
//error occurs when session_start() is not available for the specific page
//Print_r ($_SESSION);
function includeFile($path) {
    include ( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/includes/'.$path);
}

function requireFile($path) {
    require ( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/includes/'.$path);   
}

function includeFileOnce($path) {
    include_once ( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/includes/'.$path);   
}

?>


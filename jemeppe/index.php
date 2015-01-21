<?php 
    $lang = $_COOKIE['lang'];

    if(!isset($_COOKIE['lang'])) {
        setcookie('lang', 'en');
        header('Location: en/');
    }

    if(isset($_COOKIE['lang'])) {
        if($lang == 'en') {
            header('Location: en/');
        } elseif($lang == 'nl') {
            header('Location: nl/');
        }
    }
    
?>
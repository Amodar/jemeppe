<?php
$url = $_SERVER['REQUEST_URI'];

global $language;
if (strpos($url,'/en/') == true) {
    setcookie('lang','en', time()+3600, '/', "broowse.com/jemeppe/");
    $language = 'english';
}
if (strpos($url,'/nl/') == true) {
    setcookie('lang','nl', time()+3600, '/', "broowse.com/jemeppe/");
    $language = 'dutch';
}
?>
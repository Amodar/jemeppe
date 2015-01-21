<?php
global $mysqli;
include_once( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/includes/backend/model/db_connect.php' );

function getEnglishUrl($mysqli, $uri) {
    if($stmt = $mysqli->prepare("SELECT english FROM `url_translation` WHERE dutch = ?")) {
        $stmt->bind_param('s', $uri);
        
        $stmt->execute();
        $stmt->store_result();
        
        $stmt->bind_result($english);
        $stmt->fetch();
        echo '<li><a href="' . $english . '">en-GB <img src="media/image/flags/UK.png"></a></li>';
    }
}
function getDutchUrl($mysqli, $uri) {
    if($stmt = $mysqli->prepare("SELECT dutch FROM `url_translation` WHERE english = ?")) {
        $stmt->bind_param('s', $uri);
        
        $stmt->execute();
        $stmt->store_result();
        
        $stmt->bind_result($dutch);
        $stmt->fetch();
        echo '<li><a href="' . $dutch . '">NL <img src="media/image/flags/NL.png"></a></li>';
    }
}
?>
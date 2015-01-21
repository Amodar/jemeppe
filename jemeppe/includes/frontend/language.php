<?php
$root = $_SERVER['DOCUMENT_ROOT'].'/jemeppe/';
    $url = $_SERVER['REQUEST_URI'];
    echo '<base href="http://localhost/jemeppe/" />';
    if (preg_match('/\/en\//',$url)){
        
        echo '<div>
                <a href="nl/"><img src="media/image/flags/NL.png"></a>
                <a href="en/#"><img src="media/image/flags/UK.png"></a>
              </div>';
    }

    if (preg_match('/\/nl\//',$url)){
        echo '<div>
                <a href="nl/#"><img src="media/image/flags/NL.png"></a>
                <a href="en/"><img src="media/image/flags/UK.png"></a>
              </div>';
    }
?>
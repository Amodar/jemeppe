<?php 
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$uri = $_SERVER['REQUEST_URI'];
$root = $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/includes/';
include($root.'backend/model/url_translator.php');
$baseLangURL = substr($url, -4);
global $language;
?>

<?php

if (strpos($url, '/en/')) {
    echo '<div id="jemeppe_logo">';
    echo '<a href="../../jemeppe/en/">';
    echo '<img src="../../jemeppe/media/image/logo/jemeppe_logo.png" draggable="false">';
    echo '</a>';
    echo '</div>';
}

if (strpos($url, '/nl/')) {
    echo '<div id="jemeppe_logo">';
    echo '<a href="../../jemeppe/nl/">';
    echo '<img src="../../jemeppe/media/image/logo/jemeppe_logo.png" draggable="false">';
    echo '</a>';
    echo '</div>';
}


?>
<div class="navbar navbar-default mainnav">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>  <span class="icon-bar"></span>  <span class="icon-bar"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav centered">
        <?php 
            if (strpos($url, '/en/')) {
        ?>
                <li <?php 
                        if (false !== strpos($baseLangURL,'/en/')) { 
                            echo "class=\"active\"><a href=\"en/\">Home</a>"; 
                            } else {
                                echo "><a href='en/'>Home</a>";
                        }; 
                    ?>
                </li>

                <li <?php 
                        if (false !== strpos($url,'/en/castle')) { 
                            echo "class=\"active\"><a href=\"en/castle\">The castle</a>"; 
                            } else {
                                echo "><a href='en/castle'>The castle</a>";
                        };
                    ?>
                </li>

                <li <?php 
                    if (false !== strpos($url,'en/rooms')) { 
                        echo "class=\"active\"><a href=\"en/rooms\">Rooms & Suites</a>"; 
                    } else {
                        echo "><a href='en/rooms'>Rooms & Suites</a>";
                    }; 
                    ?>
                </li>

                <li <?php 
                    if (false !== strpos($url,'en/location')) { 
                        echo "class=\"active\"><a href=\"en/location\">Location</a>"; 
                    } else {
                        echo "><a href='en/location'>Location</a>";
                    }; 
                    ?>
                </li>

                <li <?php 
                    if (false !== strpos($url,'en/kitchen')) { 
                        echo "class=\"active\"><a href=\"en/kitchen\">Kitchen</a>"; 
                    } else {
                        echo "><a href='en/kitchen'>Kitchen</a>";
                    }; 
                    ?>
                </li>

        <?php
            if (false !== strpos($url,'en/leisure')) { 
                    echo '<li class="dropdown active">';
                } else {
                    echo '<li class="dropdown">';
                }; 
        ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"data-toggle="collapse">
                    leisure
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="en/leisure/horse-riding">Horse Riding</a></li>
                    <li><a href="en/leisure/hot-air-balloon">Hot Air Balloon</a></li>
                    <li><a href="en/leisure/library">Library</a></li>
                    <li><a href="en/leisure/sport">Sport</a></li>
                    <li><a href="en/leisure/swimming-pool">Swimming pool</a></li>
                </ul>
            </li>
        
        <?php
            if (false !== strpos($url,'en/meetings')) { 
                    echo '<li class="dropdown active">';
                } else {
                    echo '<li class="dropdown">';
                }; 
        ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Meetings & Events
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="en/meetings/conference">conferences</a></li>
                    <li><a href="en/meetings/conventions">conventions</a></li>
                    <li><a href="en/meetings/wedding">weddings</a></li>
                    <li><a href="en/meetings/reservation">reservation</a></li>
                </ul>
            </li>
            
            <li <?php 
                if (false !== strpos($url,'en/reviews')) { 
                    echo "class=\"active\"><a href=\"en/reviews\">Reviews</a>"; 
                } else {
                    echo "><a href='en/reviews'>Reviews</a>";
                }; 
                ?>
            </li>

            <li <?php
                    if (false !== strpos($url,'en/contact')) { 
                        echo "class=\"active\"><a href=\"en/contact\">Contact</a>"; 
                    } else {
                        echo "><a href='en/contact'>Contact</a>";
                    };
                ?>
            </li>
        
        
        
            <?php
            } else if (strpos($url, '/nl/')) {
            ?>
                <li <?php 
                        if (false !== strpos($baseLangURL,'/nl/')) { 
                            echo "class=\"active\"><a href=\"nl/\">Home</a>"; 
                            } else {
                                echo "><a href='nl/'>Home</a>";
                        }; 
                    ?>
                </li>

                <li <?php 
                        if (false !== strpos($url,'nl/kasteel')) { 
                            echo "class=\"active\"><a href=\"nl/kasteel\">Kasteel</a>"; 
                            } else {
                                echo "><a href='nl/kasteel'>Kasteel</a>";
                        }; 
                    ?>
                </li>

                <li <?php 
                    if (false !== strpos($url,'nl/kamers')) { 
                        echo "class=\"active\"><a href=\"nl/kamers\">Kamers & Suites</a>"; 
                    } else {
                        echo "><a href='nl/kamers'>Kamers & Suites</a>";
                    }; 
                    ?>
                </li>

                <li <?php 
                    if (false !== strpos($url,'nl/locatie')) { 
                        echo "class=\"active\"><a href=\"nl/locatie\">Locatie</a>"; 
                    } else {
                        echo "><a href='nl/locatie'>Locatie</a>";
                    }; 
                    ?>
                </li>

                <li <?php 
                    if (false !== strpos($url,'nl/keuken')) { 
                        echo "class=\"active\"><a href=\"nl/keuken\">Keuken</a>"; 
                    } else {
                        echo "><a href='nl/keuken'>Keuken</a>";
                    }; 
                    ?>
                </li>
    
    
    <?php
            if (false !== strpos($url,'nl/ontspanning')) { 
                    echo '<li class="dropdown active">';
                } else {
                    echo '<li class="dropdown">';
                }; 
        ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    ontspanning
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="nl/ontspanning/paardrijden">Paardrijden</a></li>
                    <li><a href="nl/ontspanning/luchtballon">Luchtballon</a></li>
                    <li><a href="nl/ontspanning/bibliotheek">Biblioteek</a></li>
                    <li><a href="nl/ontspanning/sport">Sport</a></li>
                    <li><a href="nl/ontspanning/zwembad">Zwembad</a></li>
                </ul>
            </li>
    
            <?php
            if (false !== strpos($url,'nl/meetings')) { 
                    echo '<li class="dropdown active">';
                } else {
                    echo '<li class="dropdown">';
                }; 
            ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Meetings & Events
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="nl/meetings/conventies">conventies</a></li>
                    <li><a href="nl/meetings/vergadering">vergadering</a></li>
                    <li><a href="nl/meetings/trouwerij">trouwerij</a></li>
                    <li><a href="nl/meetings/reserveren">reserveren</a></li>
                </ul>
            </li>

            <li <?php 
                if (false !== strpos($url,'nl/recensies')) { 
                    echo "class=\"active\"><a href=\"nl/recensies\">Recensies</a>"; 
                } else {
                    echo "><a href='nl/recensies'>Recensies</a>";
                }; 
                ?>
            </li>

            <li <?php
                    if (false !== strpos($url,'nl/contact')) { 
                        echo "class=\"active\"><a href=\"nl/contact\">Contact</a>"; 
                    } else {
                        echo "><a href='nl/contact'>Contact</a>";
                    };
                ?>
            </li>
            
            
            <?php } ?>
                
        </ul>
        
        <ul class="nav navbar-nav push-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php 
                    if (strpos($url, '/en/')) {
                        echo '<img src="media/image/flags/UK.png">';
                    }
                    if (strpos($url, '/nl/')) {
                        echo '<img src="media/image/flags/NL.png">';
                    }
                    ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">

                    <?php 
                    if (strpos($url, '/en/')) {
                        getDutchUrl($mysqli, $uri);
                    }
                    if (strpos($url, '/nl/')) {
                        getEnglishUrl($mysqli, $uri);
                    }
                    ?>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li>
                <?php 
                    if (strpos($url, '/en/')) {
                        if (false !== strpos($url,'account')) { 
                            echo '<li class="active"><a href="en/account">My account</a></li>'; 
                        } else {
                            echo '<li><a href="en/account">My account</a></li>';
                    };
                    }
                    if (strpos($url, '/nl/')) {
                        if (false !== strpos($url,'inloggen')) { 
                            echo '<li class="active"><a href="nl/account">Mijn account</a></li>';
                        } else {
                            echo '<li><a href="nl/account">Mijn account</a></li>';
                        };
                    }
                    ?>
            </li>
        </ul>
    </div>
</div>

<?php
    if (strpos($url, '/reservation/') == false && strpos($url, '/reserveren/') == false 
            && strpos($url, '/registration/') == false && strpos($url, '/rooms/') == false 
            && strpos($url, '/kamers/') == false && strpos($url, '/account/') == false) {
?>

    <div id="reservationAnchor">
    </div>

    <div id="reservation">
        <?php 
            if (strpos($url, '/en/')) {
                echo '<a href="en/rooms/">';
                echo '<input class="form-control" value="Book today!" type="submit" />';
                echo '</a>';
            }

            if (strpos($url, '/nl/')) {
                echo '<a href="nl/kamers/">';
                echo '<input class="form-control" value="Reserveer vandaag!" type="submit" />';
                echo '</a>';
            }
        ?>
</div>
<?php 
    }
?>
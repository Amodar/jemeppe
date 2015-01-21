<?php
ob_start();
session_start();
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
includeFile('backend/model/validation.php');
includeFile('backend/model/User.class.php');
includeFile('backend/model/Content.class.php');
includeFile('backend/model/ContentOverview.class.php');

//debug
if(isset($_GET['unset'])) {
    unset($_SESSION['email']);
    unset($_SESSION['login_string']);
    header("location: ../account");
}
if(isset($_GET['error'])) {
    if($_GET['error'] == 1){
        $error = "<h3>Email or password is incorrect, please try again.</h3>";
    }
}
?>

<html>
    <head>
        <?php includeFile('frontend/standard.php'); ?>
        
        <link rel="stylesheet" type="text/css" href="http://broowse.com/jemeppe/css/account.css">
    
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker.min.css">
    
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker3.min.css">
    
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/locales/bootstrap-datepicker.en-GB.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/locales/bootstrap-datepicker.nl.min.js"></script>
        
    </head>
    <body>
        <?php 
            includeFile('frontend/navigation.php');
        ?>
        <?php
            if (login_check($mysqli) == true) {
                
                if(isset($_SESSION['bookMode']) == 1){
                    header('location: http://www.broowse.com/jemeppe/en/reservation/overview');                   
                }
                $user = new User($mysqli, $_SESSION['email']);
                
        ?>
        <br>
        
        <div class="container">
            <div class="pull-right">

                <form action="en/account" method="get" role="form">
                    <input type="submit" name="unset" class="btn btn-default" id="unset" value="Click here to logout">
                </form>
            </div>
        </div>
        <div class="container">
            <div class="centered">
                <a href='en/account/review'>
                    <div class="account-menu-box col-md-3">
                        <div class='icon'><i class="fa fa-newspaper-o fa-5x"></i></div>
                        <hr>
                        <div class="account-box-text"><p class="lead">Write a review</p></div>
                    </div>
                </a>
                <a>
                    <div class="account-menu-box col-md-3">
                        <div class='icon'><i class="fa fa-credit-card fa-5x"></i></div>
                        <hr>
                        <div class="account-box-text"><p class="lead">Payments</p></div>
                    </div>
                </a>
                <a href='en/account/invoices'>
                    <div class="account-menu-box col-md-3">
                        <div class='icon'><i class="fa fa-file-text-o fa-5x"></i></div>
                        <hr>
                        <div class="account-box-text"><p class="lead">Invoices</p></div>
                    </div>
                </a>
                <a>
                    <div class="account-menu-box col-md-3">
                        <div class='icon'><i class="fa fa-pencil-square-o fa-5x"></i></div>
                        <hr>
                        <div class="account-box-text"><p class="lead">Change account information</p></div>
                    </div>
                </a>
            </div>
        </div>
        <hr>
        <?php
              } else {
        ?>
        <br>
        <div class="container">
            <?php 
            if (isset($_GET['error'])) {
                echo $error;
            }
            if (isset($_SESSION['bookMode']) == 1){
                $category = 'reservation_login';
                $o_content = new ContentOverview($mysqli, $category, $language);
                $o_contentId = $o_content->getId_content();
                $contentTitle = array();
                $contentContent = array();

                foreach($o_contentId as $o_contentId) {
                    $content = new Content($mysqli, $o_contentId);

                    $title = $content->getTitle();
                    $content = $content->getContent();

                    array_push($contentTitle, $title);
                    array_push($contentContent, $content);
                }
                echo "<p class='lead'>" . $contentContent[0] . "</p>";
            }
            ?>
            <form action="en/account/process" method="post" role="form">
                <div class="row">
                    <div class="form-group col-md-12 ">
                        <label>Email</label> <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email adres">
                        <label>Password</label> <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                        <br>
                        <div class='col-md-12 centered'>
                            <a href="en/registration"><input type="button" value="Create new account"  class="btn btn-info"></a>  
                            <input type="submit" value="sign in" class="btn btn-danger pull-right" class="form-control ">
                        </div>
                    </div>
                </div>
            </form>
            
            Forgot your password? <a>click here</a><br>
        </div>
        <?php } ?>
    </body>
</html>
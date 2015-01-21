<?php
global $mysqli;
include_once( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/includes/backend/model/db_connect.php' );

function login($mysqli) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if ($stmt = $mysqli->prepare("select email, password from user where email = ? LIMIT 1")) {
        $stmt->bind_param('s', $email);
        
        $stmt->execute();
        $stmt->store_result();
        
         if ($stmt->num_rows == 1) {
            // get variables from result.
            $stmt->bind_result($db_email, $db_password);
            $stmt->fetch();
             
            if (password_verify($password, $db_password)) {
                $_SESSION['login_string'] = password_hash($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . $db_password, PASSWORD_BCRYPT);
                $_SESSION['email'] = $db_email; 
                return true;
            } else {
                return false;
            }
         } else {
             return false;
         }
    } else {
        return false;
    }
}

function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['email'], $_SESSION['login_string'])) {
        $login_string = $_SESSION['login_string'];
        $email = $_SESSION['email'];
 
        if ($stmt = $mysqli->prepare("SELECT password FROM user WHERE email = ? LIMIT 1")) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows == 1) {
                // get variables from result.
                $stmt->bind_result($db_password);
                $stmt->fetch();
                
                $login_check = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . $db_password;
                
                if (password_verify($login_check, $login_string)) {
                    // Logged In
                    return true;
                } else {
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}
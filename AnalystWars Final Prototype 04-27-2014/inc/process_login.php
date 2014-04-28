<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start();
 
if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; // The hashed password.
    
    error_log('hashed pw from login form is: ' . $password);
    
    if (login($email, $password, $mysqli) == true) {		//run login function
        // Login success 
        header('Location: ../admin/index.php');
    } else {
        // Login failed
        if (checkbrute($email, $mysqli) == true)
        	header('Location: ../error.php?err=1');
        else 
        	header('Location: ../error.php?err=2');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}
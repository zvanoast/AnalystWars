<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start();
 
if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; // The hashed password.
    
    if (login($email, $password, $mysqli) == true) {		//run login function
        // Login success 
        header('Location: ../protected_page.php');
    } else {
        // Login failed 
        header('Location: ../error.php');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}
<?php
include_once 'db_connect.php';
include_once 'sec_login_config.php';
include_once 'functions.php';

sec_session_start();
 
$error_msg = "";
 
if (isset($_POST['email'], $_POST['password'])) {
    // Sanitize and validate the data passed in
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
 
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
        $error_msg .= ' ' . $password;	//debug
    }
    
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
 
    $prep_stmt = "SELECT userID
    		FROM user_information
    		WHERE email = ?
    		LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
        }
        $stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error</p>';
    }
    
    
    $fName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    //$mName = filter_input(INPUT_POST, 'midName', FILTER_SANITIZE_STRING);			//middle name not on form
    $lName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    //$dob = filter_input(INPUT_POST, 'dateOfBirth', FILTER_SANITIZE_STRING);
    $dob = "";
    //$sex = filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_STRING);				//sex not on form
    //$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);				//phone not on form
    //$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);				//address not on form
    //$maritalStatus = filter_input(INPUT_POST, 'maritalStatus', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $educationLevel = filter_input(INPUT_POST, 'educationLevel', FILTER_SANITIZE_STRING);
    //$occupation = filter_input(INPUT_POST, 'occupation', FILTER_SANITIZE_STRING);			//occupation not on form
    
    
    //$mName = '';
    //$sex = '';
    //$phone = '';
    //$address = '';
    $occupation = '';
    
    error_log('fname: ' . $fName);
    //error_log('mname: ' . $mName . '\n');
    error_log('lname: ' . $lName);
    error_log('dob: ' . $dobe);
    //error_log('maritalStatus: ' . $maritalStatus . '\n');
    //error_log('password: ' . $password . '\n');
    error_log('educationLevel: ' . $educationLevel);
    //error_log('sex: ' . $sex . '\n');
    //error_log('phone: ' . $phone . '\n');
    //error_log('address: ' . $address . '\n');
    error_log('occupation: ' . $occupation);
    
    
    /*
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
    */
    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
 
        // Create salted password
        error_log('registration salt: ' . $random_salt . '\n');
        //<br />
        error_log('registration hashed pw: ' . $password . '\n');
        //<br />
        $passwordUnsalted = $password;
        $password = hash('sha512', $password . $random_salt);
        
        error_log('registration final hash: ' . $password);
        
 
        // Insert the new user into the database 
        if (($insert_stmt = $mysqli->prepare("INSERT INTO user_account (email, password, salt) VALUES (?, ?, ?)")) &&
        	($insert_stmt2 = $mysqli->prepare("INSERT INTO user_information (email, firstName, lastName, dateOfBirth,
        									 educationLevel, occupation)
        									 VALUES (?, ?, ?, ?, ?, ?)"))) {
            $insert_stmt->bind_param('sss', $email, $password, $random_salt);
            $insert_stmt2->bind_param('ssssss', $email, $fName, $lName, $dob, $educationLevel, $occupation);
            // Execute the prepared query.
            
            if (!$insert_stmt->execute()) {
            	error_log("1st Statement Fail");
            	header('Location: ../error.php?err=Registration failure: INSERT');
            }
	    if(!$insert_stmt2->execute()){
                header('Location: ../error.php?err=Registration failure: INSERT');
                error_log("2nd Statement Fail");
            }
                
            else{
            	//send to user login, which will then send them to the dashboard index
            	if (login($email, $passwordUnsalted, $mysqli) == true) {		//run login function
	        // Login success 
	        header('Location: ../admin/index.php');
	    	} else {
	        // Login failed
	        	header('Location: ../error.php?err=2');
	    	}
            }
            $insert_stmt->close();
            $insert_stmt2->close();
            mkdir('../admin/userFiles/'.$email);
        }
    }
    else 
    {
    	error_log($error_msg);
    	header('Location: ../admin/login.php?=registration_failure');
    }
}
<?php
include_once 'sec_login_config.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';
    $secure = SECURE;
    // This stops JavaScript being able to access the session id
    $httponly = true;
    // Forces sessions to only use cookies
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id();    // regenerated the session, delete the old one. 
}


function login($email, $password, $mysqli) {
    if ($stmt = $mysqli->prepare("SELECT userID 
        FROM user_information
        WHERE email = ?
        LIMIT 1")) {

        $stmt->bind_param('s', $email);  // Bind "$email" to parameter
        $stmt->execute();    // Execute the prepared query
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id);
        $stmt->fetch();
        
        $stmt2 = $mysqli->prepare("SELECT password, salt 
        FROM user_account
        WHERE email = ?
        LIMIT 1");
        
	$stmt2->bind_param('s', $email);  // Bind "$email" to parameter
	$stmt2->execute();    // Execute the prepared query
	$stmt2->store_result();
	$stmt2->bind_result($db_password, $salt);
	$stmt2->fetch();
	}
	else error_log('fail');
 	
 	
        // hash the password with the unique salt
        $password = hash('sha512', $password . $salt);
        
        
        if ($stmt2->num_rows == 1) {
            // If the user exists we check if the account is locked from too many login attempts
 
            if (checkbrute($email, $mysqli) == true) {
                // Account is locked 
                // Future update: send an email to user saying their account is locked
                error_log('brute detected in login function');
                return false;
            }
            else {  
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct
                    // Get the user-agent string of the user
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value - removes the user id from the session info
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['email'] = $email;					//DEBUG: take this out later!!
                    /*
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    */
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the failed login table in db
                    $now = time();
                    error_log("time is " . $now);
                    $mysqli->query("INSERT INTO account_login_attempt(email, time)
                                    VALUES ('$email', '$now')");
                    return false;
                }
            }
        } else {
            // User does not exist
            error_log('User does not exist');
            return false;
        }
    }


function checkbrute($email, $mysqli) {
    // Get current timestamp
    $now = time();
 
    // All login attempts are counted from the past 1 hour
    $valid_attempts = $now - (1 * 60 * 60);
    
 	error_log('valid: ' . $valid_attempts);
 	error_log('current: ' . $now);
 	
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM account_login_attempt
                             WHERE email = ? 
                            AND time > '$valid_attempts'")) {		//took <code><pre> out after account_login_attempt
        $stmt->bind_param('s', $email);
 
        // Execute the prepared query
        $stmt->execute();
        $stmt->store_result();
 
        // If there have been more than 5 failed logins, possible BF attack
        if ($stmt->num_rows > 3) {
        	error_log("brute!");
            return true;
        } else {
        	error_log("no brute");
            return false;
        }
    }
}


/*
function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['email'], 						//wherever user_id was -> email
                        $_SESSION['login_string'])) {
 
        //$user_id = $_SESSION['user_id'];
        $email = $_SESSION['email'];
        $login_string = $_SESSION['login_string'];
        //$username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM user_account 
                                      WHERE user_id = ?			//replaced user_id
                                      LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Logged in
                    return true;
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
    } else {
        // Not logged in 
        return false;
    }
}
*/

function login_check($mysqli) {
	error_log('calling login_check');
	error_log('session email: ' . $_SESSION['email']);
    // Check if all session variables are set 
    if (isset($_SESSION['email'], 						//wherever user_id was -> email
                        $_SESSION['login_string'])) {
 
        //$user_id = $_SESSION['user_id'];
        $email = $_SESSION['email'];
        $login_string = $_SESSION['login_string'];
        //$username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM user_account 
                                      WHERE email = ?
                                      LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('s', $email);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Logged in
                    return true;
                } else {
                    // Not logged in
                    error_log('fail 1'); 
                    return false;
                }
            } else {
                // Not logged in 
                error_log('fail 2');
                return false;
            }
        } else {
            // Not logged in 
            error_log('fail 3');
            return false;
        }
    } else {
        // Not logged in 
        error_log('fail 4');
        return false;
    }
}


function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}


function fetch($result)
{   
    $array = array();
   
    if($result instanceof mysqli_stmt)
    {
        $result->store_result();
       
        $variables = array();
        $data = array();
        $meta = $result->result_metadata();
       
        while($field = $meta->fetch_field())
            $variables[] = &$data[$field->name]; // pass by reference
       
        call_user_func_array(array($result, 'bind_result'), $variables);
       
        $i=0;
        while($result->fetch())
        {
            $array[$i] = array();
            foreach($data as $k=>$v)
                $array[$i][$k] = $v;
            $i++;
           
            // don't know why, but when I tried $array[] = $data, I got the same one result in all rows
        }
    }
    elseif($result instanceof mysqli_result)
    {
        while($row = $result->fetch_assoc())
            $array[] = $row;
    }
   
    return $array;
}
<?php

include_once 'connect.php';
include_once 'core.php';

if(loggedin())
	{   
	    $firstname = getuserfield('firstname');
		$lastname = getuserfield('lastname');
		echo 'You\'re logged in, '.$firstname.' '.$lastname.' <a herf="logout.php">Log out</a><br>';	
	}	
else {
	include 'login.php';
}


?>
<?php
include_once('../inc/db_connect.php');
include_once '../inc/functions.php';
sec_session_start();

if (login_check($mysqli)) error_log("logged in");
else error_log("not logged in");


$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$dateOfBirth= $_POST["dob"];
$educationLevel = $_POST["educationLevel"];
$occupation = $_POST["occupation"];
$aboutMe = $_POST["about"];
$investmentExperience = $_POST["investmentExperience"];
$researchExpertise = $_POST["researchExpertise"];
$websiteURL = $_POST["websiteURL"];


$email = $_SESSION['email'];

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
/*
if($insert_stmt = $mysqli->prepare("SELECT firstName, lastName, dateOfBirth, educationLevel, occupation, about, investmentExperience, researchExpertise, websiteURL FROM user_information WHERE email=?")){
	$insert_stmt->bind_param('s', $email);
	$insert_stmt->execute();
    	$insert_stmt->bind_result($dbFirstName, $dbLastName, $dbDateOfBirth, $dbEducationLevel, $dbOccupation, $dbAbout, $dbInvestmentExperience, $dbResearchExpertise, $dbWebsiteURL);
    	$insert_stmt->fetch();
    	echo $dbFirstName . "<br>";
    	echo $dbLastName . "<br>";
    	echo $dbDateOfBirth . "<br>";
    	echo $dbEducationLevel . "<br>";
    	echo $dbOccupation . "<br>";
    	echo $dbAbout . "<br>";
    	echo $dbInvestmentExperience . "<br>";
    	echo $dbResearchExpertise . "<br>";
    	echo $dbWebsiteURL . "<br>";
    	$insert_stmt->close();
}
*/

if($firstName!=''){
	$update_stmt = $mysqli->prepare("UPDATE user_information SET firstName=? WHERE email=?");
	$update_stmt->bind_param('ss', $firstName, $email);
	$update_stmt->execute();
	$update_stmt->close();
}

if($lastName!=''){
	$update_stmt = $mysqli->prepare("UPDATE user_information SET lastName=? WHERE email=?");
	$update_stmt->bind_param('ss', $lastName, $email);
	$update_stmt->execute();
}

if($dateOfBirth!=''){
	$update_stmt = $mysqli->prepare("UPDATE user_information SET dateOfBirth=? WHERE email=?");
	$update_stmt->bind_param('ss', $dateOfBirth, $email);
	$update_stmt->execute();
	$update_stmt->close();
}

if($educationLevel!=''){
	$update_stmt = $mysqli->prepare("UPDATE user_information SET educationLevel=? WHERE email=?");
	$update_stmt->bind_param('ss', $educationLevel, $email);
	$update_stmt->execute();
	$update_stmt->close();
}

if($occupation!=''){
	$update_stmt = $mysqli->prepare("UPDATE user_information SET occupation=? WHERE email=?");
	$update_stmt->bind_param('ss', $occupation, $email);
	$update_stmt->execute();
	$update_stmt->close();
}

if($aboutMe!=''){
	$update_stmt = $mysqli->prepare("UPDATE user_information SET about=? WHERE email=?");
	$update_stmt->bind_param('ss', $aboutMe, $email);
	$update_stmt->execute();
	$update_stmt->close();
}

if($investmentExperience!=''){
	$update_stmt = $mysqli->prepare("UPDATE user_information SET investmentExperience=? WHERE email=?");
	$update_stmt->bind_param('ss', $investmentExperience, $email);
	$update_stmt->execute();
	$update_stmt->close();
}

if($researchExpertise!=''){
	$update_stmt = $mysqli->prepare("UPDATE user_information SET researchExpertise=? WHERE email=?");
	$update_stmt->bind_param('ss', $researchExpertise, $email);
	$update_stmt->execute();
	$update_stmt->close();
}

if($websiteURL!=''){
	$update_stmt = $mysqli->prepare("UPDATE user_information SET websiteURL =? WHERE email=?");
	$update_stmt->bind_param('ss', $websiteURL, $email);
	$update_stmt->execute();
	$update_stmt->close();
}
header("Location: http://analystwars.com/admin/extra_profile.php"."?status=changes saved");
?>
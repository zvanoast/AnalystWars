<?php
include_once('../inc/db_connect.php');
include_once '../inc/functions.php';
sec_session_start();

if (login_check($mysqli)) error_log("logged in");
else error_log("not logged in");

$email = $_SESSION['email'];

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$location = "userFiles/" . $email . "/";
$filename = $_FILES["userPicture"]["name"];

$allowedExtensions = array("gif", "jpeg", "jpg", "png");
$tempExtension = explode(".", $_FILES["userPicture"]["name"]);
$extension = end($tempExtension);
if ((($_FILES["userPicture"]["type"] == "gif")
|| ($_FILES["userPicture"]["type"] == "image/jpeg")
|| ($_FILES["userPicture"]["type"] == "image/jpg")
|| ($_FILES["userPicture"]["type"] == "image/pjpeg")
|| ($_FILES["userPicture"]["type"] == "image/x-png")
|| ($_FILES["userPicture"]["type"] == "image/png"))
&& ($_FILES["userPicture"]["size"] < 2000000)
&& in_array($extension, $allowedExtensions))
{
	if ($_FILES["userPicture"]["error"] > 0)
	{
	  echo "Error: " . $_FILES["userPicture"]["error"] . "<br>";
	}
	else
	{
	  //echo "Upload: " . $_FILES["userPicture"]["name"] . "<br>";
	  //echo "Type: " . $_FILES["userPicture"]["type"] . "<br>";
	  //echo "Size: " . ($_FILES["userPicture"]["size"] / 1024) . " kB<br>";
	  //echo "Stored in: " . $_FILES["userPicture"]["tmp_name"];
		if (file_exists("upload/" . $_FILES["userPicture"]["name"]))
		  {
		  echo $_FILES["userPicture"]["name"] . " already exists. ";
		  }
		else
		  {
		  move_uploaded_file($_FILES["userPicture"]["tmp_name"],
		  $location . $_FILES["userPicture"]["name"]);
		  //echo "Stored in: " . $location . $_FILES["userPicture"]["name"];
		  }
	}
	
	
	if($insert_stmt = $mysqli->prepare("UPDATE user_information SET profilePicture=? WHERE email=?")){
		$insert_stmt->bind_param('ss', $filename, $email);
		$insert_stmt->execute();
	}
    header("Location: http://analystwars.com/admin/extra_profile.php"."?status=changes saved");
}
else
  {
  header("Location: http://analystwars.com/admin/extra_profile.php"."?status=Invalid File");
  }
?>
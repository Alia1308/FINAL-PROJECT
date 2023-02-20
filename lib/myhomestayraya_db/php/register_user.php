<?php
error_reporting(0);
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");
$name = $_POST['name'];
$email = $_POST['email'];
$password = sha1($_POST['password']);
$phone=$_POST['phone'];
$otp = rand(10000,99999);
$sqlinsert = "INSERT INTO `tbl_users` (`user_email`,`user_name`,`user_password`,`user_phone`,`user_otp`) VALUES('$email','$name','$password','$phone','$otp')";

try {
	if ($conn->query($sqlinsert) === TRUE) {
		$response = array('status' => 'success', 'data' => null);
		sendJsonResponse($response);
	}else{
		$response = array('status' => 'failed', 'data' => null);
		sendJsonResponse($response);
	}
}
catch(Exception $e) {
  $response = array('status' => 'failed', 'data' => null);
  sendJsonResponse($response);

}
$conn->close();

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>
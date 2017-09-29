<?php

// Include confi.php
include_once('config.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
$name = (isset($_POST['name']))?$_POST['name']:'' ;
$email = (isset($_POST['email']))?$_POST['email']:'';
$password = (isset($_POST['password']))?$_POST['password']:'';
$status = (isset($_POST['status']))?$_POST['status']:'';
$sql = "INSERT INTO users (`name`, `email`, `password`, `status`) VALUES     ('$name', '$email', '$password', '$status')";
$qur = mysqli_query($conn, $sql);
if($qur){
$json = array("status" => 1, "msg" => "Done User added!");
}else{
$json = array("status" => 0, "msg" => "Error adding user!");
}
}else{
$json = array("status" => 0, "msg" => "Request method not accepted");
}
@mysqli_close($conn);
header('Content-type: application/json');
echo json_encode($json);
	
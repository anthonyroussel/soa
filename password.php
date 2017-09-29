<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] != "PUT") {
  exit(http_response_code(405)); // invalid method
}

parse_str(file_get_contents("php://input"), $post_vars);
$uid = intval($post_vars['uid']);
$password = sha1($post_vars['password']);

$sql = "UPDATE users SET password = '".$password."' WHERE id = ".$uid.";";
if (!mysqli_query($conn, $sql)) {
  exit(http_response_code(500));
}

if (mysqli_affected_rows($conn) != 1) {
  exit(http_response_code(400));
}

echo json_encode(array('status'=>200));

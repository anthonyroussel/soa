<?php
header('Content-type: application/json');

function json_return($code, $message) {
  http_response_code($code);
  echo json_encode(array("code" => $code, "message" => $message));
  exit;
}

$mysqli = new mysqli("mariadb", "root", "s22s", "tuts_rest");

// check database connection
if (mysqli_connect_errno()) {
  json_return(500, "Database connection error");
}

// GET
if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (!isset($_GET['id'])) {
    json_return(400, "Missing parameter: id");
  }
  $id = intval($_GET['id']);

  $stmt = $mysqli->prepare("select id, name, email, status from users where id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result->num_rows != 1) {
    json_return(404, "Missing user");
  }

  $row = $result->fetch_assoc();
  exit(json_encode($row));

// PUT
} elseif ($_SERVER['REQUEST_METHOD'] == "PUT") {
  parse_str(file_get_contents("php://input"), $put_vars);
  if (!isset($put_vars['id'])) {
    json_return(400, "Missing parameter: id");
  } else if (!isset($put_vars['name'])) {
    json_return(400, "Missing parameter: email");
  } else if (!isset($put_vars['email'])) {
    json_return(400, "Missing parameter: email");
  } else if (!isset($put_vars['password'])) {
    json_return(400, "Missing parameter: password");
  } else if (!isset($put_vars['status'])) {
    json_return(400, "Missing parameter: status");
  }
  $id = intval($put_vars['id']);
  $name = $put_vars['name'];
  $email = $put_vars['email'];
  $password = $put_vars['password'];
  $status = $put_vars['status'];

  $stmt = $mysqli->prepare("update users set name = ?, email = ?, password = ?, status = ? where id = ?");
  $stmt->bind_param('ssssi', $name, $email, $password, $status, $id);
  $stmt->execute();

  if ($stmt->affected_rows != 1) {
    json_return(500, "Failed updating the user");
  }

  http_response_code(200);
  exit(json_encode(array("code" => 200, "message" => "User $id updated")));

// POST
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (!isset($_POST['name'])) {
    json_return(400, "Missing parameter: name");
  } else if (!isset($_POST['email'])) {
    json_return(400, "Missing parameter: email");
  } else if (!isset($_POST['password'])) {
    json_return(400, "Missing parameter: password");
  } else if (!isset($_POST['status'])) {
    json_return(400, "Missing parameter: status");
  }
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $status = $_POST['status'];

  $stmt = $mysqli->prepare("insert into users(name, email, password, status) values(?, ?, ?, ?)");
  $stmt->bind_param('ssss', $name, $email, $password, $status);
  $stmt->execute();

  if ($stmt->affected_rows != 1) {
    json_return(500, "Failed creating the user");
  }

  http_response_code(200);
  exit(json_encode(array("code" => 200, "message" => "User $stmt->insert_id created")));

// DELETE
} elseif ($_SERVER['REQUEST_METHOD'] == "DELETE") {
  parse_str(file_get_contents("php://input"), $delete_vars);

  if (!isset($delete_vars['id'])) {
    json_return(400, "Missing parameter: id");
  }
  $id = intval($delete_vars['id']);

  $stmt = $mysqli->prepare("delete from users where id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  if ($stmt->affected_rows != 1) {
    json_return(404, "Missing user");
  }

  http_response_code(200);
  exit(json_encode(array("code" => 200, "message" => "User $id deleted")));

} else {
  json_return(405, "Method Not Allowed");
}

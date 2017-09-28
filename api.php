<?php

function get_student_info($id) {
  switch($id) {
    case 1:
      return array("first_name" => "Dale", "last_name" => "Cooper", "address" => "123 Main St Yakima, WA");
      break;
    case 2:
      return array("first_name" => "Harry", "last_name" => "Truman", "address" => "202 South St Vancouver, WA");
      break;
    case 3:
      return array("first_name" => "Shelly", "last_name" => "Johnson", "address" => "9 Pond Rd Sparks, NV");
      break;
    case 4:
      return array("first_name" => "Bobby", "last_name" => "Briggs", "address" => "14 12th St San Diego, CA");
      break;
    case 5:
      return array("first_name" => "Donna", "last_name" => "Hayward", "address" => "120 16th St Davenport, IA");
      break;
  }
}

function get_student_list() {
  return array(
    array("id" => 1, "name" => "Dale Cooper"),
    array("id" => 2, "name" => "Harry Truman"),
    array("id" => 3, "name" => "Shelly Johnson"),
    array("id" => 4, "name" => "Bobby Briggs"),
    array("id" => 5, "name" => "Donna Hayward")
  );
}

if (isset($_GET["action"])) {
  switch($_GET["action"]) {
    case "get_student_list":
      header("Content-type: application/json");
      exit(json_encode(get_student_list()));
      break;
    case "get_student":
      $student = get_student_info($_GET["id"]);
      if (!isset($student)) {
        http_response_code(404);
        return;
      }
      header("Content-type: application/json");
      exit(json_encode($student));
      break;
  }
}

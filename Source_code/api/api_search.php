<?php
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
  header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
    header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

  exit(0);
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);


  mysqli_set_charset($conn, 'utf8');
  $qur = mysqli_query($conn, "SELECT * FROM program");
  if (!$qur) {
    $json = array("status" => 0, "msg" => "Query Error!");
  } else {
    // $resultArray = array();

    while ($result = mysqli_fetch_array($qur)) {
      $resultArray =  (object) ["program_id" => $result["program_id"], 'program_name_th' => $result["program_name_th"], 'program_name_en' => $result["program_name_en"], 'program_objective' => $result["program_objective"]];
    }

    if ($resultArray == "" || $resultArray == null) {
      $json = array("status" => 404, "msg" => "Not Found Information!");
    } else {
      $json = array("status" => 200, "data" => $resultArray);
    }
  }
} else {
  $json = array("status" => 500, "msg" => "Request method not accepted");
}

mysqli_close($conn);

/* Output header */
header('Content-type: application/json');
echo json_encode($json);

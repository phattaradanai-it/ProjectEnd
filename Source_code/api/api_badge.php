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
  $id = $request->id;
  $sql_query = "SELECT badge.badge_id, course.course_id, course.course_name_en, course.course_name_th, course.course_detail_en, course.course_detail_th, course.course_credit, course.course_score, program.cert_id, enroll.enroll_id, enroll.practice_score, enroll.objective_score, badge_img.badge_img_name
    FROM badge 
    LEFT JOIN badge_img ON badge.badge_img_id = badge_img.badge_img_id
    LEFT JOIN enroll ON badge.enroll_id = enroll.enroll_id 
    LEFT JOIN course ON enroll.course_id = course.course_id
    LEFT JOIN course_of_program ON course.course_id = course_of_program.course_id
    LEFT JOIN program ON course_of_program.program_id = program.program_id
    WHERE enroll.std_id = '$id' 
    ORDER BY course_of_program.course_order ASC ";

  // if (isset($_SESSION['current_cert_id'])) {
  //   $current_cert = $_SESSION['current_cert_id'];
  //   $sql_query .= "LEFT JOIN course_of_program ON course.course_id = course_of_program.course_id
  //   LEFT JOIN program ON course_of_program.program_id = program.program_id
  //   WHERE enroll.std_id = '$id' AND program.cert_id = '$current_cert' 
  //   ORDER BY course_of_program.course_order ASC";
  // } else {
  //   $sql_query .= " WHERE enroll.std_id = '$id'";
  // }

  mysqli_set_charset($conn, 'utf8');
  $qur = mysqli_query($conn, $sql_query);

  if (!$qur) {
    $json = array("status" => 0, "msg" => "Query Error!");
  } else {
    $resultArray = array();
    while ($result = mysqli_fetch_array($qur)) {
      $resultArray[$result["badge_id"]] = array("badge_id" => $result["badge_id"], "course_id" => $result["course_id"], 'course_name_en' => $result["course_name_en"], 'course_name_th' => $result["course_name_th"], 'course_detail_en' => $result["course_detail_en"], 'course_detail_th' => $result["course_detail_th"], 'course_credit' => $result["course_credit"], 'course_score' => $result["course_score"], "cert_id" => $result["cert_id"], "enroll_id" => $result["enroll_id"], "practice_score" => $result["practice_score"], "objective_score" => $result["objective_score"], 'badge_img_name' => $result["badge_img_name"]);
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

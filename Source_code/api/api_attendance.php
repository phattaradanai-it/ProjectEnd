<?php
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    }

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }

    exit(0);
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $id = $request->id;

    mysqli_set_charset($conn, 'utf8');
    $qur = mysqli_query($conn, "SELECT program.*, diploma.diploma_date, diploma.diploma_approve,
                                IF(diploma.diploma_date IS NOT NULL, 'DIPLOMA',
                                  IF((SELECT cert_of_student.id from cert_of_student WHERE cert_of_student.std_id = '$id' AND cert_of_student.cert_id = program.cert_id) IS NOT NULL, 'CERT', NULL
                                    )
                                )
                                as status FROM attendance
                              LEFT JOIN program ON attendance.program_id = program.program_id
                              LEFT JOIN diploma ON attendance.std_id = diploma.std_id  AND program.program_id = diploma.program_id
                              WHERE attendance.std_id = '$id'");

    if (!$qur) {
        $json = array("status" => 0, "msg" => "Query Error!");
    } else {
        $resultArray = array();

        while ($result = mysqli_fetch_array($qur)) {
            $resultArray[] = array("program_id" => $result["program_id"], 'program_name_th' => $result["program_name_th"], 'program_name_en' => $result["program_name_en"], 'cert_id' => $result["cert_id"], 'status' => $result["status"], 'diploma_date' => $result["diploma_date"], 'diploma_approve' => $result["diploma_approve"]);
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
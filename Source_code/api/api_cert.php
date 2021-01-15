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
    $qur = mysqli_query($conn, "SELECT cert_of_student.id, cert.cert_id, cert.cert_name_en, cert.cert_name_th,
                                    cert.cert_img, cert_of_student.cert_approve, cert_of_student.cert_date,
                                    cert_type.cert_type_name, badge_img.badge_img_name
                              FROM cert
                                      LEFT JOIN cert_of_student ON cert.cert_id = cert_of_student.cert_id
                                      LEFT JOIN cert_type ON cert.cert_type_id = cert_type.id
                                      LEFT JOIN badge_img ON cert_type.badge_img_id = badge_img.badge_img_id
                              WHERE cert_of_student.std_id = '$id' AND cert_of_student.show_cer = '1' ");

    if (!$qur) {
        $json = array("status" => 0, "msg" => "Query Error!");
    } else {
        $resultArray = array();

        while ($result = mysqli_fetch_array($qur)) {
            $resultArray[$result["id"]] = array('cert_id' => $result["cert_id"],
                'cert_name_en' => $result["cert_name_en"],
                'cert_name_th' => $result["cert_name_th"],
                'cert_img' => $result["cert_img"],
                'cert_approve' => $result["cert_approve"],
                'cert_date' => $result["cert_date"],
                'cert_type' => $result["cert_type_name"],
                'badge_img_name' => $result["badge_img_name"],
            );
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
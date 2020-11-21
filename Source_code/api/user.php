<?php

include 'config.php';

// $conn = mysqli_connect("digitech.sut.ac.th", "root", "DG@dmin2019");
// mysqli_select_db($conn, 'digitech');
// mysqli_set_charset($conn, 'utf8');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

mysqli_set_charset($conn, 'utf8');
// $qur = mysqli_query($conn, "SELECT id FROM student WHERE std_password = ''");
$qur = mysqli_query($conn, "SELECT id FROM student WHERE std_hashcode = ''");

if (!$qur) {
    $json = array("status" => 0, "msg" => "Query Error!");
} else {
    // while ($result = mysqli_fetch_array($qur)) {
    //   $id_ = $result["id"];
    //   echo $id_ . '<br/>';
    //   $gen_password = password_hash(substr($id_, 7), PASSWORD_DEFAULT);
    //   $qur = mysqli_query($conn, "UPDATE student SET std_password = '$gen_password' WHERE id = '$id_'");
    // }

    while ($result = mysqli_fetch_array($qur)) {
        $id_ = $result["id"];
        echo $id_ . '<br/>';
        $gen_password = password_hash(substr($id_, 7), PASSWORD_DEFAULT);
        $gen_hash = password_hash($id_, PASSWORD_DEFAULT);

        $sec_qur = mysqli_query($conn, "UPDATE student SET std_password = '$gen_password', std_hashcode = '$gen_hash' WHERE id = '$id_'");
    }

    // if ($resultArray == "" || $resultArray == null) {
    //   $json = array("status" => 404, "msg" => "Not Found Information!");
    // } else {
    //   $json = array("status" => 200, "data" => $resultArray);
    // }
}

mysqli_close($conn);

/* Output header */
header('Content-type: application/json');
echo json_encode($json);
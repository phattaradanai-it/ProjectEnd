<?php
session_start();
$service_url = 'https://digitech.sut.ac.th/api/api_login.php';
$curl = curl_init($service_url);
$curl_post_data = array(
    'username' => $_POST['username'],
    'password' => $_POST['password'],
);

$curl_post_data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data_string);

$curl_response = curl_exec($curl);

if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);

$decoded = json_decode($curl_response);

if ($decoded->status == 200) {

    foreach ($decoded->data as $data) {
        $user_id = $data->id;
        $user_std_id = $data->std_id;
        $user_nametitle = $data->std_nametitle;
        $user_firstname = $data->std_firstname;
        $user_lastname = $data->std_lastname;
        $user_hcode = $data->std_hashcode;
    }

    $_SESSION["user_id"] = $user_id;
    $_SESSION["user_std_id"] = $user_std_id;
    $_SESSION["user_nametitle"] = $user_nametitle;
    $_SESSION["user_firstname"] = $user_firstname;
    $_SESSION["user_lastname"] = $user_lastname;
    $_SESSION["user_hcode"] = $user_hcode;

    echo true;
} else {

    echo null;
}
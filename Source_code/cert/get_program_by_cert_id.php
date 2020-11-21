<?php
// session_start();

$service_url = 'https://digitech.sut.ac.th/api/api_program_by_cert_id.php';
$curl = curl_init($service_url);
$curl_post_data = array(
    'cert_id' => $_SESSION['current_cert_id'],
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
    $_SESSION["current_program"] = $decoded->data;
    // echo $decoded->data;
} else if ($decoded->status == 500) {
    header("location: 500.html");
} else if ($decoded->status == 404) {
    // header("location: 404.html");
}
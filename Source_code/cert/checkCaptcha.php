<?php

// ตรวจสอบเมื่อกดปุ่ม และเมื่อส่งค่า  g-recaptcha-response มาตรวจสอบ
if (isset($_POST['personal_id']) && isset($_POST['g-recaptcha-response'])) {
    $recaptcha_secret = "6LeqedAUAAAAAJlFwmT2gU-xyO1F9iQUqi4svA5O";
    $recaptcha_response = trim($_POST['g-recaptcha-response']);
    $recaptcha_remote_ip = $_SERVER['REMOTE_ADDR'];
    $recaptcha_api = "https://www.google.com/recaptcha/api/siteverify?" .
        http_build_query(
            array(
                'secret' => $recaptcha_secret,
                'response' => $recaptcha_response,
                'remoteip' => $recaptcha_remote_ip
            )
        );
    $response = json_decode(file_get_contents($recaptcha_api), true);
}

if (isset($response) &&  $response['success']) { // ตรวจสอบสำเร็จ 
    $_SESSION['sessuser'] = $_POST['personal_id'];
    @header("Location:index.php");
    // echo "Successful!"; // ทำคำสั่งเพิ่มข้อมูลหรืออื่นๆ 
} else {
    header("Location:500.html");
    // echo "Access denied!";
}

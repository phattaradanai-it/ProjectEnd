<?php
require_once './vendor/autoload.php';

use chillerlan\QRCode\QRCode;

$new_badge_date = new DateTime("2020-08-31 23:59:59", new DateTimeZone("Asia/Bangkok"));
$cert_date = new DateTime($cert->cert_date, new DateTimeZone("Asia/Bangkok"));

$cert_type = false;

if ($cert_date > $new_badge_date) {
    $cert_type = "true";
}

?>

<div style="position : relative;">
    <img src="img/cert_img/TEMPLATE-BACKGROUND/Certificate-Digitech-TEMPLATE-blank.jpg" class="bg-cert" />
    <div class="row ml-0 mr-0 inner-cert">

        <img src="img/sut_logo_jpg.png" class="sut-logo-cert" />

        <div class="text-cert ">
            <div class="text">
                <div class="c-text-1">สัมฤทธิบัตร<?php echo $honor ? 'เกียรตินิยม' : '' ?></div>
                <div class="c-text-2">มหาวิทยาลัยเทคโนโลยีสุรนารี</div>
                <div class="c-text-3">มอบสัมฤทธิบัตรฉบับนี้แก่</div>
                <div class="name">
                    <?php echo $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname']; ?>
                </div>
                <div class="c-text-4">เพื่อแสดงว่าได้มีสัมฤทธิผลตามเกณฑ์มาตรฐานของหลักสูตร</div>
                <div class="name">
                    <?php echo $cert->cert_name_th; ?>
                </div>
                <div class="c-text-4">ให้ไว้ ณ วันที่ <?php echo dateThai($cert->cert_date) ?></div>
                <img class="text-cert-sign" src="img/sign_img/Dr.Weerapong.png">
                <div class="c-text-5">
                    (รองศาสตราจารย์ ดร.วีระพงษ์ แพสุวรรณ)</br>
                    อธิการบดีมหาวิทยาลัยเทคโนโลยีสุรนารี</br>
                </div>

            </div>
        </div>

        <div class="badge-cert">
            <?php if ($cert_type) {?>
            <div class="row ml-0 mr-0 " style="margin-bottom:-4%">
                <div class="col-12 pl-0 pr-0  align-center">
                    <img src="img/cert_type_img/<?php echo $honor ? 'excellence' : 'achievement' ?>/<?php echo $cert->badge_img_name ?>"
                        class="single-badge" />
                </div>
            </div>
            <?php } else {?>
            <?php $i = count((array) $badge) % 2 != 0 ? 0 : 1;?>
            <?php foreach ($badge as $badge_key => $badge_value) {?>
            <?php $percent = calBadgeLevel($badge_value->practice_score, $badge_value->objective_score, $badge_value->course_score);?>
            <?php if (count((array) $badge) % 2 != 0 && $i == 0) {?>
            <div class="row ml-0 mr-0 " style="margin-bottom:-4%">
                <div class="col-12 pl-0 pr-0  align-center"> <img
                        src="img/badge_img/<?php echo $percent >= 80 ? 'gold' : 'silver' ?>/<?php echo $badge_value->badge_img_name; ?>"
                        class="badge3-1" /></div>
            </div>
            <?php } else {?>
            <?php if ($i % 2) {?>
            <div class="row ml-0 mr-0">
                <div class="col-6 p-0 align-right"> <img
                        src="img/badge_img/<?php echo $percent >= 80 ? 'gold' : 'silver' ?>/<?php echo $badge_value->badge_img_name; ?>"
                        class="badge3-2" /></div>
                <?php } else {?>
                <div class="col-6 p-0 align-left"> <img
                        src="img/badge_img/<?php echo $percent >= 80 ? 'gold' : 'silver' ?>/<?php echo $badge_value->badge_img_name; ?>"
                        class="badge3-3" /></div>
            </div>
            <?php }?>
            <?php }?>
            <?php $i++;?>
            <?php }?>
            <?php }?>
            <?php $img_qr = "https://digitech.sut.ac.th/cert/verify_qrcode.php?id=" . $_SESSION['user_hcode']?>
            <img class="text-cert-qr" src="<?php echo (new QRCode)->render($img_qr) ?> " alt="QR Code" />
        </div>
    </div>


</div>
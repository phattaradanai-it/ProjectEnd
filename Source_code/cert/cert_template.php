<?php
require_once './vendor/autoload.php';

use chillerlan\QRCode\QRCode;

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

<!-- ใช้ตรงนี้ -->

        <div class="badge-cert">
            <div class="row ml-0 mr-0 " style="margin-bottom:-4%">
                <div class="col-12 pl-0 pr-0  align-center">
                    <img src="img/cert_type_img/<?php echo $honor ? 'excellence' : 'achievement' ?>/<?php echo $cert->badge_img_name ?>"
                        class="single-badge" />
                </div>
            </div>
            <?php?>
            
<!-- ถึงนี้ -->
            <?php $img_qr = "https://digitech.sut.ac.th/cert/verify_qrcode.php?id=" . $_SESSION['user_hcode']?>
            <img class="text-cert-qr" src="<?php echo (new QRCode)->render($img_qr) ?> " alt="QR Code" />
        </div>
    </div>


</div>
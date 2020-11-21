<?php
require_once './vendor/autoload.php';

?>


<div style="position : relative;">
    <img src="img/diploma_img/TEMPLATE-BACKGROUND/Diploma-Digitech-TEMPLATE-blank.jpg" class="bg-cert" />
    <div class="row ml-0 mr-0 inner-cert">

        <img src="img/sut_logo_jpg.png" class="sut-logo-diploma" />

        <div class="text-diploma ">
            <div class="text">
                <div class="d-text-1">มหาวิทยาลัยเทคโนโลยีสุรนารี</div>
                <div class="d-text-2">หนังสือฉบับนี้ให้ไว้้เพื่อแสดงว่า</div>
                <div class="d-text-3">
                    <?php echo $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname']; ?>
                </div>
                <div class="d-text-4">เข้าร่วมอบรมหลักสูตรสัมฤทธิบัตร</div>
                <div class="d-text-5">
                    <?php echo str_replace("หลักสูตรสัมฤทธิบัตร", "", $_SESSION['current_program']->program_name_th); ?>
                </div>
                <div class="d-text-4">ให้ไว้ ณ วันที่ <?php echo dateThai($diploma_date) ?></div>
                <!-- <div class="c-text-2">มหาวิทยาลัยเทคโนโลยีสุรนารี</div>
                <div class="c-text-3">มอบสัมฤทธิบัตรฉบับนี้แก่</div>-->

                <img class="text-diploma-sign" src="img/sign_img/Dr.Weerapong.png">
                <div class="d-text-6">
                    (รองศาสตราจารย์ ดร.วีระพงษ์ แพสุวรรณ)</br>
                    ผู้อำนวยการโครงการจัดรูปแบบการบริหารวิชาการด้านเทคโนโลยีดิจิทัลรูปใหม่</br>
                </div>

            </div>
        </div>


    </div>


</div>
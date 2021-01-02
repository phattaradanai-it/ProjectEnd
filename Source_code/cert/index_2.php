<?php
session_start();
include "check_login.php";
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css.css">

 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


    <style>
        .container-fluid {

            width: 90% !important;
            position: relative;
        }

        .section-area {
            background-color: #f6f8fb;

        }

        #cover {
            width: 260px;
            height: 260px;
            margin: 0 auto;
        }



        .mini-card {
            margin-left: 30%;
        }

        .text_head {

            position: absolute;
            top: 85px;
            left: 80px;
        }

        .text_name {

            position: absolute;
            top: 100px;
            left: 80px;
        }

        .text_center {

            position: absolute;
            top: 120px;
            left: 80px;
        }

        .text_cer {

            position: absolute;
            top: 160px;
            left: 80px;
        }

        .text_date {

            position: absolute;
            top: 180px;
            left: 80px;

        }

        .size_text {

            font-size: 13px;

        }

        .image_cer {

            position: absolute;
            top: 60px;
            left: 22rem;

        }

        .signature {

            position: absolute;
            top: 210px;
            left: 190px;

        }

        .leader {
            position: absolute;
            top: 240px;
            left: 100px;

        }

        .main_namecer {
            position: absolute;
            margin-left: 39%;
            top: 30px;
        }

        .button_margin {
            position: absolute;
            margin-left: 39%;
            bottom: 1px;

        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            width: 100px;
        }

        .carousel-control-next,
        .carousel-control-prev {
            width: 5% !important;

        }


        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
        }

        .btn-primary2 {

            color: #fff;
            background-color: #007bff !important;
            border-color: #007bff !important;

        }

        .card{

            border-radius: 25px;

        }
    </style>
</head>

<body>
<?php include 'header.php';?>]
    <br><br><br><br>      
    <div class="section-area">
        <div class="container-fluid">

        
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-white" style="background-color: #002c67; height: 50px;">
                            <h4 class="text-center">Certification</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9">
                                    <img class="bg-cert" src="img/cert_img/background.jpg" height="320px">
                                    <div class="size_text">
                                        <div class="text_head">มอบสัมฤทธิบัตรฉบับนี้แก่</div>
                                        <div class="text_name">สมชาย ใจดี</div>
                                        <div class="text_center">
                                            เพื่อแสดงว่าได้มีสัมฤทธิผลตามเกณฑ์<br>มาตรฐานของหลักสูตร</div>
                                        <div class="text_cer">สัมฤทธิบัตรโปรแกรมประยุกต์บนอุปกรณ์เคลื่อนที่</div>
                                        <div class="text_date">ให้ไว้ ณ วันที่ ๙ เมษายน พ.ศ. ๒๕๖๓</div>
                                        <div class="image_cer"><img src="cer_coin/ADVANCED.png" width="90px">
                                        </div>
                                        <div class="signature"><img src="sig/test.png" width="40px"></div>
                                        <div class="leader">(รองศาสตราจารย์
                                            ดร.วีระพงษ์แพสุวรรณ)<br>อธิการบดีมหาวิทยาลัยเทคโนโลยีสุรนารี</div>
                                    </div>

                                    <div class="main_namecer">
                                        <h4>Certificate in Mobile Application</h4>
                                        <p>Approved by : DIGITECH, Suranaree University of Technology<br>Approval date :
                                            April 9, 2020</p>
                                    </div>
                                    <div class="button_margin">
                                        <a href="#" class="btn btn-primary">Detail</a>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="mini-card">
                                        <div id="cover">

                                            <a href="#"><img src="badge/G/BIA1.png"style="float: left; width: 45%; margin: 1.66%;"></a>
                                            <a href="#"><img src="badge/G/BIA2.png"style="float: left; width: 45%; margin: 1.66%;"></a>
                                            <a href="#"><img src="badge/G/BIA3.png"style="float: left; width: 45%; margin: 1.66%;"></a>
                                            <a href="#"><img src="badge/S/BIA4.png"style="float: left; width: 45%; margin: 1.66%;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--line-->
                        <hr style="height:2px; background-color:#002c67;">
                        <!-----card---->
                    </div>
                </div>
            </div>





            <br>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-header text-white" style="background-color: #002c67; height: 50px;">
                        <h4 class="text-center">Certification ที่เกี่ยวข้อง</h4>
                    </div><br>
                </div>
            </div>


            <!----slider1---->
            <div id="slider1" class="carousel slide" data-ride="carousel" data-interval="false">
                <!---inner--->
                <div class="carousel-inner">
                    <div class="row justify-content-lg-center">
                        <div class="col-sm-11">
                            <!----item1--->
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Certificate Program in Mobile Application</h5>
                                                <br>
                                                <br>
                                                <div class="float-right">
                                                    <a href="#" class="btn btn-primary">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Certificate Program in Mobile Application</h5>
                                                <br>
                                                <br>
                                                <div class="float-right">
                                                    <a href="#" class="btn btn-primary">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!----item1--->
                            </div>

                            <!----item2--->
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Certificate Program in Mobile Application</h5>
                                                <br>
                                                <br>
                                                <div class="float-right">
                                                    <a href="#" class="btn btn-primary">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Certificate Program in Mobile Application</h5>
                                                <br>
                                                <br>
                                                <div class="float-right">
                                                    <a href="#" class="btn btn-primary">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!----item2--->
                            </div>

                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#slider1" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#slider1" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                        <!-----row----->
                    </div>

                    <!---inner--->
                </div>
                <!----slider---->
            </div>

            <br>





            <div class="row">
                <div class="col-lg-12">
                    <div class="card-header text-white" style="background-color: #002c67; height: 50px;">
                        <h4 class="text-center">Attendance</h4>
                    </div><br>
                </div>
            </div>



            <!----slider2---->
            <div id="slider2" class="carousel slide" data-ride="carousel" data-interval="false">
                <!---inner--->
                <div class="carousel-inner">
                    <div class="row justify-content-lg-center">
                        <div class="col-sm-11">
                            <!----item1--->
                            <div class="carousel-item active">
                                <div class="row">
                                    <!---------------->
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title_en">Certificate Program in Mobile Application</h5>
                                                <br>
                                                <h5 class="card-title_th">
                                                    หลักสูตรสัมฤทธิบัตรโปรแกรมประยุกต์บนอุปกรณ์เคลื่อนที่</h5><br><br>
                                                <a href="#" class="btn btn-primary2 btn-block">หนังสือรับรอง</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!---------------->
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title_en">Certificate Program in Business Insight
                                                    Analytics</h5><br>
                                                <h5 class="card-title_th">
                                                    หลักสูตรสัมฤทธิบัตรการวิเคราะห์ข้อมูลเชิงลึกทางธุรกิจ</h5><br><br>
                                                <a href="#" class="btn btn-primary2 btn-block">หนังสือรับรอง</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!---------------->
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title_en">Certificate Program in Online Content Creation
                                                </h5><br>
                                                <h5 class="card-title_th">หลักสูตรสัมฤทธิบัตรการสร้างสรรค์เนื้อหาออนไลน์
                                                </h5><br><br>
                                                <a href="#" class="btn btn-primary2 btn-block">หนังสือรับรอง</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!---------------->
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title_en">Certificate Program in Business Insight
                                                    Analytics</h5><br>
                                                <h5 class="card-title_th">
                                                    หลักสูตรสัมฤทธิบัตรการวิเคราะห์ข้อมูลเชิงลึกทางธุรกิจ</h5><br><br>
                                                <a href="#" class="btn btn-primary2 btn-block">หนังสือรับรอง</a>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!----item1--->
                            </div>

                            <!----item2--->
                            <div class="carousel-item">
                                <div class="row">
                                    <!---------------->
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title_en">Certificate Program in Mobile Application</h5>
                                                <br>
                                                <h5 class="card-title_th">
                                                    หลักสูตรสัมฤทธิบัตรโปรแกรมประยุกต์บนอุปกรณ์เคลื่อนที่</h5><br><br>
                                                <a href="#" class="btn btn-primary2 btn-block">หนังสือรับรอง</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!---------------->
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title_en">Certificate Program in Mobile Application</h5>
                                                <br>
                                                <h5 class="card-title_th">
                                                    หลักสูตรสัมฤทธิบัตรโปรแกรมประยุกต์บนอุปกรณ์เคลื่อนที่</h5><br><br>
                                                <a href="#" class="btn btn-primary2 btn-block">หนังสือรับรอง</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!---------------->
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title_en">Certificate Program in Mobile Application</h5>
                                                <br>
                                                <h5 class="card-title_th">
                                                    หลักสูตรสัมฤทธิบัตรโปรแกรมประยุกต์บนอุปกรณ์เคลื่อนที่</h5><br><br>
                                                <a href="#" class="btn btn-primary2 btn-block">หนังสือรับรอง</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!---------------->
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title_en">Certificate Program in Mobile Application</h5>
                                                <br>
                                                <h5 class="card-title_th">
                                                    หลักสูตรสัมฤทธิบัตรโปรแกรมประยุกต์บนอุปกรณ์เคลื่อนที่</h5><br><br>
                                                <a href="#" class="btn btn-primary2 btn-block">หนังสือรับรอง</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!----item2--->
                            </div>

                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#slider2" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#slider2" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                        <!-----row----->
                    </div>

                    <!---inner--->
                </div>
                <!----slider---->
            </div>
            <br>


<?php

$conn = new mysqli("localhost", "root", "", "digitech");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql2 = "SELECT * FROM student where std_firstname = '" . $_SESSION["user_firstname"] . "'";
$query2 = mysqli_query($conn, $sql2)  or die($mysqli->error);
$result2 = mysqli_fetch_assoc($query2); //query get degree


$sql = "SELECT * FROM program  JOIN cert ON program.cert_id = cert.cert_id AND cert.cert_type_id  
= " . $result2['std_degree'];  

$query = mysqli_query($conn, $sql)  or die($mysqli->error);
 // query fetch cert order by degree of student

 while ($result = mysqli_fetch_assoc($query)) {  
    echo $result['program_name_en'];
    echo"<br>";
}


$i = 0;
?>


        </div>
    </div>
</body>

</html>
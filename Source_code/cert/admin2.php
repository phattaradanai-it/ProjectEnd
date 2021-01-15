<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- W3 CSS -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">



    <!-- Load icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!------font------->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">


    <style>
        .container-fluid {

            width: 90% !important;


        }

        body {

            font-family: 'Kanit', sans-serif;
            background-color: #f6f8fb;
        }

        .w3-table-all {
            margin-left: auto;
            margin-right: auto;
            font-size: 20px;
        }

        .card {

            border-radius: 25px;


        }

        .text-center {
            font-family: 'Kanit', sans-serif;
            position: relative;
            margin-top: -5px;

        }

        .search_position {

            position: relative;
            margin-left: 70px;


        }

        .form-group {

            position: absolute;
            margin-top: -80px;
            margin-left: 290px;
            width: 12%;

        }

        .md-form {

            width: 15%;


        }

        .w3-button {

            position: absolute;
            background-color: #002c67;
            color: white;
            margin-top: -55px;
            margin-left: 35%;

        }

        
        .btn-group{

            position: absolute;
            margin-top: 0px;
            margin-left: 91%;


        }
        

        .btn:hover {
            background-color: #E9F1F0;
        }

        .head_bar{

            position: absolute;
            margin-top: -80px;
            margin-left: 1210px;

        }
 
        .next_bar {
        
            margin-left: 5%;

        } 

        .footer {
        margin-top: 4vh;
        background-color: #002c67;
        padding: 25px 0px 20px 0px;
        text-align: center;
        position: sticky;
        }

        .footer-copy-right p {
                
            margin: 0px;
            font-size: 15px;
            color: #fff;
        }
    </style>

</head>

<?php
session_start();
include "check_login.php";
?>
 


 <body>
 <?php include 'header.php';?>]
 <?php

$conn = new mysqli("localhost", "root", "", "digitech");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

error_reporting(E_ALL ^ E_NOTICE);
    $var_value = $_GET['search'];
    $var_value2 = $_GET['degree'];


    $perpage = 16;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $start = ($page - 1) * $perpage;


$sqlalldegree = "SELECT 
        program.program_name_th,program.program_name_en,cert.cert_name_th,cert.cert_name_en,cert.cert_type_id,cert_type.degree
        FROM
        program
        LEFT JOIN
        cert on program.cert_id = cert.cert_id 
        LEFT JOIN
        cert_type on cert.cert_type_id = cert_type.id
        limit {$start} , {$perpage}";

$sqlsearch = "SELECT 
        program.program_name_th,program.program_name_en,cert.cert_name_th,cert.cert_name_en,cert.cert_type_id,cert_type.degree
        FROM
        program
        LEFT JOIN
        cert on program.cert_id = cert.cert_id 
        LEFT JOIN
        cert_type on cert.cert_type_id = cert_type.id
        WHERE program_name_th LIKE '%" . $var_value . "%' OR cert_name_th LIKE '%" . $var_value . "%'
        limit {$start} , {$perpage}";
                

$sqldegree3 = "SELECT 
        program.program_name_th,program.program_name_en,cert.cert_name_th,cert.cert_name_en,cert.cert_type_id,cert_type.degree
        FROM
        program
        LEFT JOIN
        cert on program.cert_id = cert.cert_id
        LEFT JOIN
        cert_type on cert.cert_type_id = cert_type.id
        where cert_type.degree = 'ปริญาตรี'
        limit {$start} , {$perpage}";

$sqldegree4 = "SELECT 
        program.program_name_th,program.program_name_en,cert.cert_name_th,cert.cert_name_en,cert.cert_type_id,cert_type.degree
        FROM
        program
        LEFT JOIN
        cert on program.cert_id = cert.cert_id 
        LEFT JOIN
        cert_type on cert.cert_type_id = cert_type.id
        where cert_type.degree = 'ปริญาโท'
        limit {$start} , {$perpage}";

$sqldegree5 = "SELECT 
        program.program_name_th,program.program_name_en,cert.cert_name_th,cert.cert_name_en,cert.cert_type_id,cert_type.degree
        FROM
        program
        LEFT JOIN
        cert on program.cert_id = cert.cert_id 
        LEFT JOIN
        cert_type on cert.cert_type_id = cert_type.id
        where cert_type.degree = 'ปริญาเอก'
        limit {$start} , {$perpage}";

$sqlcount = "SELECT 
        program.program_name_th,program.program_name_en,cert.cert_name_th,cert.cert_name_en,cert.cert_type_id
        FROM
        program
        LEFT JOIN
        cert on program.cert_id = cert.cert_id 
        AND
        (program_name_en LIKE '%" . $var_value . "%' OR program_name_th LIKE '%" . $var_value . "%')";
        $querycount = mysqli_query($conn, $sqlcount)  or die($mysqli->error);


if($_GET['search'] ==! null){
    $query = mysqli_query($conn, $sqlsearch)  or die($mysqli->error);
}else if($_GET['degree'] == 3){
    $query = mysqli_query($conn, $sqldegree3)  or die($mysqli->error);
}else if($_GET['degree'] == 4){
    $query = mysqli_query($conn, $sqldegree4)  or die($mysqli->error);
}else if($_GET['degree'] == 5){
    $query = mysqli_query($conn, $sqldegree5)  or die($mysqli->error);
}else if($_GET['degree'] == null){
    $query = mysqli_query($conn, $sqlalldegree)  or die($mysqli->error);
}

$result = mysqli_fetch_assoc($query); 
$total_record = mysqli_num_rows($querycount);
$total_page = ceil($total_record / $perpage);
?>


<br><br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <!-- <div class="card-header text-white" style="background-color: #002c67; height: 60px; font-size: 35px; border-radius:25px 25px 0px 0px;">
                        <h2 class="text-center">ชุดวิชามาจากรายวิชาอะไรบ้าง</h2>
                    </div> -->
                    <br><br>

                    <form class="search1" name="search" method="get" action="">

                        <div class="search_position">
                                <div class="md-form active-cyan mb-3">
                                    <label>ค้นหา</label>
                                    <input class="form-control" type="text" name="search" placeholder="Search" aria-label="Search">
                                </div>

                        </div>

                            <div class="form-group">
                                <label for="degree">หลักสูตร</label>
                                <select class="form-control" name="degree" id="degree">
                                <option value="">ทั้งหมด</option>
                                <option value="3">ปริญาตรี</option>
                                <option value="4">ปริญาโท</option>
                                <option value="5">ปริญาเอก</option>
                                </select>
                            </div>
                            <button href="#!" class="w3-button w3-round-large" type="submit">Search</button>
                         
                            <div class="head_bar">
                                <label>เลือกหน้า</label>
                            </div> 
                            <div class="btn-group">                  
                             <button type="button" class="w3-button w3-round-large" data-toggle="dropdown" id="#" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars"></i></button>

                            <div class="dropdown-menu" aria-labelledby="#">
                                <a class="dropdown-item" href="admin1.php">Program</a>
                                <a class="dropdown-item" href="admin2.php">Cert</a>
                                <a class="dropdown-item" href="admin3.php">badge</a>
                            </div>

                        </div>
                    </form><br>

                    <table class="w3-table-all w3-hoverable" style="width: 90%;">
                        <thead>
                            <tr style="height:60px; background-color:#002c67; color: white;">
                                <th>No</th>
                          
                                <th>Program_Name_th</th>
                                <th>Cert_Name_th</th>
                                <th>Degree</th>
                            
                            </tr>
                        </thead>

                        <?php $n =1; $qc="test"; $qc2="tt"; while ($result = mysqli_fetch_assoc($query)) { ?>
                            <tr>
                                <td><?php echo $n++;?></td>

                                        <td><?php echo $result["program_name_th"]; ?></td>
                                        <td><?php echo $result["cert_name_th"]; ?></td>
                                        <td><?php echo $result["degree"]; ?></td>
                                
                                        
                            </tr>           
                        <?php }  ?>
                    </table>
                    <br>

                <div class="next_bar">   
                    <nav aria-label="Page navigation">
                         <ul class="pagination pagination-lg">
                            <?php for ($i = 1; $i <= $total_page; $i++) { 
                                 if($_GET['degree'] == 3){ ?>
                                        <li class="page-item "><a class="page-link" href="admin2.php?page=<?php echo $i; ?>search=&degree=3"><?php echo $i; ?></a></li>
                                <?php }else if($_GET['degree'] == 4) { ?>
                                         <li class="page-item "><a class="page-link" href="admin2.php?page=<?php echo $i; ?>search=&degree=4"><?php echo $i; ?></a></li>
                               <?php }else if($_GET['degree'] == 5) { ?>
                                         <li class="page-item "><a class="page-link" href="admin2.php?page=<?php echo $i; ?>search=&degree=5"><?php echo $i; ?></a></li>
                               <?php }else{ ?>
                                     <li class="page-item "><a class="page-link" href="admin2.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php } 
                            }?>
                        </ul>
                     </nav>
                </div>



                </div>
            </div>
        </div>

    </div>
    <br><br>      
        <!-- Footer --> 
     <div class="footer">
        <div class="footer-copy-right p">
            <p>โครงการจัดรูปแบบการบริหารวิชาการด้านเทคโนโลยีดิจิทัลรูปใหม่ มหาวิทยาลัยเทคโนโลยีสุรนารี 111
                มหาวิทยาลัยเทคโนโลยีสุรนารี ต.สุรนารี อ.เมือง จ.นครราชสีมา 30000</p>
            <p>โทรศัพท์ : 044-223789 Email : digitech@sut.ac.th</p>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
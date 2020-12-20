<style>
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

.card-header{
    background-color: #002c67 !important;
    color: white;

}

</style>


<?php
// Please re-check
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too

session_start();
include "check_login.php";
echo $_GET["id"]; 
 ?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

 <body>
 <?php include 'header.php';?>]
        <?php
                $conn = new mysqli("localhost","root", "", "digitech");
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM program where program_id =  ".$_GET["id"]." ";
                $query = mysqli_query($conn, $sql)  or die ( $mysqli->error );

                $sql2 ="SELECT * FROM course JOIN course_of_program ON course.course_id = course_of_program.course_id AND course_of_program.program_id = ".$_GET["id"];
                $query2 = mysqli_query($conn, $sql2)  or die ( $mysqli->error ); 

              
        ?>

    <br>
    <br><br>
    <div class="container-fluid">   
        <?php
             while ($result = mysqli_fetch_assoc($query))  {  
                    echo"<h4>";
                    echo $result['program_name_en'];
                    echo"<br>";
                    echo $result['program_name_th'];
                    echo"<br>";
                    echo"</h4>";
                 }
        ?>
        <br>
        <div class="card-header text-center">
            <h5>โครงสร้างหลักสูตร</h5>
        </div>
        <br><br>
        <div class="card-deck"> 
                 <?php while ($result2 = mysqli_fetch_assoc($query2))  {   ?>
            <div class="col-sm-6">      
                        <div class="card text-center">  
                            <div class="card-body">
                            <h5 class="card-title"><?php echo $result2['course_name_th']; ?></h5>
                                <h5><?php echo $result2['course_name_en']; ?></h5><br><br>                   
                            <img src="icons/data.png" class="rounded mx-auto d-block" height="420" width="50%"><br><br>
                            <p class="card-text"><?php echo $result2['course_detail_th']; echo $result2['course_detail_en'];?> </p>
                            </div>
                        </div>
                </div>
            <?php } ?>
        </div>


    </div>


    <div class="footer">
            <div class="footer-copy-right p">
                <p>โครงการจัดรูปแบบการบริหารวิชาการด้านเทคโนโลยีดิจิทัลรูปใหม่ มหาวิทยาลัยเทคโนโลยีสุรนารี 111
                 มหาวิทยาลัยเทคโนโลยีสุรนารีต.สุรนารี อ.เมือง จ.นครราชสีมา 30000</p>
                 <p>โทรศัพท์ : 044-223789 Email : digitech@sut.ac.th</p>
            </div>
        </div>

</body>
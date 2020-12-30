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
    margin-bottom: 20px !important;
    margin-left: -45;
    margin-right: -45;
    
}

.ml-auto, .mx-auto {
    margin-bottom: -5% !important;
    margin-top: -5% !important;
}

.body-section {
    display: flow-root;
    background-color: #fff;
    padding: 2vh 2vw;
}

.section-area {
    background-color: #f6f8fb;
}

.container-fluid {
    width: 95% !important;
    /* margin-top: 5%; */

}

.col-sm-6.detail{
    margin-bottom: 50px;
}

.card-title{
    background-color: #002c67 !important;
    color: white;
    margin-bottom: 20px !important;
    margin-left: -20;
    margin-right: -20;
}
.card-text:last-child {
    text-align: left;
}
</style>



<?php
// Please re-check
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too

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
                
                $sql3 ="SELECT * FROM course JOIN course_of_program ON course.course_id = course_of_program.course_id AND course_of_program.program_id = ".$_GET["id"];
                $query3 = mysqli_query($conn, $sql3)  or die ( $mysqli->error );
                ?>
    
    <div class="section-area">
        <div class="container-fluid">
        <br><br><br>          
             <?php
             while ($result = mysqli_fetch_assoc($query))  {  
                    echo"<h4>";
                    echo $result['program_name_en'];
                    echo"<br>";
                    echo $result['program_name_th'];
                    echo"<br>";
                    echo"</h4>";
                 }?><br>
                <div class="card-header text-center">
                    <h3>โครงสร้างหลักสูตร</h3>
                </div>
    <?php
        $total = 0;
        while ($result3 = mysqli_fetch_assoc($query3))  {  
          $i = $result3['course_credit'];
          $total = $total + $result3['course_credit'];
        }
    ?>

    <h5>จำนวนหน่วยกิตรวมตลอดหลักสูตร <?php echo $total;  ?> หน่วยกิต (ทวิภาค) รายวิชา</h5>
        
     <div class="row cert-mg-t"> 
             
        <div class="card-deck"> 
        <?php while ($result2 = mysqli_fetch_assoc($query2))  { ?>
              
            <div class="col-sm-6 detail">      
                        <div class="card text-center">  
                            <div class="card-body">
                            <h5 class="card-title"><?php echo $result2['course_name_th']."<br>"; ?>
                                <?php echo $result2['course_name_en']; ?></h5><br>                  
                            <img src="img/icon_courses/<?php echo $result2['img']; ?>" class="rounded mx-auto d-block" height="300" width="40%"><br><br>
                            <p class="card-text"><?php echo "TH: ".$result2['course_detail_th']; echo "<br><br>"." EN: ".$result2['course_detail_en'];?> </p>
                            </div>
                        </div>  
             </div>
            <?php }  ?>
        </div>

    </div>

    </div>

        <div class="footer">
                    <div class="footer-copy-right p">
                        <p>โครงการจัดรูปแบบการบริหารวิชาการด้านเทคโนโลยีดิจิทัลรูปใหม่ มหาวิทยาลัยเทคโนโลยีสุรนารี 111
                        มหาวิทยาลัยเทคโนโลยีสุรนารี ต.สุรนารี อ.เมือง จ.นครราชสีมา 30000</p>
                        <p>โทรศัพท์ : 044-223789 Email : digitech@sut.ac.th</p>
                    </div>
            </div>

    </div>  
       

</body>
</html>
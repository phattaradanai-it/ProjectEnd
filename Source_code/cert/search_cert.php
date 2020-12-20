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

* {
  box-sizing: border-box;
}

/* Style the search field */
form.search1 input[type=text] {
  padding: 10px;
  font-size: 12px;
  border: 1px solid grey;
  float: left;
  width: 20%;
  background: #f1f1f1;
}

/* Style the submit button */
form.search1 button {
  float: left;
  width: 3%;
  padding: 10px;
  background: #002c67;
  color: white;
  font-size: 12px;
  border: 1px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.search1 button:hover {
  background: #0b7dda;
}

/* Clear floats */
form.search1::after {
  content: "";
  clear: both;
  display: table;
}

.center {
    display: flex;
    justify-content: center;
  }

.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
    
}
*, ::after, ::before {
    box-sizing: border-box;
}
* {
    box-sizing: border-box;
}

div {
    display: block;
}
.text-center {
    text-align: center!important;
}

.card .text-white{
    background-color: #002c67;
    text-align: center;
}

.btn-primary {
    background-color: #002c67 !important;
    border-color: #002c67 !important;
}

.body-section {
    display: flow-root;
    background-color: #fff;
    padding: 2vh 1vw;
}

/* .card-body {
 background-image: url("wallpapersut.jpg");
} */
  /* .row {
    margin-left: 80px !important;
} */

</style>
<?php
session_start();
include "check_login.php";
?>
<!doctype html>
<html class="no-js" lang="th">
<?php $var_value = null;
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DIGITECH</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include 'header.php';?>]
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

        <br><br><br><br>
         <!-- form search and send value in page -->
            <form class="search1"  name="search"  method="get" action="">
                <div class="center">
                <input type="text" placeholder="Search.." name="search" autocomplete="off">
                <button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <br><br>
        
    <?php
        error_reporting (E_ALL ^ E_NOTICE); 
        $var_value = $_GET['search'];
    ?>


    <div class="section-area  ">
        <div class="container-fluid">
            <div class="row cert-mg-t"> 
                <!--  Certification  -->

                <?php
                $conn = new mysqli("localhost","root", "", "digitech");
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

          
                

                $sql2 = "SELECT * FROM student where std_firstname = '". $_SESSION["user_firstname"] ."'";  
                $query2 = mysqli_query($conn, $sql2)  or die ( $mysqli->error ); 
                $result2 = mysqli_fetch_assoc($query2); //query get degree
                
                
                $sql = "SELECT * FROM program JOIN cert ON program.cert_id = cert.cert_id AND cert.cert_type_id = ".$result2['std_degree']." AND(program_name_en LIKE '%".$var_value."%' OR program_name_th LIKE '%".$var_value."%')"; // ค้นหา
                $query = mysqli_query($conn, $sql)  or die ( $mysqli->error );
                  // query fetch cert order by degree of student

                ?>
                
                 <div class="container-fluid">         
                    <div class="row">
                         <?php while ($result = mysqli_fetch_assoc($query))  {  ?>
                            
                            <div class="col-sm-6">  <!-----block fetch data --->
                                <div class="card">
                                    <div class="card-body " >
                                         <h3 class="card-title">
                                                <div class="card text-white">
                                                <?php echo $result['cert_name_en'];  $send =$result['program_id'];  ?>
                                                </div>
                                         </h3><br>

                                            <div class="card-deck">
                                                <?php
                                                $sql3 ="SELECT course.course_name_en FROM course JOIN course_of_program ON course.course_id = course_of_program.course_id AND course_of_program.program_id = ".$result['program_id'];
                                                $query3 = mysqli_query($conn, $sql3)  or die ( $mysqli->error ); ?> 
                                                <?php while ($result3 = mysqli_fetch_assoc($query3))  { ?>
                                                <div class="col-sm-6">
                                                      <div class="card text-center">
                                                            <img class="card-img-top" src="icon.png" alt="Card image cap" height="200" width="50">
                                                            <div class="card-body">
                                                                <p class="card-title"><?php echo $result3['course_name_en']; ?></p>
                                                            </div>
                                                     </div>
                                                </div>
                                                <?php } ?>
                                            </div><br>

                                                   
                                        <form action="search_detail.php" method="get">
                                            <!-- send detail in cert value -->
                                            <input type="hidden" name="id" value="<?php echo $send  ?>">
                                            <div class="float-right">
                                                <button class="btn btn-primary" type="submit"> Detail > </button>
                                            </div>
                                        </form>


                                    </div>
                                </div><br><br>
                            </div>
                            
                        <?php } ?>
                     </div>
                 </div>


                
            </div>       
        </div>
    </div>

  

        <!-- Footer -->
        <div class="footer">
            <div class="footer-copy-right p">
                <p>โครงการจัดรูปแบบการบริหารวิชาการด้านเทคโนโลยีดิจิทัลรูปใหม่ มหาวิทยาลัยเทคโนโลยีสุรนารี 111
                 มหาวิทยาลัยเทคโนโลยีสุรนารีต.สุรนารี อ.เมือง จ.นครราชสีมา 30000</p>
                 <p>โทรศัพท์ : 044-223789 Email : digitech@sut.ac.th</p>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade qr-modal" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="align-center modal-title">This website is issued to certify that</div>
                        <div class="modal-name align-center">
                            <?php echo $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname']; ?></div>
                        <div class="align-center">has successfully completed</div>
                        <div class="align-center">the program of digitech</div>
                        <div class="align-center">
                            <button type="button" class="modal-button" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php if (isset($_SESSION["user_qr_login"]) && $_SESSION["user_qr_login"] == true) {?>
    <?php $_SESSION["user_qr_login"] = false;?>
    <script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
    </script>

    <?php }?>


    <!-- jquery -->
    <!-- <script src="js/vendor/jquery-1.12.4.min.js"></script> -->
    <!-- meanmenu JS-->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- metisMenu JS -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- main JS -->
    <!-- <script src="js/main.js"></script> -->
    <!-- fittext -->
    <script src="js/fittext.js"></script>
</body>

<?php include "fittext-config.php";?>

</html>
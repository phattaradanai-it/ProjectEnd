<style>
.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
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

* {
  box-sizing: border-box;
}

/* Style the search field */
form.search1 input[type=text] {
  padding: 10px;
  font-size: 12px;
  border: 1px solid grey;
  float: left;
  width: 10%;
  background: #f1f1f1;
}

/* Style the submit button */
form.search1 button {
  float: left;
  width: 3%;
  padding: 10px;
  background: #2196F3;
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

</style>
<?php
session_start();
include "check_login.php";
?>
<!doctype html>
<html class="no-js" lang="th">

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
         <!-- The form -->
         <form class="search1" action="#">
                <div class="center">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
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

                $perpage = 6;
                if (isset($_GET['page'])) {
                     $page = $_GET['page'];
                } else {
                     $page = 1;
                }
                $start = ($page - 1) * $perpage;
                
                
                $sql = "select id, course_of_program.program_id, program.program_name_th, program.program_name_en, 
                course.course_name_th,course.course_name_en
                from course_of_program 
                LEFT JOIN program on course_of_program.program_id = program.program_id 
                LEFT JOIN course on course_of_program.course_id = course.course_id
                limit {$start} , {$perpage} ";
                $query = mysqli_query($conn, $sql)  or die ( $mysqli->error );
                ?>
               
                 <div class="container-fluid">         
                    <div class="row">
                         <?php while ($result = mysqli_fetch_assoc($query))  { ?>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                         <h5 class="card-title"><?php echo $result['program_name_en']; ?><br>
                                        <?php echo $result['program_name_th']; ?></h5>
                                         <br>
                                         <br>
                                         <p>Course : <?php echo $result['course_name_en']; ?></p>
                                         <p>รายวิชา : <?php echo $result['course_name_th']; ?></p>
                                        <div class="float-right">
                                             <a href="#" class="btn btn-primary">Detail</a>
                                        </div>
                                    </div>
                                </div><br><br>
                            </div>
                        <?php } ?>
                     </div>
                 </div>

                <?php
                $sql2 = "select * from course_of_program ";
                $query2 = mysqli_query($conn, $sql2);
                $total_record = mysqli_num_rows($query2);
                $total_page = ceil($total_record / $perpage);
                ?>
                

                <div class="pagination">
                    <a href="search_cert.php?page=1">&laquo;</a>
                    <?php for($i=1;$i<=$total_page;$i++){ ?>
                    <li><a href="search_cert.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <a href="search_cert.php?page=<?php echo $total_page;?>">&raquo;</a>
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
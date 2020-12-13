
<?php
session_start();
include "check_login.php";


// echo "<script>console.log('" . json_encode($_SESSION['attendance']) . "');</script>";
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


    <!-- style CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS -->
    <!-- <script src="js/vendor/modernizr-2.8.3.min.js"></script> -->

</head>

<body>
    <?php include 'header.php';?>]


    <!-- <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="../images/logo_banner_white.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div> -->


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

                $perpage = 10;
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
                <div class="container">
                <div class="row">
                <div class="col-lg-12">
                <table class="table table-bordered table-hover">
                <thead>
                <tr>
                <th>#</th>
                <th>program_id</th>
                <th>program_name_th</th>
                <th>program_name_en</th>
                <th>course_name_th</th>
                <th>course_name_en</th>
                </tr> 
                </thead>
                <tbody>
                <?php while ($result = mysqli_fetch_assoc($query))  { ?>
                <tr>
                <td><?php echo $result['id']; ?></td>
                <td><?php echo $result['program_id']; ?></td>
                <td><?php echo $result['program_name_th']; ?></td>
                <td><?php echo $result['program_name_en']; ?></td>
                <td><?php echo $result['course_name_th']; ?></td>
                <td><?php echo $result['course_name_en']; ?></td>
                </tr>
                <?php } ?>
                </tbody>
                </table>

                <?php
                $sql2 = "select * from course_of_program ";
                $query2 = mysqli_query($conn, $sql2);
                $total_record = mysqli_num_rows($query2);
                $total_page = ceil($total_record / $perpage);
                ?>
                
                <nav>
                <ul class="pagination">
                <li>
                <a href="search_cert.php?page=1" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <?php for($i=1;$i<=$total_page;$i++){ ?>
                <li><a href="search_cert.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
                <li>
                <a href="search_cert.php?page=<?php echo $total_page;?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
                </ul>
                </nav>

                
                </div>
                </div>       
                </div>

            </div>



        <!-- Footer -->
        <?php include "footer.php";?>


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
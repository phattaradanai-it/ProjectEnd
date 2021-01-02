<style>
.header-section {
    background-color: var(--content-color);
    color: #fff;
    font-size: 3vh;
    margin-top: 2vh;
    padding: 0.3vh 2vh;
}

.carousel-control-next-icon, .carousel-control-prev-icon {
    display: inline-block !important;
    width: 20px !important;
    height: 20px !important;
    background-size: 100% 100% !important;
   
}

.carousel-control-next-icon {
    background-image: url("right.png") !important;
}

.carousel-control-prev-icon {
    background-image: url("left.png") !important;
}



</style>


<?php
session_start();
include "check_login.php";
include "get_cert.php";
include "get_badge.php";
include "get_attendance.php";
include "cert_function.php";


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
  

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


    <!-- style CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS -->
    <!-- <script src="js/vendor/modernizr-2.8.3.min.js"></script> -->

    
</head>


<body>
    <?php include 'header.php';?>]

    <?php
        $conn = new mysqli("localhost", "root", "", "digitech");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql2 = "SELECT * FROM student where std_firstname = '" . $_SESSION["user_firstname"] . "'";
        $query2 = mysqli_query($conn, $sql2)  or die($mysqli->error);
        $result2 = mysqli_fetch_assoc($query2); //query get degree


        $sql = "SELECT cert.cert_name_en FROM cert WHERE NOT EXISTS(SELECT*FROM cert_of_student WHERE cert_of_student.std_id = 
        ".$result2['std_id']." AND cert_of_student.cert_id = cert.cert_id ) AND cert_type_id = ". $result2['std_degree'];
        $query = mysqli_query($conn, $sql)  or die($mysqli->error);
    ?>



    <div class="section-area  ">
        <div class="container-fluid">

            <div class="row cert-mg-t">

                <!--  Certification  -->
                <?php !empty($_SESSION['cert']) ? include "cert.php" : '';?>

                <!--  Badge  -->
                <?php if (!empty($_SESSION['badge'])) {?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="section header-section mb-2">
                        My Badge
                    </div>
                    <div class="section">
                        <?php $badge = $_SESSION['badge'];?>
                        <?php include "badge.php"?>
                    </div>
                </div>
                <?php }?>

                <!--  Attendance  -->
                <?php !empty($_SESSION['attendance']) ? include "attendance.php" : ''?>
            </div> <br>
         

            <div class="section header-section mb-4">
                Recommend Certificate
            </div>
                <?php include "Recommend_cert.php"?>      
            


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
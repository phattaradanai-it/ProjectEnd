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
                <?php !empty($_SESSION['cert']) ? include "cert.php" : '';?>

                <!--  Badge  -->
                <?php if (!empty($_SESSION['badge'])) {?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="section header-section mb-2">
                        Badge
                    </div>
                    <div class="section">
                        <?php $badge = $_SESSION['badge'];?>
                        <?php include "badge.php"?>
                    </div>
                </div>
                <?php }?>

                <!--  Attendance  -->
                <?php !empty($_SESSION['attendance']) ? include "attendance.php" : ''?>

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
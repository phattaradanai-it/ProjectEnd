<?php

// Please re-check
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too

session_start();
include "check_login.php";

$order = 0;
$cert = [];
$badge = (object) [];
$honor = true;

$cert_id = $_POST['id'] != null ? $_POST['id'] : $_SESSION['current_cert_id'];

foreach ($_SESSION['cert'] as $key => $cert_value) {
    if ($cert_value->cert_id == $cert_id) {
        $cert = $cert_value;
        $_SESSION['current_cert_id'] = $cert_id;
        $_SESSION['current_cert'] = $cert;
    }
}

foreach ($_SESSION['badge'] as $key => $badge_value) {
    if ($badge_value->cert_id == $cert_id) {
        $badge->$key = $badge_value;
        if ($badge_value->practice_score + $badge_value->objective_score < 80) {
            $honor = false;
        }
    }
}

include "get_program_by_cert_id.php";
include "get_course.php";
include "cert_function.php";

?>
<!doctype html>
<html class="no-js" lang="th">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>DIGITECH</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- style CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script type="text/javascript" src="./node_modules/html2canvas/dist/html2canvas.js"></script>
</head>

<body>

    <!-- for Print -->
    <div class="bg-overlay"></div>
    <div id="cert-hide">
        <div id="printableArea" class="container-cert">
            <?php include "cert_template.php"?>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div class="spinner-overlay align-center">
        <div class="spinner-ring ">
            <div></div>
        </div>
    </div>

    <?php include 'header.php';?>

    <!-- Start Welcome area -->
    <div class="cert-mg-t">

        <!-- Content Here -->
        <div class="section-area">
            <div class="container-fluid">
                <div class="row">

                    <!-- Cert Detail -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="section">
                            <div class="cert-header">
                                <div class="en"> <?php echo $cert->cert_name_en; ?></div>
                                <div class="th"> <?php echo $cert->cert_name_th; ?></div>
                            </div>
                            <div class="cert-content ">
                                <div class="row">
                                    <!-- LEFT -->
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <!-- for Preview -->
                                        <div class="cert-img">
                                            <?php include "cert_template.php"?>
                                        </div>
                                    </div>

                                    <!-- RIGHT -->
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">

                                        <div class="row">
                                            <div class="col-2 cert-line">
                                                <hr>
                                            </div>
                                            <div class="col-8 cert-text-1 align-center">This certificate is awarded to
                                            </div>
                                            <div class="col-2 cert-line">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="cert-name align-center">
                                            <?php echo $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname']; ?>
                                        </div>

                                        <div class="cert-approved">
                                            <div class="header">
                                                Approved by
                                            </div>
                                            <div class="body"><?php echo $cert_value->cert_approve; ?> </div>
                                            <hr style="border-color : #5D5D5D">
                                            <div class="header">
                                                Approval date
                                            </div>
                                            <div class="body">
                                                <?php echo date("F j, Y", strtotime($cert_value->cert_date)); ?></div>
                                        </div>

                                        <div class="align-center">
                                            <button class="download align-center" onclick="printDiv('printableArea')">
                                                Download <img style="height:25px; margin-left:5px;"
                                                    src="img/file-download-icon.svg"> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Program Detail -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="section ">

                            <div class="course-body">
                                <div class="course-header">วัตถุประสงค์ของหลักสูตร</div>
                                <div class="body white-bg">
                                    <?php echo nl2br($_SESSION['current_program']->program_objective); ?>
                                </div>
                            </div>

                            <div class="course-body">
                                <div class="course-header">โครงสร้างหลักสูตร</div>
                                <div class="body-2">
                                    จำนวนหน่วยกิต รวมตลอดหลักสูตร
                                    <?php
$i = 0;
foreach ($_SESSION['course'] as $credit) {
    $i += $credit->course_credit;
}
echo $i;
?>
                                    หน่วยกิต (ทวิภาค)

                                    <!--  Program  -->
                                    <div class="mt-3">
                                        <?php include "badge.php"?>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>


        <!-- Footer -->
        <?php include "footer.php";?>

        <script type="text/javascript">
        function printDiv(divName) {

            // var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

            // if (!isMobile) {
            //   var printContents = document.getElementById(divName).innerHTML;
            //   document.body.innerHTML = printContents;
            //   window.print();
            //   location.reload();
            // } else {
            document.getElementsByClassName("spinner-overlay")[0].style.display = 'flex';

            html2canvas(document.querySelector("#printableArea"), {
                scrollY: 0
            }).then(canvas => {
                var imgData = canvas.toDataURL(
                    'image/png');
                var doc = new jsPDF('l', 'mm', 'a4');
                var width = doc.internal.pageSize.getWidth();
                var height = doc.internal.pageSize.getHeight();
                doc.addImage(imgData, 'PNG', 0, 0, width, height);
                document.getElementsByClassName("spinner-overlay")[0].style.display = 'none';
                // doc.save('cert-digitech.pdf');
                // window.open(doc.output('bloburl'))
                window.open(doc.output('bloburl'), '_blank');
                // window.open(URL.createObjectURL(doc.output("blob")))
            });
            // }
        }
        </script>
        <!-- jquery -->
        <script src="js/vendor/jquery-1.12.4.min.js"></script>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
            integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous">
        </script>
        <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>




    </div>
</body>

<?php include "fittext-config.php";?>

</html>
<?php

// Please re-check
// header('Cache-Control: no cache'); //no cache
// session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too

session_start();
include "check_login.php";

// echo "<script>console.log('" . json_encode($_SESSION['attendance']) . "');</script>";
$program_id = $_GET['program_id'];
$diploma = false;
$diploma_date = "";
$diploma_approve = "";

if (!empty($program_id)) {
    $_SESSION['current_program_id'] = $program_id;
    include "get_program.php";
    include "get_course.php";

    foreach ($_SESSION['attendance'] as $program) {
        if ($program->program_id == $program_id && $program->status == "หนังสือรับรอง") {
            $diploma = true;
            $diploma_date = $program->diploma_date;
            $diploma_approve = $program->diploma_approve;
        }
    }
}

// echo "<script>console.log('" . json_encode($_SESSION["current_program"]) . "');</script>";

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- style CSS -->

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">


</head>

<body>

    <!-- Left menu area -->
    <?php include "header.php";?>

    <div class="cert-mg-t">
        <!-- Content Here -->
        <div class="section-area">
            <div class="container-fluid">
                <div class="row">
                    <!-- Program Header -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="z-index:1;">
                        <div class="section">
                            <div class="cert-header">
                                <div class="en"> <?php echo $_SESSION["current_program"]->program_name_en; ?></div>
                                <div class="th"> <?php echo $_SESSION["current_program"]->program_name_th; ?></div>
                            </div>

                        </div>
                    </div>


                    <!-- Diploma -->
                    <?php if ($diploma) {
    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 get-overlay">
                        <div class="section ">
                            <?php include "diploma_detail.php";}?>

                        </div>
                    </div>
                    </php }?>

                    <!-- Program Detail -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 get-overlay">
                        <div class="section ">
                            <div class="course-body">
                                <div class="course-header">วัตถุประสงค์ของหลักสูตร</div>
                                <div class="body white-bg">
                                    <?php echo nl2br($_SESSION["current_program"]->program_objective); ?>
                                </div>
                            </div>

                            <div class="course-body">
                                <div class="course-header">โครงสร้างหลักสูตร</div>
                                <div class="body-2">
                                    <div>จำนวนหน่วยกิต รวมตลอดหลักสูตร
                                        <?php
$i = 0;
foreach ($_SESSION['course'] as $credit) {
    $i += $credit->course_credit;
}
echo $i;
?>
                                        หน่วยกิต (ทวิภาค)
                                    </div>
                                    <div>รายวิชา</div>
                                    <?php foreach ($_SESSION['course'] as $course) {?>
                                    <div class="course-card">
                                        <div class="title">
                                            <?php echo $course->course_name_th . ' (' . $course->course_name_en . ')'; ?>
                                        </div>
                                        <div class="content">
                                            <p><?php echo $course->course_detail_th; ?></p>
                                            <p><?php echo $course->course_detail_en; ?></p>
                                        </div>
                                    </div>
                                    <?php
}
?>
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


</body>



</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style_header.css">
</head>

<body>
    <header>
        <div class="menu">
            <nav>
                <div class="row-bars">
                    <a href="../index.php" class="logo-bars">
                        <img src="img/logo_menu.png" alt="" style="height: 9.5vw;">
                    </a>
                    <div id="bars" class="menu-bars">
                        <i class="fa fa-bars"></i>
                    </div>
                </div>

                <a href="../index.php" class="logo">
                    <img src="img/logo_menu.png" alt="" style="height: 3.3vw;">
                </a>
                <ul class="main-menu">
                    <li><a href="../about-program.php">เกี่ยวกับโครงการ</a></li>
                    <li><a href="#">หลักสูตรที่เปิดสอน<i class="fa fa-sort-desc" style="font-size: initial"></i></a>
                        <ul>
                            <li><a href="../index.php">เกี่ยวกับกลุ่มหลักสูตร</a></li>
                            <li><a href="../digital-technology.php">สาขาวิชาเทคโนโลยีดิจิทัล</a></li>
                            <li><a href="../digital-communication.php">สาขาวิชานิเทศศาสตร์ดิจิทัล</a></li>
                        </ul>
                    </li>
                    <li><a href="#">การรับสมัคร<i class="fa fa-sort-desc" style="font-size: initial"></i></a>

                        <ul>
                            <li><a href="../register_certificate.php">หลักสูตรสัมฤทธิบัตร</a></li>
                            <li><a href="#">หลักสูตรปริญญาตรี<i class="fa fa-sort-desc"
                                        style="font-size: initial"></i></a>
                                <ul>
                                    <li><a href="../apply.php">ขั้นตอนการสมัคร</a></li>
                                    <li><a href="../tuition-fees.php">ค่าธรรมเนียมการศึกษา</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">บุคลากร<i class="fa fa-sort-desc" style="font-size: initial"></i></a>
                        <ul>
                            <li><a href="../personnal-board.php">ผู้บริหารโครงการ</a></li>
                            <li><a href="../personnal-professor.php">คณาจารย์</a></li>
                            <li><a href="../personnal-staff.php">เจ้าหน้าที่ และผู้ช่วยสอน</a></li>
                        </ul>
                    </li>
                    <!-- <li><a href="../personnal.php">คณาจารย์และบุคลากร</a></li> -->
                    <li><a href="../contact-us.php">ติดต่อเรา</a></li>
                    <?php if (isset($_SESSION["user_id"])) {?>
                    <li><a href="#">
                            <i class="fa fa-user-circle pl-0"></i>
                            <span class="admin-name"> <?php echo $_SESSION["user_firstname"] ?></span><i
                                class="fa fa-sort-desc" style="font-size: initial"></i></a>
                        <ul>
                            <li><a href="index.php">สัมฤทธิบัตร</a></li>
                            <?php if (!isset($_SESSION["user_qr_login"])) {?> <li><a href="logout.php">ออกจากระบบ</a>
                            </li> <?php }?>
                        </ul>
                    </li>
                    <?php } else {?>
                    <li><a href="../cert/login.php">ตรวจสอบสัมฤทธิบัตร</a></li>
                    <?php }?>

                </ul>
            </nav>
        </div>
    </header>
    <script type="text/javascript">
    $("#bars").click(function() {
        $("ul").slideToggle();
        $("ul ul").css("display", "none");
    });

    $(".drop").click(function() {
        $("ul ul").slideUp();
        $(this).find('ul').slideToggle();
    });

    $(".layer-drop").click(function() {
        $("ul ul").slideUp();
        $(this).find('ul').slideToggle();
    });

    $(window).resize(function() {
        if ($(window).width() > 768) {
            $("ul").removeAttr('style');
        }
    });
    </script>
</body>

</html>
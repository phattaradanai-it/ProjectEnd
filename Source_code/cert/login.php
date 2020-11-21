<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("location: index.php");
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- style CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">


    <script src='https://www.google.com/recaptcha/api.js?hl=th'></script>
</head>

<body>

    <?php include 'header.php';?>

    <!-- Modal -->
    <div class="modal fade qr-modal" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    </br>
                    <div class="align-center modal-title">Invalid username or password. Please check and try again.
                    </div>
                    </br>
                    <div class="align-center">
                        <button type="button" class="modal-button" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="error-pagewrap">
        <div class="error-page-int">
            <div class="text-center mt-5 m-b-md custom-login">
                <p>ตรวจสอบสัมฤทธิบัตร</p>
            </div>
            <div class="login-line mr-4 ml-4"></div>
            <div class="content-error">
                <div class="hpanel">
                    <div class="panel-body">
                        <form name="loginForm" method="post" action="">
                            <div class="form-group">
                                <label class="control-label login-title">บัญชีผู้ใช้</label>
                                <input class="form-control" type="type" name="username" id="username">
                                <label class="control-label login-title">รหัสผ่าน</label>
                                <input class="form-control" type="password" name="password" id="password">
                                <!-- <input class="form-control" type="type" maxlength="13" name="personal_id" id="personal_id"  onblur="onCheckId()"> -->
                                <!-- <span class="help-block h4" id="warning_field" style="visibility:hidden">กรุณากรอกให้ครบ 13 หลัก</span> -->
                                <div class="g-recaptcha  align-center mt-5" data-callback="makeaction"
                                    data-sitekey="6LeqedAUAAAAAEPT0NvZ4CsQsw2bTjUFAB6xaBIx"></div>

                            </div>
                            <button id="btn_submit" class="btn btn-success btn-block loginbtn"
                                onclick="return doSubmit()" disabled>
                                <h4>ตรวจสอบ</h4>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
    var check = false; // please change to false after need captcha + disabled button

    function doSubmit() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        if (username == "") {
            document.getElementsByName("username")[0].placeholder = "กรุณากรอกบัญชีผู้ใช้";
            return false;
        } else if (password == "") {
            document.getElementsByName("password")[0].placeholder = "กรุณากรอกรหัสผ่าน";
            return false;
        } else {
            jQuery.ajax({
                type: "POST",
                url: "verify_login.php",
                data: {
                    username: username,
                    password: password,
                },
                success: function(response) {
                    if (response != null && response != "") {
                        window.location.href = "./index.php";
                    } else {
                        onLoginFailWarning();
                    }
                }
            });
        }
        return false;
    };

    function makeaction() {
        check = true;
        document.getElementById('btn_submit').disabled = false;
        return false;
    };

    function onCheckId() {
        var id = document.getElementById('personal_id').value;
        if (id != "" && id.length != 0 && id.length < 13) {
            document.getElementById('personal_id').focus();
            document.getElementById('warning_field').style.visibility = "visible";
            document.getElementsByName("personal_id")[0].placeholder = "";
        } else {
            document.getElementById('warning_field').style.visibility = "hidden";
        }
    }

    function onLoginFailWarning() {
        $(document).ready(function() {
            $('#myModal').modal('show');
        });
    }
    </script>

</body>

</html>
<?php
// echo "<script>console.log('" . json_encode($_SESSION['current_program']) . "');</script>";
include "cert_function.php";
?>
<!-- for Print -->
<div class="bg-overlay"></div>
<div id="cert-hide">
    <div id="printableArea" class="container-cert">
        <?php include "diploma_template.php"?>
    </div>
</div>

<!-- Loading Spinner -->
<div class="spinner-overlay align-center">
    <div class="spinner-ring ">
        <div></div>
    </div>
</div>


<!-- Cert Detail -->

<div class="cert-content m-0">
    <div class="row">
        <!-- LEFT -->
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <!-- for Preview -->
            <div class="cert-img">
                <?php include "diploma_template.php"?>
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
                <div class="body"><?php echo $diploma_approve; ?> </div>
                <hr style="border-color : #5D5D5D">
                <div class="header">
                    Approval date
                </div>
                <div class="body">
                    <?php echo date("F j, Y", strtotime($diploma_date)); ?>
                </div>
            </div>

            <div class="align-center">
                <button class="download align-center" onclick="printDiv('printableArea')">
                    Download <img style="height:25px; margin-left:5px;" src="img/file-download-icon.svg"> </button>
            </div>
        </div>
    </div>


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
    <script type="text/javascript" src="./node_modules/html2canvas/dist/html2canvas.js"></script>

    <script type="text/javascript">
    fitText(document.getElementsByClassName('d-text-1'), 2.25);
    fitText(document.getElementsByClassName('d-text-2'), 3.75);
    fitText(document.getElementsByClassName('d-text-3'), 3.25);
    fitText(document.getElementsByClassName('d-text-4'), 3.75);
    fitText(document.getElementsByClassName('d-text-5'), 3.15);
    fitText(document.getElementsByClassName('d-text-6'), 4.5);
    if (document.getElementsByClassName('cert-text-1').length) {
        fitText(document.getElementsByClassName('cert-text-1'), 1.2)
    }
    </script>

</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="section header-section">
        Certification
    </div>
    <div class="section body-section ">

        <?php
$honor = true;
foreach ($_SESSION['cert'] as $key => $value) {
    $badge = (object) [];
    foreach ($_SESSION['badge'] as $badge_key => $badge_value) {
        if ($badge_value->cert_id == $value->cert_id) {
            $badge->$badge_key = $badge_value;
            if ($badge_value->practice_score + $badge_value->objective_score < 80) {
                $honor = false;
            }
        }
    }
    ?>

        <div class="row pl-4 pr-4 mt-2">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <?php $cert = $value?>
                <?php include "cert_template.php"?>
            </div>
            <div class="content col-lg-9 col-md-8 col-sm-8 col-xs-12">
                <div class="title ">
                    <?php echo $value->cert_name_en; ?>
                    </br>
                    <?php echo $value->cert_name_th; ?>
                </div>
                <div class="detail">
                    <span> Approved by : <?php echo $value->cert_approve; ?></span></br>
                    <span> Approval date : <?php echo date("F j, Y", strtotime($value->cert_date)); ?></span></br>
                </div>
                <div class="detail-button">
                    <form action="cert_detail.php" method="post">
                        <!-- send detail in cert value -->
                        <input type="hidden" name="id" value="<?php echo $value->cert_id ?>">
                        <button class="more" type="submit"> Detail > </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="line mr-4 ml-4"></div>

        <?php }?>
    </div>
</div>
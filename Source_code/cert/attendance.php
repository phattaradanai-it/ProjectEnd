<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="section header-section mb-4">
        Attendance
    </div>

    <?php
foreach ($_SESSION['attendance'] as $value) {

    if (!empty($value->status)) {
        if ($value->status == "DIPLOMA") {
            $value->order = "1";
            $value->status = "หนังสือรับรอง";
            $value->color = "bronze-tag";
        } else if ($value->status == "CERT") {
            $value->order = "2";
            $value->status = "สัมฤทธิบัตร";
            $value->color = "silver-tag";
            $honor = true;
            foreach ($_SESSION['cert'] as $key => $cert_value) {
                if ($cert_value->cert_id == $value->cert_id) {
                    $badge = (object) [];
                    foreach ($_SESSION['badge'] as $badge_key => $badge_value) {
                        if ($badge_value->cert_id == $cert_value->cert_id) {
                            $badge->$badge_key = $badge_value;
                            if ($badge_value->practice_score + $badge_value->objective_score < 80) {
                                $honor = false;
                            }
                        }
                    }

                }
            }
            if ($honor) {
                $value->order = "3";
                $value->status = "สัมฤทธิบัตรเกิยรตินิยม";
                $value->color = "gold-tag";
            }
        }

    } else {
        $value->order = "0";
    }
}
$order = array_column($_SESSION['attendance'], 'order');
array_multisort($order, SORT_DESC, $_SESSION['attendance']);

foreach ($_SESSION['attendance'] as $value) {

    ?>
    <div class="att-header" onclick="location.href='./program_detail.php?program_id=<?php echo $value->program_id ?>'">
        <div class="text"> <?php echo $value->program_name_en ?>
        </div>
        <div class="text"> <?php echo $value->program_name_th ?> </div>

        <?php
echo !empty($value->status) ? ($value->order > 1 ?
        "<form action='cert_detail.php' method='post'>
              <input type='hidden' name='id' value=" . $value->cert_id . ">
              <div class='tag " . $value->color . "'><button class='unset-button' type='submit'> $value->status</button></div>
            </form>"
        : "<div class='tag " . $value->color . "'>$value->status </div> </form>"
    ) : '';

    ?>
    </div>
    <?php }?>

</div>
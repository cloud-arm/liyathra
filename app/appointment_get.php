<?php
session_start();
include("../connect.php");
date_default_timezone_set("Asia/Colombo");

$id = $_SESSION['SESS_MEMBER_ID'];

$result = $db->prepare("SELECT * FROM user WHERE id = '$id' ");
$result->bindParam(':id', $res);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $pos = $row['position'];
}

$date = date('Y-m-d');

if (isset($_GET['type'])) {
    $sql = "SELECT * FROM job WHERE action != 'close' AND  action != 'cancel'  ORDER BY order_no  ";
} else {
    $sql = "SELECT * FROM job WHERE action != 'close' AND  action != 'cancel' AND app_date = '$date' ORDER BY order_no ";
}

$result = $db->prepare($sql);
$result->bindParam(':userid', $date);
$result->execute();

for ($i = 0; $row = $result->fetch(); $i++) {
    $con = $row['action'];
    $num = $i + 1;

    if ($con == 'pending') {

        $time_now = date("H.i");
        $time_end = $row['app_time'];
        //-------------------- Date sum --------------------//
        $date1 = date_create(date('Y-m-d'));
        $date2 = date_create($row['app_date']);
        $date_diff = date_diff($date1, $date2);
        $deff_date = $date_diff->format("%R%a");
        //--------------------Time sum----------------------//
        list($out_h, $out_m) = explode('.', $time_end);
        list($in_h, $in_m) = explode('.', $time_now);

        $deff_h = $out_h - $in_h;
        $deff_m = $out_m - $in_m;
        if ($deff_m < 0) {
            $deff_m = $deff_m + 60;
            $deff_h = $deff_h - 1;
        }

        if ($deff_date > 0) {
            $deff_h = $deff_h + ($deff_date * 24);
        }

        $deff_time = $deff_h . "." . sprintf("%02d", $deff_m);
        //----------------------------------------------------//
    } else if ($con == 'active') {

        $time_now = $row['start_time'];
        $time_end = date("H.i");
        //-------------------- Date sum --------------------//
        $date1 = date_create(date('Y-m-d'));
        $date2 = date_create($row['app_date']);
        $date_diff = date_diff($date1, $date2);
        $deff_date = $date_diff->format("%R%a");
        //--------------------Time sum----------------------//
        list($out_h, $out_m) = explode('.', $time_end);
        list($in_h, $in_m) = explode('.', $time_now);

        $deff_h = $out_h - $in_h;
        $deff_m = $out_m - $in_m;
        if ($deff_m < 0) {
            $deff_m = $deff_m + 60;
            $deff_h = $deff_h - 1;
        }

        if ($deff_date > 0) {
            $deff_h = $deff_h + ($deff_date * 24);
        }

        $deff_time = $deff_h . "." . sprintf("%02d", $deff_m);
        //----------------------------------------------------//
    }
?>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
        <div class="ajk_ady ">
            <div class="info-box" style="border: 2px solid rgb(var(--bg-theme));<?php if ($con == 'active') { ?> background: rgba(var(--bg-theme), 0.25);<?php } ?>">
                <div class="row w-100">
                    <div class="col-3 p-0">
                        <div class="inb_num">
                            <span class="num" <?php if ($con == 'active') { ?> style="color: rgb(var(--bg-black));" <?php } ?>><?php echo $num; ?></span>
                            <span class="time">Time:<?php echo  $row['app_time']; ?> </span>
                            <?php if (isset($_GET['type'])) { ?>
                                <span class="time"><?php echo  $row['app_date']; ?> </span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-9 as_jdk">
                        <div class="i_n_b">
                            <span class="head"><?php echo $row['cus_name']; ?></span>
                        </div>
                        <div class="info-foot">
                            <div class="qty-box">
                                <span class="time"><?php echo  $deff_time; ?> </span>
                            </div>
                            <div class="app">
                                <span class="type"><?php echo  $row['type_name']; ?> </span>
                                <a class="nav-link" style="align-self: end;" <?php if ($con == 'active') { ?> href="order.php?id=<?php echo $row['id'] ?>" <?php } ?> <?php if ($con == 'pending') { ?> href="appointment_action.php?id=<?php echo $row['id'] ?>" <?php } ?>>
                                    <span <?php if ($con == 'active') { ?> style="color: rgb(var(--bg-black));" <?php } ?> class="bin btn">View</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }

if (isset($_GET['type'])) {
    $sql = "SELECT * FROM job WHERE  action = 'cancel' AND cancel_date = '$date' ORDER BY order_no  ";
} else {
    $sql = "SELECT * FROM job WHERE action = 'close' AND app_date = '$date' ORDER BY order_no ";
}
$result = $db->prepare($sql);
$result->bindParam(':userid', $date);
$result->execute();

for ($i = 0; $row = $result->fetch(); $i++) {
    $con = $row['action'];
    $num = $i + 1;

    if ($con == 'close') {

        $time_now = $row['start_time'];
        $time_end = $row['end_time'];
        //-------------------- Date sum --------------------//
        $date1 = date_create(date('Y-m-d'));
        $date2 = date_create($row['app_date']);
        $date_diff = date_diff($date1, $date2);
        $deff_date = $date_diff->format("%R%a");
        //--------------------Time sum----------------------//
        list($out_h, $out_m) = explode('.', $time_end);
        list($in_h, $in_m) = explode('.', $time_now);

        $deff_h = $out_h - $in_h;
        $deff_m = $out_m - $in_m;
        if ($deff_m < 0) {
            $deff_m = $deff_m + 60;
            $deff_h = $deff_h - 1;
        }

        if ($deff_date > 0) {
            $deff_h = $deff_h + ($deff_date * 24);
        }

        $deff_time = $deff_h . "." . sprintf("%02d", $deff_m);
        //----------------------------------------------------//
    }
?>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
        <div class="ajk_ady ">
            <div class="info-box" style="border: 2px solid rgb(var(--bg-theme)); background: rgb(223 223 223);">
                <div class="row w-100">
                    <div class="col-3 p-0">
                        <div class="inb_num">
                            <span class="num" <?php if ($con == 'active') { ?> style="color: rgb(var(--bg-black));" <?php } ?>><?php echo $num; ?></span>
                            <span class="time">Time:<?php echo  $row['app_time']; ?> </span>
                            <?php if (isset($_GET['type'])) { ?>
                                <span class="time"><?php echo  $row['app_date']; ?> </span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-9 as_jdk">
                        <div class="i_n_b">
                            <span class="head"><?php echo $row['cus_name']; ?></span>
                        </div>
                        <div class="info-foot">
                            <div class="qty-box">
                                <span class="time"><?php echo  $deff_time; ?> </span>
                            </div>
                            <div class="app">
                                <span class="type"><?php echo  $row['type_name']; ?> </span>
                                <a class="nav-link <?php if ($pos != 'admin') {
                                                        echo 'disabled';
                                                    } ?>" style="align-self: end;" <?php if ($pos == 'admin') { ?> href="bill.php?id=<?php echo $row['invoice_no'] ?>" <?php } ?>>
                                    <span <?php if ($pos != 'admin') { ?> style="background: rgb(131 131 131);" <?php } ?> class="bin btn">View</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
} ?>
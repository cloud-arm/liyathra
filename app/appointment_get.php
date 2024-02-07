<?php
include("../connect.php");
date_default_timezone_set("Asia/Colombo");

$date = date('Y-m-d');

if (isset($_GET['type'])) {
    $sql = "SELECT * FROM job WHERE action != 'close'  ";
} else {
    $sql = "SELECT * FROM job WHERE action != 'close' AND app_date = '$date' ";
}

$result = $db->prepare($sql);
$result->bindParam(':userid', $date);
$result->execute();

for ($i = 0; $row = $result->fetch(); $i++) {
    $con = $row['action'];
    $num = $i + 1;
?>
    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
        <div class="ajk_ady ">
            <div class="info-box" style="border: 2px solid rgb(var(--bg-theme));<?php if ($con == 'active') { ?> background: rgba(var(--bg-theme), 0.25);<?php } ?>">
                <div class="row w-100">
                    <div class="col-3 p-0">
                        <div class="inb_num">
                            <span class="num" <?php if ($con == 'active') { ?> style="color: rgb(var(--bg-black));" <?php } ?>><?php echo $num; ?></span>
                            <span class="time">Time:<?php echo  $row['app_time']; ?> </span>
                        </div>
                    </div>
                    <div class="col-9 as_jdk">
                        <div class="i_n_b">
                            <span class="head"><?php echo $row['cus_name']; ?></span>
                        </div>
                        <div class="info-foot">
                            <div class="qty-box">
                                <span class="time"><?php echo  $row['app_time']; ?> </span>
                            </div>
                            <a class="nav-link" <?php if ($con == 'active') { ?> href="order.php?id=<?php echo $row['id'] ?>" <?php } ?> <?php if ($con == 'pending') { ?> href="appointment_action.php?id=<?php echo $row['id'] ?>" <?php } ?>>
                                <span <?php if ($con == 'active') { ?> style="color: rgb(var(--bg-black));" <?php } ?> class="bin btn">View</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
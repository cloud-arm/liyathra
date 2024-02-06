<?php
include("../connect.php");
date_default_timezone_set("Asia/Colombo");


$sql = "SELECT * FROM job WHERE action != 'close' ";

$result = $db->prepare($sql);
$result->bindParam(':userid', $date);
$result->execute();

for ($i = 0; $row = $result->fetch(); $i++) {
    $con = $row['action'];

?>
    <div class="col-4 col-sm-4 col-md-3 col-lg-2">
        <a href="order.php?id=<?php echo $row['id'] ?>" class="nav-link">
            <div class="room" <?php if ($con == 'active') { ?> style="background-color: rgb(var(--bg-theme));" <?php } ?>>
                <span style="font-size: 12px;"><?php echo $row['app_date'] . ' <br> Time: ' . $row['app_time']; ?> </span>

                <span class="num" <?php if ($con == 'active') { ?> style="color: rgb(var(--bg-black));" <?php } ?>><?php echo $row['id'] ?></span>

                <span style="font-size: 10px;" class="tot"><?php echo $row['cus_name']; ?></span>
                <span class="tot"><?php echo $row['type_name']; ?></span>
            </div>
        </a>
    </div>

<?php } ?>
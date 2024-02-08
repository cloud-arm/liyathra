<?php
session_start();
date_default_timezone_set("Asia/Tehran");
include("../connect.php");

$ui = $_SESSION['SESS_MEMBER_ID'];
$un = $_SESSION['SESS_FIRST_NAME'];
$date = date("Y-m-d");
$time = date('H:i:s');

$util = $_POST['util'];
$meter = $_POST['meter'];

$re = $db->prepare("SELECT * FROM utility_bill WHERE id = :id ");
$re->bindParam(':id', $util);
$re->execute();
for ($k = 0; $r = $re->fetch(); $k++) {
    $util_name = $r['name'];
    $unit_price = $r['unit_price'];
    $last_meter = $r['meter'];
    $last_date = $r['last_date'];
}


if ($date > $last_date) {

    $qty = $meter - $last_meter;

    $amount = $qty * $unit_price;

    $sql = "INSERT INTO util_meter_record (util_id,name,qty,amount,date,time,start,end,unit_price,user_id,user_name) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $ql = $db->prepare($sql);
    $ql->execute(array($util, $util_name, $qty, $amount, $date, $time, $last_meter, $meter, $unit_price, $ui, $un));
} else {

    if ($last_meter > $meter) {
        $qty = $last_meter - ($last_meter - $meter);
    } else {
        $qty = $last_meter + ($meter - $last_meter);
    }

    $amount = $qty * $unit_price;

    $re = $db->prepare("SELECT * FROM util_meter_record WHERE util_id = :id AND date = '$date' ");
    $re->bindParam(':id', $util);
    $re->execute();
    for ($k = 0; $r = $re->fetch(); $k++) {
        $id = $r['id'];
    }

    $sql = 'UPDATE  util_meter_record SET qty=?, amount=?, start=?, end=?, time=?, user_id=?, user_name=?  WHERE  id=? ';
    $ql = $db->prepare($sql);
    $ql->execute(array($qty, $amount, $last_meter, $meter, $time, $ui, $un, $id));
}

$sql = 'UPDATE  utility_bill SET meter=?, last_date=?  WHERE  id=? ';
$ql = $db->prepare($sql);
$ql->execute(array($meter, $date, $util));

header("location: cost_analyser.php");

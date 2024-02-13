<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include("../connect.php");

$user_id = $_SESSION['SESS_MEMBER_ID'];

$invo = $_GET['invo'];
$cus = $_GET['cus'];

$date = date("Y-m-d");
$time = date('H:i:s');


$cus_name = '';
$result = $db->prepare("SELECT * FROM customer WHERE id = '$cus' ");
$result->bindParam(':id', $res);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $cus_name = $row['name'];
}

$emp_name = '';
$result = $db->prepare("SELECT * FROM user WHERE id = '$user_id' ");
$result->bindParam(':id', $res);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $emp = $row['emp_id'];
    $user_name = $row['name'];
}


$sql = "INSERT INTO inquiries (date,time,cus_id,cus_name,emp_id,emp_name,invoice_no) VALUES (?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($date, $time, $cus, $cus_name, $emp, $user_name, $invo));


header("location: inquiries_service.php?invo=$invo");

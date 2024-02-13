<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include("../connect.php");

$user_id = $_SESSION['SESS_MEMBER_ID'];
$app_date = $_POST['date'];
$app_time = $_POST['time'];

$note = $_POST['note'];

$invo = $_POST['invo'];
$cus = $_POST['cus'];

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

$order_no = str_replace('-', '', $app_date) . str_replace(':', '', $app_time);

$sql = "INSERT INTO job (note,date,time,cus_id,cus_name,emp_id,emp_name,app_date,app_time,action,invoice_no,order_no,booking_user) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($note, $date, $time, $cus, $cus_name, $emp, $user_name, $app_date, $app_time, 'pending', $invo, $order_no, $user_id));


header("location: appointment_service.php?invo=$invo");

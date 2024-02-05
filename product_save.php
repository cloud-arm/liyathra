<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$ui = $_SESSION['SESS_MEMBER_ID'];
$un = $_SESSION['SESS_FIRST_NAME'];

$date = date('Y-m-d H:i:s');

$name = $_POST['name'];
$type = $_POST['type'];
$amount = $_POST['price'];


$serve_type = 0;
if ($type == 'Service') {
    $serve_type = $_POST['serve_type'];
}

$type_name = '';
$result = $db->prepare("SELECT * FROM job_type  WHERE id = :id ");
$result->bindParam(':id', $serve_type);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $type_name = $r['name'];
}



$sql = "INSERT INTO product (name,job_type,type_name,sell,type,time) VALUES (?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($date, $serve_type, $type_name, $amount, $type, $date));



header("location: product.php");

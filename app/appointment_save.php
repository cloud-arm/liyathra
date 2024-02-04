<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include("../connect.php");


$app_date = $_POST['date'];
$app_time = $_POST['time'];
$type = $_POST['type'];
$service = $_POST['service'];
$note = $_POST['note'];
$price = $_POST['price'];

$invo = $_POST['invo'];
$cus = $_POST['cus'];
$emp = $_POST['emp'];

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
$result = $db->prepare("SELECT * FROM Employees WHERE id = '$emp' ");
$result->bindParam(':id', $res);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $emp_name = $row['name'];
}

$type_name = '';
$result = $db->prepare("SELECT * FROM job_type WHERE id = '$type' ");
$result->bindParam(':id', $res);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $type_name = $row['name'];
}

$name = '';
$result = $db->prepare("SELECT * FROM product WHERE product_id = '$service' ");
$result->bindParam(':id', $res);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $name = $row['name'];
}


$sql = "INSERT INTO job (note,date,time,cus_id,cus_name,emp_id,emp_name,app_date,app_time,job_type,type_name,action,job_no,price,invoice_no) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($note, $date, $time, $cus, $cus_name, $emp, $emp_name, $app_date, $app_time, $type, $type_name, 'pending', $service,$price,$invo));


header("location: index.php");

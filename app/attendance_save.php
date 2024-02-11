<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include("../connect.php");

$date = date("Y-m-d");
$time = date('H.i.s');

$id = $_POST['id'];

$result = $db->prepare("SELECT * FROM user WHERE id = '$id' ");
$result->bindParam(':id', $res);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $id = $row['emp_id'];
    $pos = $row['position'];
}

$result = $db->prepare("SELECT * FROM Employees WHERE id=:id ");
$result->bindParam(':id', $id);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $name = $row['name'];
}

$sql = "INSERT INTO attendance (emp_id,name,date,time,IN_time,action) VALUES (?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($id, $name, $date, $time, $time, 1));


header("location: index.php");

<?php 
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");


$sql = 'UPDATE  attendance SET action =? WHERE emp_id=? AND date=? ';
$ql = $db->prepare($sql);
$ql->execute(array('1',$_POST['emp'], $_POST['date']));

header("location: hr_attendance.php");
?>
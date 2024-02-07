<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");



$date=$_POST['date'];
$time=date('H:i:s');



$result = $db->prepare("DELETE FROM attendance WHERE  date= :memid");
$result->bindParam(':memid', $date);
$result->execute();

$result = $db->prepare("SELECT * FROM Employees WHERE action='0' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 
    $emp=0;
    $name=$row['name'];
    $id=$row['id'];
    $emp=$_REQUEST['emp_'.$id];

    if($emp==1){
    $sql = "INSERT INTO attendance (emp_id,name,date,time) VALUES (?,?,?,?)";
    $q = $db->prepare($sql);
    $q->execute(array($id,$name,$date,$time));
    }
}

$Y = date("Y");
$m = date("m");
$d = date("d");

if(isset($_POST['end'])){
    header("location: app/hr_attendance.php");
}else{
    header("location: hr_attendance.php?emp=all&dates=$Y%2F$m%2F$d+-+$Y%2F$m%2F$d");
}





?>
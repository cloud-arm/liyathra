<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");



$id=$_POST['id'];
$note=$_POST['note'];
$amount=$_POST['amount'];
$month=$_POST['month'];


$now=date('Y-m-d');

$result = $db->prepare("SELECT * FROM Employees WHERE id='$id'");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $name=$row['name'];}


$next=date('Y-m');
$term_amount=$amount/$month;

//echo $customer_name;

$sql = "INSERT INTO hr_loan (emp_id,name,amount,term,date,note,amount_left,term_left,next_date,term_amount) VALUES (?,?,?,?,?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($id,$name,$amount,$month,$now,$note,$amount,$month,$next,$term_amount));


header("location: hr_loan.php");

?>
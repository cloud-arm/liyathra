<?php
session_start();
include("../connect.php");

$user = $_SESSION['SESS_MEMBER_ID'];
$user_name = $_SESSION['SESS_FIRST_NAME'];
$date = date("Y-m-d");
$time = date('H:i:s');

$id = $_POST['id'];
$job = $_POST['job'];
$emp = $_POST['emp'];
$sup_emp = $_POST['sup_emp'];

$emp_name = '';
$sup_emp_name = '';

$result = $db->prepare("SELECT * FROM sales_list WHERE id = '$id' ");
$result->bindParam(':id', $res);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $invo = $row['invoice_no'];
    $service = $row['product_id'];
    $service_name = $row['name'];
}

$result = $db->prepare("SELECT * FROM Employees WHERE id = '$emp' ");
$result->bindParam(':id', $res);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $emp_name = $row['name'];
}

$result = $db->prepare("SELECT * FROM Employees WHERE id = '$sup_emp' ");
$result->bindParam(':id', $res);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $sup_emp_name = $row['name'];
}


$sql = "UPDATE sales_list SET emp = ?, sup_emp = ?, emp_name = ?, sup_emp_name = ?  WHERE id = ? ";
$ql = $db->prepare($sql);
$ql->execute(array($emp, $sup_emp, $emp_name, $sup_emp_name, $id));


$sql = 'INSERT INTO assign_record (user,user_name,invoice_no,sales_id,main_id,sup_id,service,service_name,date,time) VALUES (?,?,?,?,?,?,?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($user, $user_name, $invo, $id, $emp, $sup_emp, $service, $service_name, $date, $time));


if (isset($_POST['pid'])) {

    $invo = $_POST['invo'];
    $pid = $_POST['pid'];

    header("location: product_add.php?id=$pid&invo=$invo");
} else {

    header("location: appointment_action.php?id=$job");
}

<?php
//session_start();
include("../connect.php");


$id = $_POST['id'];
$emp = $_POST['emp'];
$sup_emp = $_POST['sup_emp'];
$job = $_POST['job'];

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


if (isset($_POST['pid'])) {

    $invo = $_POST['invo'];
    $pid = $_POST['pid'];
    
    header("location: product_add.php?id=$pid&invo=$invo");
} else {

    header("location: appointment_action.php?id=$job");
}

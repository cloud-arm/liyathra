<?php
session_start();
include('connect.php');

$name = $_POST['name'];
$contact = $_POST['contact'];
$nic = $_POST['nic'];
$address = $_POST['address'];
$des = $_POST['des'];
$epf_no = $_POST['epf_no'];
$epf_amount = $_POST['epf_amount'];
$rate = $_POST['rate'];
$id = $_POST['id'];
$ot = $_POST['ot'];

$result = $db->prepare("SELECT * FROM Employees_des WHERE id =:id");
$result->bindParam(':id', $des);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $des_name = $row['name'];
}


$sql = "UPDATE Employees 
        SET name=?,address=?,nic=?,phone_no=?,hour_rate=?,des=?,epf_amount=?,epf_no=?,ot=?,des_id=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($name, $address, $nic, $contact, $rate, $des_name, $epf_amount, $epf_no, $ot, $des, $id));


header("location: hr_employee_profile.php?id=$id");

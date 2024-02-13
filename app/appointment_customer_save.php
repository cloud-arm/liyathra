<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include("../connect.php");

$date = date("Y-m-d");
$time = date('H:i:s');

$type = $_POST['type'];

$invo = date("ymdhis");


if ($type == 'cus_check') {
    $mobile = $_POST['mobile'];

    $cus_id = 0;
    $result = $db->prepare("SELECT * FROM customer WHERE contact = '$mobile' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $cus_id = $row['id'];
    }

    if ($cus_id > 0) {

        header("location: appointment_add.php?cus=$cus_id&invo=$invo");
    } else {
        $sql = "INSERT INTO customer (contact) VALUES (?)";
        $ql = $db->prepare($sql);
        $ql->execute(array($mobile));

        $result = $db->prepare("SELECT * FROM customer WHERE contact = '$mobile' ");
        $result->bindParam(':id', $res);
        $result->execute();
        for ($i = 0; $row = $result->fetch(); $i++) {
            $cus_id = $row['id'];
        }

        header("location: appointment_customer_add.php?cus=$cus_id");
    }
} else

if ($type == 'cus_add') {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $sql = 'UPDATE customer SET name = ?, email = ?, contact = ? WHERE id = ? ';
    $ql = $db->prepare($sql);
    $ql->execute(array($name, $email, $mobile, $id));

    header("location: appointment_add.php?cus=$id&invo=$invo");
}

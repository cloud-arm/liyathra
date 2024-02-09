<?php
//session_start();
include("../connect.php");
date_default_timezone_set("Asia/Colombo");


$id = $_REQUEST['id'];
$type = $_REQUEST['type'];

if ($type == 'edit') {

    $date = $_REQUEST['date'];
    $time = $_REQUEST['time'];

    $order_no = str_replace('-', '', $date) . str_replace(':', '', $time);

    $sql = "UPDATE job SET app_date =?, app_time =?, order_no = ?  WHERE id = ? ";
    $ql = $db->prepare($sql);
    $ql->execute(array($date, $time, $order_no, $id));

    header("location: appointment_action.php?id=$id");
}


if ($type == 'active') {

    $time = date("H.i");

    $sql = "UPDATE job SET action = ?, start_time = ?  WHERE id = ? ";
    $ql = $db->prepare($sql);
    $ql->execute(array('active',$time, $id));

    header("location: order.php?id=$id");
}

if ($type == 'cancel') {

    $result = $db->prepare("DELETE FROM job WHERE  id= :id");
    $result->bindParam(':id', $id);
    $result->execute();

    header("location: index.php");
}

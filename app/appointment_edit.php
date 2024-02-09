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
    $ql->execute(array('active', $time, $id));

    header("location: order.php?id=$id");
}

if ($type == 'cancel') {

    $date = date("Y-m-d");
    $time = date('H.i');

    $sql = "UPDATE job SET action = ?, cancel_date = ?, cancel_time = ?  WHERE id = ? ";
    $ql = $db->prepare($sql);
    $ql->execute(array('cancel', $date, $time, $id));

    header("location: index.php");
}

<?php
session_start();
include("../connect.php");
date_default_timezone_set("Asia/Colombo");


$id = $_REQUEST['id'];
$type = $_REQUEST['type'];
$user_id = $_SESSION['SESS_MEMBER_ID'];

if ($type == 'edit') {

    $date = $_REQUEST['date'];
    $time = $_REQUEST['time'];

    $order_no = str_replace('-', '', $date) . str_replace(':', '', $time);

    $sql = "UPDATE job SET app_date =?, app_time =?, order_no = ?, edit_user = ?  WHERE id = ? ";
    $ql = $db->prepare($sql);
    $ql->execute(array($date, $time, $order_no, $user_id, $id));

    header("location: appointment_action.php?id=$id");
}


if ($type == 'active') {

    $time = date("H.i");
    $date = date("Y-m-d");

    $sql = "UPDATE job SET action = ?, start_time = ?, active_user = ?, active_date = ?  WHERE id = ? ";
    $ql = $db->prepare($sql);
    $ql->execute(array('active', $time, $user_id, $date, $id));

    header("location: order.php?id=$id");
}

if ($type == 'cancel') {

    $date = date("Y-m-d");
    $time = date('H.i');

    $sql = "UPDATE job SET action = ?, cancel_date = ?, cancel_time = ?, cancel_user = ?  WHERE id = ? ";
    $ql = $db->prepare($sql);
    $ql->execute(array('cancel', $date, $time, $user_id, $id));

    header("location: index.php");
}

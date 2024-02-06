<?php
//session_start();
include("../connect.php");


$id = $_REQUEST['id'];
$type = $_REQUEST['type'];

if ($type == 'edit') {

    $date = $_REQUEST['date'];
    $time = $_REQUEST['time'];

    $sql = "UPDATE job SET app_date =?, app_time = ?  WHERE id = ? ";
    $ql = $db->prepare($sql);
    $ql->execute(array($date, $time, $id));

    header("location: appointment_action.php?id=$id");
}


if ($type == 'active') {

    $sql = "UPDATE job SET action = ?  WHERE id = ? ";
    $ql = $db->prepare($sql);
    $ql->execute(array('active', $id));

    header("location: index.php");
}

if ($type == 'cancel') {

    $result = $db->prepare("DELETE FROM job WHERE  id= :id");
    $result->bindParam(':id', $id);
    $result->execute();

    header("location: index.php");
}

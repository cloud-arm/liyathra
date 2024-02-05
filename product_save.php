<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$ui = $_SESSION['SESS_MEMBER_ID'];
$un = $_SESSION['SESS_FIRST_NAME'];

$date = date('Y-m-d H:i:s');

$id = $_POST['id'];
$name = $_POST['name'];
$type = $_POST['type'];
$amount = $_POST['price'];


$serve_type = 0;
if ($type == 'Service') {
    $serve_type = $_POST['serve_type'];
}

$type_name = '';
$result = $db->prepare("SELECT * FROM job_type  WHERE id = :id ");
$result->bindParam(':id', $serve_type);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $type_name = $row['name'];
}

if ($id == 0) {

    $sql = "INSERT INTO product (name,job_type,type_name,sell,type,time) VALUES (?,?,?,?,?,?)";
    $q = $db->prepare($sql);
    $q->execute(array($name, $serve_type, $type_name, $amount, $type, $date));


    $result = $db->prepare('SELECT * FROM product ORDER BY product_id DESC LIMIT 1');
    $result->bindParam(':id', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ $id=$row['product_id']; }
    
    if ($type == 'Service') {
        $sql = 'UPDATE  use_product SET main_product =? WHERE type=? AND main_product=? ';
        $ql = $db->prepare($sql);
        $ql->execute(array($id,'1', '0'));
    }



} else {

    $sql = "UPDATE  product SET name = ?, job_type = ?, type_name = ?, sell = ?, type = ? WHERE product_id = ?";
    $ql = $db->prepare($sql);
    $ql->execute(array($name, $serve_type, $type_name, $amount, $type, $id));
}


header("location: product.php?id=0");

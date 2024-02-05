<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$id = $_GET['id'];

$sql = "DELETE FROM product WHERE product_id = ?";
$ql = $db->prepare($sql);
$ql->execute(array($id));

header("location: product.php?id=0");
?>
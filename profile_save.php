<?php
session_start();
include('connect.php');

$type = $_POST['type'];

$name = $_POST['name'];
$phone = $_POST['contact'];
$id = $_POST['id'];
$email = $_POST['email'];
$address = $_POST['address'];


$sql = "UPDATE customer 
        SET name=?,address=?,email=?,contact=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($name, $address, $email, $phone, $id));


header("location: profile.php?id=$id");

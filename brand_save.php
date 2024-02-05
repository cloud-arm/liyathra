<?php
session_start();
include('connect.php');

$id = $_POST['id'];
$name = $_POST['name'];

$img = '';
if (isset($_POST['img'])) {
    $img = $_POST['img'];
}

$name = strtoupper($name);

if ($id == '0') {
    $sql = "INSERT INTO brand (name,img) VALUES (?,?)";
    $ql = $db->prepare($sql);
    $ql->execute(array($name, $img));
} else {
    $sql = "UPDATE  brand SET name =?,img =? WHERE id =?";
    $ql = $db->prepare($sql);
    $ql->execute(array($name, $img, $id));
}
if (isset($_POST['end'])) {header("location: product.php?id=0");}
else{header("location: brand.php?id=0");}

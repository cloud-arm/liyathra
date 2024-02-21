<?php
// session_start();
include('../connect.php');
date_default_timezone_set("Asia/Colombo");


$id = $_GET['id'];
$price = $_GET['price'];
$pid = $_GET['pid'];
$invo = $_GET['invo'];

if ($id == 0) {

    $date = date("Y-m-d");
    $discount = 0;

    $result = $db->prepare("SELECT * FROM product WHERE product_id= :id");
    $result->bindParam(':id', $pid);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $pro_id = $row['product_id'];
        $code = $row['code'];
        $name = $row['name'];
        $type = $row['job_type'];
    }

    $qty = 1;
    $profit = 0;
    $emp = 0;
    $sup_emp = 0;

    // query
    $sql = "INSERT INTO sales_list (invoice_no,product_id,qty,amount,name,price,profit,code,dic,date,emp,sup_emp,type,view) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $q = $db->prepare($sql);
    $q->execute(array($invo, $pro_id, $qty, $price, $name, $price, $profit, $code, $discount, $date, $emp, $sup_emp, 'Service', 1));
} else {

    $sql = 'UPDATE sales_list SET amount =?, price =? WHERE id = ? ';
    $ql = $db->prepare($sql);
    $ql->execute(array($price, $price, $id));
}

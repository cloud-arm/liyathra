<?php
session_start();
include('connect.php');

$ui = $_SESSION['SESS_MEMBER_ID'];
$un = $_SESSION['SESS_FIRST_NAME'];

$type = $_POST['type'];
$from = $_POST['acc_from'];
$to = $_POST['acc_to'];
$type = $_POST['type'];
$amount = $_POST['amount'];

$date = date("Y-m-d");
$time = date('H:i:s');

if ($from == 1) {
    $cr_name = 'Petty Cash';
    $cr_type = 'Cash';
}
if ($from == 2) {
    $cr_name = 'Main Cash';
    $cr_type = 'Cash';
}
if ($from == 3) {
    $cr_name = 'Cash Box';
    $cr_type = 'Cash';
}

if ($to == 1) {
    $de_name = 'Petty Cash';
    $de_type = 'Cash Transfer';
}
if ($to == 2) {
    $de_name = 'Main Cash';
    $de_type = 'Cash Transfer';
}
if ($to == 3) {
    $de_name = 'Cash Box';
    $de_type = 'Cash Transfer';
}


$cr_blc = 0;
$blc = 0;
$re = $db->prepare("SELECT * FROM cash WHERE id = $from ");
$re->bindParam(':userid', $res);
$re->execute();
for ($k = 0; $r = $re->fetch(); $k++) {
    $blc = $r['amount'];
}

$cr_blc = $blc - $amount;

$de_blc = 0;
$p_blc = 0;
$re = $db->prepare("SELECT * FROM cash WHERE id = $to ");
$re->bindParam(':userid', $res);
$re->execute();
for ($k = 0; $r = $re->fetch(); $k++) {
    $p_blc = $r['amount'];
}

$de_blc = $p_blc + $amount;

$sql = "UPDATE  cash SET amount=? WHERE id=?";
$ql = $db->prepare($sql);
$ql->execute(array($de_blc, $to));

$sql = "INSERT INTO transaction_record (transaction_type,type,record_no,amount,action,credit_acc_no,credit_acc_type,credit_acc_name,credit_acc_balance,debit_acc_type,debit_acc_name,debit_acc_id,debit_acc_balance,date,time,user_id,user_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array('acc_transfer', 'Debit', $from, $amount, 0, $from, $cr_type, $cr_name, $cr_blc, $de_type, $de_name, $to, $de_blc, $date, $time, $ui, $un));

$sql = "UPDATE  cash SET amount=? WHERE id=?";
$ql = $db->prepare($sql);
$ql->execute(array($cr_blc, $from));

$sql = "INSERT INTO transaction_record (transaction_type,type,record_no,amount,action,credit_acc_no,credit_acc_type,credit_acc_name,credit_acc_balance,debit_acc_type,debit_acc_name,debit_acc_id,debit_acc_balance,date,time,user_id,user_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array('acc_transfer', 'Credit', $to, $amount, 0, $to, $de_type, $de_name, $de_blc, $cr_type, $cr_name, $from, $cr_blc, $date, $time, $ui, $un));


header("location: acc_transfer.php");

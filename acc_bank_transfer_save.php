<?php
session_start();
include('connect.php');

$ui = $_SESSION['SESS_MEMBER_ID'];
$un = $_SESSION['SESS_FIRST_NAME'];

$type = $_POST['type'];

$date = date("Y-m-d");
$time = date('H:i:s');

if ($type == 'cash') {

    $amount = $_POST['amount'];
    $bank = $_POST['bank'];

    $cr_blc = 0;
    $blc = 0;
    $re = $db->prepare("SELECT * FROM cash WHERE id = 2 ");
    $re->bindParam(':userid', $res);
    $re->execute();
    for ($k = 0; $r = $re->fetch(); $k++) {
        $blc = $r['amount'];
    }

    $cr_blc = $blc - $amount;

    $mn_blc = 0;
    $b_blc = 0;
    $re = $db->prepare("SELECT * FROM bank WHERE id =:id ");
    $re->bindParam(':id', $bank);
    $re->execute();
    for ($k = 0; $r = $re->fetch(); $k++) {
        $b_blc = $r['amount'];
    }

    $mn_blc = $b_blc + $amount;

    $sql = "UPDATE  cash SET amount=? WHERE id=?";
    $ql = $db->prepare($sql);
    $ql->execute(array($cr_blc, 2));

    $sql = "INSERT INTO transaction_record (transaction_type,type,record_no,amount,action,credit_acc_no,credit_acc_type,credit_acc_name,credit_acc_balance,debit_acc_type,debit_acc_name,debit_acc_id,debit_acc_balance,date,time,user_id,user_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $ql = $db->prepare($sql);
    $ql->execute(array('Bank Transfer', 'Debit', $bank, $amount, 0, 2, 'Cash', 'Main Cash', $cr_blc, 'Cash Transfer', 'Bank', $bank, $mn_blc, $date, $time, $ui, $un));

    $sql = "UPDATE  bank SET amount=? WHERE id=?";
    $ql = $db->prepare($sql);
    $ql->execute(array($mn_blc, $bank));

    $sql = "INSERT INTO bank_record (transaction_type,type,record_no,amount,action,credit_acc_no,credit_acc_type,credit_acc_name,credit_acc_balance,debit_acc_type,debit_acc_name,debit_acc_id,debit_acc_balance,date,time,user_id,user_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $ql = $db->prepare($sql);
    $ql->execute(array('Cash Deposit', 'Credit', 2, $amount, 0, $bank, 'Cash Transfer', 'Bank', $mn_blc, 'Cash', 'Main Cash', 2, $cr_blc, $date, $time, $ui, $un));

    header("location: acc_bank_transfer.php");
} else

if ($type == 'chq') {

    $id = $_POST['id'];
    $bank = $_POST['bank'];
    $b_blc = 0;

    $re = $db->prepare("SELECT * FROM bank WHERE id =:id ");
    $re->bindParam(':id', $bank);
    $re->execute();
    for ($k = 0; $r = $re->fetch(); $k++) {
        $b_blc = $r['amount'];
    }

    $re = $db->prepare("SELECT * FROM payment WHERE id = :id ");
    $re->bindParam(':id', $id);
    $re->execute();
    for ($k = 0; $r = $re->fetch(); $k++) {
        $amount = $r['amount'];
        $chq_no = $r['chq_no'];
        $chq_date = $r['chq_date'];
        $chq_bank = $r['chq_bank'];
    }

    $sql = "INSERT INTO bank_record (transaction_type,type,record_no,amount,action,credit_acc_no,credit_acc_type,credit_acc_name,credit_acc_balance,debit_acc_type,debit_acc_name,debit_acc_id,debit_acc_balance,date,time,user_id,user_name,chq_no,chq_bank,chq_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $ql = $db->prepare($sql);
    $ql->execute(array('Chq Deposit', 'Credit', $id, $amount, 1, $id, 'Cash Transfer', 'Chq', 0, 'Bank Deposit', 'Bank Account', $bank, $b_blc, $date, $time, $ui, $un, $chq_no, $chq_bank, $chq_date));

    $sql = "UPDATE  payment SET action=? WHERE id=?";
    $ql = $db->prepare($sql);
    $ql->execute(array(1, $id));

    echo $id;
}

if ($type == 'realize') {

    $id = $_POST['id'];

    $re = $db->prepare("SELECT * FROM payment WHERE id = :id ");
    $re->bindParam(':id', $id);
    $re->execute();
    for ($k = 0; $r = $re->fetch(); $k++) {
        $chq_no = $r['chq_no'];
        $amount = $r['amount'];
    }

    $re = $db->prepare("SELECT * FROM bank_record WHERE chq_no = :id ");
    $re->bindParam(':id', $chq_no);
    $re->execute();
    for ($k = 0; $r = $re->fetch(); $k++) {
        $bank = $r['debit_acc_id'];
    }

    $sql = "UPDATE  payment SET action=? WHERE id=?";
    $ql = $db->prepare($sql);
    $ql->execute(array(2, $id));

    $mn_blc = 0;
    $b_blc = 0;
    $re = $db->prepare("SELECT * FROM bank WHERE id =:id ");
    $re->bindParam(':id', $bank);
    $re->execute();
    for ($k = 0; $r = $re->fetch(); $k++) {
        $b_blc = $r['amount'];
    }

    $mn_blc = $b_blc + $amount;

    $sql = "UPDATE  bank SET amount=? WHERE id=?";
    $ql = $db->prepare($sql);
    $ql->execute(array($mn_blc, $bank));

    $sql = "UPDATE  bank_record SET action=? WHERE chq_no=?";
    $ql = $db->prepare($sql);
    $ql->execute(array(2, $chq_no));


    echo $id;
}

if ($type == 'return') {

    $id = $_POST['id'];

    $re = $db->prepare("SELECT * FROM payment WHERE id = :id ");
    $re->bindParam(':id', $id);
    $re->execute();
    for ($k = 0; $r = $re->fetch(); $k++) {
        $chq_no = $r['chq_no'];
    }

    $sql = "UPDATE  payment SET action=? WHERE id=?";
    $ql = $db->prepare($sql);
    $ql->execute(array(3, $id));

    $sql = "UPDATE  bank_record SET action=? WHERE chq_no=?";
    $ql = $db->prepare($sql);
    $ql->execute(array(3, $chq_no));

    echo $id;
}

if ($type == 'withdraw') {

    $bank = $_POST['bank'];
    $amount = $_POST['amount'];

    $cr_blc = 0;
    $b_blc = 0;
    $re = $db->prepare("SELECT * FROM bank WHERE id =:id ");
    $re->bindParam(':id', $bank);
    $re->execute();
    for ($k = 0; $r = $re->fetch(); $k++) {
        $b_blc = $r['amount'];
    }

    $cr_blc = $b_blc - $amount;

    $mn_blc = 0;
    $blc = 0;
    $re = $db->prepare("SELECT * FROM cash WHERE id = 2 ");
    $re->bindParam(':userid', $res);
    $re->execute();
    for ($k = 0; $r = $re->fetch(); $k++) {
        $blc = $r['amount'];
    }

    $mn_blc = $blc + $amount;

    $sql = "UPDATE  cash SET amount=? WHERE id=?";
    $ql = $db->prepare($sql);
    $ql->execute(array($mn_blc, 2));

    $sql = "INSERT INTO transaction_record (transaction_type,type,record_no,amount,action,credit_acc_no,credit_acc_type,credit_acc_name,credit_acc_balance,debit_acc_type,debit_acc_name,debit_acc_id,debit_acc_balance,date,time,user_id,user_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $ql = $db->prepare($sql);
    $ql->execute(array('Bank Transfer', 'Credit', $bank, $amount, 0, 2, 'Cash', 'Main Cash', $mn_blc, 'Cash Withdraw', 'Bank', $bank, $cr_blc, $date, $time, $ui, $un));

    $sql = "UPDATE  bank SET amount=? WHERE id=?";
    $ql = $db->prepare($sql);
    $ql->execute(array($cr_blc, $bank));

    $sql = "INSERT INTO bank_record (transaction_type,type,record_no,amount,action,credit_acc_no,credit_acc_type,credit_acc_name,credit_acc_balance,debit_acc_type,debit_acc_name,debit_acc_id,debit_acc_balance,date,time,user_id,user_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $ql = $db->prepare($sql);
    $ql->execute(array('Cash Withdraw', 'Debit', 2, $amount, 0, 2, 'Cash', 'Main Cash', $mn_blc, 'Bank Withdraw', 'Bank', $bank, $cr_blc, $date, $time, $ui, $un));


    header("location: acc_bank_transfer.php");
}

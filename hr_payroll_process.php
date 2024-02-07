<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");



$id=$_GET['id'];
$year=$_GET['year'];
$month=$_GET['month'];
$amount=$_GET['amount'];

$pay_month=$year.'-'.$month;

$date=date('Y-m-d');

$result = $db->prepare("SELECT * FROM payroll WHERE  emp_id='$id' AND pay_month='$pay_month' ");
$result->bindParam(':id', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $pay_id=$row['id']; }


if(isset($pay_id)){
    header("location: hr_payroll_print.php?id=$pay_id");
}else{

    $result = $db->prepare('SELECT * FROM Employees WHERE  id=:id ');
    $result->bindParam(':id', $id);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ $emp_name=$row['name']; }







    $id=$_GET["id"];
    $d1=$_GET['year'].'-'.$_GET['month'].'-01';
    $d2=$_GET['year'].'-'.$_GET['month'].'-31';  $h=0;$m=0;
    $result = $db->prepare("SELECT work_time,ot FROM attendance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ 
        $hour[]=$row['work_time'];
        $ot[]=$row['ot'];
    }

    $day=0;
    $result = $db->prepare("SELECT count(id) FROM attendance WHERE action='0' AND emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ 
        $day=$row['count(id)'];
    }

    $result = $db->prepare("SELECT count(id) FROM attendance WHERE action='1' AND emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ 
        $holf_day=$row['count(id)'];
    }

    $day=$day+$holf_day*0.5;

    $result = $db->prepare("SELECT * FROM Employees WHERE id='$id' ");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ 
        $name=$row['name'];
        $basic=$row['hour_rate'];
        $epf=$row['epf_amount'];
        $ex_date_rate=$row['ot'];
        $set_allowance=$row['allowance'];
    }

    $loan=0;
    $result = $db->prepare("SELECT * FROM hr_loan WHERE emp_id='$id' AND action='0' ");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ 
        $loan=$row['term_amount'];
        $loan_id=$row['id'];

        if($amount > $loan){
        $sql = 'UPDATE  hr_loan SET amount_left = amount_left - ?,term_left=term_left-1  WHERE  id=? ';
        $ql = $db->prepare($sql);
        $ql->execute(array($loan,$loan_id));
        }
    }

    $adv=0;
    $result = $db->prepare("SELECT sum(amount) FROM salary_advance WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
    $result->bindParam(':userid', $date);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){$adv+=$row['sum(amount)'];}








    $sql = 'INSERT INTO payroll (emp_id,emp_name,amount,pay_month,date) VALUES (?,?,?,?,?)';
    $q = $db->prepare($sql);
    $q->execute(array($id,$emp_name,$amount,$pay_month,$date));


$result = $db->prepare("SELECT * FROM payroll WHERE  emp_id='$id' AND pay_month='$pay_month' ");
$result->bindParam(':id', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $pay_id=$row['id']; }

//###################### insert payroll list ################################//

// basic 
$sql = 'INSERT INTO payroll_list (payroll_id,name,amount,type) VALUES (?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($pay_id,'Basic Salary',$basic,'1'));

//attendees 
$sql = 'INSERT INTO payroll_list (payroll_id,name,amount,type) VALUES (?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($pay_id,'ATTENDANCE DAYS',$day,'1'));



//No Pay
if($day >= 26){$nopay=0;}else{
$nopay=(26-$day)*$ex_date_rate;
}
$sql = 'INSERT INTO payroll_list (payroll_id,name,amount,type) VALUES (?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($pay_id,'No Pay',$nopay,'2'));



//SALARY 
$salary=$basic-$nopay;
$sql = 'INSERT INTO payroll_list (payroll_id,name,amount,type) VALUES (?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($pay_id,'SALARY',$salary,'3'));



//DAY OFF
if($day > 26){ $day_off=($day-26)*$ex_date_rate; }else{ $day_off=0; } 
$sql = 'INSERT INTO payroll_list (payroll_id,name,amount,type) VALUES (?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($pay_id,'DAY OFF',$day_off,'1'));



// allowance 
$allowances=0;
$result = $db->prepare("SELECT * FROM hr_allowances WHERE emp_id='$id' AND date BETWEEN '$d1' AND '$d2' ORDER BY id ASC");
$result->bindParam(':id', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 

$sql = 'INSERT INTO payroll_list (payroll_id,name,amount,type) VALUES (?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($pay_id,$row['note'],$row['amount'],'1'));
$allowances+=$row['amount'];
 }



// Set Allowance
$sql = 'INSERT INTO payroll_list (payroll_id,name,amount,type) VALUES (?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($pay_id,'SET ALLOWANCE',$set_allowance,'1'));
$allowances+=$set_allowance;



//Gross Salary
$gross=$salary+$day_off+$allowances; 
$sql = 'INSERT INTO payroll_list (payroll_id,name,amount,type) VALUES (?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($pay_id,'GROSS SALARY',$gross,'3'));


//Salary Advance
$sql = 'INSERT INTO payroll_list (payroll_id,name,amount,type) VALUES (?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($pay_id,'Salary Advance',$adv,'2'));



//Loan Deduction
$sql = 'INSERT INTO payroll_list (payroll_id,name,amount,type) VALUES (?,?,?,?)';
$q = $db->prepare($sql);
$q->execute(array($pay_id,'Loan Deduction',$loan,'2'));





 header("location: hr_payroll_print.php?id=$pay_id");
}


?>
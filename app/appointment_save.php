<?php
session_start();
date_default_timezone_set("Asia/Colombo");
include("../connect.php");

$user_id = $_SESSION['SESS_MEMBER_ID'];
$app_date = $_POST['date'];
$app_time = $_POST['time'];

$note = $_POST['note'];

$invo = $_POST['invo'];
$cus = $_POST['cus'];

$date = date("Y-m-d");
$time = date('H:i:s');


$cus_name = '';
$result = $db->prepare("SELECT * FROM customer WHERE id = '$cus' ");
$result->bindParam(':id', $res);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $cus_name = $row['name'];
}

$emp_name = '';
$result = $db->prepare("SELECT * FROM user WHERE id = '$user_id' ");
$result->bindParam(':id', $res);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $emp = $row['emp_id'];
    $user_name = $row['name'];
}

$order_no = str_replace('-', '', $app_date) . str_replace('.', '', $app_time);

$sql = "INSERT INTO job (note,date,time,cus_id,cus_name,emp_id,emp_name,app_date,app_time,action,invoice_no,order_no,booking_user) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($note, $date, $time, $cus, $cus_name, $emp, $user_name, $app_date, $app_time, 'pending', $invo, $order_no, $user_id));


if($_SERVER['SERVER_NAME']=='liyathra.colorbiz.org'){
   

  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://chatbiz.net/api/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
  "number": "94779252594",
  "type": "media",
  "message": "Hi *beautiful*,
   Your appointment was booked .Liyathra salon will be delighted serve you on 11/02/2024 at 9.00 am. 
   *_See you soon!_*",
  "media_url": "https://liyathra.colorbiz.org/main/pages/get/app/img/LIYATHRA BOOKING.png",
  "instance_id": "65C8624CF2E87",
  "access_token": "65b8742c1285f"
  }',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Cookie: stackpost_session=efk5hfs38t9mtcfe0lq2laprmohinudj'
    ),
  ));
  
  $response = curl_exec($curl);
  
  curl_close($curl);
  echo $response;
  
}


header("location: appointment_service.php?invo=$invo");

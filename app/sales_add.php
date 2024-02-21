
<?php
//session_start();
include("../connect.php");


$id = $_REQUEST['id'];
$invo = $_REQUEST['invo'];
$qty = $_REQUEST['qty'];
$main_id = $_REQUEST['pro_id'];
$sev_id = $_REQUEST['sev'];

$met_id = $main_id;

$date = date("Y-m-d");
$discount = 0;


$result = $db->prepare("SELECT * FROM product WHERE product_id= :id");
$result->bindParam(':id', $id);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
	$pro_id = $row['product_id'];
	$sell = $row['sell'];
	$code = $row['code'];
	$name = $row['name'];
	$cost = $row['cost'];
}

$amount = $sell * $qty;

$profit = ($sell - $cost) * $qty;


// query
$sql = "INSERT INTO sales_list (invoice_no,product_id,qty,amount,name,price,profit,code,dic,date,view,service_id,met_id,type,action,cost) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($invo, $pro_id, $qty, $amount, $name, $sell, $profit, $code, $discount, $date, 0, $sev_id, $met_id, 'Materials', 1,$cost));


header("location: item_get.php?unit=2&invo=$invo&id=$main_id");
?>





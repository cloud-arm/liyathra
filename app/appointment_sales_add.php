
<?php
//session_start();
include("../connect.php");


$id=$_REQUEST['id'];
$invo=$_REQUEST['invo'];
$price=$_REQUEST['price'];


$date =date("Y-m-d");
$discount = 0;

$result = $db->prepare("SELECT * FROM product WHERE product_id= :id");
$result->bindParam(':id', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
	$pro_id=$row['product_id'];
	$code=$row['code'];
	$name=$row['name'];
    $type=$row['job_type'];
}

$qty = 1;
$profit = 0;
$emp = 0;
$sup_emp = 0;

// query
$sql = "INSERT INTO sales_list (invoice_no,product_id,qty,amount,name,price,profit,code,dic,date,emp,sup_emp) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($invo,$pro_id,$qty,$price,$name,$price,$profit,$code,$discount,$date,$emp,$sup_emp));


header("location: appointment_item_get.php?unit=1&invo=$invo&type=$type");
?>





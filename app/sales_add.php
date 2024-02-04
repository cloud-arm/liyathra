
<?php
//session_start();
include("../connect.php");


$id=$_REQUEST['id'];
$invo=$_REQUEST['invo'];
$qty=$_REQUEST['qty'];

$main_id=$_REQUEST['pro_id'];

$emp = 0;
$sup_emp = 0;

if(isset($_REQUEST['emp'])){$emp = $_REQUEST['emp'];}
if(isset($_REQUEST['sup_emp'])){$sup_emp = $_REQUEST['sup_emp'];}

$result = $db->prepare('SELECT * FROM appointment WHERE  invoice_no=:id ');
$result->bindParam(':id', $invo);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $action=$row['action']; $ap=$row['id'];}

if($action == 2){ 
	$sql = 'UPDATE  appointment SET action =? WHERE id =? ';
	$ql = $db->prepare($sql);
	$ql->execute(array('1',$ap));
}


$date =date("Y-m-d");
$discount = 0;

$cod=-1;
$result = $db->prepare("SELECT * FROM product WHERE product_id= :id");
$result->bindParam(':id', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
	$pro_id=$row['product_id'];
	$sell=$row['sell'];
	$code=$row['code'];
	$name=$row['name'];
	$cost=$row['cost'];
}

$amount = $sell*$qty;

$profit=($sell-$cost)*$qty;


// query
$sql = "INSERT INTO sales_list (invoice_no,product_id,qty,amount,name,price,profit,code,dic,date,emp,sup_emp) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
$q = $db->prepare($sql);
$q->execute(array($invo,$pro_id,$qty,$amount,$name,$sell,$profit,$code,$discount,$date,$emp,$sup_emp));


header("location: item_get.php?unit=2&invo=$invo&id=$main_id");
?>





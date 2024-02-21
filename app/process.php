
<?php
//session_start();
include("../connect.php");


$id = $_REQUEST['id'];
$invo = $_REQUEST['invo'];

$sev = 0;
$result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no= :id AND product_id = '$id' AND type = 'Service' ");
$result->bindParam(':id', $invo);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $sev = $row['id'];
}

$cost = 0;
$result = $db->prepare("SELECT sum(sell_price) FROM sales_list WHERE invoice_no= :id AND service_id = '$id' AND type = 'Materials' ");
$result->bindParam(':id', $invo);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {

    $cost = $row['sum(sell_price)'];
}

if ($cost == '') {
    $cost = 0;
}

$result = $db->prepare("SELECT * FROM job WHERE invoice_no =:id ");
$result->bindParam(':id', $invo);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {

    $job = $row['id'];
}

if ($sev > 0) {

    $sql = 'UPDATE sales_list SET service_id =?, cost =? WHERE id = ? ';
    $ql = $db->prepare($sql);
    $ql->execute(array($id, $cost, $sev));
} else {

    $date = date("Y-m-d");
    $discount = 0;

    $result = $db->prepare("SELECT * FROM product WHERE product_id= :id");
    $result->bindParam(':id', $id);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {

        $pro_id = $row['product_id'];
        $code = $row['code'];
        $name = $row['name'];
    }

    $qty = 1;
    $profit = 0;
    $emp = 0;
    $sup_emp = 0;


    // query
    $sql = "INSERT INTO sales_list (invoice_no,product_id,qty,name,profit,code,dic,date,emp,sup_emp,type,cost,job_no,view) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $q = $db->prepare($sql);
    $q->execute(array($invo, $pro_id, $qty, $name, $profit, $code, $discount, $date, $emp, $sup_emp, 'Service', $cost, $job, 1));
}

header("location: order.php?id=$job");
?>
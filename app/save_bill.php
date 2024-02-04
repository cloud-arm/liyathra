<?php
//session_start();
date_default_timezone_set("Asia/Tehran");
include("../connect.php");

$ui =1; //$_SESSION['SESS_MEMBER_ID'];
$un = "";//$_SESSION['SESS_FIRST_NAME'];
$date= date("Y-m-d");
$time=date('H:i:s');

$cus_name ="no";
$cus_id = 0;

$invoice = $_POST['id'];
$pay_type = $_POST['p_type'];
$now=date("Y-m-d");
$pay_total=$_POST['amount'];

$chq_no = '';
$chq_bank = '';
$chq_date = '';
if($pay_type=='chq'){
    $chq_no = $_POST['chq_no'];
    $chq_bank = $_POST['chq_bank'];
    $chq_date = $_POST['chq_date'];
}

$bank = '';
$bank_name = '';
if($pay_type=='bank'){
    $bank = $_POST['bank'];
    $re = $db->prepare("SELECT * FROM bank WHERE id = :id ");
    $re->bindParam(':id', $bank);
    $re->execute();
    for($k=0; $r = $re->fetch(); $k++){$bank_name=$r['name'];}
}

    $result = $db->prepare("SELECT * FROM appointment WHERE invoice_no = '$invoice' ");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
        $cus_name = $row['cus_name'];
        $cus_id = $row['cus_id'];
        $in_date=$row['in_date'];
        $in_time=$row['time'];
        $room_no='';
    }


    $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invoice' ");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
        $sl_id = $row['id']; 
        $p_id = $row['product_id']; 
        $name = $row['name']; 
        $qty = $row['qty']; 
        $price = $row['price']; 

        $re = $db->prepare("SELECT * FROM use_product WHERE main_product = :id ");
        $re->bindParam(':id', $p_id);
        $re->execute();
        for($i=0; $r = $re->fetch(); $i++){$id=$r['product_id'];}

        $temp_qty = $qty; 

        do{
            if(isset($id)){}else{$id = 0;}
            $qty_blc = 0; $temp_sell = 0;$temp_cost = 0;$st_id = 0;
            $re = $db->prepare("SELECT * FROM stock WHERE product_id='$id' AND qty_balance>0  ORDER BY id ASC LIMIT 1 ");
            $re->bindParam(':userid', $res);
            $re->execute();
            for($k=0; $r = $re->fetch(); $k++){
                $st_qty=$r['qty_balance'];
                $st_id = $r['id'];
                $temp_sell = $r['sell'];
                $temp_cost = $r['cost'];

                if($st_qty < $temp_qty){

                    $temp_qty = $temp_qty - $st_qty;

                    $sql = "UPDATE stock SET qty=?, qty_balance=? WHERE id=?";
                    $ql = $db->prepare($sql);
                    $ql->execute(array($st_qty,0,$st_id));            

                    $sql = "INSERT INTO inventory (product_id,name,invoice_no,type,balance,qty,date,sell,cost) VALUES (?,?,?,?,?,?,?,?,?)";
                    $ql = $db->prepare($sql);
                    $ql->execute(array($id,$name,$invoice,'out',0,$st_qty,$date,$temp_sell,$temp_cost));
                }else{

                    $qty_blc = $st_qty - $temp_qty;

                    $sql = "UPDATE stock SET qty=?, qty_balance=? WHERE id=?";
                    $ql = $db->prepare($sql);
                    $ql->execute(array($temp_qty,$qty_blc,$st_id));            

                    $sql = "INSERT INTO inventory (product_id,name,invoice_no,type,balance,qty,date,sell,cost) VALUES (?,?,?,?,?,?,?,?,?)";
                    $ql = $db->prepare($sql);
                    $ql->execute(array($id,$name,$invoice,'out',$qty_blc,$temp_qty,$date,$temp_sell,$temp_cost));
                    $temp_qty=0;
                }
            }
            if($st_id==0){ $temp_qty = 0;  }
        }while($temp_qty > 0);

        $re = $db->prepare("SELECT * FROM use_product WHERE main_product = :id ");
        $re->bindParam(':id', $p_id);
        $re->execute();
        for($i=0; $r = $re->fetch(); $i++){
            $cod=$r['product_id'];
            $use_qty=$r['qty'];

            $re0 = $db->prepare("SELECT * FROM products WHERE id = :id ");
            $re0->bindParam(':id', $cod);
            $re0->execute();
            for($i=0; $r0 = $re0->fetch(); $i++){ $blc=$r0['qty'];}

            $temp = $qty * $use_qty;

            $temp = $blc - $temp;

            $sql = 'UPDATE product SET qty = ? WHERE product_id = ? ';
            $ql = $db->prepare($sql);
            $ql->execute(array($temp,$cod));

        }

        $re = $db->prepare("SELECT * FROM product WHERE product_id = :id AND stock_action = 1 AND type != 'Materials' ");
        $re->bindParam(':id', $p_id);
        $re->execute();
        for($i=0; $r = $re->fetch(); $i++){

            $cod=$r['id'];
            
            $sql = 'UPDATE products SET qty = qty - ? WHERE id = ? ';
            $ql = $db->prepare($sql);
            $ql->execute(array($qty,$cod));
        }

            
    $result = $db->prepare("SELECT sum(amount),sum(profit) FROM sales_list WHERE invoice_no = '$invoice' ");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
        $amount = $row['sum(amount)'];
        $profit = $row['sum(profit)'];
    }
            

    $discount=0;
    $amount=$amount-$discount;

    $balance = $amount-$pay_total;

    $pay_amount = $pay_total;
    //$discount=$_POST['dis'];

    // query
    $sales_id=0;
    $result = $db->prepare('SELECT * FROM sales WHERE  invoice_number = :id');
    $result->bindParam(':id', $invoice);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){ $sales_id=$row['transaction_id']; }
    
    
    if($sales_id==0){
    // query
        $sql = "INSERT INTO sales (invoice_number,amount,balance,profit,pay_type,pay_amount,date,customer_id,customer_name,action,discount) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $ql = $db->prepare($sql);
        $ql->execute(array($invoice,$amount,$balance,$profit,$pay_type,$pay_total,$date,$cus_id,$cus_name,'active',$discount));
 
    }else{
    
        $sql = 'UPDATE  sales SET action=?, pay_amount=?, balance=amount-?, pay_type=?  WHERE  invoice_number=? ';
        $ql = $db->prepare($sql);
        $ql->execute(array('active',$pay_total,$pay_total,$pay_type,$invoice));
    }  
        
    $sql = "UPDATE appointment 
            SET action='5'
            WHERE invoice_no=?";
    $q = $db->prepare($sql);
    $q->execute(array($invoice));

    if($amount > $pay_amount){

        $sql = 'INSERT INTO payment (amount,pay_amount,pay_type,date,time,invoice_no,type,credit_balance) VALUES (?,?,?,?,?,?,?,?)';
        $q = $db->prepare($sql);
        $q->execute(array($amount,0,'Credit',$date,$time,$invoice,0,$amount));
    }


    if($pay_amount > 0){

        if($pay_type == 'card'){

            $sql = 'INSERT INTO payment (amount,pay_amount,pay_type,date,time,invoice_no,type,action) VALUES (?,?,?,?,?,?,?,?)';
            $q = $db->prepare($sql);
            $q->execute(array($pay_amount,$pay_amount,$pay_type,$date,$time,$invoice,'1',1));

            $re = $db->prepare("SELECT * FROM payment WHERE invoice_no = :id ");
            $re->bindParam(':id', $invoice);
            $re->execute();
            for($k=0; $r = $re->fetch(); $k++){$p=$r['id'];}

            $sql = "INSERT INTO bank_record (transaction_type,type,record_no,amount,action,credit_acc_no,credit_acc_type,credit_acc_name,credit_acc_balance,debit_acc_type,debit_acc_name,debit_acc_id,debit_acc_balance,date,time,user_id,user_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $ql = $db->prepare($sql);
            $ql->execute(array('invoice_payment','Credit',$invoice,$pay_amount,1,0,'Card Payment','Bank',0,'Bank Invoice','Bank Deposit',$p,0,$date,$time,$ui,$un));

        }else{

            $sql = 'INSERT INTO payment (amount,pay_amount,pay_type,date,time,invoice_no,type,chq_no,chq_bank,chq_date,bank_id,bank_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
            $q = $db->prepare($sql);
            $q->execute(array($pay_amount,$pay_amount,$pay_type,$date,$time,$invoice,'1',$chq_no,$chq_bank,$chq_date,$bank,$bank_name));
        }


        $cr_blc = $amount - $pay_amount;

        $sql = "UPDATE  payment SET credit_balance = ? WHERE invoice_no=? AND pay_type = 'Credit' ";
        $ql = $db->prepare($sql);
        $ql->execute(array($cr_blc,$invoice));

    
        if($pay_type == 'cash'){

            $cr_id = 2;

            $cr_blc = 0;$blc = 0;
            $re = $db->prepare("SELECT * FROM cash WHERE id = '$cr_id' ");
            $re->bindParam(':userid', $res);
            $re->execute();
            for($k=0; $r = $re->fetch(); $k++){$blc=$r['amount']; $cr_name=$r['name'];}

            $cr_blc = $blc + $pay_amount;

            $re = $db->prepare("SELECT * FROM payment WHERE invoice_no = :id ");
            $re->bindParam(':id', $invoice);
            $re->execute();
            for($k=0; $r = $re->fetch(); $k++){$p=$r['id'];}

            $sql = "INSERT INTO transaction_record (transaction_type,type,record_no,amount,action,credit_acc_no,credit_acc_type,credit_acc_name,credit_acc_balance,debit_acc_type,debit_acc_name,debit_acc_id,debit_acc_balance,date,time,user_id,user_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $ql = $db->prepare($sql);
            $ql->execute(array('invoice','Credit',$invoice,$pay_amount,0,$cr_id,'Cash',$cr_name,$cr_blc,'cash_invoice','Cash Payment',$p,0,$date,$time,$ui,$un));

            $sql = "UPDATE  cash SET amount=? WHERE id=?";
            $ql = $db->prepare($sql);
            $ql->execute(array($cr_blc,$cr_id));
        }

        if($pay_type == 'bank'){
            $cr_blc = 0;$blc = 0;
            $re = $db->prepare("SELECT * FROM bank WHERE id = :id ");
            $re->bindParam(':id', $bank);
            $re->execute();
            for($k=0; $r = $re->fetch(); $k++){$blc=$r['amount'];}

            $cr_blc = $blc + $pay_amount;

            $re = $db->prepare("SELECT * FROM payment WHERE invoice_no = :id ");
            $re->bindParam(':id', $invoice);
            $re->execute();
            for($k=0; $r = $re->fetch(); $k++){$p=$r['id'];}

            $sql = "UPDATE  bank SET amount=? WHERE id=?";
            $ql = $db->prepare($sql);
            $ql->execute(array($cr_blc,$bank));

            $sql = "INSERT INTO bank_record (transaction_type,type,record_no,amount,action,credit_acc_no,credit_acc_type,credit_acc_name,credit_acc_balance,debit_acc_type,debit_acc_name,debit_acc_id,debit_acc_balance,date,time,user_id,user_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $ql = $db->prepare($sql);
            $ql->execute(array('invoice_payment','Credit',$invoice,$pay_amount,0,$bank,'Bank Transfer',$bank_name,$cr_blc,'Bank Invoice','Bank Transfer',$p,0,$date,$time,$ui,$un));
        }
    }
}

$sql = "UPDATE appointment
SET action='5'
WHERE invoice_no=?";
$q = $db->prepare($sql);
$q->execute(array($invoice));

header("location: bill.php?id=$invoice");

?>
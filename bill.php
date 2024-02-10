<!DOCTYPE html>
<html>
<head>
	<?php
		  include("connect.php");
	
	$invo = $_GET['id'];
	$co = substr($invo,0,2) ;
			?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CLOUD ARM | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<style>
body {
    font-family: 'Poppins';
}

.container {
  position: relative;
  text-align: center;
  color: white;
}

.bottom-left {
  position: absolute;
  bottom: 8px;
  left: 18%;
}

.top-left {
  position: absolute;
  top: 8px;
  left: 18%;
}

.top-right {
  position: absolute;
  top: 8px;
  right: 58%;
}

.bottom-right {
  position: absolute;
  bottom: 8px;
  right: 57%;
}


.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
</head>
<body onload="window.print() " style=" font-size: 13px; font-family: 'Poppins';">
	
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
	  
	           <?php
           $invo=$_GET['id'];	
		   $result1 = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'");
		   $result1->bindParam(':userid', $date);
           $result1->execute();
           for($i=0; $row1 = $result1->fetch(); $i++){ $cus_name= $row1['customer_name']; 
                    
                $job_no=$row1['job_no'];
                $email=$row1['email'];
                $note=$row1['comment'];
                $discount=$row1['sales_discount'];
                $job_type=0;
		$result = $db->prepare("SELECT * FROM job WHERE  id='$job_no'  ");
		$result->bindParam(":userid", $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){ $job_type=$row['job_type']; }
		
		
	
		//if ($co=="qt"){ $h3="Note:"; $next_km=$row1['comment'];}
                }
                
                
         ?>
	  
	  
	  <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
        <img src="sl_logo.jpeg" width="145" alt="">
         <?php echo $cus_name; ?>

         </p>
        </div>
        <!-- /.col -->
		  
		  		  

		  
		  
        
			  <?php if($note==""){}else{ echo $note; }?>
			 
        <!-- /.col -->
</div>
  <?php
  			  $invo=$_GET['id'];
					$tot_amount=0;
				$result = $db->prepare("SELECT sum(dic) FROM sales_list WHERE   invoice_no='$invo'");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$dis_tot=$row['sum(dic)'];
				}
  ?>
<div class="box-body">
              <table id="example1" class="table">
                <thead>
                <tr style="background-color: #737373; color:#eee">
				<th>Part Number</th>
				<th>Decs</th>
					<th>Unit Price</th>
          <th>Qty</th>
          <?php
					if($dis_tot>0){
					?>
					<th>Disc</th>
					<?php } ?>
                  <th>Amount </th>
                </tr>
                </thead>
                <tbody>
				<?php
			date_default_timezone_set("Asia/Colombo");
		$hh=date("Y/m/d");
		$invo=$_GET['id'];
					$tot_amount=0;
				$result = $db->prepare("SELECT * FROM sales_list WHERE   invoice_no='$invo'  ");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
					$u_to=$row['price']+$row['dic'];
					$u_pri=$u_to/$row['qty'];

          if($row['type']=='Materials'){}else{
			?>
                <tr>
				<td><?php echo $row['code'];?></td>
                  <td><?php echo $row['name'].'  '.$row['other_info'];?></td>
					<td><?php echo ($row['amount']+$row['dic'])/$row['qty'];?></td>
				  <td><?php echo $row['qty'];?></td>
                  <?php
					if($dis_tot>0){
					?>
					<td><?php echo $row['dic'] * $row['qty'];?></td>
					<?php } ?>
                  <td style="text-align: right;" >Rs.<?php echo $row['amount'];?></td>
					<?php $tot_amount+= $row['amount'];?>
                  <?php }  }?>
                 </tr>
                 
                 <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <?php
					if($dis_tot>0){
					?>
					<td></td>
					<?php } ?>
                    
                     <td >Rs.<?php echo number_format($tot_amount,2); ?></td>
                 </tr>
                </tbody>
              </table>
	<?php
				$result1 = $db->prepare("SELECT * FROM sales WHERE   invoice_number='$invo'  ");		
					$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				//$tot_amount=$row1['amount'];
					$balance=$row1['balance'];
				}
			?>  
			<div class="col-xs-5 pull-right">
			    <div class="row" >
					    <div class="col-xs-6">
					       <h4 class="pull-right">Total</h4>
					    </div>
					    <div class="col-xs-6">
					       <h4><b class="pull-right">Rs.<?php echo number_format($tot_amount,2); ?></b> </h4>
					       
					    </div>
					</div>
					<?php if ($co>0){ if($discount > 0){?>
          <div class="row" >
					    <div class="col-xs-6">
					       <p class="pull-right">Discount</p> 
					    </div>
					    <div class="col-xs-6">
					       <p class="pull-right">Rs.<?php echo number_format($discount,2); ?></p> 
					    </div>
					</div>
          <?php $tot_amount=$tot_amount-$discount; } ?>

					<div class="row" >
					    <div class="col-xs-6">
					       <p class="pull-right">Pay Amount</p> 
					    </div>
					    <div class="col-xs-6">
					       <p class="pull-right">Rs.<?php echo number_format($tot_amount+$balance,2); ?></p> 
					    </div>
					</div>
					
					<div class="row" >
					    <div class="col-xs-6">
					       <p class="pull-right">Balance:</p> 
					    </div>
					    <div class="col-xs-6">
					       <p class="pull-right">Rs.<?php echo number_format($balance,2); ?></p> 
					    </div>
					</div>
					<?php } ?>
			</div>



	
            </div> 
<center>
<div class="container">
 
  <div class="bottom-left">
	<?php $result1 = $db->prepare("SELECT * FROM job_list WHERE   ins_id='45' AND job_no='$job_no' ");		
		$result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row = $result1->fetch(); $i++){ echo $row['note'];} ?></div>
  <div class="top-left">

  <?php $result1 = $db->prepare("SELECT * FROM job_list WHERE   ins_id='46' AND job_no='$job_no' ");		
		$result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row = $result1->fetch(); $i++){ echo $row['note'];} ?>
  </div>

  <div class="top-right">
  <?php $result1 = $db->prepare("SELECT * FROM job_list WHERE   ins_id='48' AND job_no='$job_no' ");		
		$result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row = $result1->fetch(); $i++){ echo $row['note'];} ?>
  </div> 

  <div class="bottom-right">
  <?php $result1 = $db->prepare("SELECT * FROM job_list WHERE   ins_id='47' AND job_no='$job_no' ");		
		$result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row = $result1->fetch(); $i++){ echo $row['note'];} ?>
  </div>
<div class="pull-left">
  <br><br><br>
_______________________ <br>
cashier
</div>


</div>
	<i>CARE THE PRIDE IN YOUR RIDE</i><br>
<img src="img/cloud arm name.svg" width="100" alt="">
</center>

	  
	
        </div>
  </section>
  <?php
$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='sales_rp.php?d1=<?php echo date('Y-m-d') ?>&d2=<?php echo date('Y-m-d'); ?>">
</div>
</body>
</html>
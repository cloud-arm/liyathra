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
    </style>
</head>

<body onload="window.print() " style=" font-size: 13px; font-family: 'Poppins';">

    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">

            <?php
            $id=$_GET["id"];
            $result = $db->prepare('SELECT * FROM payroll WHERE  id=:id ');
            $result->bindParam(':id', $id);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){ 
                $name=$row['emp_name'];
                $pay_month=$row['pay_month'];
                $amount=$row['amount'];
             }


            
                                  
         ?>


            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-12">
                    <h2><?php echo $name; ?></h2>
                    <h3><?php echo $pay_month ?></h3>
                </div>
                <!-- /.col -->
            </div>

            <div class="box-body">

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                        
                            <?php $result = $db->prepare('SELECT * FROM payroll_list WHERE  payroll_id=:id ');
                            $result->bindParam(':id', $id);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){ ?>
                            <tr>
                                <td><?php echo $row['name']  ?></td>
                                <td><?php echo $row['amount']  ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th>Balance Pay</th>
                                <th><?php echo $amount; ?></th>
                            </tr>
                            </table>
                    </div>


                </div>









            </div>
            <center>
                <br><br><br><br>
                <img src="img/cloud arm name.svg" width="100" alt="">
            </center>



    </div>
    </section>
    <?php
$sec = "1";
?>
    <meta http-equiv="refresh" content="<?php echo $sec;?>;URL='hr_payroll.php">
    </div>
</body>

</html>
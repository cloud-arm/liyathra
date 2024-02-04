<!DOCTYPE html>

<html>

<?php 

include("head.php");
include("connect.php");

?>


<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>



<body class="hold-transition skin-blue sidebar-mini">

    <?php 

include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];
if($r =='mechanic'){
header("location: job.php");
}
if($r =='admin'){
include_once("sidebar.php");
}
//header("location: 404.php");

?>





    <!-- /.sidebar -->

    </aside>



    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1>
                Home
                <small>Preview</small>
            </h1>


        </section>
        <!-- Main content -->
        <section class="content">
            <?php
		include('connect.php');
 date_default_timezone_set("Asia/Colombo");
 $cash=$_SESSION['SESS_FIRST_NAME'];



                  $date =  date("Y-m-d");					

			

				$result = $db->prepare("SELECT sum(profit) FROM sales WHERE action='active' AND  date='$date' ");

				

					$result->bindParam(':userid', $date);

                $result->execute();

                for($i=0; $row = $result->fetch(); $i++){

				  

				  $profit=$row['sum(profit)'];

				}

				







$result = $db->prepare("SELECT sum(amount) FROM sales WHERE  action='active' AND  date='$date'  ");

				

					$result->bindParam(':userid', $date);

                $result->execute();

                for($i=0; $row = $result->fetch(); $i++){

				  

				  $amount=$row['sum(amount)'];

				}		
					

$result = $db->prepare("SELECT sum(amount) FROM expenses_records WHERE  date = '$date' ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$ex=$row['sum(amount)'];
				}


		$month1=date("Y-m-01");
		$month2=date("Y-m-31");
		

		
	
		date_default_timezone_set("Asia/Colombo");
		$date=date("Y-m-d");$job_count=0;
		
	
				$date=date("Y-m-d");
                $d1=date("Y-m-").'01';
                $d2=date("Y-m-").'31';

			?>
            <div class="row">

                <?php     $r=$_SESSION['SESS_LAST_NAME'];



if($r =='Cashier'){

	?>



                <?php }



else{

 ?>









                <div class="col-lg-3 col-xs-6">

                    <!-- small box -->

                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>Rs.<?php echo $amount; ?></h3>
                            <p>Total Sales</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->

                <div class="col-lg-3 col-xs-6">

                    <!-- small box -->

                    <div class="small-box bg-green">

                        <div class="inner">

                            <h3>Rs.<?php echo $ex; ?></sup></h3>

                            <p>Expenses Total </p>

                        </div>

                        <div class="icon">

                            <i class="ion ion-stats-bars"></i>

                        </div>

                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                    </div>

                </div>

                <!-- ./col -->

                <div class="col-lg-3 col-xs-6">

                    <!-- small box -->

                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php $result = $db->prepare("SELECT count(transaction_id) FROM sms WHERE  date BETWEEN '$d1' AND '$d2'  ");
                            $result->bindParam(':id', $res);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){ echo $row['count(transaction_id)']; } ?></h3>
                            <p>SMS Count</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                    </div>

                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php $result = $db->prepare("SELECT count(id) FROM job WHERE  date='$date' ORDER by id DESC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				echo $row['count(id)'];	
				} ?></h3>



                            <p>Total Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-hammer"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

            </div>

            <?php 

}

 ?>

            <?php if($_SESSION['SESS_FIRST_NAME']=="Kushan"){ include('index_cancel_appr.php');} ?>


            <div class="row">


                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Latest JOB Orders <a href="job_add.php" class="btn btn-info">Add new
                                    Job</a></h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <!-- /.box-header -->






                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>app. Date</th>
                                            <th>app Time</th>
                                            <th>Customer</th>
                                            <th>Phone no</th>
                                            <th>Bill</th>
                                            <th>#</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
					  date_default_timezone_set("Asia/Colombo");
					  include("connect.php");
					  $ramp="";
					  $tot_bill=0;
					  $job_no=0;
					  $mechanic_id=0;
			$result = $db->prepare("SELECT * FROM job JOIN customer ON customer.id=job.cus_id WHERE job.type='active'  ORDER by job.id DESC  ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
                    $invoice_number=$row['invoice_no'];
                    
		$resultm = $db->prepare("SELECT sum(amount) FROM sales_list WHERE invoice_no='$invoice_number' ");
		$resultm->bindParam(':userid', $res);
		$resultm->execute();
		for($i=0; $row12 = $resultm->fetch(); $i++){	
		$tot_bill = $row12['sum(amount)'];
		}
					
				
					  ?>
                                        <tr class="alert alert-general record">
                                            <td><?php echo $row['id'];?></td>
                                            <td><?php echo $row['app_date'];?></td>
                                            <td><?php echo $row['app_time'];?></td>
                                            <td><?php echo $row['cus_name'];?></td>
                                            <td><?php echo $row['contact']  ?></td>
                                            <td><?php	echo "Rs.".$tot_bill;?></td>

                                            <td>
                                                <a href="profile.php?id=<?php echo $row['vehicle_id']; ?>"><button
                                                        class="btn btn-success"><i
                                                            class="glyphicon glyphicon-user"></i></button></a>
                                            </td>
                                        </tr>
                                        <?php } $date=date("Y-m-d");
					  $job_type1="";
		 $result = $db->prepare("SELECT * FROM job WHERE type='Close' and date='$date' ORDER by id DESC ");
				$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				$vehicle=$row['vehicle_no'];
			    $job_type1=$row['job_type'];

          $result1 = $db->prepare("SELECT * FROM vehicle WHERE vehicle_no='$vehicle'");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
                  $idi=$row1['id'];
				$cus_id=$row1['customer_id'];	
				}
					
				$result1 = $db->prepare("SELECT * FROM customer WHERE id='$cus_id'");
				$result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
				//$idi=$cus_id;	
					$cus_name=$row1['customer_name'];
					$phone_no=$row1['contact'];
					$phone_no2=$row1['contact2'];
					
				}
					
					
					if($job_type1==1){ $type_color1="red"; $type_info1="Full Service"; }
					if($job_type1==3){ $type_color1="green"; $type_info1="Service"; }
					if($job_type1==6){ $type_color1="blue"; $type_info1="Body Detailing"; }
					  
					  
					  ?>

                                        <tr class="alert alert-general record">

                                            <td><?php echo $row['vehicle_no'];?></td>
                                            <td><?php echo $row['km'];?></td>
                                            <td><span class="badge bg-green"><i class="fa fa-clock-o"></i>
                                                    <?php echo $row['type']; ?></span></td>
                                            <td><span class="badge bg-red"><i class="fa fa-wrench "></i> <?php $ramp1=$row['mechanic_id']; 
						   
						   $resultm = $db->prepare("SELECT * FROM mechanic WHERE id = '$ramp1' ");
		$resultm->bindParam(':userid', $res);
		$resultm->execute();
		for($i=0; $rowm = $resultm->fetch(); $i++){
		echo $rowm['name'];	
		}
						   
						   
						   ?></span></td>

                                            <td><?php echo $cus_name;?></td>
                                            <td><?php echo $phone_no;?></td>
                                            <td></td>

                                            <td>
                                                <a href="profile.php?id=<?php echo $idi; ?>">
                                                    <button class="btn btn-info"><i
                                                            class="glyphicon glyphicon-user"></i></button></a>
                                            </td>
                                        </tr>
                                        <?php 
				} ?>
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.table-responsive -->

                        </div>


                    </div>
                </div>





             

                <div class="col-md-6">
                    <!-- LINE CHART -->
                    <div class="box box-solid bg-teal-gradient">
                        <div class="box-header">
                            <i class="fa fa-th"></i>

                            <h3 class="box-title">Net Profit Graph</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i
                                        class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body border-radius-none">
                            <div class="chart" id="line-chart" style="height: 300px;"></div>
                        </div>
                    </div>

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">GROSS PROFIT and EXPENSES</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="barChart" style="height:230px"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>



                </div>


            </div>


            <!-- SELECT2 EXAMPLE -->

            <div class="box box-info">

                <div class="box-header with-border">

                    <h3 class="box-title"><?php echo date("Y")-1 ?> to <?php echo date("Y") ?> Sales Chart</h3>
                    <div class="chart">

                        <canvas id="lineChart" style="height:250px"></canvas>

                    </div>

                    <!-- Main content -->
                </div>

            </div>

    </div>

    <!-- /.content-wrapper -->

    <?php

  include("dounbr.php");

?>

    <!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed

       immediately after the control sidebar -->

    <div class="control-sidebar-bg"></div>



    <!-- ./wrapper -->


    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../../plugins/morris/morris.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->

    <!-- ChartJS 1.0.1 -->
    <script src="../../plugins/chartjs/Chart.min.js"></script>





    <?php

 include("chart.php");

?>





    <!-- page script -->

    <script>
    $(function() {

        var a;
        var answer = document.getElementById("result");

        if (navigator.userAgent.match(/Android/i) ||
            navigator.userAgent.match(/webOS/i) ||
            navigator.userAgent.match(/iPhone/i) ||
            navigator.userAgent.match(/iPad/i) ||
            navigator.userAgent.match(/iPod/i) ||
            navigator.userAgent.match(/BlackBerry/i) ||
            navigator.userAgent.match(/Windows Phone/i)) {
            window.location.href = 'app/';
        }


        // LINE CHART
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                //----------------------######################################## ---------------------------------------//
                {
                    y: '<?php echo $y=date("Y")-2; ?> Q1',
                    item1: <?php $date1=$y."-01-01"; $date2=$y."-03-31";
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
        
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
        
        echo $gf-$ex;
        ?>
                },


                {
                    y: '<?php echo date("Y")-2; ?> Q2',
                    item1: <?php $date1=$y."-04-01"; $date2=$y."-06-31";$ex=0;$gf=0;
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
        
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
        
        echo $gf-$ex;
        ?>
                },


                {
                    y: '<?php echo date("Y")-2; ?> Q3',
                    item1: <?php $date1=$y."-07-01"; $date2=$y."-09-31";$ex=0;$gf=0;
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
        
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
        
        echo $gf-$ex;
        ?>
                },


                {
                    y: '<?php echo date("Y")-2; ?> Q4',
                    item1: <?php $date1=$y."-10-01"; $date2=$y."-12-31";$ex=0;$gf=0;
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
        
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
        
        echo $gf-$ex;
        ?>
                },
                //----------------------######################################## ---------------------------------------//



                //----------------------######################################## ---------------------------------------//
                {
                    y: '<?php echo $y=date("Y")-1; ?> Q1',
                    item1: <?php $date1=$y."-01-01"; $date2=$y."-03-31";$gf=0;$ex=0;
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
        
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
        
        echo $gf-$ex;
        ?>
                },


                {
                    y: '<?php echo date("Y")-1; ?> Q2',
                    item1: <?php $date1=$y."-04-01"; $date2=$y."-06-31";$ex=0;$gf=0;
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
        
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
        
        echo $gf-$ex;
        ?>
                },


                {
                    y: '<?php echo date("Y")-1; ?> Q3',
                    item1: <?php $date1=$y."-07-01"; $date2=$y."-09-31";$ex=0;$gf=0;
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
        
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
        
        echo $gf-$ex;
        ?>
                },

                {
                    y: '<?php echo date("Y")-1; ?> Q4',
                    item1: <?php $date1=$y."-10-01"; $date2=$y."-12-31";$ex=0;$gf=0;
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
        
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
        
        echo $gf-$ex;
        ?>
                },
                //----------------------######################################## ---------------------------------------//


                //----------------------######################################## ---------------------------------------//
                {
                    y: '<?php echo $y=date("Y"); ?> Q1',
                    item1: <?php $date1=$y."-01-01"; $date2=$y."-03-31";$gf=0;$ex=0;
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
        
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
        
        echo $gf-$ex;
        ?>
                },


                {
                    y: '<?php echo date("Y"); ?> Q2',
                    item1: <?php $date1=$y."-04-01"; $date2=$y."-06-31";$ex=0;$gf=0;
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
        
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
        
        echo $gf-$ex;
        ?>
                },


                {
                    y: '<?php echo date("Y"); ?> Q3',
                    item1: <?php $date1=$y."-07-01"; $date2=$y."-09-31";$ex=0;$gf=0;
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
        
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
        
        echo $gf-$ex;
        ?>
                },

                {
                    y: '<?php echo date("Y"); ?> Q4',
                    item1: <?php $date1=$y."-10-01"; $date2=$y."-12-31";$ex=0;$gf=0;
        $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $gf=$row1['sum(profit)'];}  
        
        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
        $result1->execute();
        for($i=0; $row1 = $result1->fetch(); $i++){ $ex=$row1['sum(amount)'];}
        
        echo $gf-$ex;
        ?>
                }
                //----------------------######################################## ---------------------------------------//
            ],
            xkey: 'y',
            ykeys: ['item1'],
            labels: ['Value'],
            lineColors: ['#ffffff'],
            gridTextColor: ['#ffffff'],
            hideHover: 'auto'
        });



        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#lineChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);
        var areaChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                "October", "November", "December"
            ],
            datasets: [{
                    label: <?php echo date("Y")-1 ?> + " SALES ",
                    fillColor: "rgba(210, 214, 222, 1)",
                    strokeColor: "rgba(210, 214, 222, 1)",
                    pointColor: "rgba(210, 214, 222, 1)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php  echo $m1t; ?>, <?php  echo $m2t; ?>, <?php  echo $m3t; ?>,
                        <?php  echo $m4t; ?>, <?php  echo $m5t; ?>, <?php  echo $m6t; ?>,
                        <?php  echo $m7t; ?>, <?php  echo $m8t; ?>, <?php  echo $m9t; ?>,
                        <?php  echo $m10t; ?>, <?php  echo $m11t; ?>, <?php  echo $m12t; ?>
                    ]
                },

                {
                    label: <?php echo date("Y") ?> + " SALES ",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [<?php  echo $m1; ?>, <?php  echo $m2; ?>, <?php  echo $m3; ?>,
                        <?php  echo $m4; ?>, <?php  echo $m5; ?>, <?php  echo $m6; ?>,
                        <?php  echo $m7; ?>, <?php  echo $m8; ?>, <?php  echo $m9; ?>,
                        <?php  echo $m10; ?>, <?php  echo $m11; ?>, <?php  echo $m12; ?>
                    ]
                }
            ]
        };

        var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };



        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);



        //-------------

        //- LINE CHART -

        //--------------

        var lineChartCanvas = $("#lineChart").get(0).getContext("2d");

        var lineChart = new Chart(lineChartCanvas);

        var lineChartOptions = areaChartOptions;

        lineChartOptions.datasetFill = false;

        lineChart.Line(areaChartData, lineChartOptions);





        var areaChartData = {
            labels: [<?php  $x=0;
while($x <= 7) {
 
   $d=strtotime("-$x Month");
$date=date("Y-m-d", $d);
 
$split = explode("-", $date);
        $y= $split[0];
        $m= $split[1];
        $d= $split[2];
        $date=mktime(0,0,0,$m,$d,$y);
        $date= date('Y-M',$date);
        
        echo "'".$date."',";

$x++;
}?>],
            datasets: [{
                    label: "Gross Profit",
                    fillColor: "rgba(210, 214, 222, 1)",
                    strokeColor: "rgba(210, 214, 222, 1)",
                    pointColor: "rgba(210, 214, 222, 1)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php  $x=0;
while($x <= 7) {
  $d=strtotime("-$x Month");
$date=date("Y-m", $d);
$date1=$date."-01";
$date2=$date."-31";


          $result1 = $db->prepare("SELECT  sum(profit) FROM sales WHERE action='active' AND date BETWEEN '$date1' AND '$date2'  ");
        $result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
        echo $row1['sum(profit)'].",";
                } 
                $x++;
}?>]
                },
                {
                    label: "Expenses",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [<?php  $x=0;
while($x <= 7) {
  $d=strtotime("-$x Month");
$date=date("Y-m", $d);
$date1=$date."-01";
$date2=$date."-31";



          $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records WHERE date BETWEEN '$date1' AND '$date2'   ");
        $result1->bindParam(':userid', $date);
                $result1->execute();
                for($i=0; $row1 = $result1->fetch(); $i++){
        echo $row1['sum(amount)'].",";
                } 
                $x++;
}?>]
                }
            ]
        };

        //-------------

        //- BAR CHART -

        //-------------

        var barChartCanvas = $("#barChart").get(0).getContext("2d");

        var barChart = new Chart(barChartCanvas);

        var barChartData = areaChartData;

        barChartData.datasets[1].fillColor = "#00a65a";

        barChartData.datasets[1].strokeColor = "#00a65a";

        barChartData.datasets[1].pointColor = "#00a65a";

        var barChartOptions = {

            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value

            scaleBeginAtZero: true,

            //Boolean - Whether grid lines are shown across the chart

            scaleShowGridLines: true,

            //String - Colour of the grid lines

            scaleGridLineColor: "rgba(0,0,0,.05)",

            //Number - Width of the grid lines

            scaleGridLineWidth: 1,

            //Boolean - Whether to show horizontal lines (except X axis)

            scaleShowHorizontalLines: true,

            //Boolean - Whether to show vertical lines (except Y axis)

            scaleShowVerticalLines: true,

            //Boolean - If there is a stroke on each bar

            barShowStroke: true,

            //Number - Pixel width of the bar stroke

            barStrokeWidth: 2,

            //Number - Spacing between each of the X value sets

            barValueSpacing: 5,

            //Number - Spacing between data sets within X values

            barDatasetSpacing: 1,

            //String - A legend template

            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",

            //Boolean - whether to make the chart responsive

            responsive: true,

            maintainAspectRatio: true

        };



        barChartOptions.datasetFill = false;

        barChart.Bar(barChartData, barChartOptions);

    });
    </script>

</body>

</html>
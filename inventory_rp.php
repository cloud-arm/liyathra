<!DOCTYPE html>
<html>
<?php 
include("head.php");
include("connect.php");
?>
<body class="hold-transition skin-blue sidebar-mini">
<?php 
include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];

if($r =='Cashier'){

header("location:./../../../index.php");
}
if($r =='admin'){

include_once("sidebar.php");
}
?>




<link rel="stylesheet" href="datepicker.css"
        type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js"
        type="text/javascript"></script>
 <script type="text/javascript">
     
		 $(function(){
        $("#datepicker1").datepicker({ dateFormat: 'yy/mm/dd' });
        $("#datepicker2").datepicker({ dateFormat: 'yy/mm/dd' });
       
    });

    </script>




    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Item Report
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>
   
   
   
    
     <form action="inventory_rp.php" method="get">   
	<center>
	
			  
			  
			<strong>

From :<input type="text" style="width:223px; padding:4px;" name="d1" id="datepicker" value="" autocomplete="off" /> 
To:<input type="text" style="width:223px; padding:4px;" name="d2" id="datepickerd"  value="" autocomplete="off"/>

 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
 <i class="icon icon-search icon-large"></i> Search
 </button>
 
</strong>  
			  
		<br>	  
			  
         <h4> Report from&nbsp;<i class=" text-primary "><?php echo $_GET['d1'] ?></i>&nbsp;to&nbsp;<i class=" text-primary "><?php echo $_GET['d2'] ?> </i>  </h4>
			 
			 </center>
			 </form>
   
   
   
   <section class="content">
   
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sales Item Report</h3>
            </div>
            <!-- /.box-header -->
			
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
			  
                <thead>
                <tr>
                  <th>Code</th>
				  <th>Name</th>
                  <th>Sell QTY</th>
                  <th>Cost</th>
                  <th>Sales</th>
                  <th>Margin</th>
                </tr>
				
                </thead>
				
                              <tbody>
				<?php
   $d1=$_GET['d1'];
   $d2=$_GET['d2'];
   $tot_amount=0;
   $tot=0;
  
	   
	$result = $db->prepare("SELECT sum(sales_list.amount),sum(sales_list.cost),sum(sales_list.qty),sales_list.product_id,sales_list.name  FROM  sales JOIN sales_list ON sales.invoice_number=sales_list.invoice_no WHERE  sales.action='active' AND  sales.date BETWEEN '$d1' AND '$d2' GROUP BY sales_list.product_id ");
	$result->bindParam(':userid', $res);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
            $co_id = $row['product_id'];
			
				
			?>
                <tr>
				  <td><?php echo $row['product_id'];?></td>
				  <td><?php echo $row['name'];?></td>
                  
                  <td><?php echo $row['sum(sales_list.qty)'];?></td>
                  <td><?php echo $row['sum(sales_list.cost)']  ?></td>
                  <td><?php echo $row['sum(sales_list.amount)']  ?></td>
                  <td><?php echo $row['sum(sales_list.amount)']-$row['sum(sales_list.cost)']  ?></td>
                </tr>
           <?php $tot_amount+=$row['sum(sales_list.amount)']; $tot+=$row['sum(sales_list.amount)']-$row['sum(sales_list.cost)']; } ?>    
                
                </tbody>
                <tfoot>
                <tr>
                <th colspan="4">Total</th>
                <th>Rs.<?php echo $tot_amount ?></th>
                <th>Rs.<?php echo $tot; ?></th>
                </tr>
				
				
				
				
				
				
                </tfoot>
              </table>
				<center>
				<h3>Margin Total Rs.<?php echo $tot; ?>.00</h3>
					</center>
			<a href="#=<?php echo $_GET['d1']; ?>&d2=<?php echo $_GET['d2']; ?>"><button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" >
 <i class="icon icon-search icon-large"></i> print
 </button></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      
   
   
   

    <!-- Main content -->
    
      <!-- /.row -->

    </section>
    <!-- /.content -->
   </div>
  <!-- /.content-wrapper -->
<?php
  include("dounbr.php");
?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
	
	
	$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepicker').datepicker({ autoclose: true });
	
	
	
	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepickerd').datepicker({ autoclose: true  });
	
</script>
</body>
</html>

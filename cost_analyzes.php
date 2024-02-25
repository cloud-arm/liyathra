<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
date_default_timezone_set("Asia/Colombo");
?>

<body class="hold-transition skin-blue sidebar-mini ">
    <?php
    include_once("auth.php");
    $r = $_SESSION['SESS_LAST_NAME'];

    if ($r == 'Cashier') {

        include_once("sidebar2.php");
    }
    if ($r == 'admin') {

        include_once("sidebar.php");
    }
    ?>

    <link rel="stylesheet" href="datepicker.css" type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#datepicker1").datepicker({
                dateFormat: 'yy/mm/dd'
            });
            $("#datepicker2").datepicker({
                dateFormat: 'yy/mm/dd'
            });

        });
    </script>

    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Cost Analyzes
                <small>Report</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <?php
            include("connect.php");
            date_default_timezone_set("Asia/Colombo");

            $d1 = $_GET['d1'];
            $sales = 0;
            $expenses = 0;
            $labor = 0;
            $result = $db->prepare("SELECT sum(amount) FROM sales WHERE action='active' AND date = '$d1' ");
            $result->bindParam(':userid', $date);
            $result->execute();
            for ($i = 0; $row = $result->fetch(); $i++) {
                $sales = $row['sum(amount)'];
            }

            $result = $db->prepare("SELECT sum(amount) FROM expenses_records WHERE  date ='$d1' ");
            $result->bindParam(':userid', $date);
            $result->execute();
            for ($i = 0; $row = $result->fetch(); $i++) {
                $expenses = $row['sum(amount)'];
            }
            ?>
            <div class="box box-info">

                <div class="box-header with-border">
                    <h3 class="box-title" style="text-transform: capitalize;">Cost Analyzes</h3>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box-body d-block">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount (Rs.)</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <th>Today Sales</th>
                                        <th><?php echo number_format($sales, 2); ?></th>
                                    </tr>

                                    <tr>
                                        <th>Expenses</th>
                                        <th><?php echo number_format($expenses, 2); ?></th>
                                    </tr>
                                    <?php $util = 0;
                                    $result = $db->prepare("SELECT * FROM util_meter_record WHERE  date ='$d1' ");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for ($i = 0; $row = $result->fetch(); $i++) {
                                    ?>
                                        <tr>
                                            <th><?php echo $row['name']; ?></th>
                                            <th><?php echo $row['amount']; ?></th>
                                            <?php $util += $row['amount']; ?>
                                        </tr>

                                    <?php }  ?>

                                    <tr>
                                        <th>Profit</th>
                                        <th><?php echo $sales - $expenses - $util; ?></th>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>

    <!-- /.content-wrapper -->
    <?php
    include("dounbr.php");
    ?>
    <div class="control-sidebar-bg"></div>
    </div>

    <!-- jQuery 2.2.3 -->
    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="../../plugins/select2/select2.full.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Dark Theme Btn-->
    <script src="https://dev.colorbiz.org/ashen/cdn/main/dist/js/dark_theme_btn.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#example").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>



    <!-- Page script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();

            //Date range picker
            $('#reservation').daterangepicker();
            //Date range picker with time picker
            //$('#datepicker').datepicker({datepicker: true,  format: 'yyyy/mm/dd '});
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
            );

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                datepicker: true,
                format: 'yyyy/mm/dd '
            });
            $('#datepicker').datepicker({
                autoclose: true
            });

            $('#datepickerd').datepicker({
                autoclose: true,
                datepicker: true,
                format: 'yyyy/mm/dd '
            });
            $('#datepickerd').datepicker({
                autoclose: true
            });


        });
    </script>

</body>

</html>
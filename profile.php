<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>

<body class="hold-transition skin-blue sidebar-mini">
    <?php
    include_once("auth.php");
    $r = $_SESSION['SESS_LAST_NAME'];

    if ($r == 'Cashier') {

        header("location:./../../../index.php");
    }
    if ($r == 'admin') {

        include_once("sidebar.php");
    }
    ?>

    <style>
        #job-cont::-webkit-scrollbar {
            display: none;
        }
    </style>



    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Profile
                <small>Preview</small>
            </h1>
        </section>


        <!-- Main content -->
        <section class="content">
            <?php
            $id = $_GET['id'];
            $result = $db->prepare("SELECT * FROM customer WHERE id='$id' ");
            $result->bindParam(':userid', $res);
            $result->execute();
            for ($i = 0; $row = $result->fetch(); $i++) {
                $name = $row['name'];
                $address = $row['address'];
                $contact = $row['contact'];
                $email = $row['email'];
            }
            ?>
            <? if (false) { ?>
                <div id="job-cont" style="overflow-x: scroll; width: 100%;position: relative; margin-left: 25px; margin-top: 25px;">
                    <div class="row" style="display: flex;">

                        <?php
                        $result = $db->prepare("SELECT * FROM job WHERE cus_id='$id' ");
                        $result->bindParam(':userid', $res);
                        $result->execute();
                        for ($i = 0; $row = $result->fetch(); $i++) { ?>

                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-green" style="border-radius: 10px; min-width: 255px; min-height: 130px;">
                                    <div class="inner">
                                        <h3><?php echo $row['type_name']; ?></h3>
                                        <p><?php echo $row['app_date']; ?></p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            <? } ?>

            <div class="row">
                <div class="col-md-3">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">


                            <h3 class="profile-username text-center"><?php echo $name; ?></h3>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Address:</b> <i><?php echo $address; ?></i>
                                </li>
                                <li class="list-group-item">
                                    <b>Contact:</b> <i><?php echo $contact; ?></i>
                                </li>
                                <li class="list-group-item">
                                    <b>Email:</b> <i><?php echo $email; ?></i>
                                </li>
                            </ul>

                            <a href="cus_view.php" class="btn btn-primary btn-block m-0"><b>Back</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.col (left) -->


                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">INVOICE</a></li>
                            <li class=""><a href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="active tab-pane" id="activity">
                                <!-- Post -->

                                <ul class="timeline timeline-inverse">
                                    <?php
                                    $result1 = $db->prepare("SELECT * FROM sales WHERE customer_id='$id' AND action='active' ORDER by transaction_id DESC ");
                                    $result1->bindParam(':userid', $res);
                                    $result1->execute();
                                    for ($i = 0; $row = $result1->fetch(); $i++) {
                                    ?>
                                        <!-- timeline time label -->
                                        <li class="time-label">
                                            <span class="bg-blue">
                                                <?php echo $row['date']; ?>
                                            </span>
                                        </li>
                                        <li>
                                            <i class="fa fa-check bg-green"></i>
                                            </i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i>
                                                    <?php echo $row['time']; ?></span>
                                                <h3 class="timeline-header"><a href="#">Invoice no:</a>
                                                    <?php echo $row['invoice_number']; ?></h3>
                                                <div class="timeline-body">
                                                    <a class="btn btn-warning btn-xs"><?php echo $row['comment']; ?></a>
                                                    <table id="example2" class="table table-bordered table-hover ">
                                                        <tr>
                                                            <th>Product Name</th>
                                                            <th>QTY</th>
                                                            <th>Dic (Rs.)</th>
                                                            <th>Price (Rs.)</th>
                                                        </tr>
                                                        <?php $invo = $row['invoice_number'];
                                                        $total = 0;
                                                        $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invo' ");
                                                        $result->bindParam(':userid', $res);
                                                        $result->execute();
                                                        for ($i = 0; $row1 = $result->fetch(); $i++) {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $row1['name']; ?></td>
                                                                <td><?php echo $row1['qty']; ?></td>
                                                                <td><?php echo $row1['dic']; ?></td>
                                                                <td><?php echo $row1['price']; ?></td>
                                                            </tr>
                                                        <?php

                                                        }    ?>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Total Amount</td>
                                                            <td>Rs.<?php echo $row['amount']; ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="timeline-footer">
                                                    <?php $job_no = $row['job_no'];
                                                    $result = $db->prepare("SELECT * FROM sales WHERE  job_no='$job_no' AND action='Quotations' ");
                                                    $result->bindParam(':id', $res);
                                                    $result->execute();
                                                    for ($i = 0; $row1 = $result->fetch(); $i++) {   ?>
                                                        <a href="bill.php?id=<?php echo $row['invoice_number']; ?>" class="btn btn-success btn-xs">Quotations (Rs.<?php echo $row1['amount']; ?>)</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </li>

                                    <?php }  ?>

                                </ul>

                                <!-- /.post -->
                            </div>

                            <div class="tab-pane" id="settings">
                                <form method="post" action="profile_save.php" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Contact</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="contact" value="<?php echo $contact; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" placeholder="Address">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">E-mail</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="E-mail">
                                        </div>
                                    </div>

                                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> I agree to <a href="#">Submit</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.box-body -->


                <!-- /.box -->

                <!-- /.col (right) -->
            </div>
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
    <!-- Select2 -->
    <script src="../../plugins/select2/select2.full.min.js"></script>
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
    <!-- Page script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();

            //Date range picker
            $('#reservation').daterangepicker();
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                format: 'YYYY/MM/DD h:mm A'
            });
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                        'MMMM D, YYYY'));
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

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

        });
    </script>
</body>

</html>
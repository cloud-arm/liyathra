<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
date_default_timezone_set("Asia/Colombo");
?>

<body class="hold-transition skin-blue sidebar-mini">
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

    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Product
                <small>Preview</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- SELECT2 EXAMPLE -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Product </h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body d-block">
                    <form method="post" action="product_save.php">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Item Type</label>
                                    <select class="form-control" name="type" id="pro_sel" style="width: 100%;" onchange="select_type()" tabindex="2">
                                        <option>Service</option>
                                        <option>Materials</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3" id="serve_type">
                                <div class="form-group">
                                    <label>Service Type</label>
                                    <select class="form-control" name="serve_type" style="width: 100%;" tabindex="3">
                                        <?php
                                        $result = $db->prepare("SELECT * FROM job_type ");
                                        $result->bindParam(':userid', $ttr);
                                        $result->execute();
                                        for ($i = 0; $row = $result->fetch(); $i++) {
                                        ?>
                                            <option value="<?php echo $id = $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" tabindex="1" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" step=".01" name="price" class="form-control" tabindex="4" autocomplete="off">
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </section>


        <!-- /.box -->

        <section class="content">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Product List</h3>
                </div>

                <?php $sql = " SELECT * FROM product  "; ?>

                <div class="box-body d-block">
                    <table id="example" class="table table-bordered table-striped" style="border-radius: 0;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Service Type</th>
                                <th>Price</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $tot = 0;
                            $result = $db->prepare($sql);
                            $result->bindParam(':userid', $date);
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) { ?>

                                <tr class="record">
                                    <td><?php echo $row['id'];   ?> </td>
                                    <td><?php echo $row['name'];   ?> </td>
                                    <td><?php echo $row['type']; ?> </td>
                                    <td><?php echo $row['type_name']; ?> </td>
                                    <td><?php echo $row['sell'];  ?></td>
                                    <td><a href="#" id="<?php echo $row['id']; ?>" class="delbutton btn btn-danger" title="Click to Delete">
                                            <i class="icon-trash">x</i></a>
                                    </td>
                                </tr>
                            <?php }   ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <?php include("dounbr.php"); ?>

    <div class="control-sidebar-bg"></div>
    </div>

    <?php include("script.php"); ?>

    <script type="text/javascript">
        function select_type() {
            let val = $('#pro_sel').val();

            if (val == 'Service') {
                $('#serve_type').css('display', 'block');
            } else {
                $('#serve_type').css('display', 'none');
            }

        }


        $(function() {


            $(".delbutton").click(function() {

                //Save the link in a variable called element
                var element = $(this);

                //Find the id of the link that was clicked
                var del_id = element.attr("id");

                //Built a url to send
                var info = 'id=' + del_id;
                if (confirm("Sure you want to delete this Collection? There is NO undo!")) {

                    $.ajax({
                        type: "GET",
                        url: "product_dll.php",
                        data: info,
                        success: function() {}
                    });
                    $(this).parents(".record").css({
                        'opacity': '0.5',
                        'cursor': 'default'
                    })
                    $(this).remove();

                }

                return false;

            });

        });



        $(function() {
            $("#example1").DataTable();
            $('#example').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": true
            });
        });
    </script>

    <!-- Page script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();

            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("YYYY/MM/DD", {
                "placeholder": "YYYY/MM/DD"
            });
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("YYYY/MM/DD", {
                "placeholder": "YYYY/MM/DD"
            });
            //Money Euro
            $("[data-mask]").inputmask();

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
                format: 'yyyy-mm-dd '
            });
            $('#datepicker').datepicker({
                autoclose: true
            });


            $('#datepicker_set').datepicker({
                autoclose: true,
                datepicker: true,
                format: 'yyyy-mm-dd '
            });
            $('#datepicker_set').datepicker({
                autoclose: true
            });


            $('#datepickerd').datepicker({
                autoclose: true,
                datepicker: true,
                format: 'yyyy-mm-dd '
            });
            $('#datepickerd').datepicker({
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

            //Colorpicker
            $(".my-colorpicker1").colorpicker();
            //color picker with addon
            $(".my-colorpicker2").colorpicker();

            //Timepicker
            $(".timepicker").timepicker({
                showInputs: false
            });
        });
    </script>

</body>

</html>
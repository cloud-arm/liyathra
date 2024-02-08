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

    $id = $_GET['id'];
    ?>




    <link rel="stylesheet" href="datepicker.css" type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js" type="text/javascript"></script>

    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <section class="content-header">
            <h1>
                Employee
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Advanced Elements</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <?php if ($id == '0') { ?>

                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Employee</h3>
                            </div>

                            <div class="box-body d-block">

                                <form method="POST" action="hr_employee_save.php" class="w-100">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone No</label>
                                                <input type="text" name="phone_no" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>NIC</label>
                                                <input type="text" name="nic" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Month Rate</label>
                                                <input type="text" name="rate" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>OT Rate</label>
                                                <input type="text" name="ot" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>EPF NO</label>
                                                <input type="text" name="etf_no" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>EPF Amount</label>
                                                <input type="text" name="etf_amount" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Welfare Amount</label>
                                                <input type="text" name="well_amount" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <select class="form-control" name="type">
                                                    <?php
                                                    $result = $db->prepare("SELECT * FROM Employees_des ");
                                                    $result->bindParam(':userid', $res);
                                                    $result->execute();
                                                    for ($i = 0; $row = $result->fetch(); $i++) {
                                                    ?>
                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 pull-right">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="0">
                                                <input type="submit" value="Save" class="btn btn-success">
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>


                    <?php } else { ?>

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Update Employee</h3>
                            </div>

                            <?php
                            $id = $_GET['id'];

                            $result = $db->prepare("SELECT * FROM Employees WHERE id=:id ");
                            $result->bindParam(':id', $id);
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $address = $row['address'];
                                $phone_no = $row['phone_no'];
                                $hour_rate = $row['hour_rate'];
                                $nic = $row['nic'];
                                $des = $row['des'];
                                $epf_no = $row['epf_no'];
                                $epf_amount = $row['epf_amount'];
                                $well = $row['well'];
                                $ot = $row['ot'];
                                $type = $row['type'];
                            } ?>

                            <div class="box-body d-block">

                                <form method="POST" action="hr_employee_save.php" class="w-100">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" value="<?php echo $name; ?>" name="name" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" value="<?php echo $address; ?>" name="address" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone No</label>
                                                <input type="text" value="<?php echo $phone_no; ?>" name="phone_no" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>NIC</label>
                                                <input type="text" value="<?php echo $nic; ?>" name="nic" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Month Rate</label>
                                                <input type="text" value="<?php echo $rate; ?>" name="rate" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>OT Rate</label>
                                                <input type="text" value="<?php echo $ot; ?>" name="ot" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>EPF NO</label>
                                                <input type="text" value="<?php echo $epf_no; ?>" name="etf_no" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>EPF Amount</label>
                                                <input type="text" value="<?php echo $epf_amount; ?>" name="etf_amount" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Welfare Amount</label>
                                                <input type="text" value="<?php echo $well; ?>" name="well_amount" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <select class="form-control" name="type">
                                                    <?php
                                                    $result = $db->prepare("SELECT * FROM Employees_des ");
                                                    $result->bindParam(':userid', $res);
                                                    $result->execute();
                                                    for ($i = 0; $row = $result->fetch(); $i++) {
                                                    ?>
                                                        <option value="<?php echo $rid = $row['id']; ?>" <?php if ($type == $rid) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?php echo $row['name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 pull-right">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="0">
                                                <input type="submit" value="Update" class="btn btn-success">
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Employee List</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone NO</th>
                                        <th>NIC</th>
                                        <th>EPF</th>
                                        <th>EPF No</th>
                                        <th>Designation</th>
                                        <th>Day Rate</th>
                                        <th>#</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $result = $db->prepare("SELECT * FROM Employees   ");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for ($i = 0; $row = $result->fetch(); $i++) {    ?>
                                        <tr class="record">
                                            <td><?php echo $id = $row['id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['phone_no']; ?></td>
                                            <td><?php echo $row['nic']; ?></td>
                                            <td>Rs.<?php echo $row['epf_amount']; ?></td>
                                            <td><?php echo $row['epf_no']; ?></td>
                                            <td><?php echo $row['des']; ?></td>
                                            <td>Rs.<?php echo $row['hour_rate']; ?></td>
                                            <td style="display: flex; align-items: center;justify-content: space-around;">
                                                <a href="#" id="<?php echo $row['id']; ?>" class="dll_btn btn btn-danger" title="Click to Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <a href="hr_employee_profile.php?id=<?php echo $id; ?>" class="btn btn-info" title="Click to View Profile">
                                                    <i class="fa fa-user"></i>
                                                </a>
                                                <a href="hr_employee.php?id=<?php echo $row['id']; ?>" class="up_btn btn btn-warning" title="Click to Delete">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php  }  ?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

            </div>

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
    <!-- page script -->
    <script>
        $(function() {

            $(".dll_btn").click(function() {
                var element = $(this);
                var id = element.attr("id");
                var info = 'id=' + id;
                if (confirm("Sure you want to delete this Collection? There is NO undo!")) {

                    $.ajax({
                        type: "GET",
                        url: "hr_employee_dll.php",
                        data: info,
                        success: function() {

                        }
                    });
                    $(this).parents(".record").animate({
                            backgroundColor: "#fbc7c7"
                        }, "fast")
                        .animate({
                            opacity: "hide"
                        }, "slow");
                }
                return false;
            });

        });

        $(function() {
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
    </script>
</body>

</html>
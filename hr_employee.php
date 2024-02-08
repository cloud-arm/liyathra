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
    <script type="text/javascript">
        $(function() {
            $(".delbutton").click(function() {
                //Save the link in a variable called element
                var element = $(this);
                //Find the id of the link that was clicked
                var del_id = element.attr("id");
                //Built a url to send
                var info = 'id=' + del_id;
                if (confirm("Sure you want to delete this Product? There is NO undo!")) {
                    $.ajax({
                        type: "GET",
                        url: "sales_dll.php",
                        data: info,
                        success: function() {}
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
    </script>




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
                <div class="col-md-12">
                    <?php if ($id == '0') { ?>

                        <div id="myModal" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="close">&times;</span>
                                    <center>
                                        <h4>Save New Employee</h4>
                                    </center>

                                </div>
                                <div class="modal-body">
                                    <form method="post" action="hr_employee_save.php">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4>Full Name</h4>
                                                        <input class="form-control" type="text" name="name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4>Phone No</h4>
                                                        <input class="form-control" type="text" name="phone_no">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4>NIC</h4>
                                                        <input class="form-control" type="text" name="nic">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4>Address</h4>
                                                        <input class="form-control" type="text" name="address">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4>Month Rate</h4>
                                                        <input class="form-control" type="text" name="rate">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4>OT Rate</h4>
                                                        <input class="form-control" type="text" name="ot">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4>EPF NO</h4>
                                                        <input class="form-control" type="text" name="etf_no">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4>EPF Amount</h4>
                                                        <input class="form-control" type="text" name="etf_amount">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4>Allowance</h4>
                                                        <input class="form-control" type="text" name="allow">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4>Welfare Amount</h4>
                                                        <input class="form-control" type="text" name="well_amount">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4>Designation</h4>
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
                                            </div>
                                        </div>
                                        <!-- /.box -->
                                        <input class="btn btn-info" type="submit" value="Save">
                                    </form>
                                </div>

                            </div>
                        </div>

                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Employee</h3>
                            </div>

                            <div class="box-body d-block">

                                <form method="POST" action="hr_employee_save.php" class="w-100">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Phone No</label>
                                                <input type="text" name="phone_no" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>NIC</label>
                                                <input type="text" name="nic" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Month Rate</label>
                                                <input type="text" name="rate" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>OT Rate</label>
                                                <input type="text" name="ot" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>EPF NO</label>
                                                <input type="text" name="etf_no" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>EPF Amount</label>
                                                <input type="text" name="etf_amount" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Welfare Amount</label>
                                                <input type="text" name="well_amount" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
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

                                        <div class="col-md-3" style="height: 75px;display: flex; align-items: end;">
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
                                $allowance = $row['allowance'];
                                $well = $row['well'];
                                $ot = $row['ot'];
                            } ?>

                            <div class="box-body d-block">

                                <form method="POST" action="hr_employee_save.php" class="w-100">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" value="<?php echo $name; ?>" name="name" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" value="<?php echo $name; ?>" name="address" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Phone No</label>
                                                <input type="text" value="<?php echo $name; ?>" name="phone_no" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>NIC</label>
                                                <input type="text" value="<?php echo $name; ?>" name="nic" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Month Rate</label>
                                                <input type="text" value="<?php echo $name; ?>" name="rate" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>OT Rate</label>
                                                <input type="text" value="<?php echo $name; ?>" name="ot" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>EPF NO</label>
                                                <input type="text" value="<?php echo $name; ?>" name="etf_no" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>EPF Amount</label>
                                                <input type="text" value="<?php echo $name; ?>" name="etf_amount" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Allowance</label>
                                                <input type="text" value="<?php echo $name; ?>" name="allow" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Welfare Amount</label>
                                                <input type="text" value="<?php echo $name; ?>" name="well_amount" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
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

                                        <div class="col-md-3" style="height: 75px;display: flex; align-items: end;">
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
                                        <tr>
                                            <td><?php echo $id = $row['id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $vehi = $row['phone_no']; ?></td>
                                            <td><?php echo $row['nic']; ?></td>
                                            <td>Rs.<?php echo $row['epf_amount']; ?></td>
                                            <td><?php echo $row['epf_no']; ?></td>
                                            <td><?php echo $row['des']; ?></td>
                                            <td>Rs.<?php echo $row['hour_rate']; ?></td>
                                            <td><a href="hr_employee_profile.php?id=<?php echo $id; ?>"><button class="btn btn-info"><i class="fa fa-user"></i></button></a></td>

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
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


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
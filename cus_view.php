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
  <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CUSTOMER
        <small>Preview</small>
      </h1>
    </section>
    <section class="content">

      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Customer Data</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">

            <thead>
              <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>E-Mail</th>
                <th>View</th>
              </tr>

            </thead>

            <tbody>
              <?php

              $result = $db->prepare("SELECT * FROM customer   ");
              $result->bindParam(':userid', $date);
              $result->execute();
              for ($i = 0; $row = $result->fetch(); $i++) {
              ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['contact']; ?></td>
                  <td><?php echo $row['email']  ?></td>

                  <td><a href="profile.php?id=<?php echo $row['id']; ?>">
                      <button class="btn btn-info"><i class="glyphicon glyphicon-user"></i></button></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
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
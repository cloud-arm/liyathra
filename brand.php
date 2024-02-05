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
$r=$_SESSION['SESS_LAST_NAME'];

if($r =='Cashier'){
header("location: app/");
}
if($r =='admin'){
include_once("sidebar.php");
}

$id=$_GET['id'];
?>



    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Brands
                <small>Preview</small>
            </h1>
            
        </section>

        <!-- add item -->
        <section class="content">

            <div class="row">
                <div class="col-md-6">

                    <?php if($id == '0'){ ?>

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Brand</h3>
                        </div>

                        <div class="box-body d-block">

                            <form method="POST" action="brand_save.php" class="w-100">
                                        
                                <div class="row" style="display: flex; align-items: end;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Brand Name</label>
                                            <input type="text" name="name" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Brand Img</label>
                                            <label class="form-control m-0" style="display: inline-block; cursor: pointer;">
                                                <input type="file" id="img"  accept=".jpg, .jpeg, .png" name="img" style="display: none" autocomplete="off">
                                                <i class="fa fa-cloud-upload"></i> Upload Img
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="0">
                                            <input type="submit" value="Submit" class="btn btn-success">
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                    <?php }else{ ?>

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Brand</h3>
                        </div>

                        <?php 
                        $id=$_GET['id']; $name=''; 
                        
                        $result = $db->prepare("SELECT * FROM brand WHERE id=:id ");
                        $result->bindParam(':id', $id);
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){  
                            $id = $row['id'];
                            $name = $row['name'];
                        }?>

                        <div class="box-body d-block">

                            <form method="POST" action="brand_save.php" class="w-100">
                                        
                                <div class="row" style="display: flex; align-items: end;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Brand Name</label>
                                            <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Brand Img</label>
                                            <label class="form-control m-0" style="display: inline-block; cursor: pointer;">
                                                <input type="file" id="img"  accept=".jpg, .jpeg, .png" name="img" style="display: none" autocomplete="off">
                                                <i class="fa fa-cloud-upload"></i> Upload Img
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <input type="submit" value="Update" class="btn btn-info">
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                    <?php }?>

                </div>

                <div class="col-md-6">

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Brand List</h3>
                        </div>
                        <div class="box-body d-block">
                            <table id="example2" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th></th>
                                        <th>Name</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                    
                                        $result = $db->prepare("SELECT * FROM brand  ");
                                        $result->bindParam(':id', $date);
                                        $result->execute();
                                        for($i=0; $row = $result->fetch(); $i++){  ?>

                                        <tr class="record">
                                            <td><?php echo $row['id'];   ?> </td>
                                            <td align="center"><img src="<?php echo $row['img']; ?>" alt="" width="40px"></td>
                                            <td><?php echo $row['name'];   ?></td>

                                            <td align="center">
                                                <a href="#" id="<?php echo $row['id']; ?>" class="dll_btn btn btn-danger" title="Click to Delete">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </a>
                                                <a href="brand.php?id=<?php echo $row['id']; ?>" class="up_btn btn btn-warning" title="Click to Delete">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            </td>

                                        </tr>

                                    <?php }   ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </section>
    <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <?php include("dounbr.php"); ?>

    <div class="control-sidebar-bg"></div>

    <!-- ./wrapper -->

    <?php  include("script.php"); ?>


    <script type="text/javascript">

        $(function() {

            $(".dll_btn").click(function() {
                var element = $(this);
                var id = element.attr("id");
                var info = 'id=' + id;
                if (confirm("Sure you want to delete this Collection? There is NO undo!")) {

                    $.ajax({
                        type: "GET",
                        url: "brand_dll.php",
                        data: info,
                        success: function() {

                        }
                    });
                    $(this).parents(".record").animate({backgroundColor: "#fbc7c7"}, "fast")
                        .animate({opacity: "hide"}, "slow");
                }
                return false;
            });

        });

        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": true,
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


        //Date picker
        $('#datepicker').datepicker({
            autoclose: true,
            datepicker: true,
            format: 'yyyy-mm-dd '
        });
        $('#datepicker').datepicker({
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

        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });
    });
    </script>


</body>

</html>
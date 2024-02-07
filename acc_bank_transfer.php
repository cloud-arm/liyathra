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
                BANK TRANSFER &WITHDRAW
                <small>Preview</small>
            </h1>

        </section>
        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
            <div class="row">

                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Transfer Select</h3>
                            <!-- /.box-header -->
                        </div>
                        <div class="form-group">
                            <div class="box-body d-block">
                                <div class="row">

                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <label>Bank Accounts</label>
                                                </div>

                                                <select class="form-control select2" name="bank" id="b_sel" onchange="bank_select()" style="width: 100%;" tabindex="1" autofocus>

                                                    <?php
                                                    $result = $db->prepare("SELECT * FROM bank ");
                                                    $result->bindParam(':userid', $res);
                                                    $result->execute();
                                                    for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                                        <option value="<?php echo $row['id']; ?>">
                                                            <?php echo $row['name']; ?> -<?php echo $row['ac_no']; ?>
                                                        </option>
                                                    <?php    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9" style="display: none;" id="err">
                                        <h4 class="text-danger " style="margin-left: 50px; text-align: center;">Select transfer method</h4>
                                    </div>

                                    <div class="col-md-10 mt-2" style="display:flex; justify-content: center; margin: 25px 0 0 20px; ">
                                        <div class="form-group ">
                                            <span class="btn btn-primary btn-lg m-0 me-2 acc" id="cash" onclick="acc_type('cash')">Cash Deposit</span>
                                            <span class="btn btn-warning btn-lg m-0 ms-2 acc" id="chq" onclick="acc_type('chq')">Chq Deposit</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" id="cash_box" style="display: none;">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cash Deposit</h3>
                            <!-- /.box-header -->
                        </div>
                        <div class="form-group">
                            <div class="box-body d-block">
                                <form method="POST" action="acc_bank_transfer_save.php">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <?php $mn = 0;
                                            $result = $db->prepare("SELECT * FROM cash WHERE id=2");
                                            $result->bindParam(':id', $res);
                                            $result->execute();
                                            for ($i = 0; $row = $result->fetch(); $i++) {
                                                $mn = $row['amount'];
                                            }
                                            ?>
                                            <div class="form-group ">
                                                <h3 class="" style="text-align: center; margin-bottom: 25px"> Main Balance <small>Rs.</small> <?php echo $mn; ?> </h3>
                                                <input type="hidden" id="main_blc" value="<?php echo $mn; ?>">
                                            </div>

                                        </div>

                                        <div class="col-md-1"></div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label>Transfer Amount</label>
                                                <input class="form-control" type="number" name="amount" id="pay_txt" onkeyup="checking()" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-5" style="display:flex; justify-content: center; margin-top: 20px;">
                                            <input type="hidden" name="bank" id="txt_bank" value="">
                                            <input type="hidden" name="type" id="txt_acc" value="">
                                            <input class="btn btn-danger" type="submit" id="btn_tr" value="Transfer" disabled>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" id="chq_box" style="display: none;">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Chq Deposit</h3>
                            <!-- /.box-header -->
                        </div>
                        <div class="form-group">
                            <div class="box-body d-block">
                                <table id="example2" class="table table-bordered table-hover" style="border-radius: 0;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Chq No</th>
                                            <th>Chq Bank</th>
                                            <th>Chq Date</th>
                                            <th>Amount (Rs.)</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0;
                                        $style = "";
                                        $result = $db->prepare("SELECT * FROM payment WHERE action=0 AND pay_type='Chq' ");
                                        $result->bindParam(':userid', $res);
                                        $result->execute();
                                        for ($i = 0; $row = $result->fetch(); $i++) {
                                        ?>
                                            <tr id="re_<?php echo $row['id']; ?>">
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['chq_no']; ?></td>
                                                <td><?php echo $row['chq_bank']; ?></td>
                                                <td><?php echo $row['chq_date']; ?></td>
                                                <td><?php echo $row['amount']; ?></td>
                                                <td> <a href="#" id="<?php echo $row['id']; ?>" class="deposit_btn btn btn-success" title="Click to Deposit"> <i class="fa-solid fa-money-bill-transfer"></i></a></td>
                                                <?php $total += $row['amount']; ?>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>

                                </table>
                                <h4>Total Rs <b><?php echo number_format($total, 2); ?></h4>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Withdraw Select</h3>
                            <!-- /.box-header -->
                        </div>
                        <div class="form-group">
                            <div class="box-body d-block">
                                <form method="POST" action="acc_bank_transfer_save.php">
                                    <div class="row">

                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <label>Bank Accounts</label>
                                                    </div>

                                                    <select class="form-control select2" name="bank" id="bank_sel1" onchange="bank_withdraw()" style="width: 100%;" tabindex="1" autofocus>

                                                        <?php
                                                        $result = $db->prepare("SELECT * FROM bank ");
                                                        $result->bindParam(':userid', $res);
                                                        $result->execute();
                                                        for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                                            <option value="<?php echo $row['id']; ?>">
                                                                <?php echo $row['name']; ?> -<?php echo $row['ac_no']; ?>
                                                            </option>
                                                        <?php    } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <?php
                                            $result = $db->prepare("SELECT * FROM bank ");
                                            $result->bindParam(':id', $res);
                                            $result->execute();
                                            for ($i = 0; $row = $result->fetch(); $i++) {
                                                $id = $row['id'];
                                                if ($id != 1) {
                                                    $style = 'style="display: none;"';
                                                } ?>
                                                <div class="form-group acc-cont" id="acc_<?php echo $id; ?>" <?php echo $style; ?>>
                                                    <h5 style="text-align: center;">Account Bal: <small>Rs.</small> <?php echo $row['amount']; ?> </h5>
                                                    <input type="hidden" id="blc_<?php echo $id; ?>" value="<?php echo $row['amount']; ?>">
                                                </div>

                                            <?php } ?>
                                        </div>

                                        <div class="col-md-1"></div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label>Transfer Amount</label>
                                                <input class="form-control" type="number" name="amount" id="with_txt" onkeyup="check_withdraw()" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-5" style="display:flex; justify-content: center; margin-top: 20px;">
                                            <input type="hidden" name="type" value="withdraw">
                                            <input class="btn btn-danger" type="submit" id="btn_wi" value="Withdraw" disabled>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- /.content-wrapper -->
    <?php include("dounbr.php"); ?>

    <div class="control-sidebar-bg"></div>

    <?php include("script.php"); ?>


    <script type="text/javascript">
        function bank_withdraw() {
            var bank = $("#bank_sel1").val();

            $('.acc-cont').css('display', 'none');
            $('#acc_' + bank).css('display', 'block');
        }


        function check_withdraw() {
            let txt = $("#with_txt").val();
            var bank = $("#bank_sel").val();
            var blc = parseInt($("#blc_" + bank).val());

            if (0 >= txt || blc < txt) {
                $('#btn_wi').attr("disabled", "");
            } else {
                $('#btn_wi').removeAttr('disabled');
            }
        }

        function acc_type(type) {
            $(".acc").addClass("hover disabled");
            $("#" + type).removeClass("hover disabled");
            $("#txt_acc").val(type);
            $('#err').css('display', 'none');

            $('#txt_bank').val($('#b_sel').val());

            if (type == 'cash') {
                $('#cash_box').css('display', 'block')
            } else {
                $('#cash_box').css('display', 'none')
            }
            if (type == 'chq') {
                $('#chq_box').css('display', 'block')
            } else {
                $('#chq_box').css('display', 'none')
            }
        }

        function checking() {
            let txt = $("#pay_txt").val();
            let blc = parseInt($("#main_blc").val());
            console.log(blc);

            if (0 >= txt || blc < txt) {
                $('#btn_tr').attr("disabled", "");
            } else {
                $('#btn_tr').removeAttr('disabled');
            }

        }

        function bank_select() {
            $('#txt_bank').val($('#b_sel').val());
        }

        $(".deposit_btn").click(function() {
            var element = $(this);
            var id = element.attr("id");
            var bank = $('#b_sel').val();
            var info = 'type=chq&id=' + id + '&bank=' + bank;

            $.ajax({
                type: "POST",
                url: "acc_bank_transfer_save.php",
                data: info,
                success: function(res) {
                    $('#re_' + res).animate({
                            backgroundColor: "#fbc7c7"
                        }, "fast")
                        .animate({
                            opacity: "hide"
                        }, "slow");
                }
            });

        });

        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
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


            //Date picker
            $('#datepicker1').datepicker({
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

        });
    </script>

</body>

</html>
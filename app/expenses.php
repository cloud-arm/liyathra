<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLOUD ARM</title>

    <?php
    include("head.php");
    include("../connect.php");
    date_default_timezone_set("Asia/Colombo");

    ?>
</head>

<body class="bg-light customer">

    <div class="container-fluid container-md mt-4">
        <div class="box px-2 mb-0 mt-3 ">
            <div class="box-header px-0 mb-0">
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i></a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" aria-current="page" href="index.php"><i class="fa-solid fa-house me-2"></i>Home</a>
            </div>
        </div>
    </div>

    <div class="container flex my-3">
        <div class="box room-container">
            <div class="box-body room mt-0" style="padding: 30px 10px;">
                <div class="logo flex">
                    <h1>Expenses</h1>
                </div>

                <p>Expenses payment</p>

                <form action="expenses_save.php" method="POST" style="width: 100%;">

                    <h2>Enter payment date</h2>
                    <div class="form-group">
                        <label>Date*</label>
                        <input type="text" name="date" readonly value="<?php echo date("Y-m-d"); ?>" autocomplete="off" required class="form-input" placeholder="YYYY-mm-dd" id="d2" onclick="calender('d2')">
                    </div>

                    <h2>Select expenses type</h2>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-input">
                            <?php
                            $result = $db->prepare("SELECT * FROM expenses_types WHERE type_name != 'Utility_Bill' ");
                            $result->bindParam(':id', $res);
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                <option value="<?php echo $id = $row['sn']; ?>"> <?php echo $row['type_name']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <h2>Select pay type</h2>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="pay_type" id="pay_type" onchange="select_pay()" class="form-input">
                            <option value="cash"> Cash </option>
                            <option value="bank" disabled> Bank </option>
                        </select>
                    </div>

                    <h2 class="acc_sec">Select pay account</h2>
                    <div class="form-group acc_sec">
                        <label>Account</label>
                        <select name="acc" class="form-input">
                            <?php
                            $result = $db->prepare("SELECT * FROM cash ");
                            $result->bindParam(':userid', $ttr);
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) {
                            ?>
                                <option value="<?php echo $id = $row['id']; ?>" <?php if ($id == 1) { ?> selected <?php } ?>> <?php echo $row['name']; ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <h2 class="bank_sec" style="display: none;">Select bank account</h2>
                    <div class="form-group bank_sec" style="display: none;">
                        <label>Bank</label>
                        <select name="bank" class="form-input">
                            <?php
                            $result = $db->prepare("SELECT * FROM bank ");
                            $result->bindParam(':userid', $ttr);
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) {
                            ?>
                                <option value="<?php echo $id = $row['id']; ?>" <?php if ($id == 1) { ?> selected <?php } ?>> <?php echo $row['name'] . '__' . $row['dep_name']; ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <h2>Enter pay amount</h2>
                    <div class="form-group">
                        <label>Amount*</label>
                        <input type="number" name="pay_amount" autocomplete="off" required class="form-input" id="amount" onkeyup="checking()" placeholder="0.00">
                    </div>

                    <h2>Enter comment</h2>
                    <div class="form-group">
                        <label>Comment</label>
                        <input type="text" name="comment" autocomplete="off" class="form-input">
                    </div>

                    <div class="form-group" style="margin-top: 50px;">
                        <input type="submit" id="btn" disabled class="form-input" value="Save">
                        <input type="hidden" name="invo" value="exp<?php echo date("ymdhis"); ?>">
                        <input name="unit" type="hidden" value="1">
                        <input name="chq_no" type="hidden" value="">
                        <input name="chq_date" type="hidden" value="">
                        <input name="job_sec" type="hidden" value="">
                        <input name="util_id" type="hidden" value="">
                        <input name="util_date" type="hidden" value="">
                        <input name="util_invo" type="hidden" value="">
                        <input name="Util_amount" type="hidden" value="">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Date Picker -->
    <script src="js/datepik.js"></script>

    <script>
        function checking() {
            var val = $('#amount').val();
            if (val > 0) {
                $('#btn').removeAttr('disabled');
            } else {
                $('#btn').attr('disabled', '');
            }
        }

        function select_pay() {
            let val = $('#pay_type').val();

            if (val == 'cash') {
                $('.acc_sec').css('display', 'block');
            } else {
                $('.acc_sec').css('display', 'none');
            }
            if (val == 'bank') {
                $('.bank_sec').css('display', 'block');
            } else {
                $('.bank_sec').css('display', 'none');
            }

        }
    </script>
</body>

</html>
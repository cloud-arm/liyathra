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

    $user = $_GET['emp'];
    $cus_id = $_GET['cus'];

    $result = $db->prepare("SELECT * FROM customer WHERE id = '$cus_id' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $mobile = $row['contact'];
    }
    ?>
</head>

<body class="bg-light customer">
    <div class="container flex my-3">
        <div class="box room-container">
            <div class="box-body room " style="padding: 30px 10px;">
                <div class="logo flex">
                    <h1>Appointment</h1>
                </div>

                <p>Please enter name, contact & email address for customer registration</p>

                <form action="customer_save.php" method="POST" style="width: 100%;">

                    <h2>Enter customer name here</h2>
                    <div class="form-group">
                        <label>Name*</label>
                        <input type="text" name="name" class="form-input" autocomplete="off" required>
                    </div>

                    <h2>Enter customer email here</h2>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-input" autocomplete="off">
                    </div>

                    <h2>Enter customer mobile number</h2>
                    <div class="form-group">
                        <label>Mobile*</label>
                        <input type="number" name="mobile" value="<?php echo $mobile; ?>" autocomplete="off" required class="form-input" id="mobile" maxlength="10" onkeyup="checking()" placeholder="07********">
                    </div>

                    <div class="form-group" style="margin-top: 50px;">
                        <input type="submit" id="btn" class="form-input" value="Continue">
                        <input type="hidden" name="emp" value="<?php echo $user; ?>">
                        <input type="hidden" name="id" value="<?php echo $cus_id; ?>">
                        <input type="hidden" name="type" value="cus_add">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function checking() {

            let count = $('#mobile').val().length;
            var val = $('#mobile').val();

            if (count >= 10) {
                $('#mobile').attr('readonly', '');
            } else {
                $('#mobile').removeAttr('readonly');
            }

            if (val.charAt(0) == 0 && val.charAt(1) == 7) {
                $('#mobile').css('outline', '2px solid rgb(var(--bg-theme))');
            } else {
                $('#mobile').css('outline', '2px solid red');
            }

            if (event.which == 8) {
                $($('#mobile')).val(
                    function(index, value) {
                        return value.substr(0, value.length - 1);
                    })
            }
        }
    </script>
</body>

</html>
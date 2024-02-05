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

    $user = $_GET['id'];

    ?>
</head>

<body class="bg-light customer" style="overflow-y: scroll;">

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
            <div class="box-body room " style="padding: 30px 10px;">
                <div class="logo flex">
                    <h1>Appointment</h1>
                </div>

                <p>Please enter contact number for customer verification</p>

                <form action="customer_save.php" method="POST" style="width: 100%;">

                    <h2>Enter customer mobile number</h2>
                    <div class="form-group">
                        <label>Mobile*</label>
                        <input type="number" name="mobile" autocomplete="off" required class="form-input" id="mobile" maxlength="10" onkeyup="checking()" placeholder="07********">
                    </div>

                    <div class="form-group" style="margin-top: 50px;">
                        <input type="submit" id="btn" class="form-input" disabled value="Continue">
                        <input type="hidden" name="emp" value="<?php echo $user; ?>">
                        <input type="hidden" name="type" value="cus_check">
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

            if (count >= 10) {
                $('#btn').removeAttr('disabled');
            } else {
                $('#btn').attr('disabled', '');
            }

            if (val.charAt(0) == 0 && val.charAt(1) == 7) {
                $('#mobile').css('outline', '2px solid rgb(var(--bg-theme))');
            } else {
                $('#mobile').css('outline', '2px solid red');
                $('#btn').attr('disabled', '');
            }

            if (event.which == 8) {
                $($('#mobile')).val(
                    function(index, value) {
                        return value.substr(0, value.length - 1);
                        $('#btn').attr('disabled', '');
                    })
            }
        }
    </script>
</body>

</html>
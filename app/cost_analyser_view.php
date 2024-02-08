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

    $util = $_GET['id'];

    $re = $db->prepare("SELECT * FROM utility_bill WHERE id = :id ");
    $re->bindParam(':id', $util);
    $re->execute();
    for ($k = 0; $r = $re->fetch(); $k++) {
        $util_name = $r['name'];
        $meter = $r['meter'];
        $date = $r['last_date'];
    }
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
            <div class="box-body room " style="padding: 30px 10px;">
                <div class="logo flex">
                    <h1><?php echo $util_name; ?></h1>
                </div>

                <p>Please enter meter number for analyses cost</p>

                <form action="cost_analyser_save.php" method="POST" style="width: 100%;">

                    <h2><i class="fa-solid fa-arrow-up-1-9 me-2"></i>Last Meter: <?php echo $meter; ?></h2>

                    <h2><i class="fa-solid fa-calendar-days me-2"></i>Last Date: <?php echo $date; ?></h2>

                    <h2 class="mt-3">Enter meter number</h2>
                    <div class="form-group">
                        <label>Meter*</label>
                        <input type="number" name="meter" autocomplete="off" required class="form-input" id="mobile" onkeyup="checking()">
                    </div>

                    <div class="form-group" style="margin-top: 50px;">
                        <input type="submit" id="btn" class="form-input" disabled value="Continue">
                        <input type="hidden" name="util" value="<?php echo $util; ?>">
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

            var val = $('#mobile').val();

            if (val > 0) {
                $('#btn').removeAttr('disabled');
            } else {
                $('#btn').attr('disabled', '');
            }

        }
    </script>
</body>

</html>
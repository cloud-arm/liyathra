<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/datepik.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLOUD ARM</title>

    <?php
    include("head.php");
    include("../connect.php");
    date_default_timezone_set("Asia/Colombo");

    $job = $_GET['id'];

    $result = $db->prepare("SELECT * FROM job WHERE id = '$job' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $cus = $row['cus_id'];
        $customer = $row['cus_name'];
        $date = $row['app_date'];
        $time = $row['app_time'];
        $invo = $row['invoice_no'];
    }

    $result = $db->prepare("SELECT * FROM customer WHERE id = '$cus' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $customer = $row['name'];
        $contact = $row['contact'];
    }
    ?>

</head>

<body class="bg-light customer" style="--bg-background: 131, 109, 130; overflow-y: scroll;">

    <div class="container-fluid container-md mt-4">
        <div class="box px-2 mb-0 mt-3 ">
            <div class="box-header px-0 mb-0">
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i></a>
                <a class="nav-link border-0 btn fs-1 d-md-none edit_btn" aria-current="page" href="#"><i class="fa-solid fa-pen-to-square editor"></i><i class="fa-solid fa-xmark editor d-none"></i></a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" aria-current="page" href="index.php"><i class="fa-solid fa-house me-2"></i>Home</a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block edit_btn" aria-current="page" href="#"><i class="fa-solid fa-pen-to-square me-2 editor"></i><i class="fa-solid fa-xmark me-2 editor d-none"></i>Edit</a>
            </div>
        </div>
    </div>

    <div class="container flex mb-3">
        <div class="box room-container" style=" min-width: 100%;">
            <div class="box-body room " style="padding: 30px 10px;">
                <div class="logo flex">
                    <h1>Confirmation </h1>
                </div>

                <p>Appointment data sheet </p>


                <h2><i class="fa-solid fa-user mx-3"></i><?php echo $customer; ?></h2>

                <h2><i class="fa-solid fa-phone mx-3"></i><?php echo $contact; ?></h2>

                <form action="appointment_edit.php" id="edit_form" method="POST" style="width: 100%;">

                    <h2 style="margin-bottom: 1rem;"><i class="fa-solid fa-calendar-days mx-3"></i><span class="editor old"><?php echo $date; ?></span><span class="editor new d-none">Enter new date</span></h2>
                    <div class="form-group editor d-none">
                        <label>Date*</label>
                        <input type="text" name="date" readonly value="<?php echo $date; ?>" autocomplete="off" required class="form-input" placeholder="YYYY-mm-dd" id="d1" onclick="calender('d1')">
                    </div>

                    <h2><i class="fa-solid fa-clock mx-3"></i><span class="editor old"><?php echo $time; ?></span><span class="editor new d-none">Enter new date</span></h2>
                    <div class="form-group editor d-none">
                        <label>Time*</label>
                        <input type="text" name="time" value="<?php echo $time; ?>" autocomplete="off" required class="form-input" placeholder="HH:mm">
                    </div>
                    <input type="hidden" name="type" value="edit">
                    <input type="hidden" name="id" value="<?php echo $job; ?>">
                </form>

                <h2><i class="fa-solid fa-table-list mx-3"></i>Service</h2>

                <table class="w-100">
                    <?php
                    $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invo' ");
                    $result->bindParam(':id', $res);
                    $result->execute();
                    for ($i = 0; $row = $result->fetch(); $i++) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                        </tr>
                    <?php } ?>
                </table>

                <div class="form-group editor d-none" style="margin-top: 50px; width: 90%">
                    <input type="submit" id="btn" class="form-input" value="Save Edit">
                </div>

                <form action="appointment_edit.php" method="POST" id="active_form" class="d-none">
                    <input type="hidden" name="type" value="active">
                    <input type="hidden" name="id" value="<?php echo $job; ?>">
                </form>

                <form action="appointment_edit.php" method="POST" id="cancel_form" class="d-none">
                    <input type="hidden" name="type" value="cancel">
                    <input type="hidden" name="id" value="<?php echo $job; ?>">
                </form>

                <div class="flex-center editor" style="margin-top: 50px;">
                    <div class="form-group">
                        <button id="active" class="form-btn px-4"><i class="fa-solid fa-check me-2"></i>Active</button>
                    </div>
                    <div class="form-group">
                        <button id="delete" class="form-btn px-4"><i class="fa-solid fa-xmark me-2"></i>Cancel</button>
                    </div>
                </div>
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
        $('.edit_btn').click(function() {
            $('.editor').toggleClass('d-none');
        });
        $('#active').click(function() {
            $('#active_form').submit();
        });
        $('#delete').click(function() {
            if (confirm("Sure you want to delete this Appointment? There is NO undo!")) {
                $('#cancel_form').submit();
            }
            return false;
        });
        $('#btn').click(function() {
            $('#edit_form').submit();
        });
    </script>

</body>

</html>
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
    $invo = $_GET['invo'];

    $result = $db->prepare("SELECT * FROM job WHERE id = '$job' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $cus = $row['cus_id'];
        $customer = $row['cus_name'];
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

    <div class="container flex mb-3">
        <div class="box room-container">
            <div class="box-body room " style="padding: 30px 10px;">
                <div class="logo flex">
                    <h1>Confirmation </h1>
                </div>

                <p>Appointment data sheet </p>

                <h2><i class="fa-solid fa-user mx-3"></i><?php echo $customer; ?></h2>

                <h2><i class="fa-solid fa-phone mx-3"></i><?php echo $contact; ?></h2>

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

                <form action="index.php" method="POST" style="width: 100%;">
                    <div class="form-group" style="margin-top: 50px;">
                        <input type="submit" id="btn" class="form-input" value="Home">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


</body>
<script src="js/datepik.js"></script>

</html>
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

    $user_id = $_SESSION['SESS_MEMBER_ID'];
    $date = date('Y-m-d');

    $result = $db->prepare("SELECT * FROM user WHERE id = '$user_id' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $pos = $row['position'];
    }

    if ($pos == 'admin') {
        $sql1 = "SELECT sum(sales_list.amount),sum(sales_list.cost),sum(sales_list.qty),sales_list.product_id,sales_list.name  FROM  sales JOIN sales_list ON sales.invoice_number=sales_list.invoice_no WHERE  sales.action='active' AND  sales.date  = '$date' GROUP BY sales_list.product_id ";
    } else {
        $sql1 = "SELECT sum(sales_list.amount),sum(sales_list.cost),sum(sales_list.qty),sales_list.product_id,sales_list.name  FROM  sales JOIN sales_list ON sales.invoice_number=sales_list.invoice_no WHERE  sales.action='active' AND  sales.date  = '$date' AND  sales.user_id  = '$user_id' GROUP BY sales_list.product_id ";
    }

    ?>
</head>

<body class="bg-light customer">

    <div class="container-fluid container-md mt-4">
        <div class="box px-2 mb-0 mt-3 ">
            <div class="box-header px-0 mb-0">
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="report.php"><i class="fa-solid fa-chevron-left fa-fw"></i></a>
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i></a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" aria-current="page" href="report.php"><i class="fa-solid fa-chevron-left fa-fw me-2"></i></i>Back</a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" aria-current="page" href="index.php"><i class="fa-solid fa-house me-2"></i>Home</a>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="box room-container">
            <div class="box-body room " style="padding: 30px 10px;">
                <div class="logo flex">
                    <h1>Item Sales</h1>
                </div>

                <p>Today all item sales</p>

                <div class="w-100">
                    <table class="w-100 mb-2">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Cost</th>
                                <th>Sales</th>
                                <th>Margin</th>
                            </tr>
                        </thead>
                        <tbody class="border-top">
                            <?php $total = 0;
                            $result = $db->prepare($sql1);
                            $result->bindParam(':id', $res);
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                <tr class="border-top">
                                    <th><?php echo $row['product_id']; ?></th>
                                    <th colspan="3"><?php echo $row['name']; ?></th>
                                </tr>
                                <tr>
                                    <td><?php echo $row['sum(sales_list.qty)']; ?></td>
                                    <td><?php echo $row['sum(sales_list.cost)']; ?></td>
                                    <td><?php echo $row['sum(sales_list.amount)']  ?></td>
                                    <td><?php echo $row['sum(sales_list.amount)'] - $row['sum(sales_list.cost)']  ?></td>
                                    <?php $total += $row['sum(sales_list.amount)'] - $row['sum(sales_list.cost)']; ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <h2 style="font-size: 40px;">Rs.<?php echo number_format($total, 2); ?></h2>

            </div>
        </div>
    </div>

    <div class="container room-container">
        <div class="row" id="room-box">

        </div>
    </div>

    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Date Picker -->
    <script src="js/datepik.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../../../plugins/morris/morris.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../../../plugins/chartjs/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../../../plugins/sparkline/jquery.sparkline.min.js"></script>

    <script>

    </script>
</body>

</html>
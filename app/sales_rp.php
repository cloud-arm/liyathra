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

    <div class="container mt-3">
        <div class="box room-container">
            <div class="box-body room " style="padding: 30px 10px;">
                <div class="logo flex">
                    <h1>Item Sales</h1>
                </div>

                <p>Today all item sales</p>
                <?php $total = 0;
                $result = $db->prepare($sql1);
                $result->bindParam(':id', $res);
                $result->execute();
                for ($i = 0; $row = $result->fetch(); $i++) {
                    $total += $row['sum(sales_list.amount)'] - $row['sum(sales_list.cost)'];
                } ?>
                <h2 style="font-size: 40px;">Rs.<?php echo number_format($total, 2); ?></h2>

            </div>
        </div>
    </div>

    <div class="container-fluid mb-3">
        <div class="box">
            <div class="box-body d-block">
                <div class="row ">
                    <?php $total = 0;
                    $result = $db->prepare($sql1);
                    $result->bindParam(':id', $res);
                    $result->execute();
                    for ($i = 0; $row = $result->fetch(); $i++) { ?>
                        <div class="col-12 col-md-6 col-lg-4 record ajk_sdy">
                            <div class="info-box">
                                <div class="row w-100">
                                    <div class="col-3">
                                        <div class="inb_img-box">
                                            <img src="img/chicken.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-9 as_jdk">
                                        <div class="i_n_b">
                                            <span class="head"><?php echo $row['name']; ?></span>
                                        </div>
                                        <div class="info-foot">
                                            <div class="qty-box ms-3">
                                                <span class="price">Qty:<span> <?php echo $row['sum(sales_list.qty)']; ?> </span></span>
                                            </div>
                                            <span class="price">LKR. <span><?php echo $row['sum(sales_list.amount)']; ?></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
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
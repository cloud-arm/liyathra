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
        $user_id = $row['emp_id'];
        $pos = $row['position'];
    }

    if ($pos == 'admin') {
        $sql1 = "SELECT sum(amount) FROM payment WHERE  pay_type = 'cash' AND date ='$date' ";
        $sql2 = "SELECT sum(sales_list.amount),sum(sales_list.cost) FROM  sales JOIN sales_list ON sales.invoice_number=sales_list.invoice_no WHERE  sales.action='active' AND  sales.date  = '$date' GROUP BY sales_list.product_id ";
        $sql3 = "SELECT sum(amount) FROM expenses_records WHERE  date ='$date' ";
    } else {
        $sql1 = "SELECT sum(amount) FROM payment WHERE user_id = '$user_id' AND pay_type = 'cash' AND date = '$date' ";
        $sql2 = "SELECT sum(sales_list.amount),sum(sales_list.cost) FROM  sales JOIN sales_list ON sales.invoice_number=sales_list.invoice_no WHERE  sales.action='active' AND  sales.date  = '$date' AND  sales.user_id  = '$user_id' GROUP BY sales_list.product_id ";
        $sql3 = "SELECT sum(amount) FROM expenses_records WHERE user = '$user_id' AND  date = '$date' ";
    }

    $result = $db->prepare($sql1);
    $result->bindParam(':id', $user_id);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $collection = $row['sum(amount)'];
    }

    $sales = 0;
    $result = $db->prepare($sql2);
    $result->bindParam(':id', $user_id);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $sales += $row['sum(sales_list.amount)'] - $row['sum(sales_list.cost)'];
    }

    $result = $db->prepare($sql3);
    $result->bindParam(':id', $user_id);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $expenses = $row['sum(amount)'];
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

    <div class="container room-container">
        <div class="row" id="room-box">
            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                <div class="ajk_ady ">
                    <a href="collection_rp.php" style="text-decoration: none; color: rgb(var(--bg-theme))">
                        <div class="info-box" style="border: 2px solid rgb(var(--bg-theme));">
                            <div class="row w-100">
                                <div class="col-4 p-0 inb_nu">
                                    <span class="num_inp">Rs.<?php echo $collection; ?></span>
                                </div>
                                <div class="col-8">
                                    <div style="margin: 10px;" class="sparkline" data-type="bar" data-width="60%" data-height="40px" data-bar-Width="5" data-bar-Spacing="9" data-bar-Color="#B5B5B8">
                                        <?php
                                        $result1 = $db->prepare("SELECT  sum(amount) FROM payment WHERE  pay_type = 'cash' GROUP BY date ORDER BY date DESC LIMIT 20 ");
                                        $result1->bindParam(':userid', $date);
                                        $result1->execute();
                                        for ($i = 0; $row1 = $result1->fetch(); $i++) {
                                            echo $row1['sum(amount)'] . ",";
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="app badge bg-maroon" style="width: max-content;">Collection Report</div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                <div class="ajk_ady ">
                    <a href="sales_rp.php" style="text-decoration: none; color: rgb(var(--bg-theme))">
                        <div class="info-box" style="border: 2px solid rgb(var(--bg-theme));">
                            <div class="row w-100">
                                <div class="col-4 p-0 inb_nu">
                                    <span class="num_inp">Rs.<?php echo $sales . '.00'; ?></span>
                                </div>
                                <div class="col-8">
                                    <div style="margin: 10px;" class="sparkline" data-type="bar" data-width="60%" data-height="40px" data-bar-Width="5" data-bar-Spacing="9" data-bar-Color="#B5B5B8">
                                        <?php
                                        $result1 = $db->prepare("SELECT sum(sales_list.amount) FROM  sales JOIN sales_list ON sales.invoice_number=sales_list.invoice_no WHERE  sales.action='active'  GROUP BY sales.date ORDER BY sales.date DESC LIMIT 20 ");
                                        $result1->bindParam(':userid', $date);
                                        $result1->execute();
                                        for ($i = 0; $row1 = $result1->fetch(); $i++) {
                                            echo $row1['sum(sales_list.amount)'] . ",";
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="app badge bg-blue" style="width: max-content;">Sales Report</div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                <div class="ajk_ady ">
                    <a href="expenses_rp.php" style="text-decoration: none; color: rgb(var(--bg-theme))">
                        <div class="info-box" style="border: 2px solid rgb(var(--bg-theme));">
                            <div class="row w-100">
                                <div class="col-4 p-0 inb_nu">
                                    <span class="num_inp">Rs.<?php echo $expenses; ?></span>
                                </div>
                                <div class="col-8">
                                    <div style="margin: 10px;" class="sparkline" data-type="bar" data-width="60%" data-height="40px" data-bar-Width="5" data-bar-Spacing="9" data-bar-Color="#B5B5B8">
                                        <?php
                                        $result1 = $db->prepare("SELECT  sum(amount) FROM expenses_records GROUP BY date ORDER BY date DESC LIMIT 20 ");
                                        $result1->bindParam(':userid', $date);
                                        $result1->execute();
                                        for ($i = 0; $row1 = $result1->fetch(); $i++) {
                                            echo $row1['sum(amount)'] . ",";
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="app badge bg-green" style="width: max-content;">Expenses Report</div>
                    </a>
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
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../../../plugins/morris/morris.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../../../plugins/chartjs/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../../../plugins/sparkline/jquery.sparkline.min.js"></script>

    <script>
        $(function() {

            // Line charts taking their values from the tag
            $('.sparkline-1').sparkline();

            //INITIALIZE SPARKLINE CHARTS
            $(".sparkline").each(function() {
                var $this = $(this);
                $this.sparkline('html', $this.data());
            });

        });
    </script>
</body>

</html>
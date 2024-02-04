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

    $job = $_GET['id'];

    $result = $db->prepare("SELECT * FROM job WHERE id = '$job' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $invo = $row['invoice_no'];
        $type_name = $row['type_name'];
    }

    ?>
</head>

<body class="bg-light customer" style="overflow-y: scroll;">
    <div class="container-fluid container-md">
        <div class="box px-0 mb-0">
            <div class="box-header px-0">
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i></a>
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="invoice.php?id=<?php echo $job ?>&invo=<?php echo $invo ?>"><i class="fa-solid fa-sliders"></i></a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" aria-current="page" href="index.php"><i class="fa-solid fa-house me-2"></i>Home</a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" aria-current="page" href="invoice.php?id=<?php echo $job ?>&invo=<?php echo $invo ?>"><i class="fa-solid fa-sliders me-2"></i>Invoice</a>
            </div>
        </div>
    </div>


    <div class="container-fluid d-none">
        <div class="box room-container mt-0">
            <div class="box-body room mt-0">
                <form action="order_save.php" class="w-100" method="POST">
                    <h2>Add Supporter here</h2>
                    <div class="flex w-100">
                        <div class="form-group w-100 me-0">
                            <label>Supporter</label>
                            <select name="sub_emp" class="form-input">
                                <?php
                                $result = $db->prepare('SELECT * FROM Employees ');
                                $result->bindParam(':id', $res);
                                $result->execute();
                                for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                    <option value="<?php echo $row['id']  ?>">
                                        <?php echo $row['name']  ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group me-0">
                            <input class="cate-info active" type="submit" value="Save" style="margin-bottom: -15px;padding: 5px 10px;color: rgb(var(--bg-white));font-weight: 600;font-size: 18px;">
                            <input type="hidden" name="type" value="sub_emp">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container-fluid bg-none">
        <div class="container-fluid my-4">
            <h1 class="fs-2 fw-semibold m_had"><span><?php echo $type_name ?> </span> </h1>
        </div>
    </div>

    <div class="container-lg box-body category" style="overflow-x: scroll;">
        <table>
            <tr>
                <td style="padding-right: 20px;"></td>
                <?php
                $result = $db->prepare("SELECT * FROM job_type");
                $result->bindParam(':userid', $date);
                $result->execute();

                for ($i = 0; $row = $result->fetch(); $i++) { ?>
                    <td>
                        <div class="cate-info cat_fill click_fun <?php if ($type == $row['id']) {
                                                                        echo 'active';
                                                                    } ?>" value="<?php echo $row['id'] ?>">
                            <span><?php echo $row['name'] ?></span>
                        </div>
                    </td>
                <?php } ?>
            </tr>
        </table>
    </div>

    <div class="container-fluid mb-3">
        <div class="box">
            <div class="box-body">
                <div class="row" id="cat-box"></div>
            </div>
        </div>
    </div>


    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("cat-box").innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET", "item_get.php?unit=1&invo=<?php echo $invo; ?>&type=<?php echo $type; ?>", true);
            xmlhttp.send();

            $(".cat_fill").click(function() {
                var type = $(this).attr("value");

                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("cat-box").innerHTML = xmlhttp.responseText;
                    }
                }

                xmlhttp.open("GET", "item_get.php?unit=1&invo=<?php echo $invo; ?>&type=" + type, true);
                xmlhttp.send();
            });


            $(".click_fun").click(function() {
                $(".click_fun").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
</body>

</html>
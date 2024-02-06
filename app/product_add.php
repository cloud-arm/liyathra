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

    $pro_id = $_GET['id'];
    $invo = $_GET['invo'];

    $result = $db->prepare("SELECT * FROM product WHERE product_id = '$pro_id' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $name = $row['name'];
    }

    ?>
</head>

<body class="bg-light customer" style="overflow-y: scroll;">

    <div class="container-fluid bg-none">
        <div class="container-fluid my-4">
            <h1 class="fs-2 fw-semibold m_had"><span><?php echo $name ?> </span> </h1>
        </div>
    </div>

    <div class="container-lg box-body category mt-5 room-container" style="overflow-x: scroll;">
        <table>
            <tr id="mate-box">
                <?php
                $result = $db->prepare("SELECT * FROM use_product WHERE main_product = '$pro_id' ");
                $result->bindParam(':id', $res);
                $result->execute();
                for ($i = 0; $row = $result->fetch(); $i++) { ?>

                    <td>
                        <div class="mate click_fun cate-info" onclick="get_product('<?php echo $row['product_id'] ?>')">
                            <?php echo $row['product_name']; ?>
                        </div>
                    </td>

                <?php
                }
                ?>
            </tr>
        </table>
    </div>

    <div class="container-fluid mb-3">
        <div class="box">
            <div class="box-body">
                <div class="row w-lg-100" id="cat-box"></div>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-3 flex">
        <a href="order.php?id=<?php echo $_GET['id'] . '&invo=' . $_GET['invo']; ?>" class="cate-info active" style="width: 90%;justify-content: center;font-size: 25px; color: rgb(var(--bg-white)); font-weight: 600;">Next</a>
    </div>


    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function cartClick(id) {
            let info_box = $('#info-' + id);
            let dlt_box = $('#dlt-' + id);
            let qty = $('#qty_' + id);
            if ($(qty).val() > 0) {
                for (let i = 0; i < $('.info-box').length; i++) {
                    $($('.info-box')[i]).css("transform", "translateX(0)");
                    $($('.dlt-box')[i]).css("transform", "translateX(132%)");
                }

                $(info_box).css("transform", "translateX(-100px)");
                $(dlt_box).css("transform", "translateX(0)");
            }
        }

        function get_product(id) {
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

            xmlhttp.open("GET", "item_get.php?unit=2&invo=<?php echo $invo; ?>&id=" + id, true);
            xmlhttp.send();
        }

        $(document).ready(function() {

            $(".click_fun").click(function() {
                $(".click_fun").removeClass("active");
                $(this).addClass("active");
            });

        });

        function sales_add_list(i) {
            let p_id = document.getElementById('pid_' + i).value;
            let qty = document.getElementById('qty_' + i).value;
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

            xmlhttp.open("GET", "sales_add.php?id=" + p_id + "&invo=<?php echo $invo ?>&qty=" + qty + "&pro_id=<?php echo $pro_id; ?>", true);
            xmlhttp.send();

        }
    </script>
</body>

</html>
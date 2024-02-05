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

    $invo = $_GET['invo'];
    $result = $db->prepare("SELECT * FROM job WHERE invoice_no = '$invo' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $job = $row['id'];
    }
    ?>
</head>

<body class="bg-light customer" style="overflow-y: scroll;">

    <div class="container-fluid container-md mt-4">
        <div class="box px-2 mb-0 mt-3 ">
            <div class="box-header px-0 mb-0">
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i></a>
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="appointment_data.php?id=<?php echo $job ?>&invo=<?php echo $invo ?>&end=0"><i class="fa-solid fa-table"></i></a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" aria-current="page" href="index.php"><i class="fa-solid fa-house me-2"></i>Home</a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" aria-current="page" href="appointment_data.php?id=<?php echo $job ?>&invo=<?php echo $invo ?>&end=0"><i class="fa-solid fa-table me-2"></i></i>Details</a>
            </div>
        </div>
    </div>

    <div class="container-fluid down-up" id="down-up" style="transform: translateY(101%);">
        <div id="container" onclick="containerDown()"></div>
        <div class="up-content">
            <span class="closer"></span>
            <div class="content">
                <div class="cont-box ">
                    <h5 class="top" id="top">Test1</h5>
                    <h6 class="sub-top" id="sub-top">Test</h6>
                    <input type="hidden" id="p_id" value="">
                </div>
                <div class="cont-box">
                    <h6>Enter customer agree price</h5>
                        <input type="number" id="price" step=".01" onkeyup="check()" value="0.00" autocomplete="off" class="form-input w-100 ">
                </div>
                <button disabled class="btn" id="odr_btn" onclick="sales_add_list()">Order Now</button>
            </div>
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
                        <div class="cate-info cat_fill click_fun" value="<?php echo $row['id'] ?>">
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
        $('.closer').click(function() {
            $('#down-up').css("transform", "translateY(101%)");
        });

        function check() {
            let val = $('#price').val();
            if (val > 0) {
                $('#odr_btn').removeAttr('disabled');
            } else {
                $('#odr_btn').attr('disabled', '');
            }
        }

        function sales_add_list() {
            let id = document.getElementById('p_id').value;
            let price = document.getElementById('price').value;
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

            xmlhttp.open("GET", "appointment_sales_add.php?id=" + id + "&invo=<?php echo $invo ?>&price=" + price, true);
            xmlhttp.send();

            containerDown();
        }

        function open_model(id, p_name, p_code) {
            $('#p_id').val(id);
            $('#top').text(p_name);
            $('#sub-top').text(p_code);
            $('#down-up').css('transform', "translateY(0)");
        }

        function containerDown() {
            $('#down-up').css("transition", "transform 0.75s ease 0.2s");
            $('#down-up').css("transform", "translateY(101%)");
        }

        $(document).ready(function() {

            $('input[type="number"]').focus(function() {
                $(this).select();
            });

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

                xmlhttp.open("GET", "appointment_item_get.php?unit=1&invo=<?php echo $invo; ?>&type=" + type, true);
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
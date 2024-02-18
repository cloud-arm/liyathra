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

    $id = 1;
    ?>
</head>

<body class="bg-light">

    <div class="container-fluid container-md mt-4">
        <div class="box px-2 mb-0 mt-3 ">
            <div class="box-header px-0 mb-0">
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i></a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" aria-current="page" href="index.php"><i class="fa-solid fa-house me-2"></i>Home</a>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-3">
        <div class="box">
            <div class="box-header">
                <h4 class="fs-4 m-0">Explore Appointments</h4>
                <a class="room-info active" href="appointment_customer_checking.php ">
                    <div class="room-box first">
                        <span><i class="fa-solid fa-plus"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container room-container">
        <div class="row" id="room-box"></div>
    </div>

    <div class="container-fluid my-4 flex">
        <a href="index.php" class="cate-info active" style="width: 90%;justify-content: center;font-size: 25px; color: rgb(var(--bg-white)); font-weight: 600;">Home</a>
    </div>


    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
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
                    document.getElementById("room-box").innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET", "appointment_get.php?type=all", true);
            xmlhttp.send();

            $(".click_fun").click(function() {
                $(".click_fun").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
</body>

</html>
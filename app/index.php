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

    <header>
        <nav class="navbar navbar-expand-lg bg-none">
            <div class="container-fluid">
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <a href="order.php" class="d-none"><span class="navbar-toggler border-0"><i id="icon" class="fa-solid fa-bell"></i></span></a>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid mb-3">
        <div class="box">
            <div class="box-header">
                <h4 class="fs-4 m-0">Explore Appointments</h4>
                <i class="fa-solid fa-ellipsis d-md-none"></i>
            </div>
        </div>
    </div>

    <div class="container-lg box-body category" style="overflow-x: scroll;">
        <a class="room-info active" href="customer_checking.php?id=<?php echo $id; ?>">
            <div class="room-box first">
                <span><i class="fa-solid fa-plus"></i></span>
            </div>
            <span>New Appointment</span>
        </a>
    </div>

    <div class="container room-container">
        <div class="row" id="room-box"></div>
    </div>
   

    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script>
        $(document).ready(function(){
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

            xmlhttp.open("GET", "appointment_get.php" , true);
            xmlhttp.send();

            $(".click_fun").click(function() {
                $(".click_fun").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
</body>
</html>
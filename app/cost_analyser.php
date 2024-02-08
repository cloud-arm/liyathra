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

    $id = $_SESSION['SESS_MEMBER_ID'];
    $date = date("Y-m-d");
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
                <h4 class="fs-4 m-0">Cost Analyses</h4>
            </div>
        </div>
    </div>

    <div class="container room-container">
        <div class="row">
            <?php

            $sql = "SELECT * FROM utility_bill WHERE action = 1    ";
            $result = $db->prepare($sql);
            $result->bindParam(':userid', $date);
            $result->execute();

            for ($i = 0; $row = $result->fetch(); $i++) {
                $con = $row['last_date'];
                //----------------------------------------------------//
            ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="ajk_ady ">
                        <div class="info-box" style="border: 2px solid rgb(var(--bg-theme));<?php if ($con == $date) { ?> background: rgba(var(--bg-theme), 0.25);<?php } ?>">
                            <div class="w-100">
                                <div class="as_jdk">
                                    <div class="i_n_b">
                                        <span class="head"><?php echo $row['name']; ?></span>
                                    </div>
                                    <div class="info-foot">
                                        <div class="anl">
                                            <span class="anl_hed"><i class="fa-solid fa-arrow-up-1-9 me-2"></i>Last Meter : <span><?php echo $row['meter'] ?></span></span>
                                            <a class="nav-link" style="align-self: end;" href="cost_analyser_view.php?id=<?php echo $row['id'] ?>">
                                                <span <?php if ($con == $date) { ?> style="color: rgb(var(--bg-black));" <?php } ?> class="bin btn">View</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
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

            xmlhttp.open("GET", "appointment_get.php", true);
            xmlhttp.send();


            $(".click_fun").click(function() {
                $(".click_fun").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
</body>

</html>
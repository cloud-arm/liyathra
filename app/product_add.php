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
    $pos = $_SESSION['SESS_LAST_NAME'];
    $pro_id = $_GET['id'];
    $invo = $_GET['invo'];

    $result = $db->prepare("SELECT * FROM user WHERE id = '$user_id' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $user = $row['emp_id'];
        $pos = $row['position'];
    }

    $result = $db->prepare("SELECT * FROM product WHERE product_id = :id ");
    $result->bindParam(':id', $pro_id);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $name = $row['name'];
    }

    $id = 0;
    $emp = 0;
    $sup_emp = 0;
    $price = 0;
    $result = $db->prepare("SELECT * FROM sales_list WHERE product_id = :id AND invoice_no ='$invo' ");
    $result->bindParam(':id', $pro_id);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $id = $row['id'];
        $price = $row['price'];
        $emp = $row['emp'];
        $emp_name = $row['emp_name'];
        $sup_emp = $row['sup_emp'];
        $sup_emp_name = $row['sup_emp_name'];
    }

    $result = $db->prepare("SELECT * FROM job WHERE invoice_no =:id ");
    $result->bindParam(':id', $invo);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $job = $row['id'];
    }

    ?>
</head>

<body class="bg-light customer" style="overflow-y: scroll;">


    <?php if ($emp > 0 | $sup_emp > 0) { ?>
        <div class="container flex mb-0">
            <div class="box room-container mb-0 pb-0" style=" min-width: 100%;">
                <div class="box-body room " id="serve_btn" style="padding: 20px 10px;transition: display 2s ease-out; ">
                    <h2 class="mb-0 w-100" onclick="get_service(1)">Service Provider <i class="fa-solid fa-chevron-left me-3 float-end"></i></h2>
                </div>

                <div class="box-body room mb-0" id="serve_content" style="padding: 20px 10px 30px; transform: translateY(-160%);display: none;transition: transform 2s ease-out, display 2s ease-out; ">

                    <h2 class="mb-4 w-100" onclick="get_service(2)">Service Provider <i class="fa-solid fa-chevron-down me-3 float-end"></i></h2>

                    <?php if ($emp > 0) { ?>

                    <p class="mb-1 mt-4 ms-3">Main Service Provider </p>
                    <h2><i class="fa-solid fa-user mx-3"></i><?php echo $emp_name; ?></h2>

                    <?php } ?>
                    <?php if ($sup_emp > 0) { ?>

                    <p class="mb-1 mt-4 ms-3">Service Supporter </p>
                    <h2><i class="fa-solid fa-user mx-3"></i><?php echo $sup_emp_name; ?></h2>

                    <?php } ?>

                </div>
            </div>
        </div>
    <?php } ?>

    <div class="container-fluid mt-3 pb-0">
        <div class="box mb-0 pb-0">
            <div class="box-body">
                <div class="ajk_sdy">
                    <div class="info-box" style="border: 2px solid rgb(var(--bg-theme));background: rgba(var(--bg-theme), 0.25);">
                        <div class="row w-100">
                            <div class="col-3">
                                <div class="inb_img-box">
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div class="col-9 as_jdk">
                                <div class="i_n_b">
                                    <span class="head"><?php echo $name; ?></span>
                                </div>
                                <div class="info-foot">
                                    <div class="qty-box">
                                        <label for="">LKR*</label>
                                        <input type="number" step=".01" class="qty form-input mx-2" id="price" value="<?php echo $price; ?>" style="background-color: rgba(var(--bg-light), 0.75);">
                                        <input type="hidden" id="rid" value="<?php echo $id; ?>">
                                        <input type="hidden" id="pid" value="<?php echo $pro_id; ?>">
                                        <input type="hidden" id="in_id" value="<?php echo $invo; ?>">
                                    </div>
                                    <span class="bin btn" id="price_edit">Update</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($id > 0) { ?>
        <?php if ($emp == 0 | $sup_emp == 0) { ?>
            <?php if ($pos == 'admin') { ?>
                <div class="container flex mb-3">
                    <div class="box room-container pt-0" style=" min-width: 100%;">
                        <div class="box-body room mt-0 " style="padding: 30px 10px;">
                            <div class="logo flex">
                                <h1>Assign</h1>
                            </div>

                            <p>Enter an employee for the service </p>

                            <form action="appointment_emp_assign.php" method="POST" style="width: 100%;">

                                <?php if ($emp == 0) { ?>

                                    <h2 class="mt-3">Select Employee</span></h2>
                                    <div class="form-group ">
                                        <label>Employee*</label>
                                        <select name="emp" class="form-input" id="emp">
                                            <option value="0"></option>
                                            <?php
                                            $result = $db->prepare('SELECT * FROM Employees  ');
                                            $result->bindParam(':id', $res);
                                            $result->execute();
                                            for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                                <option value="<?php echo $em = $row['id']  ?>" <?php if ($emp == $em) {
                                                                                                    echo 'selected';
                                                                                                } ?>>
                                                    <?php echo  $row['name'];  ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                <?php } else { ?>
                                    <input type="hidden" name="emp" value="<?php echo $emp; ?>">
                                <?php } ?>

                                <?php if ($sup_emp == 0) { ?>

                                    <h2 class="mt-3">Select Sub Employee</span></h2>
                                    <div class="form-group ">
                                        <label>Sub Employee*</label>
                                        <select name="sup_emp" class="form-input" id="sup_emp">
                                            <option value="0"></option>
                                            <?php
                                            $result = $db->prepare('SELECT * FROM Employees  ');
                                            $result->bindParam(':id', $res);
                                            $result->execute();
                                            for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                                <option value="<?php echo $sem = $row['id']  ?>" <?php if ($sup_emp == $sem) {
                                                                                                        echo 'selected';
                                                                                                    } ?>>
                                                    <?php echo  $row['name'];  ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                <?php } else { ?>
                                    <input type="hidden" name="sup_emp" value="<?php echo $sup_emp; ?>">
                                <?php } ?>

                                <input type="hidden" name="pid" value="<?php echo $pro_id; ?>">
                                <input type="hidden" name="invo" value="<?php echo $invo; ?>">
                                <input type="hidden" name="job" value="<?php echo $job; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">

                                <div class="form-group " style="margin-top: 50px; width: 90%">
                                    <input type="submit" class="form-input" value="Assign">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <?php if ($emp == 0) { ?>
                    <div class="container-fluid mt-3">
                        <div class="box mt-0 pt-0">
                            <div class="box-body d-block">
                                <form action="appointment_emp_assign.php" method="POST" style="width: 100%;">

                                    <div class="info-box">
                                        <div class="row w-100">
                                            <div class="col-9 as_jdk">
                                                <div class="i_n_b">
                                                    <span class="head">Service provider</span>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="hidden" name="emp" value="<?php echo $user; ?>">
                                                <input type="submit" class="bin btn" value="Assign">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="sup_emp" value="<?php echo $sup_emp; ?>">
                                    <input type="hidden" name="pid" value="<?php echo $pro_id; ?>">
                                    <input type="hidden" name="invo" value="<?php echo $invo; ?>">
                                    <input type="hidden" name="job" value="<?php echo $job; ?>">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($sup_emp == 0) { ?>
                    <div class="container-fluid mb-3">
                        <div class="box mt-0 pt-0">
                            <div class="box-body d-block">
                                <form action="appointment_emp_assign.php" method="POST" style="width: 100%;">

                                    <div class="info-box">
                                        <div class="row w-100">
                                            <div class="col-9 as_jdk">
                                                <div class="i_n_b">
                                                    <span class="head">Service provider supporter</span>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input type="hidden" name="sup_emp" value="<?php echo $user; ?>">
                                                <input type="submit" class="bin btn" value="Assign">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="emp" value="<?php echo $emp; ?>">
                                    <input type="hidden" name="pid" value="<?php echo $pro_id; ?>">
                                    <input type="hidden" name="invo" value="<?php echo $invo; ?>">
                                    <input type="hidden" name="job" value="<?php echo $job; ?>">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>

    <div class="container-lg box-body category my-0 pt-0 room-container" style="overflow-x: scroll;">
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
        <div class="box mt-0 pt-0">
            <div class="box-body">
                <div class="row w-lg-100" id="cat-box"></div>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-3 flex">
        <a href="process.php?<?php echo 'id=' . $pro_id . '&invo=' . $invo; ?>" class="cate-info active" style="width: 90%;justify-content: center;font-size: 25px; color: rgb(var(--bg-white)); font-weight: 600;">Next</a>
    </div>


    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        var main_id = 0;

        function get_service(i) {
            if (i == 1) {
                $('#serve_btn').css('display', 'none');
                $('#serve_content').css('display', 'block');
                $('#serve_content').css('transform', 'translateY(0)');
            }

            if (i == 2) {
                $('#serve_btn').css('display', 'block');
                $('#serve_content').css('display', 'none');
                $('#serve_content').css('transform', 'translateY(-160%)');
            }
        }

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
            main_id = id;
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

            $("#price_edit").click(function() {
                let rid = $('#rid').val();
                let pid = $('#pid').val();
                let invo = $('#in_id').val();
                let price = $('#price').val();
                var info = 'id=' + rid + '&price=' + price + '&pid=' + pid + '&invo=' + invo;
                $.ajax({
                    type: "GET",
                    url: "service_price_save.php",
                    data: info,
                    success: function() {}
                });
            });

            $(".click_fun").click(function() {
                $(".click_fun").removeClass("active");
                $(this).addClass("active");
            });

            $('input[type="number"]').focus(function() {
                $(this).select();
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

            xmlhttp.open("GET", "sales_add.php?id=" + p_id + "&invo=<?php echo $invo ?>&qty=" + qty + "&pro_id=" + main_id + "&sev=<?php echo $pro_id; ?>", true);
            xmlhttp.send();

        }
    </script>
</body>

</html>
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

    $app_id = $_GET['id'];
    $invo = $_GET['invo'];
    $sub_emp = 0;

    $result = $db->prepare("SELECT * FROM appointment WHERE id = '$app_id' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
        $type = $row['type'];
        $type_name = $row['type_name'];
        $date = $row['app_date'];
        $time = $row['app_time'];
        $emp = $row['emp_id'];
        $emp_name = $row['emp_name'];
        $cus = $row['cus_id'];
        $cus_name = $row['cus_name'];
        $action = $row['action'];
    }

    if($action == 0){

        $sql = "INSERT INTO job (action,date,time,invoice_no,cus_id,job_no,job_type) VALUES (?,?,?,?,?,?,?)";
        $ql = $db->prepare($sql);
        $ql->execute(array('pending',$date,$time,$invo,$cus,$type,$type_name));

        $sql = 'UPDATE appointment SET invoice_no = ?, action = ? WHERE id = ? ';
		$ql = $db->prepare($sql);
		$ql->execute(array($invo,2,$app_id));

    }else{

        $result = $db->prepare("SELECT * FROM job WHERE invoice_no = '$invo' ");
        $result->bindParam(':id', $res);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
            
        }
    }

    ?>
</head>
<body class="bg-light customer" style="overflow-y: scroll;">
    <div class="container-fluid container-md">
        <div class="box px-0 mb-0">
            <div class="box-header px-0">
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i></a>
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="invoice.php?id=<?php echo $app_id?>&invo=<?php echo $invo?>"><i class="fa-solid fa-sliders"></i></a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" aria-current="page" href="index.php"><i class="fa-solid fa-house me-2"></i>Home</a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" aria-current="page" href="invoice.php?id=<?php echo $app_id?>&invo=<?php echo $invo?>"><i class="fa-solid fa-sliders me-2"></i>Invoice</a>
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
                            <select name="sub_emp" class="form-input" >
                            <?php 
                                $result = $db->prepare('SELECT * FROM Employees ');
                                $result->bindParam(':id', $res);
                                $result->execute();
                                for($i=0; $row = $result->fetch(); $i++){?>
                                <option value="<?php echo $row['id']  ?>">
                                <?php echo $row['name']  ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group me-0">
                            <input class="cate-info active" type="submit"  value="Save"
                            style="margin-bottom: -15px;padding: 5px 10px;color: rgb(var(--bg-white));font-weight: 600;font-size: 18px;">
                            <input type="hidden" name="type" value="sub_emp">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container-fluid bg-none">
        <div class="container-fluid my-4">
            <h1 class="fs-2 fw-semibold m_had"><span><?php echo $type_name?> </span> </h1>
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

                    for($i=0; $row = $result->fetch(); $i++){?>
                <td>
                    <div class="cate-info cat_fill click_fun <?php if($type == $row['id']){ echo 'active';} ?>" 
                    value="<?php echo $row['id']?>">
                        <span><?php echo $row['name'] ?></span>
                    </div>
                </td>
                <?php }?>
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


    <div class="container flex my-3 d-none" >
        <div class="box room-container">
            <div class="box-body room " style="padding: 30px 10px;">
                <div class="logo flex">
                    <h1>Appointment</h1>
                </div>

                <p>Please enter customer name, contact & email address & appointment date</p>

                <form action="appointment_save.php" method="POST" style="width: 100%;">

                    <h2>Enter customer name here</h2>
                    <div class="form-group">
                        <label>Name*</label>
                        <input type="text" name="name" class="form-input" autocomplete="off" required>
                    </div>

                    <h2>Enter customer email here</h2>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="datepicker" class="form-input"  autocomplete="off">
                    </div>

                    <h2>Enter customer mobile number</h2>
                    <div class="form-group">
                        <label>Mobile*</label>
                        <input type="number" name="mobile"  autocomplete="off" required class="form-input" id="mobile" maxlength="10" onkeyup="checking()" placeholder="07********">
                    </div>

                    <h2>Select job type</h2>
                    <div class="form-group">
                        <label>Job Type*</label>
                        <select name="type" class="form-input">
                        <?php 
                            $result = $db->prepare('SELECT * FROM job_type ');
                            $result->bindParam(':id', $res);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){?>
                            <option value="<?php echo $row['id']  ?>">
                            <?php echo $row['name']  ?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <h2>Enter appointment date</h2>
                    <div class="form-group">
                        <label>Date*</label>
                        <input type="text" name="date"  autocomplete="off" required class="form-input" placeholder="YYYY-mm-dd">
                    </div>

                    <h2>Enter appointment time</h2>
                    <div class="form-group">
                        <label>Time*</label>
                        <input type="text" name="time"  autocomplete="off" required class="form-input"  placeholder="HH:mm">
                    </div>

                    <div class="form-group" style="margin-top: 50px;">
                        <input type="submit" id="btn" class="form-input" value="Continue">
                        <input type="hidden" name="emp" value="<?php echo $user; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>

        function checking(){
            
            let count = $('#mobile').val().length; 
            var val = $('#mobile').val();
            
            if(count>=10){
                $('#mobile').attr('readonly', '');
            }else{
                $('#mobile').removeAttr('readonly');
            }

            if(val.charAt(0) == 0 && val.charAt(1) == 7){
                $('#mobile').css('outline', '2px solid rgb(var(--bg-theme))');
            }
            else{ 
                $('#mobile').css('outline', '2px solid red');
            }

            if(event.which == 8){
                $($('#mobile')).val(
                    function(index, value){
                        return value.substr(0, value.length - 1);
                })
            }
        }

        $(document).ready(function(){
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

            xmlhttp.open("GET", "item_get.php?unit=1&invo=<?php echo $invo; ?>&type=<?php echo $type; ?>" , true);
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

                xmlhttp.open("GET", "item_get.php?unit=1&invo=<?php echo $invo; ?>&type=" + type , true);
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
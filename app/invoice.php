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
    $invo = $_GET['invo'];

    $sql = "SELECT sum(amount) FROM sales_list WHERE invoice_no='$invo'";                    
    $result = $db->prepare($sql);
    $result->bindParam(':userid', $date);
    $result->execute();
    
    for($i=0; $row = $result->fetch(); $i++){
        $total = $row['sum(amount)'];
    }
    ?>
</head>
<body class="bg-light">

    <div class="container-fluid mb-3">
        <div class="box">
            <div class="box-header">
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="<?php if(isset($_GET['end'])){ ?>appointment_service.php?invo=<?php echo $invo; }else{ ?>order.php?id=<?php echo $job; }?>"><i class="fa-solid fa-chevron-left"></i></a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-flex align-items-center" aria-current="page" href="<?php if(isset($_GET['end'])){ ?>appointment_service.php?invo=<?php echo $invo; }else{ ?>order.php?id=<?php echo $job; }?>"><i class="fa-solid fa-chevron-left me-2"></i> Back</a>
                <h4 class="fs-4 m-0 text-center w-100">Invoice</h4>
                <a href="bill_print.php?id=<?php echo $_GET['invo'] ?>"><button class="btn btn-info">Print</button></a>
                
            </div>
        </div>
    </div>

    <div class="container-fluid down-up" id="down-up" style="transform: translateY(0px);" >
        <form action="save_bill.php" method="POST" class="w-100 d-flex justify-content-center">
            <div class="up-content">
                <span class="closer" onclick="containerUp()"></span>
                <div class="content">
                    <div class="tot-box">
                        <span>Total</span>
                        <span class="tot">LKR. <?php echo $total?></span>
                    </div>
                    <div class="type-box">
                        <span class="btn click_fun" id="Card"><img src="img/visa-card.png" alt=""></span>
                        <span class="btn click_fun active" id="Cash"><img src="img/cash.png" alt=""></span>
                        <span class="btn click_fun" id="ruPay"><img src="img/LANKAQR_LOGO.png" alt=""></span>
                        <span class="btn click_fun" id="frimi"><img src="img/frimi.png" alt=""></span>
                    </div>
                    <div class="pay-box">
                        <label class="paid">Pay Amount</label>
                        <div class="paid-amount">
                            <label class="lbl">LKR.</label>
                            <input type="number" class="form-control form-input bg-none" name="amount" id="amount" value="0" onkeyup="checking()">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $invo ?>" >
                    <input type="hidden" name="p_type" id="pay_type" value="Cash" >
                    
                    <input class="btn   " id="finish" type="submit" value="Finish">
                </div>
            </div>
        </form>
        <div id="container" onclick="containerDown()"></div>
    </div>

    <div class="container-fluid mb-3">
        <div class="box">
            <div class="box-body">
                <div class="row w-lg-100">
                    <?php 
                    $sql = "SELECT * FROM sales_list WHERE invoice_no='$invo'";                    
                    $result = $db->prepare($sql);
                    $result->bindParam(':userid', $date);
                    $result->execute();
                    
                    for($i=0; $row = $result->fetch(); $i++){
                    ?>
                        <div class="col-12 col-md-6 col-lg-4 record ajk_sdy">
                            <div class="info-box" id="info-<?php echo $row['id']; ?>">
                                <div class="row w-100">
                                    <div class="col-3">
                                        <div class="inb_img-box">
                                            <img src="img/chicken.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-9 as_jdk">
                                        <div class="i_n_b">
                                            <span class="head"><?php echo $row['name']?></span>
                                            <span class="bin btn" onclick="binClick('<?php echo $row['id']; ?>')"><i class="fa-solid fa-trash"></i></span>
                                        </div>
                                        <div class="info-foot">
                                            <div class="qty-box">
                                                <i class="fa-solid fa-caret-left btn" onclick="qtySet('down','<?php echo $row['id']; ?>')"></i>
                                                <input type="text" class="qty" id="qty-<?php echo $row['id']; ?>" value="<?php echo $row['qty']?>" disabled>
                                                <i class="fa-solid fa-caret-right btn" onclick="qtySet('up','<?php echo $row['id']; ?>')"></i>
                                            </div>
                                            <input type="text" value="<?php echo $row['price']; ?>" id="int-<?php echo $row['id']; ?>" class="d-none">
                                            <span class="price">LKR. <span id="prc-<?php echo $row['id']; ?>"><?php echo $row['amount']; ?></span></span>
                                        </div><?php $total+= $row['amount']?>
                                    </div>
                                </div>
                            </div>
                            <div class="dlt-box d-md-none delbutton" id="dlt-<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
                                <a href="#<?php echo $row['id']; ?>" id="<?php echo $row['id']; ?>" class="nav-link">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Style -->
    <!-- <script src="js/style.js"></script> -->

    <script>

        function finish_bill(){

        }

        $(document).ready(function(){

            if(parseInt($('#amount').val()) == 0 | $('#amount').val() == ''){
                $('#finish').attr("disabled","")
            }

            $(".click_fun").click(function() {
                $(".click_fun").removeClass("active");
                $(this).addClass("active");  
                $('#pay_type').val($(this).attr('id'));
            });

        });

        function checking(){
            if(parseInt($('#amount').val()) == 0 | $('#amount').val() == ''){
                $('#finish').attr("disabled","")
            }else{
                $('#finish').removeAttr("disabled","")
            }
        }

        function qtySet(type,id){
            let qty = parseInt(document.getElementById('qty-'+id).value);
            if(type=='up'){qty +=1;}
            if(type=='down'){if(qty > 1){qty -=1;}}
            if(qty <10){document.getElementById('qty-'+id).value=("0"+qty);}
            else{document.getElementById('qty-'+id).value=(qty);}
            let price = parseFloat(document.getElementById('int-'+id).value);
            document.getElementById('prc-'+id).innerHTML = (price*qty ) + ".00";

            var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else { 
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                       // document.getElementById("room-box").innerHTML = xmlhttp.responseText;
                       console.log(xmlhttp.responseText);
                    }
                }

                xmlhttp.open("GET", "qty_change.php?id=" + id+"&qty="+qty , true);
                xmlhttp.send();
        }

        function binClick(id) {
            let info_box = document.getElementById('info-'+id);
            let dlt_box = document.getElementById('dlt-'+id);

            for (let i = 0; i < $('.info-box').length; i++) {
                $($('.info-box')[i]).css("transform","translateX(0)");
                $($('.dlt-box')[i]).css("transform","translateX(132%)");
            }

            info_box.style.transform = "translateX(-100px)";
            dlt_box.style.transform = "translateX(0)";
        }

        function containerDown(){
            document.getElementById('down-up').style.height = "max-content";
            document.getElementById('down-up').style.transform = "translateY(90%)";
        }

        function containerUp(){
            let cnt = document.getElementById('down-up');
            if(cnt.style.transform == 'translateY(0px)'){
                cnt.style.transform = "translateY(90%)";
                cnt.style.height = "max-content";
            }else{
                cnt.style.height = "100%";
                cnt.style.transform = "translateY(0px)";
            }
        }

        $(function() {
            $(".delbutton").click(function() {
                var element = $(this);
                var del_id = element.attr("value");
                var info = 'id=' + del_id;
                if (confirm("Sure you want to delete this Collection? There is NO undo!")) {
                    $.ajax({
                        type: "GET",
                        url: "item_list_dll.php",
                        data: info,
                        success: function() {}
                    });
                    $(this).parents(".record").animate({
                        backgroundColor: "#fbc7c7"
                     }, "fast")
                    .animate({
                        opacity: "hide"
                    }, "slow");
                }
                return false;
            });
        });

    </script>
</body>
</html>
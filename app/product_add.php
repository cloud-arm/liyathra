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
    for($i=0; $row = $result->fetch(); $i++){
        $name = $row['name'];
    }


    ?>
</head>
<body class="bg-light customer" style="overflow-y: scroll;">

    <div class="container-fluid bg-none">
        <div class="container-fluid my-4">
            <h1 class="fs-2 fw-semibold m_had"><span><?php echo $name?> </span> </h1>
        </div>
    </div>

    <div class="container flex my-3" >
        <div class="box room-container" id="cat-box"></div>
    </div>

    <div class="container-fluid mb-3 flex">
        <a href="index.php" class="cate-info active" 
        style="width: 90%;justify-content: center;font-size: 25px; color: rgb(var(--bg-white)); font-weight: 600;">Next</a>
    </div>

    
    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
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
                    document.getElementById("cat-box").innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET", "item_get.php?unit=2&invo=<?php echo $invo; ?>&id=<?php echo $pro_id; ?>" , true);
            xmlhttp.send();


        });

        function sales_add_list(i){
            let p_id = document.getElementById('id_'+i).value;
            let qty = document.getElementById('qty_'+i).value;
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

            xmlhttp.open("GET", "sales_add.php?id="+p_id+"&invo=<?php echo $invo?>&qty="+ qty +"&pro_id=<?php echo $pro_id; ?>" , true);
            xmlhttp.send();

        }
    </script>
</body>
</html>
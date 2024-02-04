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
    ?>
</head>
<body class="bg-light">

   

    <div class="container-fluid mb-3">
        <div class="box">
            <div class="box-header">
                <h4 class="fs-4 m-0">INVOICE</h4>
                <i class="fa-solid fa-ellipsis d-md-none"></i>
            </div>
        </div>
    </div>

    

    <div style="marging: 10px;">
        <table border="1" cellspacing="1"  width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>QTY</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php  $tot=0;
                $result = $db->prepare('SELECT * FROM sales_list WHERE  invoice_no=:id ');
                $result->bindParam(':id', $_GET['id']);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){  ?>
                <tr>
                    <td><?php echo $row['name']  ?></td>
                    <td><?php echo $row['qty']  ?></td>
                    <td><?php echo $row['amount']  ?></td>
                </tr>
                <?php $tot+=$row['amount']; } ?>
            </tbody>
        </table>
        <h3 style="color: rgb(214, 127, 150); text-align:right; margin: 15px;">රු.<?php echo $tot; ?></h3>
    </div>

    <br><br>
<center>
<a href="index.php" style=" text-align: center;"><button class="btn btn-info">Home</button></a>
</center>
  

    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>


</body>
</html>
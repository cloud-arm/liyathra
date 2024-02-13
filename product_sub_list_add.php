<table width='100%' class='table'>
    <?php include('connect.php');

    $main = $_GET['main'];
    $mat = $_GET['mat'];
    $qty = $_GET['qty'];
    $type = $_GET['type'];

    $result = $db->prepare("SELECT * FROM product WHERE product_id='$mat'");
    $result->bindParam(':userid', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $mat_name = $row['name'];
    }

    $sql = "INSERT INTO use_product (product_name,qty,product_id,type,main_product) VALUES (?,?,?,?,?)";
    $ql = $db->prepare($sql);
    $ql->execute(array($mat_name, $qty, $mat, $type, $main));


    $result = $db->prepare("SELECT * FROM use_product WHERE main_product ='$main' ");
    $result->bindParam(':userid', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
    ?>


        <tr>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['qty']; ?></td>
            <td><b class="btn btn-danger dllpack" style="background-color: transparent !important;" id="<?php echo $row['id']; ?>" onclick="dll(<?php echo $row['id']; ?>)"><i class="icon-trash">x</i></b></td>
        </tr>

    <?php } ?>
</table>
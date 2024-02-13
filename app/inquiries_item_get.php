<?php
include("../connect.php");
date_default_timezone_set("Asia/Colombo");


$unit = $_GET['unit'];

if ($unit == 1) {

    $invo = $_GET['invo'];
    $type = $_GET['type'];


    $sql = "SELECT * FROM product WHERE  type='Service' AND job_type='$type' ";

    $result = $db->prepare($sql);
    $result->bindParam(':userid', $date);
    $result->execute();

    for ($i = 0; $row = $result->fetch(); $i++) {
        $img = $row['img'];
        if ($img == '') {
            $path = 'img/rice.png';
        } else {
            $path = 'product_img/' . $img;
        }
        $ch = 0;
        $pro_id = $row['product_id'];
        $result2 = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no=:id AND product_id='$pro_id' ");
        $result2->bindParam(':id', $invo);
        $result2->execute();
        for ($i = 0; $row1 = $result2->fetch(); $i++) {
            $ch = $row1['id'];
        }
        if ($ch == 0) {
?>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="info-box">
                    <span class="head"><?php echo $row['name']; ?></span>
                    <span class="sub-head"><?php echo $row['code'] ?></span>
                    <div class="img-box">
                        <img src="<?php echo $path; ?>" alt="">
                    </div>
                    <div class="info-foot">
                        <span class="price">LKR. <?php echo $row['sell'] ?></span>
                        <span class="fav" onclick="open_model('<?php echo $row['product_id'] ?>','<?php echo $row['name'] ?>','<?php echo $row['code'] ?>','<?php echo $row['sell'] ?>')">
                            <i class="fa-solid fa-cart-plus"></i>
                        </span>
                    </div>
                </div>
            </div>

        <?php }
    }
} else

if ($unit == 2) {

    $invo = $_GET['invo'];
    $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invo' ");
    $result->bindParam(':id', $date);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) { ?>

        <div class="sale-info record_<?php echo $row['id'] ?>">
            <span><?php echo $row['name'] ?></span>
            <span onclick="btn_dll(<?php echo $row['id'] ?>)" style="color: #d90000;"><i class="fa-solid fa-xmark me-3"></i></span>
        </div>

<?php }
}
?>
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
            <div class="col-6 col-sm-4 col-md-4 col-lg-4">
                <div class="info-box">
                    <span class="head"><?php echo $row['name']; ?></span>
                    <span class="sub-head"><?php echo $row['code'] ?></span>
                    <div class="img-box">
                        <img src="<?php echo $path; ?>" alt="">
                    </div>
                    <div class="info-foot">
                        <span class="price">LKR. <?php echo $row['sell'] ?></span>
                        <a class="fav" style="color: rgb(var(--bg-black));" href="product_add.php?id=<?php echo $row['product_id']; ?>&invo=<?php echo $invo; ?>">
                            <i class="fa-solid fa-cart-plus"></i>
                        </a>
                    </div>
                </div>
            </div>

        <?php }
    }
}

if ($unit == 2) {

    $pro_id = $_GET['id'];
    $invo = $_GET['invo'];

    $result = $db->prepare("SELECT * FROM use_product WHERE main_product = '$pro_id' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $ch = 0;
        $id = $row['product_id'];
        $result2 = $db->prepare("SELECT * FROM sales_list WHERE invoice_no=:id AND  product_id='$id' ");
        $result2->bindParam(':id', $invo);
        $result2->execute();
        for ($i = 0; $row1 = $result2->fetch(); $i++) {
            $ch = $row1['id'];
        }
        if ($ch == 0) { ?>

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
                                <span class="head"><?php echo $row['product_name'] ?></span>
                            </div>
                            <div class="info-foot">
                                <div class="qty-box">
                                    <input type="number" step=".01" class="qty form-input" id="qty_<?php echo $row['id']; ?>">
                                    <input type="hidden"  id="pid_<?php echo $row['id']; ?>" value="<?php echo $id; ?>">
                                </div>
                                <span class="bin btn" onclick="cartClick('<?php echo $row['id']; ?>')">Add</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dlt-box d-md-none" id="dlt-<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" onclick="sales_add_list(<?php echo $row['id']; ?>)">
                    <a href="#<?php echo $row['id']; ?>" id="<?php echo $row['id']; ?>" class="nav-link">
                        <i class="fa-solid fa-cart-plus"></i>
                    </a>
                </div>
            </div>

<?php }
    }
} ?>
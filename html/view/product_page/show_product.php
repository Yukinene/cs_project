<?php
require '../../inc/header.php';
require '../../inc/controller/productcontroller.php';
include '../../inc/completes.php';
include '../../inc/errors.php';

$product_info_query = mysqli_query($db,"SELECT * FROM `products` WHERE `product_id` = ".$_GET['id']);
if (mysqli_num_rows($product_info_query) > 0 && checkrole('admin')) {
    $product_info = mysqli_fetch_assoc($product_info_query);
}
else {
    header('location: ../../index.php');
}
?>
<div class="card">
    <div class="card-body ms-2">

    <div class="row mt-2 mb-2">
    <div class="col-4"><h3>สินค้า : <?=$product_info['product_name']?></h3></div>
</div>
<div class="mb-2 d-flex flex-row-reverse gap-3">
    <a class="btn btn-danger" href="../../view/admin_page/product_admin.php">ย้อนกลับ</a>
    <?php
        require "modal/edit_product_modal.php";
    ?>
    <a class="btn btn-warning" href="product_material.php?id=<?=$product_info['product_id']?>">ตรวจสอบวัตถุดิบ</a>
    <a class="btn btn-dark" href="../../view/log_page/log_products.php?id=<?=$product_info['product_id']?>">ตรวจสอบการเข้าออก</a>
</div>
<div class="row mb-2">
    <div class="col-4">
        <div class="card">
            <img src="../../images/products_image/<?=$product_info['product_img']?>" style="height: 400px;" alt="">
            <div class="card-body">
                <h3 class="card-title">รูปภาพผลิตภัณฑ์</h3>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                    <h3 class="card-title"><center>ข้อมูลของผลิตภัณฑ์</center></h3>
                    <div class="row mb-2 card-text">
						<label class="col-sm-4">ชื่อผลิตภัณฑ์ : </label>
						<div class="col-sm-8">
						<label for="" class="card-text"><?=$product_info['product_name']?></label>
                        </div>
					</div>
                    <div class="row mb-2 card-text">
						<div class="col-sm-12">
						<label for="" class="card-text"><?=$product_info['product_description']?></label>
                        </div>
					</div>
                    <div class="row mb-2 card-text">
						<label class="col-sm-4">ราคาต่อหน่วย : </label>
						<div class="col-sm-8">
						<label for="" class="card-text"><?=$product_info['product_price']?> บาท</label>
                        </div>
					</div>
                    <div class="row mb-2 card-text">
						<label class="col-sm-4">สถานะ : </label>
						<div class="col-sm-8">
						<label for="" class="card-text"><?php
                    if ($product_info['product_status'] === "active") {
                      echo "พร้อมให้บริการ";
                    }
                    else
                    {
                      echo "ไม่พร้อมให้บริการ";
                    }
                    ?></label>
                        </div>
					</div>
                    <div class="row mb-2 card-text">
						<label class="col-sm-4">จำนวนคงคลัง : </label>
						<div class="col-sm-8">
						<label for="" class="card-text"><?=$product_info['product_amount']?></label>
                        </div>
					</div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-2">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"><center>ประเภทสินค้าที่จัดไว้</center></h3>
                <div class="mb-2 d-flex flex-row-reverse gap-3">
                <?php 
                include "modal/add_product_category_modal.php";
                ?>
                </div>
                <?php
                include 'table/product_categories_list.php';
                ?>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<?php
require '../../inc/footer.php';
?>
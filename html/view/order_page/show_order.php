<?php
require '../../inc/header.php';
require '../../inc/controller/ordercontroller.php';
$username = $_SESSION['username'];
$select_user = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_assoc($select_user);

if (isset($_GET['id'])) {
    $select_order = mysqli_query($db,"SELECT * FROM `orders` WHERE `id` = ".$_GET['id']."");
    $order = mysqli_fetch_assoc($select_order);
    if (!(checkrole('admin') || ($user['id']===$order['user_id']))) {
        header('location: ../../index.php');
    }
    
    $order_cart = mysqli_query($db,"SELECT * FROM `order_products` WHERE `order_id` = ".$_GET['id']);
    $i = 1;
}
else {
    header('location: ../../index.php');
}

?>
<?php 
	include '../../inc/completes.php';
	include '../../inc/errors.php';
?>
<title>คำสั่งซื้อที่ : <?= $order['id'] ?></title>
<div class="card">
    <div class="card-body ms-2">
<div class="row mb-2">
    <div class="col-7">
        <h2 class="card-title mt-2">คำสั่งซื้อที่ : <?= $order['id'] ?></h2>
        <?php include "table/order_cart.php"; ?>
    </div>
    <div class="col-3 mt-5">
                <div class="mt-5 card text-dark bg-light">
                <h5 class="card-title mt-2 text-center">จำนวนเงินและการชำระเงิน</h5>
                    <div class="row mb-2">
                        <label class="col-sm-5">จำนวนเงินทั้งหมด</label>
                        <label class="col-sm-7"><?= $order['amount'] ?></label>
                    </div><hr>
                    <div class="row mb-2">
                        <label class="col-sm-5">ช่องทางการจ่ายเงิน</label>
                        <label class="col-sm-7"><?= $order['payment_method'] ?></label>
                    </div>
                </div>
    </div>
    <div class="col-2">
        <div class="card text-dark text-center bg-white border border-white">
            <h5 class="card-title mt-2">สถานะ :
                <?php if ($order_status[$order['status']] === "ยกเลิกรายการ") { ?>
                    <p class="text-danger">
                <?php } else if ($order_status[$order['status']] === "เสร็จสิ้น") { ?>
                    <p class="text-success">
                <?php } else { ?>
                    <p class="text-secondary"> 
                <?php } ?>
                 <?= $order_status[$order['status']] ?>
                </p>
            </h5>
        </div>
        <?php if($order['status'] != 6) {?>
        <div class="mt-3 card text-dark bg-light">
            <form method="post" enctype="multipart/form-data" action="post/post_order.php">
                <input class="form-control" type="hidden" name="order_id" value="<?= $order['id']; ?>">
                <input class="form-control" type="hidden" name="order_user" value="<?= $order['user_id']; ?>">
                <input class="form-control" type="hidden" name="order_amount" value="<?= $order['amount']; ?>">
                <input class="form-control" type="hidden" name="order_status" value="<?= $order['status']; ?>">
                <input class="form-control" type="hidden" name="created_date" value="<?= $order['created_date']; ?>">
                <?php
                if (checkrole('admin')) {?>
                    <div  class="<?php
                    if ($order['status'] != 5) {
                        echo "visually-hidden";
                     }?>">
                        <center>
                        <h5 class="card-title mt-2">ยืนยันการจัดส่ง</h5>
                        <div class="mb-2">
                            <input class="form-control" type="hidden" name="select_status" value="<?= $order['status']+1; ?>">
                            <button class="btn btn-danger mt-2 mb-1" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" type="submit" name="change_status">จัดส่งเสร็จสิ้น</button>        
                        </div>
                        </center>
                    </div>
                    <div  class="<?php
                    if ($order['status'] <= 2) {
                        if ($order['payment_method'] != 'เก็บเงินปลายทาง') {
                            echo "visually-hidden";
                        }
                     }
                     else {
                        echo "visually-hidden";
                     }
                     ?>">
                        <center>
                        <h5 class="card-title mt-2">จัดเตรียมสินค้า</h5>
                        <div class="mb-2">
                            <input class="form-control" type="hidden" name="select_status" value="3">
                            <button class="btn btn-danger mt-2 mb-1" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" type="submit" name="pre_prod"
                            <?php if ($order_cart_check > 0) {
                                echo 'disabled';
                            } ?>
                            >หักสินค้าออกจากคลัง</button>
                        </div>
                        </center>
                    </div>
                <?php }
                ?>
                <?php
                if ($order['status'] != 1) {
                    ?><div class="<?php
                    if (checkrole('admin')) {
                        echo "visually-hidden";
                     }?>">
                        <div class="form-check" style="text-align:center">
                            <label class="form-check-label" for="flexCheckDefault">
                                <input class="form-check-input align-middle" type="checkbox" value="confirm" name="cancel_order_Check" id="cancel_order_Check">
                                ยืนยันการยกเลิก
                            </label>
                            </div>
                    <center>
                    <button class="btn btn-danger mb-2" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"  type="submit" name="cancel_order">ยกเลิกการสั่งซื้อ</button>
                    </center>
                    </div>
                <?php } if ($order['status'] == 1) {
                    ?>
                    <div class="form-group mt-2 mb-2">
                        <p class="card-text text-center" style="color:Red;">ยกเลิกการสั่งซื้อเรียบร้อย</p>
                    </div>
                <?php } ?>
            </form>
        </div>
        <?php } ?>
    </div>
</div>

<div class="row mb-2">
        <div class="col-12">
            <div class="card text-dark bg-light text-center">
            <h5 class="card-title mt-2 text-center">ที่อยู่ในการจัดส่ง</h5>
            <div class="row mb-2">
                    <label class="col-sm-5">ขื่อ นามสกุล</label>
                    <label class="col-sm-7"><?= $order['name'] ?> <?= $order['surname'] ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5">เลขที่</label>
                    <label class="col-sm-7"><?= $order['building_no'] ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5">ที่อยู่</label>
                    <label class="col-sm-7"><?= $order['line'] ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5">จังหวัด</label>
                    <label class="col-sm-7"><?= $order['province'] ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5">เขต/อำเภอ</label>
                    <label class="col-sm-7"><?= $order['district'] ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5">แขวง/ตำบล</label>
                    <label class="col-sm-7"><?= $order['sub_district'] ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5">ประเทศ</label>
                    <label class="col-sm-7"><?= $order['country'] ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-5">รหัสไปรษณีย์</label>
                    <label class="col-sm-7"><?= $order['postal_code'] ?></label>
                </div>
            </div>
        </div>
</div>
<?php if ($order['status'] != 1) {
    ?>
    <div class="row">
    <h5 class="card-title mb-2">หลักฐานการจ่ายเงินและแพ็คสินค้า</h5>
    <div class="col-12">
        <div class="row">
            <div class="col-6">
                <div class="card text-dark bg-light">
                    <?php
                    if (($order['payment_method'] === "เก็บเงินปลายทาง")) { ?>
                        <div class="row mb-2">
                        <label class="text-center">ไม่ต้องส่งหลักฐานการเงิน</label>
                        </div>
                    <?php }
                    else { 
                        include 'modal/add_payment_modal.php';
                        ?>
                        
                     <?php }
                    ?>
                </div>
            </div>
            <?php if ($order['status'] >= 4 || checkrole('admin') ) {
            ?>
                <div class="col-6">
                <div class="card text-dark bg-light">
                       <?php 
                        $order_shipments = mysqli_query($db,"SELECT * FROM `shipment` WHERE `order_id` = ".$_GET['id']."");
                        include 'modal/add_shipment_modal.php';
                        ?>
                        
                </div>
            </div>
            <?php } 
            ?>
            
        </div>
        
    </div>
    </div>
<?php } ?>

    </div>
</div>
<?php
require '../../inc/footer.php';
?>
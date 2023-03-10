<?php
require '../../inc/header.php';
require '../../view/order_page/order_insert.php';
$order_status = array(
    "รอยืนยันการจ่ายเงิน",
    "ยกเลิกรายการ",
    "กำลังเตรียมส่ง",
    "กำลังจัดส่ง",
    "เสร็จสิ้น"
  );
$username = $_SESSION['username'];
$select_user = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_assoc($select_user);

if (isset($_GET['id'])) {
    $select_order = mysqli_query($db,"SELECT * FROM `orders` WHERE `id` = ".$_GET['id']."");
    $order = mysqli_fetch_assoc($select_order);
    if (!(checkrole('admin') || ($user['id']===$order['user_id']))) {
        header('location: ../../index.php');
    }
    $order_cart = json_decode($order['carts']);
    $i = 1;
}
else {
    header('location: ../../index.php');
}

?>
<?php 
	include '../../inc/complete.php';
    include '../../inc/errors.php'; 
?>
<div class="row mb-2">
    <div class="col-2">
        <h2 class="mt-2">คำสั่งซื้อลำดับที่ <?= $order['id'] ?></h2>
    </div>
    <div class="col-8"></div>    
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
    </div>
</div>  
<div class="row mb-2">
<div class="col-4">
            <h5 class="card-title mt-2">สินค้าที่ซื้อ</h5>
            <table id="cartTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                        <th width='5%'>
                        ลำดับ
                        </th>
                        <th width='40%'>
                        สินค้า
                        </th>
                        <th width='10%'>
                        จำนวน
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Display the cart
                        foreach($order_cart as $item => $quantity) {
                        echo '<tr>';
                        echo '<th>' . $i . '</th>';
                        echo '<th>' . $item . '</th>';
                        echo '<th>' . $quantity . '</th>';
                        echo '</tr>';
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
        </div>
        <div class="col-4">
            <div class="card text-dark bg-light">
            <h5 class="card-title mt-2 text-center">จำนวนเงินและการชำระเงิน</h5>
                <div class="row mb-2">
                    <label class="col-sm-8">จำนวนเงิน<br>(หลังหักส่วนลดแล้ว)</label>
                    <label class="col-sm-4"><?= $order['amount'] ?></label>
                </div><hr>
                <div class="row mb-2">
                    <label class="col-sm-6">ช่องทาง<br>การจ่ายเงิน</label>
                    <label class="col-sm-6"><?= $order['payment_method'] ?></label>
                </div>
            </div>
        </div>
    <div class="mt-3 col-4">
        <div class="card text-dark bg-light">
            <form method="post" enctype="multipart/form-data" action="">
                <input class="form-control" type="hidden" name="order_id" value="<?= $order['id']; ?>">
                <input class="form-control" type="hidden" name="order_user" value="<?= $order['user_id']; ?>">
                <input class="form-control" type="hidden" name="order_amount" value="<?= $order['amount']; ?>">
                <input class="form-control" type="hidden" name="order_status" value="<?= $order['status']; ?>">
                <input class="form-control" type="hidden" name="created_date" value="<?= $order['created_date']; ?>">
                <?php
                if (checkrole('admin')) {?>
                    <div  class="<?php
                    if ($order['status'] == 1) {
                        echo "visually-hidden";
                     }?>">
                        <h5 class="card-title mt-2">เปลี่ยนสถานะ</h5>
                        <div class="mb-2">
                            <label class="mb-2">สถานะที่จะเปลี่ยน <br> ไม่สามารถเปลี่ยนไปเป็นสถานะต่ำกว่าได้</label>
                            <select class="form-select form-select-sm" name="select_status" aria-label=".form-select-sm example">
                            <?php 
                                foreach($order_status as $status => $status_text) { ?>
                                    <option value="<?= $status ?>" <?php if ($status == $order['status']) {
                                        echo "selected";
                                    }
                                    ?>><?=$status_text?></option>
                            <?php    }
                            ?>
                            </select>
                            <center>
                            <button class="btn btn-danger mt-2 mb-1" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" type="submit" name="change_status">เปลี่ยนสถานะ</button>    
                            </center>
                        </div>
                    </div>
                <?php }
                ?>
                <?php
                if ($order['status'] != 1) {
                    ?><div class="<?php
                    if (checkrole('admin')) {
                        echo "visually-hidden";
                     }?>">
                    
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="confirm" name="cancel_order_Check" id="cancel_order_Check">
                        <label class="form-check-label" for="flexCheckDefault">
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
                        $order_payments = mysqli_query($db,"SELECT * FROM `payment` WHERE `order_id` = ".$_GET['id']."");
                        include 'add_payment_modal.php';
                        ?>
                        
                     <?php }
                    ?>
                </div>
            </div>
            <?php if ($order['status'] >= 3 || checkrole('admin') ) {
            ?>
                <div class="col-6">
                <div class="card text-dark bg-light">
                       <?php 
                        $order_shipments = mysqli_query($db,"SELECT * FROM `shipment` WHERE `order_id` = ".$_GET['id']."");
                        include 'add_shipment_modal.php';
                        ?>
                        
                </div>
            </div>
            <?php } 
            ?>
            
        </div>
        
    </div>
    </div>
<?php } ?>


<script>
        $(document).ready(function () {
            $("#cartTable").DataTable({
              "order": [[ 0, "desc" ]],
        "responsive": true,
        "ordering": false,
        lengthMenu: [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100]
          ],
        "pageLength": 25,
        language: 
        {
          url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/th.json'
        }
            });
        });
</script>
<?php
require '../../inc/footer.php';
?>
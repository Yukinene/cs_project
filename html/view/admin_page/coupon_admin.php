<?php
require '../../inc/header.php';
checkadmin();
  include '../../inc/controller/couponcontroller.php';  
  include '../../inc/completes.php';
  include '../../inc/errors.php';
?>
<title>ระบบจัดการคูปองส่วนลด (สำหรับผู้จัดการระบบ)</title>
<div class="card">
    <div class="card-body ms-2">
        <h2 class="card-title">คูปองส่วนลด</h2>
        <div class="mb-2 d-flex flex-row-reverse"> 
            <?php include '../coupon_page/modal/add_coupon_modal.php'; ?>
        </div>
        <div class="row mb-2">
            <div class="col-6 border border-dark">
                <?php require '../coupon_page/coupon_list.php'; ?>
            </div>
            <div class="col-6 border border-dark">
                <?php require '../coupon_page/admin_coupon_usage.php'; ?>
            </div>
        </div>
    </div>
</div>
<?php

require '../../inc/footer.php';
?>
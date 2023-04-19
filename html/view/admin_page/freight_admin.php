<?php
require '../../inc/header.php';
checkadmin();
  include '../../inc/controller/freightcontroller.php';  
  include '../../inc/completes.php';
  include '../../inc/errors.php';
?>
<title>ระบบจัดการค่าขนส่ง (สำหรับผู้จัดการระบบ)</title>
<div class="card">
    <div class="card-body ms-2">
        <h2 class="card-title">ค่าขนส่ง</h2>
        <div class="mb-2 d-flex flex-row-reverse"> 
            <?php include '../freight_page/modal/add_freight_modal.php'; ?>
        </div>
        <?php include '../freight_page/freight_page.php'; ?>
    </div>
</div>
<?php

require '../../inc/footer.php';
?>
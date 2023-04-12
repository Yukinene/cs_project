<?php
require '../../inc/header.php';
require '../../inc/controller/productcontroller.php';
include '../../inc/completes.php';
include '../../inc/errors.php';
checkadmin();
?>
<title>ระบบจัดการสินค้า (สำหรับผู้จัดการระบบ)</title>
<div class="card">
  <div class="card-body ms-2">
    <h2 class="card-title">สินค้า</h2>
    <div class="mb-2 d-flex flex-row-reverse">
      <?php include 'modal/add_product_modal.php'; ?>
    </div>
    <?php include '../product_page/table/product_list_table.php'; ?>
  </div>
</div>    

<?php
require '../../inc/footer.php';
?>
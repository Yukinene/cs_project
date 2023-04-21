<?php
  require '../../inc/header.php';
  checkadmin();
  require '../../inc/controller/tiercontroller.php';
  require '../../inc/controller/freightcontroller.php';
	include '../../inc/completes.php';
	include '../../inc/errors.php';
?>
<title>ระบบจัดการระดับลูกค้า (สำหรับผู้จัดการระบบ)</title>
<div class="card">
  <div class="card-body ms-2">
  <h2 class="card-title">ระดับและส่วนลด</h2>
  <div class="mb-2 d-flex flex-row-reverse gap-3">
        <?php include '../tier_page/modal/add_tier_modal.php'; ?>
  </div>
      <?php include '../tier_page/admin_tier_list.php'; ?>
  </div>
</div>
<?php
require '../../inc/footer.php';
?>
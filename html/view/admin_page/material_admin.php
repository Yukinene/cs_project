<?php
require '../../inc/header.php';
require '../../inc/controller/materialcontroller.php';
include '../../inc/completes.php';
include '../../inc/errors.php';
checkadmin();
?>
<title>ระบบจัดการวัตถุดิบ (สำหรับผู้จัดการระบบ)</title>
<div class="card">
    <div class="card-body ms-2">
      <h2>วัตถุดิบ</h2>
      <div class="mb-2 d-flex flex-row-reverse"> 
        <?php include '../material_page/modal/add_material_modal.php'; ?>
      </div>
        <?php include '../material_page/material_list.php'; ?>
  </div>
</div>

<?php
require '../../inc/footer.php';
?>
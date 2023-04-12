<?php
require '../../inc/header.php';
require '../../inc/controller/plancontroller.php';
include '../../inc/completes.php';
include '../../inc/errors.php';
checkadmin();
?>
<title>ระบบจัดการแผนการผลิต (สำหรับผู้จัดการระบบ)</title>
<div class="card">
  <div class="card-body ms-2">
    <h2 class="card-title">แผนการผลิต</h2>
    <?php
      require '../plan_page/plan_list.php';
    ?>
  </div>
</div>
<?php
require '../../inc/footer.php';
?>
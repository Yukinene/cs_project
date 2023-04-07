<?php
require '../../inc/header.php';
require '../../inc/controller/plancontroller.php';
include '../../inc/completes.php';
include '../../inc/errors.php';
checkadmin();
?>
<title>ระบบจัดการแผนการผลิต (สำหรับผู้จัดการระบบ)</title>
<h2>แผนการผลิต</h2>
  <?php
    require '../plan_page/plan_list.php';
  ?>
<?php
require '../../inc/footer.php';
?>
<?php
require '../../inc/header.php';
checkadmin();
  include '../../inc/controller/categorycontroller.php';  
  include '../../inc/completes.php';
  include '../../inc/errors.php';
?>
<title>ระบบจัดการประเภทสินค้า (สำหรับผู้จัดการระบบ)</title>

<h2>ประเภทสินค้า</h2>
<div class="mb-2 d-flex flex-row-reverse"> 
      <?php include '../category_page/modal/add_category_modal.php'; ?>
</div>
<?php
require '../category_page/category_list.php';
require '../../inc/footer.php';
?>
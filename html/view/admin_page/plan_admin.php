<?php
require '../../inc/header.php';
require '../../inc/plancontroller.php';
require '../../inc/errors.php';
require '../../inc/complete.php';
checkadmin();
$select_plans = mysqli_query($db, "SELECT * FROM `plans`");
$check_plans = mysqli_query($db, "SELECT * FROM `plans` WHERE `status` = 'เสร็จสิ้น'");
?>
<title>ระบบจัดการแผนการผลิต (สำหรับผู้จัดการระบบ)</title>
<h2>แผนการผลิต</h2>
    <div class="mb-2 d-flex flex-row-reverse">
        <form method="post" action="" enctype="multipart/form-data">
        <button class="btn btn-primary" type="submit" name="add_plan"
        <?php if(mysqli_num_rows($check_plans) < 1){
            echo'disabled';
        } ?>
         >เพิ่มแผนการผลิต</button>
        </form>
    </div>
  <?php
    require '../plan/plan_list.php';
  ?>


<?php
require '../../inc/footer.php';
?>
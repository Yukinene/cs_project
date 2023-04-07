<?php
require '../../inc/header.php';
require '../../inc/controller/plancontroller.php';
checkadmin();
if (isset($_GET['id'])) {
    $select_plan = mysqli_query($db,"SELECT * FROM `plans` WHERE `plan_id` = ".$_GET['id']."");
    $plans = mysqli_fetch_assoc($select_plan);
}
else {
    header('location: ../../index.php');
}
	include '../../inc/completes.php';
	include '../../inc/errors.php';
?>
<title>แผนการผลิตที่ <?= $plans['plan_id'] ?></title>

<div class="row mb-2">
    <div class="col-10">
        <h2>แผนการผลิตที่ <?= $plans['plan_id'] ?></h2>
    </div>
    <div class="col-2">
        <div class="mb-2 d-flex flex-row-reverse gap-3">
        <h5>สถานะ : <?= $plans['status'] ?></h5>
        </div>
        <div class="mb-2 d-flex flex-row-reverse gap-3">
            <?php require 'post/change_plan_status.php'; ?>
        </div>
    </div>
</div>
<?php if($plans['status'] == 'เตรียมแผน'){?>
<div class="mb-2 d-flex flex-row-reverse gap-3"> 
<?php require 'modal/add_plan_order_modal.php'; ?>
<?php require 'modal/add_plan_product_modal.php'; ?>
</div>
<?php }?>
<div class="row mb-2">
    <div class="col-4">
        <?php require 'table_list/order_list.php'; ?>
    </div>
    <div class="col-8">
        <?php require 'table_list/product_list.php'; ?>
    </div>
    <div class="col-12">
        <?php require 'table_list/material_list.php'; ?>
    </div>
</div>
<?php
require '../../inc/footer.php';
?>
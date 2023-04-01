<?php
require '../../inc/header.php';
require '../../inc/plancontroller.php';
checkadmin();
if (isset($_GET['id'])) {
    $select_plan = mysqli_query($db,"SELECT * FROM `plans` WHERE `plan_id` = ".$_GET['id']."");
    $plans = mysqli_fetch_assoc($select_plan);
}
else {
    header('location: ../../index.php');
}
?>
<title>แผนการผลิตที่ <?= $plans['plan_id'] ?></title>
<?php 
	include '../../inc/complete.php';
    include '../../inc/errors.php'; 
?>
<div class="row mb-2">
    <div class="col-10">
        <h2>แผนการผลิตที่ <?= $plans['plan_id'] ?></h2>
    </div>
    <div class="col-2">
        <div class="mb-2 d-flex flex-row-reverse gap-3">
            <?php require 'change_plan_status.php'; ?>
        </div>
    </div>
</div>

<div class="mb-2 d-flex flex-row-reverse gap-3"> 
<?php require 'add_plan_order_modal.php'; ?>
<?php require 'add_plan_product_modal.php'; ?>
</div>

<div class="row mb-2">
    <div class="col-4">
    <?php require 'order_list.php'; ?>
    </div>
    <div class="col-8">
        <?php require 'product_list.php'; ?>
    </div>
    <div class="col-12">
        <?php require 'material_list.php'; ?>
    </div>
</div>
<?php
require '../../inc/footer.php';
?>
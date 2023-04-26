<?php
$check_plan_products_amount = mysqli_query($db, "SELECT * FROM `plan_products` WHERE `plan_id` = '".$_GET['id']."'");
?>
<form action="post/post_plan_phase.php" method="post">
    <input type="hidden" name="plan_id" value="<?=
    $_GET['id']
    ?>">
    <?php if ($plans['status'] == 'เตรียมแผน') {?>
        <button type="submit" class="btn btn-success" name="comfirm_plan_phase_1"
        <?php if (mysqli_num_rows($check_plan_products_amount) < 1) {
            echo "disabled";
        } ?>
        >
        ยืนยัน
        </button>
    <?php } ?>
    <?php if ($plans['status'] == 'เตรียมตัวซื้อ') {?>
        <button type="submit" class="btn btn-success" name="comfirm_plan_phase_2">
        ซื้อวัตถุดิบเรียบร้อย
        </button>
    <?php } ?>
    <?php if ($plans['status'] == 'กำลังทำสินค้า') {?>
        <button type="submit" class="btn btn-success" name="comfirm_plan_phase_3">
        ทำสินค้าเสร็จสิ้น
        </button>
    <?php } ?>
    <?php if ($plans['status'] == 'ทำสินค้าเสร็จสิ้น') {?>
        <button type="submit" class="btn btn-success" name="comfirm_plan_phase_4">
        จัดส่งสินค้า
        </button>
    <?php } ?>
</form>

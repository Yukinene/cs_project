<?php
include '../../inc/initialize.php';
if (isset($_POST['plan_id'])) {
    if (isset($_POST['comfirm_plan_phase_1'])) {
        $materials = array();
        $plan_id = $_POST['plan_id'];
        $select_plan_product = mysqli_query($db,"
                SELECT * FROM `plan_products` 
                WHERE `plan_id` = ".$plan_id);
        while($fetch_plan_product = mysqli_fetch_assoc($select_plan_product)){
            $fetch_product = mysqli_fetch_assoc(mysqli_query($db,"
                SELECT * FROM `products` 
                WHERE `product_id` = ".$fetch_plan_product['product_id']));
            $amount = ($fetch_plan_product['order_amount'] + $fetch_plan_product['plan_amount'])+ceil(($fetch_plan_product['order_amount'] + $fetch_plan_product['plan_amount']) * (1/100));
            $quantity = $amount - $fetch_product['product_amount'];
            if ($quantity > 0) {
                    $select_product_materials = mysqli_query($db,"
                    SELECT * FROM `product_materials` 
                    WHERE `product_id` = ".$fetch_plan_product['product_id']);
                    while($fetch_product_materials = mysqli_fetch_assoc($select_product_materials)){
                    $fetch_materials = mysqli_fetch_assoc(mysqli_query($db,"
                    SELECT * FROM `materials` 
                    WHERE `material_id` = ".$fetch_product_materials['material_id']));
                    if(!isset($materials[$fetch_materials['material_id']])) {
                        $materials[$fetch_materials['material_id']] = $fetch_product_materials['material_amount']*$quantity;
                    }
                    else {
                        $materials[$fetch_materials['material_id']] += $fetch_product_materials['material_amount']*$quantity;
                    }
                    }
            }
            else {
                $quantity = 0;
            }
            mysqli_query($db, "
                UPDATE `plan_products` SET `total_amount`=".$quantity."
                WHERE `plan_id` = ".$_POST['plan_id']." AND `product_id` =".$fetch_plan_product['product_id']
                );

        }
        foreach($materials as $item => $quantity) {
            $fetch_materials = mysqli_fetch_assoc(mysqli_query($db,"
                SELECT * FROM `materials` 
                WHERE `material_id` = ".$item));
            $material_amount_f = ceil(($quantity-$fetch_materials['material_amount']) / $fetch_materials['bought_amount']) * $fetch_materials['bought_amount'];
            mysqli_query($db, "
                INSERT INTO `plan_materials`(`plan_id`, `material_id`, `material_amount`,`material_amount_f`) 
                VALUES (".$_POST['plan_id'].",".$item.",".$quantity.",".$material_amount_f.")
                ");
        }
        $status = "เตรียมตัวซื้อ";
        mysqli_query($db, "
                UPDATE `plans` SET `status`='".$status."'
                WHERE `plan_id`=".$_POST['plan_id']);
    }
    if (isset($_POST['comfirm_plan_phase_2'])) {
        $amount = 0;
        $select_plan_materials = mysqli_query($db,"
        SELECT * FROM `plan_materials` 
        WHERE `plan_id`=".$_POST['plan_id']);
        while ($fetch_plan_material = mysqli_fetch_assoc($select_plan_materials)) {
            mysqli_query($db, "
            INSERT INTO `log_materials`(`material_id`, `material_amount`) 
            VALUES (".$fetch_plan_material['material_id'].",".$fetch_plan_material['material_amount_f'].")
            ");
            $fetch_materials = mysqli_fetch_assoc(mysqli_query($db,"
            SELECT * FROM `materials` 
            WHERE `material_id`=".$fetch_plan_material['material_id']));
            mysqli_query($db, "
            UPDATE `materials` SET
            `material_amount`= ".$fetch_materials['material_amount']+$fetch_plan_material['material_amount_f']."
            WHERE `material_id`=".$fetch_plan_material['material_id'].")
            ");
            $amount += ($fetch_plan_material['material_amount_f']*$fetch_materials['bought_price']);
        }
        $status = "กำลังทำสินค้า";
        $info = "ซื้อวัตถุดิบในแผนที่ ".$_POST['plan_id'];
        mysqli_query($db, "
        INSERT INTO `account`(`amount`, `info`)
        VALUES (".-$amount.",".$info.")
        ");
        mysqli_query($db, "
                UPDATE `plans` SET `status`='".$status."'
                WHERE `plan_id`=".$_POST['plan_id']);
    }
    if (isset($_POST['comfirm_plan_phase_3'])) {
        $select_plan_materials = mysqli_query($db,"
        SELECT * FROM `plan_materials` 
        WHERE `plan_id`=".$_POST['plan_id']);
        while ($fetch_plan_material = mysqli_fetch_assoc($select_plan_materials)) {
            mysqli_query($db, "
            INSERT INTO `log_materials`(`material_id`, `material_amount`) 
            VALUES (".$fetch_plan_material['material_id'].",".-$fetch_plan_material['material_amount'].")
            ");
            $fetch_materials = mysqli_fetch_assoc(mysqli_query($db,"
            SELECT * FROM `materials` 
            WHERE `material_id`=".$fetch_plan_material['material_id']));
            mysqli_query($db, "
            UPDATE `materials` SET
            `material_amount`= ".$fetch_materials['material_amount']-$fetch_plan_material['material_amount']."
            WHERE `material_id`=".$fetch_plan_material['material_id'].")
            ");
        }
        $select_plan_products = mysqli_query($db,"
        SELECT * FROM `plan_products` 
        WHERE `plan_id`=".$_POST['plan_id']);
        while ($fetch_plan_product = mysqli_fetch_assoc($select_plan_products)) {
            mysqli_query($db, "
            INSERT INTO `log_products`(`product_id`, `product_amount`) 
            VALUES (".$fetch_plan_product['product_id'].",".$fetch_plan_product['total_amount'].")
            ");
            $fetch_products = mysqli_fetch_assoc(mysqli_query($db,"
            SELECT * FROM `products` 
            WHERE `product_id`=".$fetch_plan_product['product_id']));
            mysqli_query($db, "
            UPDATE `products` SET
            `product_amount`= ".$fetch_products['product_amount']+$fetch_plan_product['total_amount']."
            WHERE `product_id`=".$fetch_plan_product['product_id'].")
            ");
        }
        $status = "ทำสินค้าเสร็จสิ้น";
        mysqli_query($db, "
                UPDATE `plans` SET `status`='".$status."'
                WHERE `plan_id`=".$_POST['plan_id']);
    }
    if (isset($_POST['comfirm_plan_phase_4'])) {
        $select_plan_products = mysqli_query($db,"
        SELECT * FROM `plan_products` 
        WHERE `plan_id`=".$_POST['plan_id']);
        while ($fetch_plan_product = mysqli_fetch_assoc($select_plan_products)) {
            mysqli_query($db, "
            INSERT INTO `log_products`(`product_id`, `product_amount`) 
            VALUES (".$fetch_plan_product['product_id'].",".-$fetch_plan_product['order_amount'].")
            ");
            $fetch_products = mysqli_fetch_assoc(mysqli_query($db,"
            SELECT * FROM `products` 
            WHERE `product_id`=".$fetch_plan_product['product_id']));
            mysqli_query($db, "
            UPDATE `products` SET
            `product_amount`= ".$fetch_products['product_amount']-$fetch_plan_product['order_amount']."
            WHERE `product_id`=".$fetch_plan_product['product_id'].")
            ");
        }
        $select_plan_orders = mysqli_query($db,"
        SELECT * FROM `plan_orders` 
        WHERE `plan_id`=".$_POST['plan_id']);
        $order_status = 4;
        while ($fetch_plan_order = mysqli_fetch_assoc($select_plan_orders)) {
            mysqli_query($db, "
            UPDATE `orders` SET
            `status`= ".$order_status."
            WHERE `id`=".$fetch_plan_order['order_id'].")
            ");
        }
        $status = "เสร็จสิ้น";
        mysqli_query($db, "
                UPDATE `plans` SET `status`='".$status."'
                WHERE `plan_id`=".$_POST['plan_id']);
    }
    array_push($completes, "เปลี่ยนสถานะสำเร็จ");
    header('location: show_plan.php?id='.$_POST['plan_id']);
}
?>
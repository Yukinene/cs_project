<?php
if (isset($_POST['add_plan']))
    {
        $status = 'เตรียมแผน';
        mysqli_query($db, "INSERT INTO `plans`(`status`) VALUES ('".$status."')");
        array_push($completes, "เพิ่มแผนการผลิตสำเร็จ");
    }
if (isset($_GET['id'])) {
    if (isset($_POST['add_planproduct'])) {
            $quantity = $_POST['quantity'];
            $product_id = $_POST['product'];
            $select_plan_product = mysqli_query($db,"SELECT * FROM `plan_products` 
            WHERE `plan_id` = ".$_GET['id']." AND `product_id` = ".$product_id);
            if (mysqli_num_rows($select_plan_product)) {
                $fetch_plan_product = mysqli_fetch_assoc($select_plan_product);
                mysqli_query($db, "
                UPDATE `plan_products` SET `plan_amount`=".$quantity."
                WHERE `plan_id` = ".$_GET['id']." AND `product_id` =".$product_id
                );
            }
            else {
                mysqli_query($db, "
                INSERT INTO `plan_products`(`plan_id`, `product_id`, `plan_amount`) 
                VALUES (".$_GET['id'].",".$product_id.",".$quantity.")
                ");
            }
            array_push($completes, "เพิ่มสำเร็จ");
    }
    if (isset($_POST['del_planproduct'])) {
        $quantity = $_POST['quantity'];
        $product_id = $_POST['product'];
        if ($quantity == 0) {
            mysqli_query($db, "
                DELETE FROM `plan_products` 
                WHERE `plan_id` = ".$_GET['id']." AND `product_id` = ".$product_id);
        }
        else {
            mysqli_query($db, "
                UPDATE `plan_products` SET `plan_amount`=".$quantity."
                WHERE `plan_id` = ".$_GET['id']." AND `product_id` =".$product_id
                );
        }
        array_push($completes, "แก้ไขสำเร็จ");
    }
}
?>
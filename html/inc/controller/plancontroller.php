<?php
if (isset($_POST['add_plan']))
    {
        $check_plans = mysqli_query($db, "SELECT * FROM `plans`");
        if(mysqli_num_rows($check_plans) <= 0)
        {
            $status = 'เตรียมแผน';
            mysqli_query($db, "INSERT INTO `plans`(`status`) VALUES ('".$status."')");
        }
    }
if (isset($_GET['id'])) {
    if (isset($_POST['add_planorder'])) {
        mysqli_query($db, "
        INSERT INTO `plan_orders`(`plan_id`, `order_id`) 
        VALUES (".$_GET['id'].",".$_POST['order'].")
        ");
        $select_order_product = mysqli_query($db,"SELECT * FROM `order_products` 
        WHERE `order_id` = ".$_POST['order']);
        while($fetch_order_product = mysqli_fetch_assoc($select_order_product)){
            $select_plan_product = mysqli_query($db,"SELECT * FROM `plan_products` 
            WHERE `plan_id` = ".$_GET['id']." AND `product_id` = ".$fetch_order_product['product_id']);
            if (mysqli_num_rows($select_plan_product) > 0) {
                $fetch_plan_product = mysqli_fetch_assoc($select_plan_product);
                $quantity = $fetch_order_product['quantity'] + $fetch_plan_product['order_amount'];
                mysqli_query($db, "
                UPDATE `plan_products` SET `order_amount`=".$quantity."
                WHERE `plan_id` = ".$_GET['id']." AND `product_id` =".$fetch_plan_product['product_id']
                );
            }
            else {
                $quantity = $fetch_order_product['quantity'];
                mysqli_query($db, "
                INSERT INTO `plan_products`(`plan_id`, `product_id`, `order_amount`) 
                VALUES (".$_GET['id'].",".$fetch_order_product['product_id'].",".$fetch_order_product['quantity'].")
                ");
            } 
        }
        array_push($completes, "เพิ่มสำเร็จ");
    }
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
    if (isset($_POST['del_planorder'])) {
        $order = $_POST['order'];
        mysqli_query($db, "
                DELETE FROM `plan_orders`
                WHERE `plan_id` = ".$_GET['id']." AND `order_id` = ".$order);
        $select_order_product = mysqli_query($db,"
                SELECT * FROM `order_products` 
                WHERE `order_id` = ".$_POST['order']);
        while($fetch_order_product = mysqli_fetch_assoc($select_order_product)){
                $select_plan_product = mysqli_query($db,"SELECT * FROM `plan_products` 
                WHERE `plan_id` = ".$_GET['id']." AND `product_id` = ".$fetch_order_product['product_id']);
                if (mysqli_num_rows($select_plan_product) > 0) {
                    $fetch_plan_product = mysqli_fetch_assoc($select_plan_product);
                    $quantity = $fetch_plan_product['order_amount'] - $fetch_order_product['quantity'];
                    if (($fetch_plan_product['plan_amount'] + $quantity) == 0) {
                        mysqli_query($db, "
                        DELETE FROM `plan_products` 
                        WHERE `plan_id` = ".$_GET['id']." AND `product_id` = ".$fetch_plan_product['product_id']
                        );
                    }
                    else {
                        mysqli_query($db, "
                        UPDATE `plan_products` SET `order_amount`=".$quantity."
                        WHERE `plan_id` = ".$_GET['id']." AND `product_id` =".$fetch_plan_product['product_id']
                        );
                    }
                    
                }
            }
            array_push($completes, "แก้ไขสำเร็จ");
    }
    if (isset($_POST['del_planproduct'])) {
        $order_quantity = $_POST['order_quantity'];
        $quantity = $_POST['quantity'];
        $product_id = $_POST['product'];
        if (($order_quantity + $quantity) == 0) {
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
<?php
if (isset($_POST['add_order'])) {
    // receive all input values from the form
    $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
    $amount = mysqli_real_escape_string($db, $_POST['amount']);
    $payment_method = mysqli_real_escape_string($db, $_POST['payment_method']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $building_no = mysqli_real_escape_string($db, $_POST['building_no']);
    $line = mysqli_real_escape_string($db, $_POST['line']);
    $province = mysqli_real_escape_string($db, $_POST['province']);
    $district = mysqli_real_escape_string($db, $_POST['district']);
    $sub_district = mysqli_real_escape_string($db, $_POST['sub_district']);
    $country = mysqli_real_escape_string($db, $_POST['country']);
    $postal_code = mysqli_real_escape_string($db, $_POST['postal_code']);
    if ($_POST['coupon'] != NULL) {
      $coupon = $_POST['coupon'];
      $date = date("Y-m-d");  
      $check_coupon_expire = "SELECT * FROM `coupons` WHERE `coupon_name` = '".$coupon."' AND date(`expire_date`) > date('".$date."')";
      if (mysqli_num_rows(mysqli_query($db,$check_coupon_expire)) > 0) {
        if (mysqli_num_rows(mysqli_query($db,"SELECT * FROM `coupon_usage` WHERE `coupon_name` = '".$coupon."' AND `user_id` =".$user_id)) > 0) {
          array_push($errors, "คุณได้ใช้คูปองส่วนลดนี้แล้ว");
        }
        else {
          $coupon_ticket = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `coupons` WHERE `coupon_name` = '".$coupon."'"));
          if (($amount - $coupon_ticket['coupon_price']) > 0) {
            $amount -= $coupon_ticket['coupon_price'];
          }
          else {
            array_push($errors,"ไม่สามารถใช้งานได้เนื่องจากคูปองมีมูลค่าสูงกว่ามูลค่าสินค้าทั้งหมด");
          }
        }
      }
      else {
        $check_coupon = "SELECT * FROM `coupons` WHERE `coupon_name` = '".$coupon."'";
        if (mysqli_num_rows(mysqli_query($db,$check_coupon)) > 0) {
          array_push($errors, "คูปองนี้หมดอายุแล้ว");
        }
        else {
          array_push($errors, "คูปองนี้ไม่มีในระบบ");
        }
      }
    }
    if (count($cart) < 1) {
      array_push($errors, "กรุณาเลือกสินค้า");
    }
    if (count($errors) < 1) {
        // Finally, register order
        $query = "INSERT `orders`(`user_id`, `amount`, `payment_method`,
        `name`, `surname`, `building_no`, `line`, `province`, `district`, `sub_district`,
        `country`, `postal_code`) 
        VALUES ('$user_id','$amount','$payment_method',
        '$name', '$surname', '$building_no', '$line', '$province', '$district', '$sub_district',
          '$country','$postal_code')";
        mysqli_query($db, $query);
        if ($_POST['coupon'] != NULL) {
          mysqli_query($db,"INSERT INTO `coupon_usage`(`coupon_name`, `user_id`) VALUES ('".$coupon."',".$user_id.")");
        }
        $order_id = mysqli_fetch_assoc(mysqli_query($db,"SELECT max(`id`) FROM `orders` WHERE 1"));
        foreach($cart as $item => $quantity) {
              mysqli_query($db, "INSERT INTO `order_products`(`order_id`, `product_id`, `quantity`) 
              VALUES (".$order_id["max(`id`)"].",".$item.",".$quantity.")");
        }
        $month = date("m");
        $year = date("Y");
        $user_order = mysqli_query($db,"SELECT * FROM user_order WHERE user='".$user_id."' AND month='".$month."' AND year='".$year."'");
        if(mysqli_num_rows($user_order) < 1){
            $user_order_query = "INSERT `user_order`(`user`, `month`, `year`, `amount`) 
                VALUES ('".$user['id']."','".$month."','".$year."','".$amount."')";
            
        }
        else {
            $fetch_user_order = mysqli_fetch_assoc($user_order);
            $old_amount = $fetch_user_order['amount'];
            $user_order_query = "UPDATE `user_order` SET `amount`=".$amount+$old_amount." WHERE user='".$user_id."' AND month='".$month."' AND year='".$year."'";
            
        }
        mysqli_query($db, $user_order_query);
        $sum_amount = mysqli_query($db,"SELECT SUM(`amount`) FROM `user_order` WHERE `user` = '".$user_id."'");
        $fetch_sum_amount = mysqli_fetch_assoc($sum_amount);
        $user_total_amount = "UPDATE `users` SET `total_amount`=".$fetch_sum_amount['SUM(`amount`)']." WHERE id='".$user_id."'";
        mysqli_query($db, $user_total_amount);
        array_push($completes, "รายการสินค้าเสร็จสิ้น");
        unset($cart);
        $_SESSION['cart'] = NULL;
      }
}

?>
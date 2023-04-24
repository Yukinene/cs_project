<?php
if (isset($_POST['add_order'])) {
    // receive all input values from the form
    $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
    $payment_method = mysqli_real_escape_string($db, $_POST['payment_method']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $building_no = mysqli_real_escape_string($db, $_POST['building_no']);
    $line = mysqli_real_escape_string($db, $_POST['line']);
    $country = mysqli_real_escape_string($db, $_POST['country']);

    $province_database = mysqli_fetch_assoc(mysqli_query(
      $db,"SELECT * FROM `provinces` WHERE `id` = ".mysqli_real_escape_string($db, $_POST['province'])
    ));
    $district_database = mysqli_fetch_assoc(mysqli_query(
      $db,"SELECT * FROM `districts` WHERE `id` = ".mysqli_real_escape_string($db, $_POST['district'])
    ));
    $sub_district_database = mysqli_fetch_assoc(mysqli_query(
      $db,"SELECT * FROM `sub_districts` WHERE `id` = ".mysqli_real_escape_string($db, $_POST['sub_district'])
    ));
    $province = $province_database['name_th'];
    $district = $district_database['name_th'];
    $sub_district = $sub_district_database['name_th'];
    $postal_code = mysqli_real_escape_string($db, $_POST['postal_code']);
    
    $amount = mysqli_real_escape_string($db, $_POST['amount']);
    
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
          if ($coupon_ticket['coupon_price']+ceil($coupon_ticket['coupon_price']*(5/100)) < $amount) {
             $amount = $amount - $coupon_ticket['coupon_price'];
          }
          else {
            array_push($errors,"มูลค่าของคูปองไม่เพียงพอที่จะสามารถใช้งานได้ตามที่กำหนด");
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
        array_push($completes, "รายการสินค้าเสร็จสิ้น");
        unset($cart);
        $_SESSION['cart'] = NULL;
      }
}
if (isset($_POST['add_order_instant'])) {
    // receive all input values from the form
    $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
    $payment_method = mysqli_real_escape_string($db, $_POST['payment_method_instant']);
    $address = mysqli_fetch_assoc(mysqli_query(
      $db,"SELECT * FROM orders WHERE `id` = ".mysqli_real_escape_string($db, $_POST['instant_address'])
    ));
    $name = mysqli_real_escape_string($db, $address['name']);
    $surname = mysqli_real_escape_string($db, $address['surname']);
    $building_no = mysqli_real_escape_string($db, $address['building_no']);
    $line = mysqli_real_escape_string($db, $address['line']);
    $country = mysqli_real_escape_string($db, $address['country']);
    $province = mysqli_real_escape_string($db, $address['province']);
    $district = mysqli_real_escape_string($db, $address['district']);
    $sub_district = mysqli_real_escape_string($db, $address['sub_district']);
    $postal_code = mysqli_real_escape_string($db, $address['postal_code']);
    
    $amount = mysqli_real_escape_string($db, $_POST['amount_instant']);
    
    if ($_POST['coupon_instant'] != NULL) {
      $coupon = $_POST['coupon_instant'];
      $date = date("Y-m-d");  
      $check_coupon_expire = "SELECT * FROM `coupons` WHERE `coupon_name` = '".$coupon."' AND date(`expire_date`) > date('".$date."')";
      if (mysqli_num_rows(mysqli_query($db,$check_coupon_expire)) > 0) {
        if (mysqli_num_rows(mysqli_query($db,"SELECT * FROM `coupon_usage` WHERE `coupon_name` = '".$coupon."' AND `user_id` =".$user_id)) > 0) {
          array_push($errors, "คุณได้ใช้คูปองส่วนลดนี้แล้ว");
        }
        else {
          $coupon_ticket = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `coupons` WHERE `coupon_name` = '".$coupon."'"));
          if ($coupon_ticket['coupon_price']+ceil($coupon_ticket['coupon_price']*(5/100)) < $amount) {
             $amount = $amount - $coupon_ticket['coupon_price'];
          }
          else {
            array_push($errors,"มูลค่าของคูปองไม่เพียงพอที่จะสามารถใช้งานได้ตามที่กำหนด");
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
        if ($_POST['coupon_instant'] != NULL) {
          mysqli_query($db,"INSERT INTO `coupon_usage`(`coupon_name`, `user_id`) VALUES ('".$coupon."',".$user_id.")");
        }
        $order_id = mysqli_fetch_assoc(mysqli_query($db,"SELECT max(`id`) FROM `orders` WHERE 1"));
        foreach($cart as $item => $quantity) {
              mysqli_query($db, "INSERT INTO `order_products`(`order_id`, `product_id`, `quantity`) 
              VALUES (".$order_id["max(`id`)"].",".$item.",".$quantity.")");
        }
        array_push($completes, "รายการสินค้าเสร็จสิ้น");
        unset($cart);
        $_SESSION['cart'] = NULL;
      }
}
?>
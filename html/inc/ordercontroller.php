<?php
// require '../../inc/initialize.php';
// require '../../inc/session.php';
// require '../../inc/cart.php';
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
    
    if (empty($name) || empty($surname)) {
      array_push($errors, "กรุณาใส่ชื่อ นามสกุล");
    }
    else 
    {if (count($cart) > 0) {
        // Finally, register order
        $query = "INSERT `orders`(`user_id`, `amount`, `payment_method`,
        `name`, `surname`, `building_no`, `line`, `province`, `district`, `sub_district`,
        `country`, `postal_code`) 
        VALUES ('$user_id','$amount','$payment_method',
        '$name', '$surname', '$building_no', '$line', '$province', '$district', '$sub_district',
          '$country','$postal_code')";
        mysqli_query($db, $query);
        $order_id = mysqli_query($db,"SELECT max(`id`) FROM `orders` WHERE 1");
        foreach($cart as $item => $quantity) {
              mysqli_query($db, "INSERT INTO `order_products`(`order_id`, `product_id`, `product_amount`) 
              VALUES (".$order_id[max(`id`)].",".$item.",".$quantity.")");
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
      }
      else {
      array_push($errors, "กรุณาเลือกสินค้า");
      }
      unset($cart);
      $_SESSION['cart'] = NULL;
    }

    
}
//paymant section
if (isset($_POST['add_payment'])) {
  // receive all input values from the form
  $order_id = $_POST['order_id'];
  $user_id = $_POST['user_id'];
  $payment_img = $_FILES['payment_img']['name'];
  $payment_img_tmp_name = $_FILES['payment_img']['tmp_name'];
  $payment_img_rename = 'payment_order_'.$order_id.'_user_'.$user_id.'_'.$_FILES['payment_img']['name'];

  $payment_img_folder = '../../images/payments_image/'.$payment_img;
  $payment_img_folder_rename = '../../images/payments_image/'.$payment_img_rename;

  copy($payment_img_tmp_name, $payment_img_folder);
  if (rename($payment_img_folder,$payment_img_folder_rename)) {

    // Finally, register payment order
    $query = "INSERT INTO `payments`(`order_id`, `payment_img`) VALUES ('$order_id','$payment_img_rename')";
    mysqli_query($db, $query);
    array_push($completes, "เพิ่มหลักฐานเสร็จสิ้น");
  }
}
if (isset($_POST['payment_decline'])) {
  // receive all input values from the form
  $order_id = $_POST['order_id'];
  $user_id = $_POST['user_id'];
  $payment_img_delete = $_POST['payment_img'];
  $payment_img_folder_delete = '../../images/payments_image/'.$payment_img_delete;

  if (unlink($payment_img_folder_delete)) {
    // Finally, delete payment order
    $query = "DELETE FROM `payments` WHERE `order_id` = '$order_id'";
    mysqli_query($db, $query);
    array_push($completes, "เสร็จสิ้น");
  }
}
if (isset($_POST['payment_approve'])) {
  // receive all input values from the form
  $order_id = $_POST['order_id'];
  $user_id = $_POST['user_id'];
  
  $query = "UPDATE `orders` SET `status` = '2' WHERE `orders`.`id` = '$order_id'";
  if (mysqli_query($db, $query)) {
    // Finally, approve payment order
    array_push($completes, "เสร็จสิ้น");
  }
}
//shipment section
if (isset($_POST['add_shipment'])) {
  // receive all input values from the form
  $order_id = $_POST['order_id'];
  $user_id = $_POST['user_id'];
  $shipment_img = $_FILES['shipment_img']['name'];
  $shipment_img_tmp_name = $_FILES['shipment_img']['tmp_name'];
  $shipment_img_rename = 'shipment_order_'.$order_id.'_user_'.$user_id.'_'.$_FILES['shipment_img']['name'];

  $shipment_img_folder = '../../images/shipments_image/'.$shipment_img;
  $shipment_img_folder_rename = '../../images/shipments_image/'.$shipment_img_rename;

  copy($shipment_img_tmp_name, $shipment_img_folder);
  if (rename($shipment_img_folder,$shipment_img_folder_rename)) {

    // Finally, register shipment order
    $query = "INSERT INTO `shipment`(`order_id`, `shipment_img`) VALUES ('$order_id','$shipment_img_rename')";
    mysqli_query($db, $query);
    array_push($completes, "เพิ่มหลักฐานเสร็จสิ้น");
  }
}
if (isset($_POST['shipment_decline'])) {
  // receive all input values from the form
  $order_id = $_POST['order_id'];
  $user_id = $_POST['user_id'];
  $shipment_img_delete =  $_POST['shipment_img'];
  $shipment_img_folder_delete = '../../images/shipments_image/'.$shipment_img_delete;

  if (unlink($shipment_img_folder_delete)) {
    // Finally, delete shipment order
    $query = "DELETE FROM `shipment` WHERE `order_id` = '$order_id'";
    mysqli_query($db, $query);
    array_push($completes, "เสร็จสิ้น");
  }
}
if (isset($_POST['shipment_approve'])) {
  // receive all input values from the form
  $order_id = $_POST['order_id'];
  $user_id = $_POST['user_id'];
  
  $query = "UPDATE `orders` SET `status` = '5' WHERE `orders`.`id` = '$order_id'";
  if (mysqli_query($db, $query)) {
    // Finally, approve shipment order
    array_push($completes, "เสร็จสิ้น");
  }
}
//status section
if (isset($_POST['change_status'])) {
  // receive all input values from the form
  $order_id = $_POST['order_id'];
  $order_user = $_POST['order_user'];
  $order_amount = $_POST['order_amount'];
  $order_status = $_POST['order_status'];
  $created_date = strtotime($_POST['created_date']);
  $month = date("m",$created_date);
  $year = date("Y",$created_date);
  $status = $_POST['select_status'];
  if ($order_status < $status) {
    $query = "UPDATE `orders` SET `status` = '$status' WHERE `orders`.`id` = '$order_id'";
    if (mysqli_query($db, $query)) {
      // Finally, change status order
      if ($status == 1) {
      $user_order = mysqli_query($db,"SELECT * FROM user_order WHERE user='".$order_user."' AND month='".$month."' AND year='".$year."'");
      $fetch_user_order = mysqli_fetch_assoc($user_order);
      $old_amount = $fetch_user_order['amount'];
      $user_order_query = "UPDATE `user_order` SET `amount`=".$old_amount-$order_amount." WHERE user='".$order_user."' AND month='".$month."' AND year='".$year."'";
      mysqli_query($db, $user_order_query);
      $sum_amount = mysqli_query($db,"SELECT SUM(`amount`) FROM `user_order` WHERE `user` = '".$order_user."'");
      $fetch_sum_amount = mysqli_fetch_assoc($sum_amount);
      $user_total_amount = "UPDATE `users` SET `total_amount`=".$fetch_sum_amount['SUM(`amount`)']." WHERE id='".$order_user."'";
      mysqli_query($db, $user_total_amount);
      }
      array_push($completes, "เสร็จสิ้น");
    }
  }
  else {
    array_push($errors, "ไม่สามารถทำได้");
  }
}
if (isset($_POST['cancel_order'])) {
  // receive all input values from the form
  $order_id = $_POST['order_id'];
  $order_user = $_POST['order_user'];
  $order_amount = $_POST['order_amount'];
  $order_status = $_POST['order_status'];
  $created_date = strtotime($_POST['created_date']);
  $month = date("m",$created_date);
  $year = date("Y",$created_date);
  $check_cancel = $_POST['cancel_order_Check'];
  $status = 1;
  if ($order_status < 2 && $check_cancel === "confirm") {
    $query = "UPDATE `orders` SET `status` = '$status' WHERE `orders`.`id` = '$order_id'";
    if (mysqli_query($db, $query)) {
      // Finally, approve cancel order
      $user_order = mysqli_query($db,"SELECT * FROM user_order WHERE user='".$order_user."' AND month='".$month."' AND year='".$year."'");
      $fetch_user_order = mysqli_fetch_assoc($user_order);
      $old_amount = $fetch_user_order['amount'];
      $user_order_query = "UPDATE `user_order` SET `amount`=".$old_amount-$order_amount." WHERE user='".$order_user."' AND month='".$month."' AND year='".$year."'";
      mysqli_query($db, $user_order_query);
      $sum_amount = mysqli_query($db,"SELECT SUM(`amount`) FROM `user_order` WHERE `user` = '".$order_user."'");
      $fetch_sum_amount = mysqli_fetch_assoc($sum_amount);
      mysqli_query($db, "UPDATE `users` SET `total_amount`=".$fetch_sum_amount['SUM(`amount`)']." WHERE id='".$order_user."'");
      array_push($completes, "เสร็จสิ้น");
    }
  }
  else {
    array_push($errors, "ไม่สามารถทำได้");
  }
}
?>
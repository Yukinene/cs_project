<?php
if (isset($_POST['add_dis'])) {
    $tier = mysqli_real_escape_string($db, $_POST['tier']);
    $order_price = mysqli_real_escape_string($db, $_POST['price']);
    $discount_percentage = mysqli_real_escape_string($db, $_POST['percentage']);
    $tier_check = "SELECT * FROM `discount` WHERE `tier` = '".$tier."' LIMIT 1";
    $result = mysqli_query($db,$tier_check);
    $check = mysqli_fetch_assoc($result);
    if ($check) { // if check exists
        array_push($errors, "ระดับนี้มีอยู่ในระบบ");
      }
    else {
      $query = "INSERT INTO `discount`(`tier`,`order_price`, `discount_percentage`) 
      VALUES ('$tier','$order_price','$discount_percentage')";
  	  mysqli_query($db, $query);
      array_push($completes, "เพิ่มระดับสำเร็จ");
    }
}
if (isset($_POST['del_dis'])) {
  $tier = mysqli_real_escape_string($db, $_POST['tier']);
  $tier_check = "SELECT * FROM `discount` WHERE `tier` = '".$tier."' LIMIT 1";
  $result = mysqli_query($db,$tier_check);
  $check = mysqli_fetch_assoc($result);
  if ($check) { // if check exists
    $query = "DELETE FROM `discount` WHERE `tier` = '".$tier."'";
    mysqli_query($db, $query);
    array_push($completes, "ลบระดับสำเร็จ");
    }
  else {
    array_push($errors, "ระดับนี้ไม่มีอยู่ในระบบ");
  }
}
?>
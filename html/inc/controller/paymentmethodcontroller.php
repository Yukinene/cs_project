<?php
if (isset($_POST['add_paym'])) {
    $method = mysqli_real_escape_string($db, $_POST['method']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $method_check = "SELECT * FROM `payment_method` WHERE `method` = '".$method."' LIMIT 1";
    $result = mysqli_query($db, $method_check);
    $check = mysqli_fetch_assoc($result);
    if ($check) { // if check exists

        array_push($errors, "ช่องทางการจ่ายเงินนี้มีอยู่ในระบบ");
      }
    else {
      $query = "INSERT INTO `payment_method`(`method`, `description`) 
      VALUES ('$method','$description')";
  	  mysqli_query($db, $query);
      array_push($completes, "เพิ่มช่องทางการจ่ายเงิน");
    }
}
if (isset($_POST['change_status'])) {
  // receive all input values from the form
  $payment_method = $_POST['method'];
  $payment_status = $_POST['status'];
  if ($payment_status === "active") {
    $payment_status_after = "deactive";
  }
  elseif ($payment_status === "deactive") {
    $payment_status_after = "active";
  }
  else {
    array_push($errors, "เปลี่ยนสถานะไม่สำเร็จ");
  }
  if (count($errors) == 0) {
    // Finally, register product and upload image
    $query = "UPDATE `payment_method` SET `payment_status`='".$payment_status_after."' WHERE `method` = '".$payment_method."'";
    mysqli_query($db, $query);
    array_push($completes, "เปลี่ยนสถานะสำเร็จ");
  }
}
if (isset($_POST['edit_paym'])) {
  $old_method = $_POST['old_method'];
  $method = mysqli_real_escape_string($db, $_POST['method']);
  $description = mysqli_real_escape_string($db, $_POST['description']);
  $method_check = "SELECT * FROM `payment_method` WHERE `method` = '".$method."' LIMIT 1";
  $result = mysqli_query($db, $method_check);
  $check = mysqli_fetch_assoc($result);
  if ($old_method === $method) { //if edit description only
      $query = "UPDATE `payment_method` SET `description`='".$description."' WHERE `method` = '".$old_method."'";
      mysqli_query($db, $query);
      array_push($completes, "แก้ไขช่องทางการจ่ายเงินสำเร็จ");
    }
  else {
    if ($check) { // if check exists
      array_push($errors, "ช่องทางการจ่ายเงินนี้มีอยู่ในระบบ");
    }
    else {
      $query = "UPDATE `payment_method` SET `method`='".$method."',`description`='".$description."' WHERE `method` = '".$old_method."'";
      mysqli_query($db, $query);
      array_push($completes, "แก้ไขช่องทางการจ่ายเงินสำเร็จ");
    }
    
  }
}
?>
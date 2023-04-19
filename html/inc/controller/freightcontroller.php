<?php 
if (isset($_POST['add_frei'])) {
    $province_id = mysqli_real_escape_string($db, $_POST['province']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    if (mysqli_num_rows(mysqli_query($db,"SELECT * FROM `freight` WHERE `province_id` = {$_POST['province']}")) > 0) {
      array_push($errors, "มีจังหวัดนี้ในระบบค่าขนส่งเรียบร้อยแล้ว");
    }
    if (mysqli_num_rows(mysqli_query($db,"SELECT * FROM `provinces` WHERE `id` = {$_POST['province']}")) < 1) {
      array_push($errors, "ไม่มีจังหวัดนี้ในระบบ");
    }
    if (count($errors) < 1) {
      $query = "INSERT INTO `freight`(`province_id`, `price`) VALUES ('".$province_id."','".$price."')";
      mysqli_query($db, $query);
      array_push($completes, "เพิ่มค่าขนส่งสำเร็จของจังหวัดสำเร็จ");
    }
    
  }
if (isset($_POST['edit_frei'])) {
    $province_id = mysqli_real_escape_string($db, $_POST['province']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    if (mysqli_num_rows(mysqli_query($db,"SELECT * FROM `freight` WHERE `province_id` = {$_POST['province']}")) < 1) {
      array_push($errors, "ไม่มีจังหวัดนี้ในระบบค่าขนส่ง");
    }
    if (mysqli_num_rows(mysqli_query($db,"SELECT * FROM `provinces` WHERE `id` = {$_POST['province']}")) < 1) {
      array_push($errors, "ไม่มีจังหวัดนี้ในระบบ");
    }
    if (count($errors) < 1) {
      $query = "UPDATE `freight` SET `price`='".$price."' WHERE `province_id`='".$province_id."'";
      mysqli_query($db, $query);
      array_push($completes, "แก้ไขค่าขนส่งสำเร็จ");
    }

  }
  if (isset($_POST['del_frei'])) {
    $province_id = mysqli_real_escape_string($db, $_POST['province']);
    if ($province_id != 0 && $province_id != NULL) {
      $query = "DELETE FROM `freight` WHERE `province_id` ='".$province_id."'";
      mysqli_query($db, $query);
      array_push($completes, "ลบค่าขนส่งสำเร็จ");
    }
    else {
      array_push($errors, "ไม่สามารถลบค่าขนส่งได้");
    }
  }
?>
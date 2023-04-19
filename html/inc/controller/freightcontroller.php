<?php 
if (isset($_POST['add_frei'])) {
    $province_id = mysqli_real_escape_string($db, $_POST['province']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $query = "INSERT INTO `freight`(`province_id`, `price`) VALUES ('".$province_id."','".$price."')";
    mysqli_query($db, $query);
    array_push($completes, "แก้ไขค่าขนส่งสำเร็จ");
  }
if (isset($_POST['edit_frei'])) {
    $province_id = mysqli_real_escape_string($db, $_POST['province']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $query = "UPDATE `freight` SET `price`='".$price."' WHERE `province_id`='".$province_id."'";
    mysqli_query($db, $query);
    array_push($completes, "แก้ไขค่าขนส่งสำเร็จ");
  }
?>
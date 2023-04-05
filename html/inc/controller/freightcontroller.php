<?php 
if (isset($_POST['cha_frei'])) {
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $ordermore = mysqli_real_escape_string($db, $_POST['ordermore']);
    $query = "UPDATE `freight` SET `price`='".$price."',`ordermore`='".$ordermore."' WHERE 1";
    mysqli_query($db, $query);
    array_push($completes, "แก้ไขค่าขนส่งสำเร็จ");
  }
?>
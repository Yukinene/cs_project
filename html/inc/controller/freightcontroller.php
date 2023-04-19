<?php 
if (isset($_POST['add_frei'])) {
    $province_id = mysqli_real_escape_string($db, $_POST['province']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $query = "INSERT INTO `freight`(`province_id`, `price`) VALUES ('".$province_id."','".$price."')";
    mysqli_query($db, $query);
    array_push($completes, "แก้ไขค่าขนส่งสำเร็จ");
  }
?>


<?php
// Note
// ค่าขนส่ง
// เมื่ออยู่แถวกรุงเทพฯและปริมณฑล(นครปฐม นนทบุรี ปทุมธานี สมุครปราการ สมุครสาคร) 40 บาท
// ต่างจังหวัด 60 บาท
?>
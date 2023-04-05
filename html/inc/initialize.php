<?php
  // initializing variables
  $username = "";
  $name = "";
  $surname = "";
  $email    = "";
  $errors = array();
  $completes = array();
  $order_status = array(
    "รอยืนยันการจ่ายเงิน",
    "ยกเลิกรายการ",
    "จ่ายเงินเรียบร้อย",
    "กำลังจัดทำสินค้า",
    "กำลังเตรียมส่ง",
    "กำลังจัดส่ง",
    "เสร็จสิ้น"
  );
  $month = array("","มกราคม.","กุมภาพันธ์","มีนาคม","เมษายน.","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
  // connect to the database
  $db = mysqli_connect('localhost', 'root', '', 'cs_project_db');
  

?>
<?php
if (isset($_POST['add_cate'])) {
    $category = mysqli_real_escape_string($db, $_POST['category']);
    $category_check = "SELECT * FROM `categories` WHERE `category` = '".$category."' LIMIT 1";
    $result = mysqli_query($db,$category_check);
    $check = mysqli_fetch_assoc($result);
    if ($check) { // if check exists
        array_push($errors, "ประเภทสินค้านี้มีอยู่ในระบบ");
      }
    else {
      $query = "INSERT INTO `categories`(`category`) 
      VALUES ('$category')";
  	  mysqli_query($db, $query);
      array_push($completes, "เพิ่มประเภทสินค้าสำเร็จ");
    }
}
if (isset($_POST['del_cate'])) {
  $category = mysqli_real_escape_string($db, $_POST['category']);
  $category_check = "SELECT * FROM `categories` WHERE `category` = '".$category."' LIMIT 1";
  $result = mysqli_query($db,$category_check);
  $check = mysqli_fetch_assoc($result);
  if ($check) { // if check exists
    $query = "DELETE FROM `categories` WHERE `category` = '".$category."'";
    mysqli_query($db, $query);
    $product_category_del_query = "DELETE FROM `product_categories` WHERE `category` = '".$category."'";
    mysqli_query($db, $product_category_del_query);
    array_push($completes, "ลบสำเร็จ");
    }
  else {
    array_push($errors, "ประเภทสินค้านี้ไม่มีอยู่ในระบบ");
  }
}
?>
<?php 
  require 'session.php';

  if (isset($_POST['add_mate'])) {
      // receive all input values from the form
      $material_name = mysqli_real_escape_string($db, $_POST['material_name']);
      $bought_amount = mysqli_real_escape_string($db, $_POST['bought_amount']);
      $bought_price = mysqli_real_escape_string($db, $_POST['bought_price']);
        $query = "INSERT INTO materials (material_name,bought_amount,bought_price) 
              VALUES('$material_name','$bought_amount','$bought_price')";
        mysqli_query($db, $query);
        array_push($completes, "เพิ่มสำเร็จ");
    }
    if (isset($_POST['edit_mate'])) {
      // receive all input values from the form
      $material_id = mysqli_real_escape_string($db, $_POST['material_id']);
      $material_name = mysqli_real_escape_string($db, $_POST['material_name']);
      $bought_amount = mysqli_real_escape_string($db, $_POST['bought_amount']);
      $bought_price = mysqli_real_escape_string($db, $_POST['bought_price']);
      $check = mysqli_fetch_assoc(
        mysqli_query($db,
        "SELECT * FROM `materials` WHERE `material_name` = '".$material_name."' AND NOT `material_id` = '".$material_id."' LIMIT 1")
        );
      if ($check) { // if check exists
          array_push($errors, "วัตถุดิบนี้มีอยู่ในระบบ");
        }
      else {
        $query = "UPDATE `materials` 
        SET `material_name`='".$material_name."',`bought_amount`='".$bought_amount."',`bought_price`='".$bought_price."' 
        WHERE `material_id` = '".$material_id."'";
        mysqli_query($db, $query);
        array_push($completes, "แก้ไขสำเร็จ");
      }
    }
    if (isset($_POST['change_status'])) {
      // receive all input values from the form
      $product_id = $_POST['product_id'];
      $product_status = $_POST['product_status'];
      if ($product_status === "active") {
        $product_status_after = "deactive";
      }
      elseif ($product_status === "deactive") {
        $product_status_after = "active";
      }
      else {
        array_push($errors, "เปลี่ยนสถานะไม่สำเร็จ");
      }
      if (count($errors) == 0) {
        // Finally, product product status
        $query = "UPDATE `products` SET `product_status`='".$product_status_after."' WHERE `product_id` = ".$product_id;
        mysqli_query($db, $query);
        array_push($completes, "เปลี่ยนสถานะสำเร็จ");
      }
    }
    if (isset($_POST['edit_prod_cate'])) {
      // receive all input values from the form
      $product_id = $_POST['product_id'];
      $old_product_category = $_POST['old_product_category'];
      $product_category = $_POST['product_category'];
      if ($old_product_category === $product_category) {
        array_push($errors, "ไม่สามารถเปลี่ยนประเภทเดิมได้");
      }
      if (count($errors) == 0) {
        // Finally, product product status
        $query = "UPDATE `products` SET `product_category`='".$product_category."' WHERE `product_id` = ".$product_id;
        mysqli_query($db, $query);
        array_push($completes, "เปลี่ยนสถานะสำเร็จ");
      }
    }
?>
<?php
if (isset($_GET['id'])) {
    checkadmin();
    $select_products = mysqli_query($db,"SELECT * FROM `products` WHERE `product_id` = ".$_GET['id']."");
    $fetch_products = mysqli_fetch_assoc($select_products);
}
if (isset($_POST['add_pmat'])) {
  // receive all input values from the form
  $product_id = mysqli_real_escape_string($db, $_POST['product_id']);
  $material_id = mysqli_real_escape_string($db, $_POST['product_material']);
  $material_amount = mysqli_real_escape_string($db, $_POST['material_amount']);
    $query = "INSERT INTO product_materials (product_id,material_id,material_amount) 
          VALUES('$product_id','$material_id','$material_amount')";
    mysqli_query($db, $query);
    array_push($completes, "เพิ่มสำเร็จ");
}
if (isset($_POST['edit_pmat'])) {
  // receive all input values from the form
  $product_id = mysqli_real_escape_string($db, $_POST['product_id']);
  $material_id = mysqli_real_escape_string($db, $_POST['material_id']);
  $material_amount = mysqli_real_escape_string($db, $_POST['material_amount']);
    $query = "UPDATE `product_materials` SET `material_amount`= ".$material_amount.
    " WHERE `product_id` = ".$product_id." AND `material_id` = ".$material_id."";
    mysqli_query($db, $query);
    array_push($completes, "แก้ไขสำเร็จ");
}
if (isset($_POST['del_pmat'])) {
  // receive all input values from the form
  $product_id = mysqli_real_escape_string($db, $_POST['product_id']);
  $material_id = mysqli_real_escape_string($db, $_POST['material_id']);
    $query = "DELETE FROM `product_materials` WHERE `product_id` = ".$product_id." AND `material_id` = ".$material_id."";
    mysqli_query($db, $query);
    array_push($completes, "ลบสำเร็จ");
}
?>
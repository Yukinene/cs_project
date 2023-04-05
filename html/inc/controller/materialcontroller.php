<?php 
  include __DIR__.'/../session.php';

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
?>
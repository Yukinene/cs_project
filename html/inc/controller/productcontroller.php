<?php

  include __DIR__.'/../session.php';

  if (isset($_POST['add_prod'])) {
      // receive all input values from the form
      $product_name = mysqli_real_escape_string($db, $_POST['product_name']);
      $product_description = mysqli_real_escape_string($db, $_POST['product_description']);
      $product_price = mysqli_real_escape_string($db, $_POST['product_price']);

      $product_img = $_FILES['product_img']['name'];
      $product_img_tmp_name = $_FILES['product_img']['tmp_name'];
      $date = new DateTime();
      $result = $date->format('Y-m-d_H_i_s');
      $product_img_rename = '_create_'.$result.'_'.$product_img;

      $product_img_folder = '../../images/products_image/'.$product_img;
      $product_img_folder_rename = '../../images/products_image/'.$product_img_rename;

      // Finally, register product and upload image
      if (mysqli_num_rows(
        mysqli_query($db, "SELECT * FROM `products` WHERE `product_name` = '".$product_name."'")
      ) > 0) {
        array_push($errors, "มีผลิตภัณฑ์อยู่แล้ว");
      }
      else {
        copy($product_img_tmp_name, $product_img_folder);
      if (rename($product_img_folder,$product_img_folder_rename)) {
        $query = "INSERT INTO products (product_name,product_description,product_img,product_price) 
            VALUES('$product_name','$product_description','$product_img_rename','$product_price')";
        mysqli_query($db, $query);
        array_push($completes, "เพิ่มสำเร็จ");
        
      }
      }
      
    }
    if (isset($_POST['edit_prod'])) {
      // receive all input values from the form
      $product_id = $_POST['product_id'];
      $product_img_name = $_POST['product_img'];
      $product_name = mysqli_real_escape_string($db, $_POST['product_name']);
      $product_description = mysqli_real_escape_string($db, $_POST['product_description']);
      $product_price = mysqli_real_escape_string($db, $_POST['product_price']);
      // Finally, edit product and upload image
      if ($_FILES['product_img']['name'] != '') {
        $product_img = $_FILES['product_img']['name'];
        $product_img_tmp_name = $_FILES['product_img']['tmp_name'];
        $date = new DateTime();
        $result = $date->format('Y-m-d_H_i_s');
        $product_img_rename = '_create_'.$result.'_'.$product_img;

        $product_img_folder = '../../images/products_image/'.$product_img;
        $product_img_folder_rename = '../../images/products_image/'.$product_img_rename;
        $product_img_folder_delete = '../../images/products_image/'.$product_img_name;
        if (unlink($product_img_folder_delete)) {
          copy($product_img_tmp_name, $product_img_folder);
          if (rename($product_img_folder,$product_img_folder_rename)) {
            $query = "UPDATE `products` SET `product_name` = '".$product_name."', `product_description` = '".$product_description."',
             `product_img` = '".$product_img_rename."', `product_price` = '".$product_price."'
              WHERE `products`.`product_id` = ".$product_id."";
            mysqli_query($db, $query);
            array_push($completes, "แก้ไขสำเร็จ");
          }
        }
      }
      else {
        $query = "UPDATE `products` SET `product_name` = '".$product_name."', `product_description` = '".$product_description."',
             `product_price` = '".$product_price."'
              WHERE `products`.`product_id` = ".$product_id."";
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
    if (isset($_POST['add_prod_cate'])) {
      $product_id = $_POST['product_id'];
      $product_category = $_POST['product_category'];
        $query = "INSERT INTO `product_categories`(`product_id`, `category`) VALUES (".$product_id.",'".$product_category."')";
        mysqli_query($db, $query);
        array_push($completes, "เพิ่มประเภทสินค้าในผลิตภัณฑ์สำเร็จ");
    }
    if (isset($_POST['del_prod_cate'])) {
      $product_id = $_POST['product_id'];
      $product_category = $_POST['product_category'];
        $query = "DELETE FROM `product_categories` WHERE `product_id` = ".$product_id." AND `category` = '".$product_category."'";
        mysqli_query($db, $query);
        array_push($completes, "ลบประเภทสินค้าในผลิตภัณฑ์สำเร็จ");
    }
?>
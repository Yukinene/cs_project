<?php
// Define an array to store the cart items
$cart = array();

// Check cart
if(isset($_SESSION['cart'])) {
  $cart = $_SESSION['cart'];
}

// Add an item to the cart
if(isset($_POST['add_to_cart'])){
  if (count($cart) < 10) {
    $item = $_POST['product_name'];
    if(!isset($cart[$item])) {
      $cart[$item] = 1;
    array_push($completes, "เพิ่มในรถเข็นเรียบร้อย");
    } else {
      $cart[$item]++;
      array_push($completes, "เพิ่มจำนวนสินค้าในรถเข็นเรียบร้อย");
    }
    $_SESSION['cart'] = $cart;
  }
  else {
    array_push($errors, "ไม่สามารถใส่สินค้าเกิน 10 ชนิดได้");
  }
}

// Remove quantity from an item in the cart
if(isset($_POST['remove_quantity'])){
  $item = $_POST['product_name'];
  if(isset($cart[$item])) 
  {
    if($cart[$item] > 1)
    {
      $cart[$item]--;
      array_push($completes, "ลดจำนวนสินค้าในรถเข็นเรียบร้อย");
    }
    else
    {
      unset($cart[$item]);
    }
  }
  $_SESSION['cart'] = $cart;
}

  
  // Remove an item from the cart
  if(isset($_POST['remove'])) {
    $item = $_POST['product_name'];
    if(isset($cart[$item])) {
      unset($cart[$item]);
    }
    $_SESSION['cart'] = $cart;
  }

?>
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
    $item = $_POST['product_id'];
    if(!isset($cart[$item])) {
      $cart[$item] = 1;
    array_push($completes, "เพิ่มในรถเข็นเรียบร้อย");
    } else {
      if ($cart[$item] < 50) {
        $cart[$item]++;
        array_push($completes, "เพิ่มจำนวนสินค้าในรถเข็นเรียบร้อย");
      }
      else {
        array_push($errors, "ไม่สามารถสั่งสินค้าแต่ละชนิดเกิน 50 ได้");
      }
    }
    $_SESSION['cart'] = $cart;
  }
  else {
    array_push($errors, "ไม่สามารถใส่สินค้าเกิน 10 ชนิดได้");
  }
}
if(isset($_POST['add_quantity_10'])){
  $item = $_POST['product_id'];
  if ($cart[$item] < 50) {
    $cart[$item] += 10;
    array_push($completes, "เพิ่มจำนวนสินค้าในรถเข็นเรียบร้อย");
  }
  else {
    array_push($errors, "ไม่สามารถสั่งสินค้าแต่ละชนิดเกิน 50 ได้");
  }
  $_SESSION['cart'] = $cart;
}

// Remove quantity from an item in the cart
if(isset($_POST['remove_quantity'])){
  $item = $_POST['product_id'];
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
if(isset($_POST['remove_quantity_10'])){
  $item = $_POST['product_id'];
  $cart[$item] -= 10;
  array_push($completes, "ลดจำนวนสินค้าในรถเข็นเรียบร้อย");
  $_SESSION['cart'] = $cart;
}

// Remove an item from the cart
if(isset($_POST['remove'])) {
  $item = $_POST['product_id'];
  if(isset($cart[$item])) {
    unset($cart[$item]);
    array_push($completes, "ยกเลิกการสั่งซื้อสินค้าในรถเข็นเรียบร้อย");
  }
  $_SESSION['cart'] = $cart;
}

?>
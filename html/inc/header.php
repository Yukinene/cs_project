<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'initialize.php'; ?>
    <?php require 'script.php'; ?>
    <?php require 'permission.php'; ?>
</head>
<body class="d-flex flex-column min-vh-100">
  <div id="header" class="fixed-top mb-4 border-bottom bg-white">
    <header class="container d-flex flex-wrap justify-content-center py-3">
      <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <a href="../../index.php">
        <img src="../../images/logo.png" style="width:60px;height:40px;display: inline;"></img>
          </a>
      </div>
      
      
      <ul class="nav nav-pills">
        <li class="nav-item"><a name="home" href="../../index.php" class="nav-link">หน้าหลัก</a></li>
        <li class="nav-item"></li>
        
        <?php
        if (isset($_SESSION['username'])) 
        {?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            สินค้า <i class="bi bi-bag-fill"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
            <li class="nav-item"><a name="product_list" href="../../view/product_page/product_list.php" class="nav-link">สินค้าทั้งหมด</a></li>
              <?php 
              $category_list_query = "SELECT * FROM `category`";
              $select_category_list = mysqli_query($db,$category_list_query);
              if(mysqli_num_rows($select_category_list) > 0){
                while($fetch_category_list = mysqli_fetch_assoc($select_category_list)){
                  echo '<li class="nav-item"><a name="product_list_category_'.$fetch_category_list['category'].'" href="../../view/product_page/product_list_from_category.php?category='.$fetch_category_list['category'].'" class="nav-link">'.$fetch_category_list['category'].'</a></li>';
                }
              }
              ?>
            </ul>
          </li>
        <?php
          if (checkrole('admin')) {
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              ระบบจัดการของผู้ดูแลระบบ <i class="bi bi-file-earmark-text-fill"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
              <li class="nav-item"><a name="product_admin" href="../../view/admin_page/product_admin.php" class="nav-link">จัดการสินค้า</a></li>
              <li class="nav-item"><a name="material_admin" href="../../view/admin_page/material_admin.php" class="nav-link">จัดการวัตถุดิบ</a></li>
              <li class="nav-item"><a name="order_admin" href="../../view/admin_page/category_admin.php" class="nav-link">จัดการประเภทสินค้า</a></li>
              <li class="nav-item"><a name="order_admin" href="../../view/admin_page/payment_method_admin.php" class="nav-link">ช่องทางการจ่ายเงิน</a></li>
              <li class="nav-item"><a name="order_admin" href="../../view/admin_page/tier_admin.php" class="nav-link">ระดับและค่าขนส่ง</a></li>
              <li class="nav-item"><a name="order_admin" href="../../view/admin_page/order_admin.php" class="nav-link">คำสั่งซื้อ</a></li>
            </ul>
          </li>
            
          
              <?php
          } ?>
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?=$_SESSION['username']?> <i class="bi bi-person-circle"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                <?php
                $username = $_SESSION['username'];
                $user_info_query = "SELECT * FROM users WHERE username='$username'";
                $result = mysqli_query($db, $user_info_query);
                $discount = 0;
                $tier = 'ลูกค้า';
                $user = mysqli_fetch_assoc($result);
                $select_discounts = mysqli_query($db, "SELECT * FROM `discount` WHERE `order_price` < '".$user['total_amount']."'");
                if(mysqli_num_rows($select_discounts) > 0){
                    while($fetch_discounts = mysqli_fetch_assoc($select_discounts)){
                      if ($discount < $fetch_discounts['order_price']) {
                        $discount = $fetch_discounts['order_price'];
                        $tier = $fetch_discounts['tier'];
                      }
                    }?>
                    <li class="nav-item">
                      <a name="tier_name" class="nav-link text-info">ระดับ : <br><?= $tier ?></a>
                    </li>
                  <?php }
                else {
                  ?>
                    <li class="nav-item">
                      <a name="tier_name" class="nav-link text-info">ระดับ : <br><?= $tier ?></a>
                    </li>
                  <?php
                }
                ?>
                <li class="nav-item"><a name="profile" href="../../view/profile_page/profile.php" class="nav-link">ข้อมูลผู้ใช้</a></li>
                <?php if(checkrole('admin')) { ?>
                <li class="nav-item"><span><a name="cart" href="../../view/cart_page/cart.php" class="nav-link">รถเข็น <i class="bi bi-cart"></i></a></span></li>
                <?php } ?>
          <?php if (checkrole('user')) {
          ?>
              <li class="nav-item"><a name="profile" href="../../view/profile_page/order_user.php" class="nav-link">คำสั่งซื้อ</a></li>
              <li class="nav-item"><span><a name="cart" href="../../view/cart_page/cart.php" class="nav-link">รถเข็น <i class="bi bi-cart"></i></a></span></li>
          <?php
          } ?>    
              <li class="nav-item"><span><a name="logout" href="../../util/registration/logout.php" class="nav-link">ออกจากระบบ <i class="bi bi-power"></i></a></span></li>
            </ul>
          </li>
          
        <?php
        }
        else
        {
        ?>
          <li class="nav-item"><span><a name="login" href="../../util/registration/login.php" class="nav-link">เข้าสู่ระบบ</a></span></li>
          <li class="nav-item"><span><a name="register" href="../../util/registration/register.php" class="nav-link">สมัครสมาชิก</a></span></li>
        <?php
        }
        ?>
      </ul>
    </header>
  </div>
<main class="bg-transparent">
<div class="my-5 p-5 pb-md-4">
  <!-- <br><br> -->
<!-- my-4 p-5 pb-md-4 -->
<?php
require '../../inc/header.php';
require '../../inc/cart.php';
require '../../inc/controller/ordercontroller.php';
if (!(isset($cart))) {
  $cart = array();
}
checkuser();
$i = 1;
$total = 0;
$totalamount = 0;
$discount = 0;
$discount_percentage = 0;
$total_afterdiscount = 0;
$username = $_SESSION['username'];
$user_info_query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($db, $user_info_query);
$user = mysqli_fetch_assoc($result);
$profile = array("name", "surname");
?>
<?php 
	include '../../inc/completes.php';
	include '../../inc/errors.php';
?>
<title>รถเข็น</title>
<div class="card">
  <div class="card-body">
  <h2 class="card-title">รถเข็น</h2>
        <div class="row mb-2">
          <div class="col-12">
            <?php include 'table/cart_table.php' ?>
          </div>
        </div>
        <div class="mb-2 d-flex flex-row-reverse gap-3">
            <a class="btn btn-info" href="../product_page/product_list.php">สั่งซื้อสินค้าเพิ่มเติม</a>
        </div>
        <hr>
  	    <div class="row mt-2">
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                <?php include '../order_page/add_order.php';  ?>
              </div>
            </div>
          </div>
          <div class="col-6">
            <h3>เกี่ยวกับการชำระเงิน</h3>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">ระดับและส่วนลด</h5>
                <?php include '../tier_page/user_tier_list.php';  ?>
              </div>
            </div>
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">ค่าขนส่ง</h5>
                  <?php include '../freight_page/table/user_freight_list.php';  ?>
                </div>
            </div>
          </div>
        </div>
  </div>
</div>
<?php
  // $cart_test = var_dump($cart);
  // echo ($cart_test);
?>

<?php
require 'script/cart_javascript.php';
require '../../inc/footer.php';
?>
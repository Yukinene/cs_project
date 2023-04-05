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
<title>รถเข็น</title>
<?php 
	include '../../inc/complete.php';
  include '../../inc/errors.php'; 
?>
  <h2>รถเข็น</h2>
    <table id="cartTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            <th width='5%'>
              ลำดับ
            </th>
            <th width='15%'>
              
            </th>
            <th width='40%'>
              สินค้า
            </th>
            <th width='10%'>
              จำนวน
            </th>
            <th width='10%'>
              ราคา
            </th>
            <th width='20%'>
              ตัวเลือก
            </th>
          </tr>
        </thead>
        <tbody>
            <?php
            // Display the cart
            foreach($cart as $item => $quantity) {
              $products = "SELECT * FROM `products` WHERE `product_id` = '".$item."'";
              $product = mysqli_fetch_array(mysqli_query($db, $products));
              echo '<tr>';
              
              echo '<th>' . $i . '</th>';
              echo '<th><img src="../../images/products_image/'.$product['product_img'].'" width="150" height="75" alt=""></th>';
              echo '<th>' . $product['product_name'] . '</th>';
              echo '<th>' . $quantity . '</th>';
              echo '<th>' . $product['product_price']*$quantity . '</th>';
              echo '<th>';
              echo '<form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="product_id" value="'.$item.'"">';
                  echo '<input type="submit" class="btn btn-success" value="เพิ่ม" name="add_to_cart">';
                  if($quantity > 1)
                  {
                    echo '<input type="submit" class="btn btn-warning" value="ลด" name="remove_quantity">';
                  }
              echo '<input type="submit" class="btn btn-danger" value="ลบ" name="remove">';
              echo '</form>';
              echo '</th>';
              echo '</tr>';
              $totalamount += $product['product_price']*$quantity;
              $i++;
            }
            ?>
        </tbody>
      </table>
      <h2>สั่งซื้อสินค้า</h2>
  	    <div class="row">
          <div class="card col-4">
              <div class="card-body">
                <h5 class="card-title">ราคาสินค้า</h5>
                <div class="card-text d-flex justify-content-between">
                  <p>ราคาทั้งหมด</p>
                  <p> <?php echo $totalamount ?> บาท</p>
                </div>
                <div class="card-text d-flex justify-content-between">
                  <p class="text">ส่วนลด
                  <?php
                      $tier = 'ลูกค้า';
                      $select_discounts = mysqli_query($db, "SELECT * FROM `discount` WHERE `order_price` < '".$user['total_amount']."'");
                        if(mysqli_num_rows($select_discounts) > 0){
                            while($fetch_discounts = mysqli_fetch_assoc($select_discounts)){
                              if ($discount < $fetch_discounts['order_price']) {
                                $tier = $fetch_discounts['tier'];
                                $discount = $fetch_discounts['order_price'];
                                $discount_percentage = $fetch_discounts['discount_percentage'];
                              }
                            }
                          }
                      echo $discount_percentage .'%';
                      if ($tier != 'ลูกค้า') {
                        echo ' (จากระดับ'.$tier.')';
                      }
                      echo '</p>';
                      echo '<p>'.$totalamount*($discount_percentage/100);
                      $totalamount_afterdiscount = $totalamount-$totalamount*($discount_percentage/100)
                  ?> บาท</p>
                </div>
                <div class="card-text d-flex justify-content-between">
                  <p class="text">ค่าขนส่ง
                  <?php
                      $freight_query = "SELECT * FROM `freight`";
                      $select_freight_list = mysqli_query($db,$freight_query);
                      $freight = mysqli_fetch_assoc($select_freight_list);
                      if ($totalamount >= $freight['ordermore']) {
                        $freight_cost = 0;
                      }
                      else {
                        $freight_cost = $freight['price'];
                      }
                      echo '</p>';
                      echo '<p>'.$freight_cost;
                      $totalamount = $totalamount_afterdiscount + $freight_cost;
                  ?> บาท</p>
                </div>
                <div class="card-text d-flex justify-content-between">
                  <p>ราคาสุทธิ</p>
                  <p><?php echo $totalamount ?> บาท</p>
                </div>
              </div>
          </div>
          <div class="col-8">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">ที่อยู่ในการจัดส่ง</h5>
                <?php include '../order_page/add_order.php';  ?>
              </div>
            </div>
          </div>
        </div>
<?php
  // $cart_test = var_dump($cart);
  // echo ($cart_test);
?>

<?php
require '../../inc/inputprovince.php';
require '../../inc/footer.php';
?>
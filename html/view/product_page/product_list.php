
<?php
    require_once("../../inc/header.php");
    require '../../inc/cart.php';
	include '../../inc/complete.php'; 
?>

<div class="container">
<section class="products">
   <h1 class="heading">ผลิตภัณฑ์ใหม่ล่าสุด</h1>
   <div class="row">      
    <?php
      $select_products = mysqli_query($db, "SELECT * FROM `products` WHERE `product_status` = 'active'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>
    <div class="col-4">
        <div class="card">
                <img src="../../images/products_image/<?php echo $fetch_product['product_img']; ?>" style="height: 400px;" alt="">
                <div class="card-body">
                <h3 class="card-title"><?php echo $fetch_product['product_name']; ?></h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <div class="card-text"><?php echo $fetch_product['product_description']; ?></div>
                        <div class="card-text">$<?php echo $fetch_product['product_price']; ?>/THB</div>
                        <input type="hidden" name="product_id" value="<?php echo $fetch_product['product_id']; ?>">
                        <?php if(checkusername()){
                        ?>
                        <input type="submit" class="btn btn-success" value="add to cart" name="add_to_cart">
                        <?php
                        }
                        ?>
                    </div>
                </form>
                </div>
            </div>
    </div>
    
    <?php
         };
      }
      else { ?>
        <div class="col-4">
        </div>
    <div class="col-4">
        <div class="card alert alert-danger text-center">
                <div class="card-body">
                <h3 class="card-title">สินค้าหมดชั่วคราว</h3>
                </div>
            </div>
    </div>
      <?php }
      ?>
  </div>
</div>
</section>

</div>
<?php
require_once("../../inc/footer.php");
?>
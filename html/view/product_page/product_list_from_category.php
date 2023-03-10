<?php
    require_once("../../inc/header.php");
    require '../../inc/cart.php';
	include '../../inc/complete.php';
    if (isset($_GET['category'])) {
        $select_category = mysqli_query($db,"SELECT * FROM `category` WHERE `category` = '".$_GET['category']."'");
        if(mysqli_num_rows($select_category) > 0) {
            $category = mysqli_fetch_assoc($select_category);
        }
        else
        {
            header('location: ../../index.php');   
        }
    }
    else {
        header('location: ../../index.php');
    }
?>
<div class="container">
<section class="products">
   <h1 class="heading">สินค้าประเภท<?= $category['category'] ?></h1>
   <div class="row">      
    <?php
      $select_products = mysqli_query($db, "SELECT * FROM `products` WHERE `product_category` = '".$category['category']."' AND `product_status` = 'active'");
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
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['product_name']; ?>">
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
<?php
require_once("../../inc/footer.php");
?>
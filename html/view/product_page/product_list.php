
<?php
    require_once "../../inc/header.php";
    require '../../inc/cart.php';
	include '../../inc/completes.php';
	include '../../inc/errors.php';
?>

<div class="container">
<section class="products">
   <h1 class="heading">ผลิตภัณฑ์ใหม่ล่าสุด</h1>
   <div class="row">      
    <?php
      $select_products = mysqli_query($db, "SELECT * FROM `products` WHERE `product_status` = 'active'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
            require "card/product_card.php";
         };
      }
      else {
        require "card/product_nla.php";
     }
      ?>
  </div>
</div>
</section>

</div>
<?php
require_once("../../inc/footer.php");
?>
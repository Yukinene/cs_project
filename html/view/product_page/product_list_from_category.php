<?php
    require_once "../../inc/header.php";
    require '../../inc/cart.php';
	include '../../inc/completes.php';
	include '../../inc/errors.php';

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
<?php
require_once("../../inc/footer.php");
?>
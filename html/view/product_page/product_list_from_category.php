<?php
    require_once "../../inc/header.php";
    require '../../inc/cart.php';
	include '../../inc/completes.php';
	include '../../inc/errors.php';

    if (isset($_GET['category'])) {
        $select_category = mysqli_query($db,"SELECT * FROM `categories` WHERE `category` = '".$_GET['category']."'");
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
<div class="card">
    <div class="card-body ms-2">
    <section class="products">
   <h1 class="heading">สินค้าประเภท<?= $category['category'] ?></h1>
   <div class="row">      
    <?php
    
      $select_product_categories = mysqli_query($db, "SELECT * FROM `product_categories` WHERE `category` = '".$category['category']."'");
      // 
      if(mysqli_num_rows($select_product_categories) > 0){
         while($fetch_product_categories = mysqli_fetch_assoc($select_product_categories)){
            $fetch_product = mysqli_fetch_assoc(
                mysqli_query($db, 
                "SELECT * FROM `products` WHERE `product_id` = '".$fetch_product_categories['product_id']."'AND `product_status` = 'active'"
                )
            );
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
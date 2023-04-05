<?php
    $select_products = mysqli_query($db,"SELECT * FROM `products`");
?>

<!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addplanproductModal"
    >
    เพิ่มสินค้า
    </button>

<!-- Modal -->
<div class="modal fade" id="addplanproductModal" tabindex="-1" aria-labelledby="addplanproductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addplanproductModalLabel">เพิ่มสินค้า</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
			    <label class="text-start">สินค้า</label>
                <select class="form-select form-select-sm" name="product" aria-label=".form-select-sm example" required>
		        <?php
                    if(mysqli_num_rows($select_products) > 0){
                        while($fetch_product = mysqli_fetch_assoc($select_products)){
                            $check_already_plan_products = mysqli_query($db,"SELECT * FROM `plan_products` WHERE `plan_id` = ".$_GET['id']." AND `product_id` = ".$fetch_product['product_id']."");
                            if (mysqli_num_rows($check_already_plan_products) > 0){ 
                              $fetch_already_plan_products = mysqli_fetch_assoc($check_already_plan_products);
                              if ($fetch_already_plan_products['plan_amount'] < 1) {
                                ?>
                                <option value="<?= $fetch_product['product_id'] ?>">
                                    <?= $fetch_product['product_id'] ?>
                                     - 
                                    <?= $fetch_product['product_name'] ?>
                                </option>
                            <?php 
                              } }
                            else { ?>
                              <option value="<?= $fetch_product['product_id'] ?>">
                                    <?= $fetch_product['product_id'] ?>
                                     - 
                                    <?= $fetch_product['product_name'] ?>
                                </option>
                            <?php }
                        }
                    }
                ?>
                </select>
			</div>
      <div class="form-group mt-1">
			    <label class="text-start">จำนวน</label>
          <input class="form-control" type="number" name="quantity" min="1" required>
			</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit" name="add_planproduct">เพิ่มสินค้า</button>
      </div>
    </form>
    </div>
  </div>
</div>
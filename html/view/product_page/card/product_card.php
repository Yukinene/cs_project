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
                    <input type="submit" class="btn btn-success" value="เพิ่มเข้าไปรถเข็น" name="add_to_cart">
                    <?php
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
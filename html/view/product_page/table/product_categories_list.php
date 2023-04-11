<?php
    $select_product_categories = mysqli_query($db,"SELECT * FROM `product_categories` WHERE product_id = ".$_GET['id']);
    if (mysqli_num_rows($select_product_categories) > 0) { ?>
    <div class="table-responsive">
    <table id="ProductCategoriesTable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>
                ประเภทสินค้า
            </th>
            <th>
                ตัวเลือก
            </th>
        </tr>
    </thead>
    <tbody>
        <?php while ($fetch_product_categories = mysqli_fetch_assoc($select_product_categories)) { ?>
            <tr>
                <th>
                    <?=$fetch_product_categories['category']?>
                </th>
                <th>
                    <form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" id="product_id" value="<?=$product_info['product_id']?>">
                        <input type="hidden" name="product_category" id="product_category" value="<?=$fetch_product_categories['category']?>">
                        <button class="btn btn-danger" type="submit" name="del_prod_cate">ลบ</button>
                    </form>
                </th>
            </tr>            
            <?php } ?>
    </tbody>
</table>
</div>
    <?php }
?>
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editproductcategoryModal<?=$fetch_product['product_id']?>">
    แก้ไขประเภทผลิตภัณฑ์
</button>
    <div class="modal fade" id="editproductcategoryModal<?=$fetch_product['product_id']?>" tabindex="-1" aria-labelledby="editproductcategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editproductcategoryModalLabel">แก้ไขประเภทของ - <?=$fetch_product['product_name']?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" id="product_id" value="<?=$fetch_product['product_id']?>">
                        <input type="hidden" name="old_product_category" id="old_product_category" value="<?=$fetch_product['product_category']?>">
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="product_category" id="product_category" required>
                        <option value="">กรุณาเลือกประเภท</option>
                        <?php
                            $category_list_query = "SELECT * FROM `category`";
                            $select_category_list = mysqli_query($db,$category_list_query);
                            if(mysqli_num_rows($select_category_list) > 0){
                                while($fetch_category_list = mysqli_fetch_assoc($select_category_list)){
                                    echo '<option value="'.$fetch_category_list['category'].'"';
                                    if ($fetch_category_list['category'] === $fetch_product['product_category']) {
                                    echo 'selected';
                                    }
                                    echo'>'.$fetch_category_list['category'].'</option>';
                              }
                            }
                        ?>
                        </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" name="edit_prod_cate">แก้ไข</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
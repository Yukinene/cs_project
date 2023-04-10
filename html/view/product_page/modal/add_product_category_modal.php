<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editproductcategoryModal<?=$product_info['product_id']?>">
    เพิ่มประเภทผลิตภัณฑ์
</button>
    <div class="modal fade" id="editproductcategoryModal<?=$product_info['product_id']?>" tabindex="-1" aria-labelledby="editproductcategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editproductcategoryModalLabel">เพิ่มประเภทของ - <?=$product_info['product_name']?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" id="product_id" value="<?=$product_info['product_id']?>">
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="product_category" id="product_category" required>
                        <option value="">กรุณาเลือกประเภท</option>
                        <?php
                            $category_list_query = "SELECT * FROM `categories`";
                            $select_category_list = mysqli_query($db,$category_list_query);
                            if(mysqli_num_rows($select_category_list) > 0){
                                while($fetch_category_list = mysqli_fetch_assoc($select_category_list)){
                                    $select_product_categories = mysqli_query($db,"SELECT * FROM `product_categories` WHERE `product_id` = ".$_GET['id']." AND`category` = '".$fetch_category_list['category']."'");
                                    if (mysqli_num_rows($select_product_categories) < 1) {
                                    echo '<option value="'.$fetch_category_list['category'].'"';
                                    echo'>'.$fetch_category_list['category'].'</option>';
                                    }
                              }
                            }
                        ?>
                        </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" name="add_prod_cate">เพิ่ม</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
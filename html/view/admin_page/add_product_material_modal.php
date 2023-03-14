<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproductmaterialModal">
	เพิ่มวัตถุดิบ
</button>

<!-- Modal -->
<div class="modal fade" id="addproductmaterialModal" tabindex="-1" aria-labelledby="addproductmaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addproductmaterialModalLabel">เพิ่มวัตถุดิบ</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?=$_GET['id']?>">
                <div class="form-group">
                <label>วัตถุดิบ</label>
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="product_material" id="product_material" required>
                            <option value="">กรุณาเลือกวัตถุดิบ</option>
                            <?php
                              $select_material_list = mysqli_query($db,"SELECT * FROM `materials`");
                              if(mysqli_num_rows($select_material_list) > 0){
                              while($fetch_material_list = mysqli_fetch_assoc($select_material_list)){
                                $check_material_product = 
                                    mysqli_query($db,
                                    "SELECT * FROM `product_materials` WHERE `material_id` = ".$fetch_material_list['material_id'].""
                                    );
                                if(mysqli_num_rows($check_material_product) > 0){
                               
                              }
                              else {
                                 echo '<option value="'.$fetch_material_list['material_id'].'"';
                                echo'>'.$fetch_material_list['material_name'].'</option>';
                              }
                            }
                        }
                            ?>
                          </select>
                </div>
                <div class="form-group">
                    <label>จำนวนที่ใช้ (กิโลกรัม)</label>
                    <input class="form-control" type="number" name="material_amount" min="0" step=any required>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" name="add_pmat">เพิ่ม</button>
            </div>
        		</form>
    	</div>
    </div>
 </div>
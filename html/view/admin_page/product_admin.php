<?php
require '../../inc/header.php';
require '../../inc/productcontroller.php';
require '../../inc/errors.php';
require '../../inc/complete.php';
checkadmin();
?>
<title>ระบบจัดการสินค้า (สำหรับผู้จัดการระบบ)</title>
<h2>สินค้า</h2>
    <div class="mb-2 d-flex flex-row-reverse"> 
      <?php include 'add_product_modal.php'; ?>
    </div>
    
	  <table id="ProductTable" class="table table-striped" style="width:100%">
        <thead>
			<center>
            <tr>
            <th width='5%'>
              ID
            </th>
			<th width='5%'>
              
            </th>
			      <th width='20%'>
              ชื่อ
            </th>
            <th width='20%'>
              ประเภท
            </th>
            <th width='15%'>
              ราคาผลิตภัณฑ์
            </th>
            <th width='15%'>
              สถานะ
            </th>
            <th width='20%'>
              ตัวเลือก
            </th>
          </tr>
			</center>
        </thead>
        <tbody>
        <?php
        	$select_products = mysqli_query($db, "SELECT * FROM `products`");
      		if(mysqli_num_rows($select_products) > 0){
         		while($fetch_product = mysqli_fetch_assoc($select_products)){
        ?>
            <tr>
                <th>
                    <?=$fetch_product['product_id']?>
                </th>
				<th>
					<div class="card">
						<img style="padding: 5px; max-height: 400px; width: 150px;" src="../../images/products_image/<?php echo $fetch_product['product_img']; ?>" alt="">
					</div>
                </th>
				        <th>
                    <?=$fetch_product['product_name']?>
                </th>
                <th>
                    <?php if ($fetch_product['product_category'] == NULL) {
                      echo 'ยังไม่มีประเภท';
                    } else {
                      echo $fetch_product['product_category'];
                    }
                    ?>
                </th>
                <th>
                    <?=$fetch_product['product_price']?>
                </th>
                <th>
                    <?=$fetch_product['product_status']?>
                </th>
                <th>
                        <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" id="product_id" value="<?=$fetch_product['product_id']?>">
                        <input type="hidden" name="product_status" id="product_status" value="<?=$fetch_product['product_status']?>">
                        <?php
                        if ($fetch_product['product_status'] === "active") 
                        {?>
                          <input type="submit" class="btn btn-danger" value="ปิดการขาย" name="change_status">
                        <?php }
                        else { ?>
                          <input type="submit" class="btn btn-success" value="เปิดการขาย" name="change_status">
                        <?php }
                        ?>
                        </form>
                    <br>
                    <a class="btn btn-warning" href="../../view/admin_page/product_material.php?id=<?=$fetch_product['product_id']?>">ตรวจสอบวัตถุดิบ</a>
                    <br><br>
                    <a class="btn btn-dark" href="../../view/log/log_products.php?id=<?=$fetch_product['product_id']?>">ตรวจสอบการเข้าออก</a>
                    <br><br>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editproductModal<?=$fetch_product['product_id']?>">
                      แก้ไขผลิตภัณฑ์
                    </button>
                    <div class="modal fade" id="editproductModal<?=$fetch_product['product_id']?>" tabindex="-1" aria-labelledby="editproductModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editproductModalLabel">แก้ไข <?=$fetch_product['product_id']?> - <?=$fetch_product['product_name']?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <form method="post" action="" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" id="product_id" value="<?=$fetch_product['product_id']?>">
                            <input type="hidden" name="product_img" id="product_img" value="<?=$fetch_product['product_img']?>">
                          <div class="form-group">
                              <label class="text-start">ขื่อผลิตภัณฑ์</label>
                                <input class="form-control" type="text" name="product_name" value="<?=$fetch_product['product_name']?>" maxlength="190" readonly>
                          </div>
                          <div class="form-group">
                            <label>รายละเอียดของผลิตภัณฑ์ (สูงสุด 190 ตัวอักษร)</label>
                            <textarea class="form-control" name="product_description" rows="5" maxlength="190" required><?=$fetch_product['product_description']?></textarea>
                          </div>
                          <div class="form-group">
                            <label>ราคาผลิตภัณฑ์ (บาท)</label>
                            <input class="form-control" type="number" name="product_price" value="<?=$fetch_product['product_price']?>" min="0" required>
                          </div>
                          <div class="form-group">
                            <label for="formFile" class="form-label">รูปภาพผลิตภัณฑ์ <br>(รับประเภท .PNG , .JPG และ .JPEG เท่านั้น)</label>
                            <input class="form-control" type="file" name="product_img" id="product_img" accept="image/png, image/jpg, image/jpeg">
                            <label for="formFile" class="form-label text-danger">เพิ่มหรือไม่ก็ได้</label>
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" name="edit_prod">แก้ไขผลิตภัณฑ์</button>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                    <br><br>
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
                </th>
            </tr><?php
              }
            }
        ?>
        </tbody>
    </table>
  </div>

  <script>
        $(document).ready(function () {
            $("#ProductTable").DataTable({
              "order": [[ 0, "desc" ]],
        "responsive": true,
        "ordering": false,
        lengthMenu: [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100]
          ],
        "pageLength": 25,
        language: 
        {
          url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/th.json'
        }
            });
        });
</script>

<?php
require '../../inc/footer.php';
?>
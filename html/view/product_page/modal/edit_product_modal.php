<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editproductModal<?=$product_info['product_id']?>">
    แก้ไขผลิตภัณฑ์
    </button>
        <div class="modal fade" id="editproductModal<?=$product_info['product_id']?>" tabindex="-1" aria-labelledby="editproductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editproductModalLabel">แก้ไข <?=$product_info['product_id']?> - <?=$product_info['product_name']?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" id="product_id" value="<?=$product_info['product_id']?>">
                            <input type="hidden" name="product_img" id="product_img" value="<?=$product_info['product_img']?>">
                        <div class="form-group">
                            <label class="text-start">ขื่อผลิตภัณฑ์</label>
                            <input class="form-control" type="text" name="product_name" value="<?=$product_info['product_name']?>" maxlength="190" readonly>
                        </div>
                        <div class="form-group">
                            <label>รายละเอียดของผลิตภัณฑ์ (สูงสุด 190 ตัวอักษร)</label>
                            <textarea class="form-control" name="product_description" rows="5" maxlength="190" required><?=$product_info['product_description']?></textarea>
                        </div>
                        <div class="form-group">
                            <label>ราคาผลิตภัณฑ์ (บาท)</label>
                            <input class="form-control" type="number" name="product_price" value="<?=$product_info['product_price']?>" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="formFile" class="form-label">รูปภาพผลิตภัณฑ์ <br>(รับประเภท .PNG , .JPG และ .JPEG เท่านั้น)</label>
                            <input class="form-control" type="file" name="product_img" id="product_img" accept="image/png, image/jpg, image/jpeg">
                            <label for="formFile" class="form-label text-danger">*เพิ่มหรือไม่ก็ได้</label>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" name="edit_prod">แก้ไขผลิตภัณฑ์</button>
                </div>
                        </form>
        </div>
  </div>
</div>
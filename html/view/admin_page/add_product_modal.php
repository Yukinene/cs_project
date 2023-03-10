<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproductModal">
  เพิ่มผลิตภัณฑ์
</button>

<!-- Modal -->
<div class="modal fade" id="addproductModal" tabindex="-1" aria-labelledby="addproductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addproductModalLabel">เพิ่มผลิตภัณฑ์</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
			    <label class="text-start">ขื่อผลิตภัณฑ์</label>
		        <input class="form-control" type="text" name="product_name" value="" maxlength="190" required>
			</div>
			<div class="form-group">
				<label>รายละเอียดของผลิตภัณฑ์ (สูงสุด 190 ตัวอักษร)</label>
				<textarea class="form-control" name="product_description" rows="5" maxlength="190" required></textarea>
			</div>
			<div class="form-group">
				<label>ราคาผลิตภัณฑ์ (บาท)</label>
				<input class="form-control" type="number" name="product_price" min="0" required>
			</div>
			<div class="form-group">
				<label for="formFile" class="form-label">รูปภาพผลิตภัณฑ์ <br>(รับประเภท .PNG , .JPG และ .JPEG เท่านั้น)</label>
				<input class="form-control" type="file" name="product_img" id="product_img" accept="image/png, image/jpg, image/jpeg" required>
			</div>
			<br>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit" name="add_prod">เพิ่มผลิตภัณฑ์</button>
      </div>
    </form>
    </div>
  </div>
</div>
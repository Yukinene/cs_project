<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adddiscountModal">
  เพิ่มระดับ
</button>

<!-- Modal -->
<div class="modal fade" id="adddiscountModal" tabindex="-1" aria-labelledby="adddiscountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addproductModalLabel">เพิ่มระดับ</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" enctype="multipart/form-data">
      <div class="form-group">
				<label>ระดับ</label>
				<input class="form-control" type="text" name="tier" max=255 required>
			</div>
			<div class="form-group">
				<label>เมื่อซื้อครบ (บาท)</label>
				<input class="form-control" type="number" name="price" min="1" required>
			</div>
      <div class="form-group">
				<label>ส่วนลด (เปอร์เซนต์)</label>
				<input class="form-control" type="number" name="percentage" min="0" required>
			</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit" name="add_dis">เพิ่มระดับ</button>
      </div>
    </form>
    </div>
  </div>
</div>
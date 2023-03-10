<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpaymentmethodModal">
  เพิ่มช่องทางการจ่ายเงิน
</button>

<!-- Modal -->
<div class="modal fade" id="addpaymentmethodModal" tabindex="-1" aria-labelledby="addpaymentmethodModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addproductModalLabel">เพิ่มช่องทางการจ่ายเงิน</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
			    <label class="text-start">ช่องทางการจ่ายเงิน</label>
		        <input class="form-control" type="text" name="method" value="" maxlength="90" required>
			</div>
			<div class="form-group">
				<label>รายละเอียดช่องทางการจ่ายเงิน (สูงสุด 190 ตัวอักษร)</label>
				<textarea class="form-control" name="description" rows="5" maxlength="190" required></textarea>
			</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit" name="add_paym">เพิ่มช่องทางการจ่ายเงิน</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#freightModal">
  จัดการค่าขนส่ง
</button>
<?php
$freight_query = "SELECT * FROM `freight`";
$select_freight_list = mysqli_query($db,$freight_query);
$freight = mysqli_fetch_assoc($select_freight_list);
?>
<!-- Modal -->
<div class="modal fade" id="freightModal" tabindex="-1" aria-labelledby="freightModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="freightModalLabel">จัดการค่าขนส่ง</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" enctype="multipart/form-data">
      <div class="form-group">
				<label>ค่าขนส่ง (บาท)</label>
				<input class="form-control" type="number" name="price" min="1" value="<?=$freight['price']?>" required>
			</div>
			<div class="form-group">
				<label>เมื่อซื้อครบส่งฟรี (บาท)</label>
				<input class="form-control" type="number" name="ordermore" min="1" value="<?=$freight['ordermore']?>" required>
			</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit" name="cha_frei">แก้ไข</button>
      </div>
    </form>
    </div>
  </div>
</div>
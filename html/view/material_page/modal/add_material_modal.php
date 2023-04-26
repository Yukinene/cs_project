<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addmaterialModal">
	เพิ่มวัตถุดิบ
</button>

<!-- Modal -->
<div class="modal fade" id="addmaterialModal" tabindex="-1" aria-labelledby="addmaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addmaterialModalLabel">เพิ่มวัตถุดิบ</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="text-start">ขื่อวัตถุดิบ</label>
                    <input class="form-control" type="text" name="material_name" maxlength="190" required>
                </div>
                <div class="form-group">
                    <label>จำนวนที่ซื้อ (กิโลกรัม)</label>
                    <input class="form-control" type="number" name="bought_amount" min="0" step=any required>
                </div>
                <div class="form-group">
                    <label>ราคาที่ซื้อ (บาท)</label>
                    <input class="form-control" type="number" name="bought_price"min="0" required>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" name="add_mate">เพิ่ม</button>
            </div>
        		</form>
    	</div>
    </div>
 </div>
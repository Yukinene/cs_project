<?php $tomorrow = gmdate('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")+2, date("Y"))); ?>


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcouponModal">
  เพิ่มคูปอง
</button>

<!-- Modal -->
<div class="modal fade" id="addcouponModal" tabindex="-1" aria-labelledby="addcouponModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="addcouponModalLabel">เพิ่มคูปอง</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label>คูปองส่วนลด</label>
                <input class="form-control" type="text" name="coupon_name" max=255 required>
            </div>
            <div class="form-group">
                <label>ส่วนลดราคา</label>
                <input class="form-control" type="number" name="coupon_price" min="25" max="1000" required>
            </div>
            <div class="form-group">
                <label>วันหมดอายุ</label>
                <input class="form-control" type="date" name="expire_date" min="<?=$tomorrow?>" required>
            </div>
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" value="" name="coupon_comfirm" id="coupon_comfirm" required>
                <label>ยืนยัน</label>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit" name="add_cou">เพิ่มคูปอง</button>
        </div>
            </form>
    </div>
  </div>
</div>
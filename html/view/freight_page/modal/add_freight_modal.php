<!-- Button trigger modal -->
<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addfreightModal">
  เพิ่มค่าขนส่งเส้นทางใหม่
</button>
<?php
$freight_query = "SELECT * FROM `freight` WHERE `province_id` = 0";
$select_freight_list = mysqli_query($db,$freight_query);
$freight = mysqli_fetch_assoc($select_freight_list);
?>
<!-- Modal -->
<div class="modal fade" id="addfreightModal" tabindex="-1" aria-labelledby="addfreightModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addfreightModalLabel">เพิ่มค่าขนส่ง</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" enctype="multipart/form-data">
      <div class="form-group">
						<label>จังหวัด</label>
              <select class="form-select" type="text" id="province" name="province" required>
                <option value="">กรุณาเลือกจังหวัด</option>
							  <?php $province_query = mysqli_query($db,"SELECT * FROM `provinces`");
							    while($province = mysqli_fetch_assoc($province_query)){ 
                    $province_check = mysqli_query($db,"SELECT * FROM `freight` WHERE `province_id` = ".$province['id']);
                    if (mysqli_num_rows($province_check) < 1) { ?>
								      <option value="<?=$province['id']?>"><?=$province['name_th']?>
                    <?php }
							      } ?> 
              </select>
			</div>
      <div class="form-group">
				<label>ค่าขนส่ง (บาท)</label>
				<input class="form-control" type="number" name="price" min="1" value="<?=$freight['price']?>" max="<?=$freight['price']?>" required>
			</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit" name="add_frei">เพิ่ม</button>
      </div>
    </form>
    </div>
  </div>
</div>

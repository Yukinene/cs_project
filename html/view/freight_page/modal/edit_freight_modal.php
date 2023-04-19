<!-- Button trigger modal -->
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editfreightModal_<?=$fetch_freight['province_id']?>">
  จัดการค่าขนส่ง
</button>
<?php
$freight_default_query = "SELECT * FROM `freight` WHERE `province_id` = 0";
$select_freight_default_list = mysqli_query($db,$freight_default_query);
$freight_default = mysqli_fetch_assoc($select_freight_default_list);
?>
<!-- Modal -->
<div class="modal fade" id="editfreightModal_<?=$fetch_freight['province_id']?>" tabindex="-1" aria-labelledby="editfreightModalLabel_<?=$fetch_freight['province_id']?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editfreightModalLabel_<?=$fetch_freight['province_id']?>">จัดการค่าขนส่ง : 
          <?php 
            if ($fetch_freight['province_id'] != 0) {
              $fetch_province = mysqli_fetch_assoc(mysqli_query($db,
                "SELECT * FROM `provinces` WHERE `id` = ".$fetch_freight['province_id']));
                echo $fetch_province['name_th'];
              } else {
                echo "จังหวัดอื่นๆทั่วประเทศไทย";
              }
          ?>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" enctype="multipart/form-data">
      <div class="form-group">
        <input type="hidden" name="province" id="province_id" value="<?=$fetch_freight['province_id']?>">
      </div>
      <div class="form-group">
				<label>ค่าขนส่ง (บาท)</label>
				<input class="form-control" type="number" name="price" min="1" value="<?=$fetch_freight['price']?>" max="<?php
          if ($fetch_freight['province_id'] != 0) {
            echo $freight_default['price'];
            } else {
            echo 500;
        }
        ?>" required>
			</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit" name="edit_frei">แก้ไข</button>
      </div>
    </form>
    </div>
  </div>
</div>

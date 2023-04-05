<?php
    $select_orders = mysqli_query($db,"SELECT * FROM `orders` WHERE `status` = 2");
?>

<!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addplanorderModal"
    >
    เพิ่มคำสั่งซื้อ
    </button>

<!-- Modal -->
<div class="modal fade" id="addplanorderModal" tabindex="-1" aria-labelledby="addplanorderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addplanorderModalLabel">เพิ่มคำสั่งซื้อ</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
			    <label class="text-start">คำสั่งซื้อ</label>
                <select class="form-select form-select-sm" name="order" aria-label=".form-select-sm example" required>
		        <?php
                    if(mysqli_num_rows($select_orders) > 0){
                        while($fetch_order = mysqli_fetch_assoc($select_orders)){
                            $check_already_plan_orders = mysqli_query($db,"SELECT * FROM `plan_orders` WHERE `order_id` = ".$fetch_order['id']."");
                            if (mysqli_num_rows($check_already_plan_orders) <= 0){ ?>
                                <option value="<?= $fetch_order['id'] ?>">
                                    <?= $fetch_order['id'] ?>
                                     - 
                                    <?= $fetch_order['name'] ?>
                                     : 
                                    <?= $fetch_order['amount'] ?> บาท
                                </option>
                            <?php }
                        }
                    }
                ?>
                </select>
			</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit" name="add_planorder">เพิ่มคำสั่งซื้อ</button>
      </div>
    </form>
    </div>
  </div>
</div>
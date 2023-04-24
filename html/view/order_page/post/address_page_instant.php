<form method="post" enctype="multipart/form-data" action="">
<div class="row mb-2">
	<input class="form-control" type="hidden" id="totalamount_afterdiscount_instant" name="totalamount_afterdiscount_instant" value="<?= $totalamount_afterdiscount; ?>">
	<input class="form-control" type="hidden" id="amount_instant" name="amount_instant" value="<?= $totalamount_final; ?>">
	<input class="form-control" type="hidden" name="user_id" value="<?= $user['id']; ?>">
</div>

<div class="row mb-2">
	<label class="col-sm-4 col-sm-4 col-form-label">ช่องทางการจ่ายเงิน</label>
	<div class="col-sm-8">
		<select class="form-select" name="payment_method_instant" aria-label="Default select example" required>
			<?php
				$payment_method_query = "SELECT * FROM `payment_method`WHERE `payment_status` = 'active'";
				$payment_method_result = mysqli_query($db, $payment_method_query);
				if(mysqli_num_rows($payment_method_result) > 0){
					while($fetch_payment_method = mysqli_fetch_assoc($payment_method_result)){?>
						<option value="<?=$fetch_payment_method['method']?>" selected><?=$fetch_payment_method['method']?></option>
				<?php	}
				}
				?>
		</select>
	</div>
</div>
	<div class="input-group row mb-2">
		<label class="col-sm-2 col-sm-2 col-form-label">ที่อยู่</label>
		<div class="col-sm-14">
			<select class="form-select" type="text" id="instant_address" name="instant_address"  onchange="freightCalculator_instant()" required>
				<option value="">กรุณาเลือกที่อยู่</option>
				<?php
				$instant_address_query = mysqli_query($db,"SELECT DISTINCT `name`,`surname`,`building_no`,`line`,`province`,`district`,`sub_district`,`country`,`postal_code` FROM `orders` WHERE `user_id` = ".$user['id']);
				while ($instant_address = mysqli_fetch_array($instant_address_query)) {
					$display_address = $instant_address['name'].' '.$instant_address['surname'].' '.
					$instant_address['building_no'].' '.$instant_address['line'].' '.
					$instant_address['province'].' '.$instant_address['district'].' '.$instant_address['sub_district'].' '.
					$instant_address['country'].' '.$instant_address['postal_code'];
					$value_address  = mysqli_fetch_array(mysqli_query($db,
						"SELECT * FROM `orders` WHERE `name` = '".$instant_address['name']."' AND 
						`surname` = '".$instant_address['surname']."' AND
						`building_no` = '".$instant_address['building_no']."' AND 
						`line` = '".$instant_address['line']."' AND
						`province` = '".$instant_address['province']."' AND 
						`district` = '".$instant_address['district']."' AND
						`sub_district` = '".$instant_address['sub_district']."' AND 
						`country` = '".$instant_address['country']."' AND 
						`postal_code` = '".$instant_address['postal_code']."'"));
					?>
					<option value="<?=$value_address['id']?>">
						<?=$display_address?>
					</option>
				<?php }	?>
			</select>
		</div>
	</div>
	<div class="row mb-2">
		<label class="col-sm-2 col-sm-2 col-form-label">คูปองส่วนลด</label>
		<div class="col-sm-10">
			<input class="form-control" type="text" id="coupon_instant" name="coupon_instant">
		</div>
	</div>
	<button class="btn btn-primary mb-2" type="submit" name="add_order_instant">ทำรายการให้เสร็จสิ้น</button>
</form>
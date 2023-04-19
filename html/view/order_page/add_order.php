<form method="post" enctype="multipart/form-data" action="">
					<input class="form-control" type="hidden" name="user_id" value="<?= $user['id']; ?>">
					<div class="row mb-2"> 
					<label class="col-sm-2 col-sm-2 col-form-label">ช่องทางการจ่ายเงิน</label>
						<div class="col-sm-10">
							<select class="form-select" name="payment_method" aria-label="Default select example" required>
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
					<div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">ขื่อ</label>
						<div class="col-sm-10">
						<input class="form-control" type="text" name="name" value="<?= $user['name']; ?>" required>
						</div>
					</div>
					<div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">นามสกุล</label>
						<div class="col-sm-10">
						<input class="form-control" type="text" name="surname" value="<?= $user['surname']; ?>" required>
						</div>
					</div>
					<div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">เลขที่</label>
						<div class="col-sm-10">
						<input class="form-control" type="text" name="building_no" required>
						</div>
					</div>
                    <div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">ที่อยู่</label>
						<div class="col-sm-10">
                        <textarea class="form-control" name="line" rows="3" maxlength="200" required></textarea>
						</div>
					</div>
                    <div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">จังหวัด</label>
						<div class="col-sm-10">
                            <select class="form-select" type="text" id="province" name="province" required>
                            <option value="">กรุณาเลือกจังหวัด</option>
							<?php $province_query = mysqli_query($db,"SELECT * FROM `provinces`");
							while($province = mysqli_fetch_assoc($province_query)){ ?>
								<option value="<?=$province['id']?>"><?=$province['name_th']?>
							<?php } ?> 
                            </select>
						</div>
					</div>
                    <div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">เขต/อำเภอ</label>
						<div class="col-sm-10">
						<select class="form-select" type="text" id="district"  name="district" required>
                        <option value="">กรุณาเลือกเขต/อำเภอ</option>
                        </select>
						</div>
					</div>
                    <div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">แขวง/ตำบล</label>
						<div class="col-sm-10">
						<select class="form-select" type="text" id="sub_district"  name="sub_district" required>
                        <option value="">กรุณาเลือกแขวง/ตำบล</option>
                        </select>
						</div>
					</div>
                    <div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">ประเทศ</label>
						<div class="col-sm-10">
						<input class="form-control" type="text" id="country" name="country" value="ประเทศไทย" readonly>
						</div>
					</div>
                    <div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">รหัสไปรษณีย์</label>
						<div class="col-sm-10">
						<input class="form-control" type="text" id="postal_code" name="postal_code" readonly>
						</div>
					</div>
					<div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">คูปองส่วนลด</label>
						<div class="col-sm-10">
						<input class="form-control" type="text" id="coupon" name="coupon">
						</div>
					</div>
					<div class="row mb-2">
						<label class="col-sm-10 col-sm-2 col-form-label">ราคาสินค้า</label>
						<div class="col-sm-2">
							<label class="col-form-label"><?= $totalamount ?> บาท</label>
						</div>
					</div>
					<div class="row mb-2">
						<?php
							$tier = 'ลูกค้า';
							$select_discounts = mysqli_query($db, "SELECT * FROM `discount` WHERE `order_price` < '".$user['total_amount']."'");
								if(mysqli_num_rows($select_discounts) > 0){
									while($fetch_discounts = mysqli_fetch_assoc($select_discounts)){
									if ($discount < $fetch_discounts['order_price']) {
										$tier = $fetch_discounts['tier'];
										$discount = $fetch_discounts['order_price'];
										$discount_percentage = $fetch_discounts['discount_percentage'];
									}
									}
								}
							$tier_discount_amount = ceil($totalamount*($discount_percentage/100));
							$totalamount_afterdiscount = $totalamount - $tier_discount_amount;
						?>
						<label class="col-sm-10 col-sm-2 col-form-label">ส่วนลดจากระดับลูกค้า <?= $discount_percentage ?>%</label>
						<div class="col-sm-2">
							<label id="tier_discount_amount" class="col-form-label"><?= $tier_discount_amount ?> บาท</label>
						</div>
					</div>
					<div class="row mb-2">
						<?php
							$freight_query = "SELECT * FROM `freight` WHERE `province_id` = 0";
							$select_freight_list = mysqli_query($db,$freight_query);
							$freight = mysqli_fetch_assoc($select_freight_list);
							$freight_cost = $freight['price'];
							$totalamount_final = $totalamount_afterdiscount + $freight_cost;
                  		?>
						<label class="col-sm-10 col-sm-2 col-form-label">ค่าขนส่ง</label>
						<div class="col-sm-2">
							<label id="freight_cost_label" class="col-form-label"><?= $freight_cost ?> บาท</label>
						</div>
					</div>
					<div class="row mb-2">
						<label class="col-sm-10 col-sm-2 col-form-label">ราคาสุทธิ</label>
						<div class="col-sm-2">
							<label id="totalamount_final_label" class="col-form-label"><?= $totalamount_final ?> บาท</label>
						</div>
						<input class="form-control" type="hidden" id="totalamount_afterdiscount" name="totalamount_afterdiscount" value="<?= $totalamount_afterdiscount; ?>">
						<input class="form-control" type="hidden" id="amount" name="amount" value="<?= $totalamount_final; ?>">
					</div>
					<button class="btn btn-primary mb-2" type="submit" name="add_order">ทำรายการให้เสร็จสิ้น</button>
</form>

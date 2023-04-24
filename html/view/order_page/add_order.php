	                <h5 class="card-title mb-2">การชำระเงิน</h5>
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
					</div>
					<h5 class="card-title mb-2">ที่อยู่ในการจัดส่ง</h5>
					<?php
						$checkaddress_database_query = mysqli_query($db,"SELECT * FROM `orders` WHERE `user_id` = ".$user['id']);
					?>
					<div class="form-check mb-2 form-switch
					<?php if (mysqli_num_rows($checkaddress_database_query) < 1) {
							echo "visually-hidden";
						} ?>
					">
						<input class="form-check-input" type="checkbox" role="switch" onchange="changeaddress()" name="Checkaddress" id="Checkaddress"
						<?php
						if (mysqli_num_rows($checkaddress_database_query) < 1) {
							echo "disabled";
						}
						?>
						>
						<label class="form-check-label" for="flexSwitchCheckDefault">เปลี่ยนเป็นที่อยู่สำเร็จรูป</label>
					</div>
					<div id="address_page_input" name="address_page_input" class="mb-2">
						<?php include 'post/address_page_input.php'; ?>
					</div>
					<div id="address_page_instant" name="address_page_instant" class="visually-hidden mb-2">
						<?php include 'post/address_page_instant.php'; ?>
					</div>
</form>

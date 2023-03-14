<form method="post" enctype="multipart/form-data" action="">
					<?php 
					include '../../inc/errors.php'; 
					?>
					<input class="form-control" type="hidden" name="user_id" value="<?= $user['id']; ?>">
                    <input class="form-control" type="hidden" name="amount" value="<?= $totalamount; ?>">
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
					<div class="form-check form-switch mb-2">
						<input class="form-check-input" onchange="changetoedit()" type="checkbox" id="SwitchCheck">
						<label class="form-check-label" for="SwitchCheck">ส่งเป็นของขวัญ</label>
					</div>
					<div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">ขื่อ</label>
						<div class="col-sm-10">
						<input class="form-control" type="text" name="name" value="<?= $user['name']; ?>">
						</div>
					</div>
					<div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">นามสกุล</label>
						<div class="col-sm-10">
						<input class="form-control" type="text" name="surname" value="<?= $user['surname']; ?>">
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
						<input class="form-control" type="text" name="country" value="ประเทศไทย" readonly>
						</div>
					</div>
                    <div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">รหัสไปรษณีย์</label>
						<div class="col-sm-10">
						<input class="form-control" type="text" id="postal_code" name="postal_code" readonly>
						</div>
					</div>
					<button class="btn btn-primary mb-2" type="submit" name="add_order">ทำรายการให้เสร็จสิ้น</button>
</form>

<?php
require '../../inc/header.php';
require '../../inc/controller/usercontroller.php';
include '../../inc/errors.php'; 
?>
  <title>ระบบสมัครสมาชิก</title>  
  <div class="container">
  	<div class="row">
  		<div class="col-4"></div>
			<div class="col-sm-offset-2 col-sm-4">
				<div class="card">
					<div class="card-body justify-content-center">
						<div class="header">
							<h2>สมัครสมาชิก</h2>
						</div>
						<form method="post" action="register.php">
								<input type="hidden" id="role" name="role" value="user">
							<div class="form-group">
								<label class="text-start">ชื่อผู้ใช้</label>
								<input class="form-control" type="text" name="username" value="<?php echo $username; ?>" required>
							</div>
							<div class="form-group">
								<label class="text-start">ขื่อ</label>
								<input class="form-control" type="text" name="name" value="<?php echo $name; ?>" required>
							</div>
							<div class="form-group">
								<label>นามสกุล</label>
								<input class="form-control" type="text" name="surname" value="<?php echo $surname; ?>" required>
							</div>
							<div class="form-group">
								<label class="text-start">อีเมล</label>
								<input class="form-control" type="email" name="email" value="<?php echo $email; ?>" required>
							</div>
							<div class="form-group">
								<label class="text-start">รหัสผ่าน</label>
								<input class="form-control" type="password" name="password_1" required>
							</div>
							<div class="form-group">
								<label class="text-start">ยืนยันรหัสผ่าน</label>
								<input class="form-control" type="password" name="password_2" required>
							</div>
							<div class="form-group mt-2">
								<div class="cf-turnstile" data-sitekey="0x4AAAAAAADwjCCrKbo0LqwV" data-callback="javascriptCallback"></div>
							</div>	
					</div>
					<div class="card-footer">
						<button class="btn btn-primary" type="submit" name="reg_user">สมัครสมาชิก</button>
							<p>
								เป็นสมาชิกอยู่แล้ว? <a href="login.php">เข้าสู่ระบบ</a>
							</p>
					</div>
						</form>
				</div>
			</div>
  		</div>
  	</div>
</div>
  <?php
require '../../inc/footer.php';
?>
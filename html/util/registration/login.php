<?php
require '../../inc/header.php';
require '../../inc/controller/usercontroller.php';
include '../../inc/errors.php'; 
?>
<title>เข้าสู่ระบบ</title>
<div class="row">
  <div class="col-4"></div>
  <div class="col-sm-offset-2 col-sm-4">
		<div class="card">
			<div class="card-body justify-content-center">
				<div class="card-title">
					<h2>เข้าสู่ระบบ</h2>
				</div>
  				<form method="post" action="login.php">
				<div class="form-group">
					<label>ชื่อผู้ใช้</label>
					<input class="form-control" type="text" name="username" required>
				</div>
				<div class="form-group">
					<label>รหัสผ่าน</label>
					<input class="form-control" type="password" name="password" required>
				</div>
				<div class="form-group mt-2">
					<div class="cf-turnstile" data-sitekey="0x4AAAAAAADwjCCrKbo0LqwV" data-callback="javascriptCallback"></div>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary" name="login_user">เข้าสู่ระบบ</button>
					<p>
						ยังไม่เป็นสมาชิกอยู่หรอ? <a href="consent_form.php">สมัครสมาชิก</a>
					</p>
			</div>
				</form>
		</div>
	</div>
</div>
<?php
require '../../inc/footer.php';
?>

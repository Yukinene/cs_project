<?php
require '../../inc/header.php';
require '../../inc/controller/usercontroller.php';
?>
  <title>ระบบสมัครสมาชิก</title>
  
  <div class="container">
  	<div class="row">
  		<div class="col-4"></div>
			<div class="col-sm-offset-2 col-sm-4">
					<div class="row placeholders">
					<div class="panel  panel-default">
					<div class="panel-body justify-content-center">
				<div class="header">
					<h2>สมัครสมาชิก</h2>
				</div>
				<form method="post" action="register.php">
					<?php 
					include '../../inc/errors.php'; 
					?>
					<input type="hidden" id="role" name="role" value="user">
					<div class="form-group">  
					<label class="text-start">ชื่อผู้ใช้</label>
					<input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
					</div>
					<div class="form-group">
					<label class="text-start">ขื่อ</label>
					<input class="form-control" type="text" name="name" value="<?php echo $name; ?>">
					</div>
					<div class="form-group">
					<label>นามสกุล</label>
					<input class="form-control" type="text" name="surname" value="<?php echo $surname; ?>">
					</div>
					<div class="form-group">
					<label class="text-start">อีเมล</label>
					<input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
					</div>
					<div class="form-group">
					<label class="text-start">รหัสผ่าน</label>
					<input class="form-control" type="password" name="password_1">
					</div>
					<div class="form-group">
					<label class="text-start">ยืนยันรหัสผ่าน</label>
					<input class="form-control" type="password" name="password_2">
					</div>
					<br>
					<button class="btn btn-primary" type="submit" name="reg_user">สมัครสมาชิก</button>
					<p>
						เป็นสมาชิกอยู่แล้ว? <a href="login.php">เข้าสู่ระบบ</a>
					</p>
				</form>
			</div>
			</div>
			</div>
  		</div>
  	</div>
  </div>
  <?php
require '../../inc/footer.php';
?>
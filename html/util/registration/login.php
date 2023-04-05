<?php
require '../../inc/header.php';
require '../../inc/controller/usercontroller.php';
?>
<title>เข้าสู่ระบบ</title>
<div class="container">
  <div class="row">
  <div class="col-4"></div>
  <div class="col-sm-offset-2 col-sm-4">
		<div class="row placeholders">
		<div class="panel  panel-default">
  		<div class="panel-body justify-content-center">
	<div class="header">
  	<h2>เข้าสู่ระบบ</h2>
  	</div>
	 
  <form method="post" action="login.php">
    <?php 
	include '../../inc/errors.php'; 
	?>
  	<div class="form-group">
  		<label>ชื่อผู้ใช้</label>
  		<input class="form-control" type="text" name="username" >
  	</div>
  	<div class="form-group">
  		<label>รหัสผ่าน</label>
  		<input class="form-control" type="password" name="password">
  	</div>
	<br>
	  <button type="submit" class="btn btn-primary" name="login_user">เข้าสู่ระบบ</button>
  	<p>
  		ยังไม่เป็นสมาชิกอยู่หรอ? <a href="register.php">สมัครสมาชิก</a>
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

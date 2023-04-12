<?php
require '../../inc/header.php';
require '../../inc/controller/usercontroller.php';
include '../../inc/completes.php';
include '../../inc/errors.php';
checkuser();
$username = $_SESSION['username'];
$user_info_query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($db, $user_info_query);
$user = mysqli_fetch_assoc($result);
$edit_profile = array("name", "surname", "email", "password_new", "password_old");
?>
<title>แก้ไขข้อมูลผู้ใช้</title>
<div class="row">
  	<div class="col-3"></div>
	<div class="col-6">
			<div class="card justify-content-center">
				<div class="card-body">
				<div class="header mt-2 mb-2">
					<h2>แก้ไขข้อมูลผู้ใช้</h2>
				</div>
                <div class="mb-2 d-flex flex-row-reverse gap-3">
                	<a class="btn btn-danger" href="profile.php">ย้อนกลับ</a>
                </div>
				<form method="post" action="">
					<div class="row mb-2">  
						<label class="col-sm-2 col-sm-2 col-form-label">ชื่อผู้ใช้</label>
						<div class="col-sm-10">
						<input class="form-control-plaintext" type="text" name="username" value="<?= $user['username']; ?>" readonly>
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
						<label class="col-sm-2 col-sm-2 col-form-label">อีเมล</label>
						<div class="col-sm-10">
						<input class="form-control" type="email" name="email" value="<?= $user['email']; ?>" required>
						</div>
					</div>
					<div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">รหัสผ่านใหม่</label>
						<div class="col-sm-10">
						<input class="form-control" type="password" name="password_new">
						</div>
					</div>
					<div class="row mb-2">
						<label class="col-sm-2 col-sm-2 col-form-label">รหัสผ่านเก่า</label>
						<div class="col-sm-10">
						<input class="form-control" type="password" name="password_old">
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary mb-2" type="submit" name="cha_info">แก้ไขข้อมูล</button>
				</div>
				</form>
		</div>
	</div>
</div>
<?php
require '../../inc/footer.php';
?>
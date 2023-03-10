<?php
require '../../inc/header.php';
require '../../inc/usercontroller.php';
checkuser();
$username = $_SESSION['username'];
$user_info_query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($db, $user_info_query);
$user = mysqli_fetch_assoc($result);
$edit_profile = array("name", "surname", "email", "password_new", "password_old");
$month = array("","มกราคม.","กุมภาพันธ์","มีนาคม","เมษายน.","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
?>
<title>Profile</title>
<div class="container">
  	<div class="row">
  		<div class="col-2">
		</div>
			<div class="col-6">
					<div class="row placeholders">
					<div class="panel  panel-default">
					<div class="panel-body justify-content-center">
				<div class="header mb-2">
					<h2>ข้อมูลผู้ใช้</h2>
				</div>
				<div class="form-check form-switch mb-2">
					<input class="form-check-input" onchange="changetoedit()" type="checkbox" id="profileSwitchCheck">
					<label class="form-check-label" for="profileSwitchCheck">แก้ไขข้อมูลผู้ใช้</label>
				</div>
				<form method="post" action="">
					<?php 
					include '../../inc/errors.php'; 
					?>
					<div class="row mb-2">  
						<label class="col-sm-2 col-sm-2 col-form-label">ชื่อผู้ใช้</label>
						<div class="col-sm-10">
						<input class="form-control-plaintext" type="text" name="username" value="<?= $user['username']; ?>" readonly>
						</div>
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
						<label class="col-sm-2 col-sm-2 col-form-label">อีเมล</label>
						<div class="col-sm-10">
						<input class="form-control" type="email" name="email" value="<?= $user['email']; ?>">
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
					<br>
					<button class="btn btn-primary mb-2" type="submit" name="cha_info">แก้ไขข้อมูล</button>
					<?php 
					include '../../inc/complete.php'; 
					?>
				</form>
			</div>
			</div>
			</div>
  		</div>
  	</div>
  </div>
  <?php
    $user_order_list_query = "SELECT * FROM `user_order` WHERE `user` = '".$user['id']."'";
    $user_order_list = mysqli_query($db,$user_order_list_query);
?>
	<div class="row mt-2">
		<div class="col-2"></div>
  		<div class="col-8">
		  <h2>ประวัติการใช้จ่าย</h2>
    <table id="userorderTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            <th width='50%'>
              เดือน / ปี
            </th>
            <th width='50%'>
              จำนวนเงิน
            </th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($user_order_list) > 0){
            while($fetch_user_order = mysqli_fetch_assoc($user_order_list)){
        ?>
            <tr>
                <th>
                    <?=$month[$fetch_user_order['month']]?> / <?=$fetch_user_order['year']?>
                </th>
                <th>
                    <?=$fetch_user_order['amount']?>
                </th>
            </tr><?php
              }
            }
        ?>
        </tbody>
    </table>
		</div>
		<div class="col-2"></div>
    
<script>
function changetoedit() {
  if ($("#profileSwitchCheck").prop("checked")) {
	<?php foreach ($edit_profile as $value) 
	{ ?>
		$("input[name=<?=$value?>]").prop('disabled', false);
	<?php } ?>
		$("button[name=cha_info]").prop('disabled', false);
  }
  else
  {
	<?php foreach ($edit_profile as $value) 
	{ ?>
		$("input[name=<?=$value?>]").prop('disabled', true);
	<?php } ?>
		$("button[name=cha_info]").prop('disabled', true);
  }
}
$( document ).ready(function() {
	changetoedit();
});
</script>
<?php
require '../../inc/footer.php';
?>
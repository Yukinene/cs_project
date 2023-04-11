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
<title>Profile</title>
  	<div class="row">
  		<div class="col-2">
		</div>
			<div class="col-8">
				<?php include 'show_user.php'; ?>
			</div>
  		</div>
  		</div>
  	</div>
	<div class="row mt-2">
		<div class="col-2"></div>
  		<div class="col-4">
		  	<div class="card">
				<div class="card-body">
					<h2 class="card-title">
						ประวัติการใช้จ่าย
					</h2>
					<?php include 'table/user_order_table.php' ?>
				</div>
			</div>
		</div>
		<div class="col-4">
		  	<div class="card">
				<div class="card-body">
					<?php include '../coupon_page/user_coupon_usage.php' ?>
				</div>
			</div>
		</div>
	</div>
<?php
require '../../inc/footer.php';
?>
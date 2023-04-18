<?php
include('db.php');
$district = "SELECT * FROM `districts` WHERE `province_id` = {$_POST['province_id']}";
$district_query = mysqli_query($db, $district);
$district_json = array();
while($district_result = mysqli_fetch_assoc($district_query)) {    
array_push($district_json, $district_result);
}
echo json_encode($district_json);
?>
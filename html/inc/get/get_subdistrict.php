<?php
include('db.php');
$sub_district = "SELECT * FROM `sub_districts` WHERE `district_id` = {$_POST['district_id']}";
$sub_district_query = mysqli_query($db, $sub_district);
$sub_district_json = array();
while($sub_district_result = mysqli_fetch_assoc($sub_district_query)) {    
array_push($sub_district_json, $sub_district_result);
}
echo json_encode($sub_district_json);
?>
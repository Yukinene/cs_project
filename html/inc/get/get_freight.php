<?php
include('db.php');
$freight = "SELECT * FROM `freight` WHERE `province_id` = {$_POST['province_id']}";
$freight_default = "SELECT * FROM `freight` WHERE `province_id` = 0";
$freight_query = mysqli_query($db, $freight);
$freight_default_query = mysqli_query($db, $freight_default);
$freight_json = array();
if (mysqli_num_rows($freight_query) > 0) {
    while($freight_result = mysqli_fetch_assoc($freight_query)) {    
    array_push($freight_json, $freight_result);
    }   
}
else {
    $freight_result = mysqli_fetch_assoc($freight_default_query);
    array_push($freight_json, $freight_result);
}
echo json_encode($freight_json);
?>
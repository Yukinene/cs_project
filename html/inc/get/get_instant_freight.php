<?php
include('db.php');
$order_address = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `orders` WHERE id = {$_POST['instant_address']}"));
$province = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `provinces` WHERE `name_th` = '{$order_address['province']}'"));
$freight = "SELECT * FROM `freight` WHERE `province_id` = {$province['id']}";
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
<?php 
    if (isset($_POST['add_cou']) && isset($_POST['coupon_comfirm'])) {
        $coupon_name = $_POST['coupon_name'];
        $coupon_price = $_POST['coupon_price'];
        $expire_date = $_POST['expire_date'];
        $check_same_coupon_name = mysqli_query($db,"SELECT * FROM `coupons` WHERE `coupon_name` = '".$coupon_name."'");
        if (mysqli_num_rows($check_same_coupon_name) < 1) {
            mysqli_query($db,"INSERT INTO 
            `coupons`(`coupon_name`, `coupon_price`, `expire_date`) 
            VALUES ('".$coupon_name."',".$coupon_price.",'".$expire_date."')");
        }
        else {
            array_push($errors, "คูปองนี้มีอยู่ในระบบ");
        }
    }
?>
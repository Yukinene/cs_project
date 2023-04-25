
<title>Home</title>
<?php
require '../../inc/header.php';
if (checkusername()) {
    ?>
    <div class="row mb-2">
        <div class="col-4"></div>
        <div class="col-4 text-center">
            <div class="card">
                <h1><h1 class="fs-1 mb-3">ภูมินทร์การค้า</h1>
                <h4 class="fs-1 mb-3">ถั่วเคลือบมะม่วงเคลือบ</h4></h1>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
    <?php
    require '../product_page/product_list.php';    
}
else {
    require 'intro.php';
}
require_once '../../inc/footer.php';
?>
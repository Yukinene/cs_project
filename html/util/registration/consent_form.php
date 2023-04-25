<?php
require '../../inc/header.php';
?>
<title>นโยบายเกี่ยวกับข้อมูลส่วนบุคคล</title>
้<div class="row mb-2">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h2>นโยบายเกี่ยวกับข้อมูลส่วนบุคคล</h2>
            </div>
            <div class="card-body">
                <div class="overflow-scroll" style="height:300px;">
                <?php include '../consent.php' ?>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-success" href="register.php">ข้าพเจ้ายอมรับนโยบายเกี่ยวกับข้อมูลส่วนบุคคลนี้</a>
            </div>
        </div>
    </div>
</div>
<?php
require '../../inc/footer.php';
?>
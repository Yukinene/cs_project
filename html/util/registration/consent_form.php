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
                <div name="consent" id="consent" class="overflow-scroll" style="height:300px;">
                <?php include '../consent.php' ?>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" name="register" id="register" onclick="location.href='register.php';" disabled>
                    ข้าพเจ้ายอมรับนโยบายเกี่ยวกับข้อมูลส่วนบุคคลนี้
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function scroll() {
        var consent = document.querySelector('#consent');
        var scrollTop = consent.scrollTop;
        var height = consent.scrollHeight - consent.clientHeight;
        var percent = scrollTop/height;
        console.log(percent);
        if (percent > 0.99) {
            document.getElementById("register").disabled = false;
        }
        else
        {
            document.getElementById("register").disabled = true;
        }
    }

    document
    .querySelector("#consent")
    .addEventListener("scroll", (event) => {
        scroll();
    });

</script>

<?php
require '../../inc/footer.php';
?>
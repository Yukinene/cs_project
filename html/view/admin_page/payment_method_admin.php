<?php
require '../../inc/header.php';
checkadmin();
  include '../../inc/controller/paymentmethodcontroller.php';
  include '../../inc/completes.php';
  include '../../inc/errors.php';
?>
<title>ระบบจัดการช่องทางการเงิน (สำหรับผู้จัดการระบบ)</title>
<div class="card">
  <div class="card-body ms-2">
    <h2 class="card-title">ช่องทางการเงิน</h2>
    <div class="mb-2 d-flex flex-row-reverse"> 
        <?php include '../payment_page/modal/add_payment_method_modal.php'; ?>
    </div>
    <?php
    include '../payment_page/payment_list.php';
    ?>
  </div>
</div>




<script>
        $(document).ready(function () {
            $("#paymentTable").DataTable({
              "order": [[ 0, "desc" ]],
        "responsive": true,
        "ordering": false,
        lengthMenu: [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100]
          ],
        "pageLength": 25,
        language: 
        {
          url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/th.json'
        }
            });
        });
</script>

<?php
require '../../inc/footer.php';
?>
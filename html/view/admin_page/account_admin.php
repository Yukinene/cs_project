<?php
require '../../inc/header.php';
checkadmin();
?>
<title>ระบบรายรับรายจ่าย (สำหรับผู้จัดการระบบ)</title>
<div class="card">
    <div class="card-body ms-2">

    <h2 class="card-title">ระบบรายรับรายจ่าย (สำหรับผู้จัดการระบบ)</h2>
<?php
$account = mysqli_query($db,"SELECT * FROM `account`");
if (mysqli_num_rows($account) > 0) {
$amount = 0;
?>
    <table id="accountTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <td>
                    เวลา
                </td>
                <td>
                    รายละเอียด
                </td>
                <td>
                    จำนวน
                </td>
            </tr>
        </thead>
        <tbody>
            <?php while ($log_account = mysqli_fetch_assoc($account)) { $amount += $log_account['amount']; ?>
            <tr>
                <td>
                    <?= $log_account['time_log'] ?>
                </td>
                <td>
                    <?= $log_account['info'] ?>
                </td>
                <td>
                    <?= $log_account['amount'] ?>
                </td>
            </tr>
            <?php } ?>
            
        </tbody>
    </table>
    <div class="md-5">
    <table id="logTableall" class="table table-striped" style="width:100%">
            <tbody>
                    <tr>
                            <td>รวมทั้งหมด</td>
                            <td><?= $amount ?></td>
                    </tr>
            </tbody>
        </table>       
    </div>
    </div>
</div>
<script>
        $(document).ready(function () {
            $("#accountTable").DataTable({
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
}
require '../../inc/footer.php';
?>
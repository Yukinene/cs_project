<?php
require '../../inc/header.php';
$log_materials = mysqli_query($db, "SELECT * FROM `log_materials` WHERE `material_id` = ".$_GET['id']);
$material = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `materials` WHERE `material_id` = ".$_GET['id']));
?>
<div class="card">
        <div class="card-body ms-2">
                
้<h2 class="card-title">ประวัติการเข้าออกวัตถุดิบ : <?=$material['material_name']?></h2>
<?php
if (mysqli_num_rows($log_materials) > 0) {
$amount = 0;
?>
<div class="mb-2 d-flex flex-row-reverse gap-3">
    <a class="btn btn-danger" href="../admin_page/material_admin.php">ย้อนกลับ</a>
</div>
<table id="logTable" class="table table-striped" style="width:100%">
        <thead>
                <tr>
                        <td>
                                เวลา
                        </td>
                        <td>
                                จำนวน (กิโลกรัม)
                        </td>
                </tr>
        </thead>
        <tbody>
                <?php while ($log = mysqli_fetch_assoc($log_materials)) {
                        $amount += $log['material_amount'];
                 ?>
                <tr>
                        <td>
                                <?= $log['time_log'] ?>
                        </td>
                        <td>
                                <?= $log['material_amount'] ?>
                        </td>
                </tr>
                <?php
                }
                ?>
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
            $("#logTable").DataTable({
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
}
else
{
        ?>
        <div class="card alert alert-danger text-center">
                        <div class="card-body">
                        <h3 class="card-title">ไม่มีข้อมูลการเข้าออก</h3>
                        </div>
                    </div>
        <?php
}
<?php
require '../../inc/header.php';
$log_products = mysqli_query($db, "SELECT * FROM `log_products` WHERE `product_id` = ".$_GET['id']);
$product = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM `products` WHERE `product_id` = ".$_GET['id']));
?>
้<h2>ประวัติการเข้าออกสินค้า : <?=$product['product_name']?></h2>
<?php
if (mysqli_num_rows($log_products) > 0) {
$amount = 0;

?>
<table id="logTable" class="table table-striped" style="width:100%">
        <thead>
                <tr>
                        <td>
                                เวลา
                        </td>
                        <td>
                                จำนวน
                        </td>
                </tr>
        </thead>
        <tbody>
                <?php while ($log = mysqli_fetch_assoc($log_products)) {
                        $amount += $log['product_amount'];
                 ?>
                <tr>
                        <td>
                                <?= $log['time_log'] ?>
                        </td>
                        <td>
                                <?= $log['product_amount'] ?>
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
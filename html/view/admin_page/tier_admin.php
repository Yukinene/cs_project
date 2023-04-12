<?php
  require '../../inc/header.php';
  checkadmin();
  require '../../inc/controller/tiercontroller.php';
  require '../../inc/controller/freightcontroller.php';
	include '../../inc/completes.php';
	include '../../inc/errors.php';
?>
<title>ระบบจัดการระดับแบะค่าขนส่ง (สำหรับผู้จัดการระบบ)</title>
<div class="card">
  <div class="card-body ms-2">
  <h2 class="card-title">ระดับและค่าขนส่ง</h2>
  <div class="mb-2 d-flex flex-row-reverse gap-3"> 
        <?php include 'modal/freight_modal.php'; ?>
        <?php include 'modal/add_tier_modal.php'; ?>
  </div>
<?php
    $discount_list_query = "SELECT * FROM `discount`";
    $select_discount_list = mysqli_query($db,$discount_list_query);
?>  
    <table id="discountTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            <th width='15%'>
              ระบบ
            </th>
            <th width='15%'>
              เมื่อซื้อครบ
            </th>
            <th width='15%'>
              เปอร์เซนต์
            </th>
            <th width='20%'>
              ตัวเลือก
            </th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($select_discount_list) > 0){
            while($fetch_discount_list = mysqli_fetch_assoc($select_discount_list)){
        ?>
            <tr>
                <th>
                    <?=$fetch_discount_list['tier']?>
                </th>
                <th>
                    <?=$fetch_discount_list['order_price']?>
                </th>
                <th>
                    <?=$fetch_discount_list['discount_percentage']?>
                </th>
                <th>
                    <form action="" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="tier" id="tier" value="<?=$fetch_discount_list['tier']?>">
                      <input type="submit" class="btn btn-danger" value="ลบ" name="del_dis">
                    </form>
                </th>
            </tr><?php
              }
            }
        ?>
        </tbody>
    </table>
  </div>
</div>
  
<script>
        $(document).ready(function () {
            $("#discountTable").DataTable({
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
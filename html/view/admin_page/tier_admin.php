<?php
require '../../inc/header.php';
checkadmin();
if (isset($_POST['add_dis'])) {
    $tier = mysqli_real_escape_string($db, $_POST['tier']);
    $order_price = mysqli_real_escape_string($db, $_POST['price']);
    $discount_percentage = mysqli_real_escape_string($db, $_POST['percentage']);
    $tier_check = "SELECT * FROM `discount` WHERE `tier` = '".$tier."' LIMIT 1";
    $result = mysqli_query($db,$tier_check);
    $check = mysqli_fetch_assoc($result);
    if ($check) { // if check exists
        array_push($errors, "ส่วนลดนี้มีอยู่ในระบบ");
      }
    else {
      $query = "INSERT INTO `discount`(`tier`,`order_price`, `discount_percentage`) 
      VALUES ('$tier','$order_price','$discount_percentage')";
  	  mysqli_query($db, $query);
      array_push($completes, "เพิ่มส่วนลดสำเร็จ");
    }
}
if (isset($_POST['cha_frei'])) {
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $ordermore = mysqli_real_escape_string($db, $_POST['ordermore']);
  $query = "UPDATE `freight` SET `price`='".$price."',`ordermore`='".$ordermore."' WHERE 1";
  mysqli_query($db, $query);
  array_push($completes, "แก้ไขค่าขนส่งสำเร็จ");
}
if (isset($_POST['del_dis'])) {
  $tier = mysqli_real_escape_string($db, $_POST['tier']);
  $tier_check = "SELECT * FROM `discount` WHERE `tier` = '".$tier."' LIMIT 1";
  $result = mysqli_query($db,$tier_check);
  $check = mysqli_fetch_assoc($result);
  if ($check) { // if check exists
    $query = "DELETE FROM `discount` WHERE `tier` = '".$tier."'";
    mysqli_query($db, $query);
    array_push($completes, "ลบสำเร็จ");
    }
  else {
    array_push($errors, "ส่วนลดนี้ไม่มีอยู่ในระบบ");
  }
}
?>
<title>ระบบจัดการระดับ (สำหรับผู้จัดการระบบ)</title>
<?php 
	include '../../inc/complete.php';
    include '../../inc/errors.php'; 
?>
<div class="mb-2 d-flex flex-row-reverse"> 
      <?php include 'freight_modal.php'; ?>
      <?php include 'add_tier_modal.php'; ?>
</div>

<?php
    $discount_list_query = "SELECT * FROM `discount`";
    $select_discount_list = mysqli_query($db,$discount_list_query);
    
?>
    <h2>ระดับ</h2>
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
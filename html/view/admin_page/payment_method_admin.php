<?php
require '../../inc/header.php';
checkadmin();
if (isset($_POST['add_paym'])) {
    $method = mysqli_real_escape_string($db, $_POST['method']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $method_check = "SELECT * FROM `payment_method` WHERE `method` = '".$method."' LIMIT 1";
    $result = mysqli_query($db, $method_check);
    $check = mysqli_fetch_assoc($result);
    if ($check) { // if check exists

        array_push($errors, "ช่องทางการจ่ายเงินนี้มีอยู่ในระบบ");
      }
    else {
      $query = "INSERT INTO `payment_method`(`method`, `description`) 
      VALUES ('$method','$description')";
  	  mysqli_query($db, $query);
      array_push($completes, "เพิ่มช่องทางการจ่ายเงิน");
    }
}
if (isset($_POST['change_status'])) {
  // receive all input values from the form
  $payment_method = $_POST['method'];
  $payment_status = $_POST['status'];
  if ($payment_status === "active") {
    $payment_status_after = "deactive";
  }
  elseif ($payment_status === "deactive") {
    $payment_status_after = "active";
  }
  else {
    array_push($errors, "เปลี่ยนสถานะไม่สำเร็จ");
  }
  if (count($errors) == 0) {
    // Finally, register product and upload image
    $query = "UPDATE `payment_method` SET `payment_status`='".$payment_status_after."' WHERE `method` = '".$payment_method."'";
    mysqli_query($db, $query);
    array_push($completes, "เปลี่ยนสถานะสำเร็จ");
  }
}
if (isset($_POST['edit_paym'])) {
  $old_method = $_POST['old_method'];
  $method = mysqli_real_escape_string($db, $_POST['method']);
  $description = mysqli_real_escape_string($db, $_POST['description']);
  $method_check = "SELECT * FROM `payment_method` WHERE `method` = '".$method."' LIMIT 1";
  $result = mysqli_query($db, $method_check);
  $check = mysqli_fetch_assoc($result);
  if ($old_method === $method) { //if edit description only
      $query = "UPDATE `payment_method` SET `description`='".$description."' WHERE `method` = '".$old_method."'";
      mysqli_query($db, $query);
      array_push($completes, "แก้ไขช่องทางการจ่ายเงินสำเร็จ");
    }
  else {
    if ($check) { // if check exists
      array_push($errors, "ช่องทางการจ่ายเงินนี้มีอยู่ในระบบ");
    }
    else {
      $query = "UPDATE `payment_method` SET `method`='".$method."',`description`='".$description."' WHERE `method` = '".$old_method."'";
      mysqli_query($db, $query);
      array_push($completes, "แก้ไขช่องทางการจ่ายเงินสำเร็จ");
    }
    
  }
}
?>
<title>ระบบจัดการช่องทางการเงิน (สำหรับผู้จัดการระบบ)</title>
<?php 
	include '../../inc/complete.php';
    include '../../inc/errors.php'; 
?>
<div class="mb-2 d-flex flex-row-reverse"> 
      <?php include 'add_payment_method_modal.php'; ?>
</div>

<?php
    $payment_list_query = "SELECT * FROM `payment_method`";
    $select_payment_list = mysqli_query($db,$payment_list_query);
    
?>
    <h2>ช่องทางการเงิน</h2>
    <table id="paymentTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            <th width='15%'>
              ช่องทางการเงิน
            </th>
            <th width='15%'>
              คำอธิบาย
            </th>
            <th width='20%'>
              สถานะ
            </th>
            <th width='20%'>
              ตัวเลือก
            </th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($select_payment_list) > 0){
            while($fetch_payment_list = mysqli_fetch_assoc($select_payment_list)){
        ?>
            <tr>
                <th>
                    <?=$fetch_payment_list['method']?>
                </th>
                <th>
                    <?=$fetch_payment_list['description']?>
                </th>
                <th>
                    <?=$fetch_payment_list['payment_status']?>
                </th>
                <th>
                <form action="" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="method" id="method" value="<?=$fetch_payment_list['method']?>">
                      <input type="hidden" name="status" id="status" value="<?=$fetch_payment_list['payment_status']?>">
                      <?php if (!($fetch_payment_list['method'] === "เก็บเงินปลายทาง")) {
                        if ($fetch_payment_list['payment_status'] === "active") 
                      {?>
                        <input type="submit" class="btn btn-danger" value="ปิดช่องทาง" name="change_status">
                      <?php }
                      else { ?>
                        <input type="submit" class="btn btn-success" value="เปิดช่องทาง" name="change_status">
                      <?php }
                      
                      }?>
                      
                    </form>
                    
                    <br>
                    <?php if (!($fetch_payment_list['method'] === "เก็บเงินปลายทาง")) { ?>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editproductModal<?=$fetch_payment_list['method']?>">
                      แก้ไข
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="editproductModal<?=$fetch_payment_list['method']?>" tabindex="-1" aria-labelledby="editproductModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editproductModalLabel">แก้ไข <?=$fetch_payment_list['method']?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form method="post" action="" enctype="multipart/form-data">
                              <input type="hidden" name="old_method" id="old_method" value="<?=$fetch_payment_list['method']?>">
                              <div class="form-group">
                                <label class="text-start">ช่องทางการจ่ายเงิน</label>
                                <input class="form-control" type="text" name="method" value="<?=$fetch_payment_list['method']?>" maxlength="90" required>
                              </div>
                              <div class="form-group">
                                <label>รายละเอียดช่องทางการจ่ายเงิน (สูงสุด 190 ตัวอักษร)</label>
                                <textarea class="form-control" name="description" rows="5" maxlength="190" required><?=$fetch_payment_list['description']?></textarea>
                            </div>
                            <br>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="submit" name="edit_paym">แก้ไขช่องทางการเงิน</button>
                            </div>
                          </form>
                          </div>
                      </div>
                    </div>
                    <?php } ?>
                </th>
            </tr><?php
              }
            }
        ?>
        </tbody>
    </table>



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
<?php
    $payment_list_query = "SELECT * FROM `payment_method`";
    $select_payment_list = mysqli_query($db,$payment_list_query);
?>
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
                    <?php
                    if ($fetch_payment_list['payment_status'] === "active") {
                      echo "เปิดการใช้งาน";
                    }
                    else {
                      echo "ปิดการใช้งาน";
                    }
                    ?>
                </th>
                <th>
                <div class="mb-3">
                <form action="" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="method" id="method" value="<?=$fetch_payment_list['method']?>">
                      <input type="hidden" name="status" id="status" value="<?=$fetch_payment_list['payment_status']?>">
                      <?php if (!($fetch_payment_list['method'] === "เก็บเงินปลายทาง")) {
                        if ($fetch_payment_list['payment_status'] === "active") 
                      {?>
                        <input type="submit" class="btn btn-danger" value="ปิดช่องทาง" onClick="return confirm('จะปิดช่องทาง<?=$fetch_payment_list['method']?>หรือไม่?')" name="change_status">
                      <?php }
                      else { ?>
                        <input type="submit" class="btn btn-success" value="เปิดช่องทาง" name="change_status">
                      <?php }
                      
                      }?>
                </form>
                </div>
                <div class="mb-3">
                  <?php
                    require "modal/edit_payment_method_modal.php";
                  ?>
                </div>
                </th>
            </tr><?php
              }
            }
        ?>
        </tbody>
    </table>
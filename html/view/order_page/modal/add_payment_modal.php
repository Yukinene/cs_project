<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpaymentModal">
  หลักฐานการจ่ายเงิน
</button>

<!-- Modal -->
<div class="modal fade" id="addpaymentModal" tabindex="-1" aria-labelledby="addpaymentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addpaymentModalLabel">หลักฐานการจ่ายเงิน</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" enctype="multipart/form-data" action="../order_page/post/post_order.php">
                                <input class="form-control" type="hidden" name="user_id" value="<?= $user['id']; ?>">
                                <input class="form-control" type="hidden" name="order_id" value="<?= $order['id']; ?>">
                        <?php $order_payments = mysqli_query($db,"SELECT * FROM `payments` WHERE `order_id` = ".$_GET['id']);
                        if(mysqli_num_rows($order_payments) < 1 && $user['id'] == $order['user_id']){
                              $order_payments_method = mysqli_query($db,"SELECT * FROM `payment_method` WHERE `method` = '".$order['payment_method']."'");
                              $fetch_payments_method = mysqli_fetch_assoc($order_payments_method)
                        ?>
                              <?php if ($fetch_payments_method != NULL) { ?>
                                <div class="form-group mb-2">
                                <label for="formFile" class="form-label">คำอธิบาย :
                                  <br><?= $fetch_payments_method['description'] ?></label>
                                </div>
                              <?php } ?>
                                
                                <div class="form-group mb-2">
								                  <label for="formFile" class="form-label">เพิ่มรูปภาพหลักฐานการจ่ายเงิน <br>(รับประเภท .PNG , .JPG และ .JPEG เท่านั้น)</label>
								                  <input class="form-control" type="file" name="payment_img" id="payment_img" accept="image/png, image/jpg, image/jpeg" required>
							                  </div>
                                <center>
                                    <button class="btn btn-primary mb-2" type="submit" name="add_payment">เพิ่มหลักฐาน</button>
                                </center>
                            <?php } elseif (mysqli_num_rows($order_payments) > 0){
                                $fetch_payment = mysqli_fetch_assoc($order_payments)
                                 ?>
                                <input class="form-control" type="hidden" name="payment_img" value="<?= $fetch_payment['payment_img']; ?>">
                                <div class="form-group mb-2">
								                    <label for="formFile mb-2" class="form-label">รูปภาพหลักฐานการจ่ายเงิน : </label>
                                    <center>
                                        <img style="max-width:400px;max-height:600px;width:100%;height:100% " src="../../images/payments_image/<?php echo $fetch_payment['payment_img']; ?>" alt="">
                                    </center>
								    </div>
                                <center>
                            <?php if (checkrole('admin') && $order['status'] == 0) { ?>
                                    <button class="btn btn-success mb-2" type="submit" name="payment_approve">ยืนยัน</button>
                                    <button class="btn btn-danger mb-2" type="submit" onClick="return confirm('จะปฏิเสธและลบหลักฐานหรือไม่?')" name="payment_decline">ปฏิเสธ</button>
                            <?php }
                               if($order['status'] == 0 && $user['id'] == $order['user_id']) {?>
                                    <button class="btn btn-danger mb-2" type="submit" onClick="return confirm('จะลบหลักฐานหรือไม่?')" name="payment_decline">ลบ</button>
                            <?php } ?> 
                            </center>
                        <?php }
                        else {
                          ?>
                          <div class="form-group mb-2">
                            <label for="noInput mb-2" class="form-label">ยังไม่ได้รับไฟล์</label>
                          </div>
                          <?php
                        }
                        ?>
                        </form>
      </div>
    </div>
  </div>
</div>
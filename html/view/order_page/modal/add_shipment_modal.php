<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addshipmentModal">
หลักฐานการแพ็คสินค้า
</button>

<!-- Modal -->
<div class="modal fade" id="addshipmentModal" tabindex="-1" aria-labelledby="addshipmentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addpaymentModalLabel">หลักฐานการแพ็คสินค้า</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" enctype="multipart/form-data" action="post/post_order.php">
                                <input class="form-control" type="hidden" name="user_id" value="<?= $order['user_id']; ?>">
                                <input class="form-control" type="hidden" name="order_id" value="<?= $order['id']; ?>">
                        <?php if(mysqli_num_rows($order_shipments) < 1 && checkrole('admin')){
                        ?>
                                
                                <div class="form-group mb-2">
								    <label for="formFile" class="form-label">เพิ่มรูปหลักฐานการแพ็คสินค้า <br>(รับประเภท .PNG , .JPG และ .JPEG เท่านั้น)</label>
								    <input class="form-control" type="file" name="shipment_img" id="shipment_img" accept="image/png, image/jpg, image/jpeg" required>
							    </div>
                                <center>
                                    <button class="btn btn-primary mb-2" type="submit" name="add_shipment">เพิ่มหลักฐาน</button>
                                </center>
                            <?php } else {
                                $fetch_shipment = mysqli_fetch_assoc($order_shipments)
                                 ?>
                                <div class="form-group mb-2">
								    <label for="formFile mb-2" class="form-label">รูปหลักฐานการแพ็คสินค้า : </label>
                                    <input class="form-control" type="hidden" name="shipment_img" value="<?= $fetch_shipment['shipment_img']; ?>">
                                    <center>
                                        <img style="max-width:400px;max-height:600px;width:100%;height:100% " src="../../images/shipments_image/<?php echo $fetch_shipment['shipment_img']; ?>" alt="">
                                    </center>
								    </div>
                                <center>
                            <?php if (checkrole('admin') && $order['status'] < 4) { ?>
                                    <button class="btn btn-success mb-2" type="submit" name="shipment_approve">ยืนยัน</button>
                                    <button class="btn btn-danger mb-2" type="submit" name="shipment_decline">ปฏิเสธ</button>
                            <?php }?>
                            </center>
                        <?php }
                        ?>
                        </form>
      </div>
    </div>
  </div>
</div>
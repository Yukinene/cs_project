<?php if (!($fetch_payment_list['method'] === "เก็บเงินปลายทาง")) { ?>
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editpaymentModal<?=$fetch_payment_list['method']?>">
        แก้ไข
    </button>
    <div class="modal fade" id="editpaymentModal<?=$fetch_payment_list['method']?>" tabindex="-1" aria-labelledby="editpaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editpaymentModalLabel">แก้ไข <?=$fetch_payment_list['method']?></h1>
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
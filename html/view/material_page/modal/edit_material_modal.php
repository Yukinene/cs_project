<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editmaterialModal<?=$fetch_material['material_id']?>">
                      แก้ไขวัตถุดิบ
                    </button>
                    <div class="modal fade" id="editmaterialModal<?=$fetch_material['material_id']?>" tabindex="-1" aria-labelledby="editmaterialModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editmaterialModalLabel">แก้ไขวัตถุดิบ <?=$fetch_material['material_id']?> - <?=$fetch_material['material_name']?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                          <form method="post" action="" enctype="multipart/form-data">
                            <input type="hidden" name="material_id" id="material_id" value="<?=$fetch_material['material_id']?>">
                          <div class="form-group">
                              <label class="text-start">ขื่อวัตถุดิบ</label>
                                <input class="form-control" type="text" name="material_name" value="<?=$fetch_material['material_name']?>" maxlength="190" required>
                          </div>
                          <div class="form-group">
                            <label>จำนวนที่ซื้อ (กิโลกรัม)</label>
                            <input class="form-control" type="number" name="bought_amount" value="<?=$fetch_material['bought_amount']?>" min="0" step=any required>
                          </div>
                          <div class="form-group">
                            <label>ราคาที่ซื้อ (บาท)</label>
                            <input class="form-control" type="number" name="bought_price" value="<?=$fetch_material['bought_price']?>" min="0" required>
                          </div>
                          <br>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" name="edit_mate">แก้ไขวัตถุดิบ</button>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
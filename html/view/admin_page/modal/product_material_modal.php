<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproductmaterialModal<?=$fetch_product_materials['material_id']?>">
  แก้ไขวัตถุดิบ
</button>

<div class="modal fade" id="addproductmaterialModal<?=$fetch_product_materials['material_id']?>" tabindex="-1" aria-labelledby="addproductmaterialModalLabel<?=$fetch_product_materials['material_id']?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addproductmaterialModalLabel<?=$fetch_product_materials['material_id']?>">แก้ไขวัตถุดิบ <?=$fetch_materials['material_name']?> ใน <?=$fetch_products['product_name']?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?=$fetch_product_materials['product_id']?>">
                    <input type="hidden" name="material_id" value="<?=$fetch_product_materials['material_id']?>">
                        <div class="form-group">
                            <label>จำนวนที่ใช้ (กิโลกรัม)</label>
                            <input class="form-control" type="number" name="material_amount" min="0" value="<?=$fetch_product_materials['material_amount']?>" step=any required>
                        </div>
                        <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit" name="edit_pmat">แก้ไข</button>
            </div>
                </form>
        </div>
    </div>
</div>
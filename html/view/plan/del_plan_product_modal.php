<!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delplanproductModal<?=$fetch_plan_products['product_id']?>"
    <?php
    if ($fetch_plan_products['plan_amount'] < 1) {?>
      disabled
    <?php
    }
    ?>
    >
    แก้ไขจำนวนสินค้านอกคำสั่งซื้อ
    </button>

<!-- Modal -->
<div class="modal fade" id="delplanproductModal<?=$fetch_plan_products['product_id']?>" tabindex="-1" aria-labelledby="delplanproductModal<?=$fetch_plan_products['product_id']?>Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="delplanproductModal<?=$fetch_plan_products['product_id']?>Label">แก้ไขจำนวนสินค้านอกคำสั่งซื้อ - <?=$fetch_products['product_name']?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="product" value ="<?=$fetch_plan_products['product_id']?>">
        <input type="hidden" name="order_quantity" value ="<?=$fetch_plan_products['order_amount']?>">
      <div class="form-group mt-1">
			    <label class="text-start">จำนวน</label>
          <input class="form-control" type="number" name="quantity" min="0" value="<?=$fetch_plan_products['plan_amount']?>" max="<?=$fetch_plan_products['plan_amount']?>" required>
			</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="submit" name="del_planproduct">แก้ไข</button>
      </div>
    </form>
    </div>
  </div>
</div>
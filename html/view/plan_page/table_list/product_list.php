<?php
    $select_plan_products = mysqli_query($db,"SELECT * FROM `plan_products` WHERE `plan_id` = ".$plans['plan_id']."");
?>
<?php
if(mysqli_num_rows($select_plan_products) > 0){
?>
<h3>สินค้าในแผน :</h3>
<div class="table-responsive">
  <table id="PlanproductTable" class="table table-striped" style="width:100%">
    <thead>
			<center>
            <tr>
            <th width='20%'>
              สินค้า
            </th>
            <th width='20%'>
              ที่ผลิต
            </th>
            <?php if ($plans['status'] == 'เตรียมแผน') {?>
            <th width='40%'>
              ตัวเลือก
            </th>
            <?php
            } ?>
          </tr>
			</center>
    </thead>
    <tbody>
        <?php
         		while($fetch_plan_products = mysqli_fetch_assoc($select_plan_products)){
                    $fetch_products = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `products` WHERE `product_id` = ".$fetch_plan_products['product_id'].""))
        ?>
            <tr>
                <th>
                    <?=$fetch_products['product_name']?>
                </th>
                <th>
                    <?=$fetch_plan_products['plan_amount']?>
                </th>
                <?php if ($plans['status'] == 'เตรียมแผน') {?>
				        <th>
                    <?php
                      include __DIR__.'\..\modal\del_plan_product_modal.php';
                    ?>
                </th>
                <?php
            } ?>
            </tr>
            <?php
                }
        ?>
    </tbody>
  </table>
</div>
ปล. สินค้าจะทำเพิ่ม 1% เสมอ
<?php
 }
?>
<?php
    $select_plan_orders = mysqli_query($db,"SELECT * FROM `plan_orders` WHERE `plan_id` = ".$plans['plan_id']."");
?>
<?php
if(mysqli_num_rows($select_plan_orders) > 0){
?>
<h3>คำสั่งซื้อในแผน :</h3>
<table id="PlanorderTable" class="table table-striped" style="width:100%">
    <thead>
			<center>
            <tr>
            <th width='20%'>
              คำสั่งซื้อที่
            </th>
            <th width='40%'>
              
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
         	while($fetch_plan_orders = mysqli_fetch_assoc($select_plan_orders)){
        ?>
            <tr>
                <th>
                    <?=$fetch_plan_orders['order_id']?>
                </th>
                <th>

                </th>
                <?php if ($plans['status'] == 'เตรียมแผน') {?>
				<th>
                    <form action="" method="post">
                    <input type="hidden" name="order" value="<?=$fetch_plan_orders['order_id']?>">
                    <div class="form-group">
                        <button class="btn-danger" name="del_planorder" type="submit">ลบคำสั่งซื้อนี้ในแผน</button>
                    </div>
                    </form>
                </th>
                <?php
            } ?>
            </tr>
            <?php
                }
        ?>
    </tbody>
</table>
<?php
}
?>
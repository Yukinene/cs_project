<?php if ($plans['status'] != 'เตรียมแผน') {?>
    <?php
    $select_plan_materials = mysqli_query($db,"SELECT * FROM `plan_materials` WHERE `plan_id` = ".$plans['plan_id']."");
?>
<?php
if(mysqli_num_rows($select_plan_materials) > 0){
?>
<h3>วัตถุดิบในแผน :</h3>
<div class="table-responsive">
    <table id="PlanmaterialTable" class="table table-striped" style="width:100%">
        <thead>
			<center>
            <tr>
            <th width='20%'>
              วัตถุดิบ
            </th>
            <th width='20%'>
              จำนวนที่ใช้
            </th>
            <th width='20%'>
              จำนวนที่ซื้อ
            </th>
          </tr>
			</center>
        </thead>
        <tbody>
        <?php
         		while($fetch_plan_materials = mysqli_fetch_assoc($select_plan_materials)){
                    $fetch_materials = mysqli_fetch_assoc(mysqli_query($db,
                    "SELECT * FROM `materials` WHERE `material_id` = ".$fetch_plan_materials['material_id'].""))
        ?>
            <tr>
                <th>
                    <?=$fetch_materials['material_name']?>
                </th>
                <th>
                    <?=$fetch_plan_materials['material_amount']?>
                </th>
                <th>
                    <?php if ($fetch_plan_materials['material_amount_f'] > 0) {
                        echo $fetch_plan_materials['material_amount_f'];
                    } 
                    else { echo 0; }?>
                </th>
            </tr>
            <?php
                }
        ?>
        </tbody>
    </table>
</div>
<?php
 }
?>
<?php } ?>
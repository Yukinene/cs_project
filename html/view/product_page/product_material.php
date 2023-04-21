<?php
require '../../inc/header.php';
checkadmin();
require '../../inc/controller/productmaterialcontroller.php';
include '../../inc/completes.php';
include '../../inc/errors.php';
?>

<title>ระบบจัดการวัตถุดิบสินค้า (สำหรับผู้จัดการระบบ)</title>
<div class="card">
  <div class="card-body ms-2">
  <h2 class="card-title">จัดการวัตถุดิบ - <?=$fetch_products['product_name']?></h2>
    <div class="mb-2 d-flex flex-row-reverse gap-3">
    <a class="btn btn-danger" href="show_product.php?id=<?=$fetch_products['product_id']?>">ย้อนกลับ</a>
      <?php include 'modal/add_product_material_modal.php'; ?>
    </div>
    
	  <table id="ProductmaterialTable" class="table table-striped" style="width:100%">
        <thead>
			<center>
            <tr>
            <th width='25%'>
              วัตถุดิบ
            </th>
            <th width='10%'>
              จำนวนที่ใช้
            </th>
            <th width='20%'>
              ตัวเลือก
            </th>
          </tr>
			</center>
        </thead>
        <tbody>
        <?php
        	$select_product_materials = mysqli_query($db, "SELECT * FROM `product_materials` WHERE `product_id` = '".$_GET['id']."'");
      		if(mysqli_num_rows($select_product_materials) > 0){
         		while($fetch_product_materials = mysqli_fetch_assoc($select_product_materials)){
              $select_materials = mysqli_query($db,"SELECT * FROM `materials` WHERE `material_id` = ".$fetch_product_materials['material_id']."");
              $fetch_materials = mysqli_fetch_assoc($select_materials);
        ?>
            <tr>
                <th>
                  <?= $fetch_materials['material_name'] ?>
                </th>
                <th><?=$fetch_product_materials['material_amount']?></th>
                <th>
                <div class="mb-2">
                  <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" id="product_id" value="<?=$fetch_product_materials['product_id']?>">
                    <input type="hidden" name="material_id" id="material_id" value="<?=$fetch_product_materials['material_id']?>">
                    <input type="submit" class="btn btn-danger" onClick="return confirm('ลบ<?=$fetch_materials['material_name']?>ออกจาก<?=$fetch_products['product_name']?>หรือไม่?')" value="ลบวัตถุดิบ" name="del_pmat">
                  </form>
                </div>

                <?php
                  require "modal/edit_product_material_modal.php";
                ?>
                </th>
            </tr>
            
        <?php
                }
            }
        ?>
        </tbody>
    </table>
  </div>

  </div>
</div>
<script>
        $(document).ready(function () {
            $("#ProductmaterialTable").DataTable({
              "order": [[ 0, "desc" ]],
        "responsive": true,
        "ordering": false,
        lengthMenu: [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100]
          ],
        "pageLength": 25,
        language: 
        {
          url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/th.json'
        }
            });
        });
</script>

<?php
require '../../inc/footer.php';
?>
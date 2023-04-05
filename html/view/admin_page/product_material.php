<?php
require '../../inc/header.php';

checkadmin();
require '../../inc/controller/productmaterialcontroller.php';

require '../../inc/errors.php';
require '../../inc/complete.php';
?>

<title>ระบบจัดการวัตถุดิบสินค้า (สำหรับผู้จัดการระบบ)</title>
<h2>จัดการวัตถุดิบ - <?=$fetch_products['product_name']?></h2>

    <div class="mb-2 d-flex flex-row-reverse"> 
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
                <form action="" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="product_id" id="product_id" value="<?=$fetch_product_materials['product_id']?>">
                      <input type="hidden" name="material_id" id="material_id" value="<?=$fetch_product_materials['material_id']?>">
                      <input type="submit" class="btn btn-danger" value="ลบวัตถุดิบ" name="del_pmat">
                </form>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproductmaterialModal<?=$fetch_product_materials['material_id']?>">
                  แก้ไขวัตถุดิบ
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addproductmaterialModal<?=$fetch_product_materials['material_id']?>" tabindex="-1" aria-labelledby="addproductmaterialModalLabel<?=$fetch_product_materials['material_id']?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addproductmaterialModalLabel<?=$fetch_product_materials['material_id']?>">แก้ไขวัตถุดิบ - <?=$fetch_product_materials['material_id']?></h1>
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
                </th>
            </tr>
            
        <?php
                }
            }
        ?>
        </tbody>
    </table>
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
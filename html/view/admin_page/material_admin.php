<?php
require '../../inc/header.php';
require '../../inc/materialcontroller.php';
require '../../inc/errors.php';
require '../../inc/complete.php';
checkadmin();
?>
<title>ระบบจัดการวัตถุดิบ (สำหรับผู้จัดการระบบ)</title>
<h2>วัตถุดิบ</h2>
    <div class="mb-2 d-flex flex-row-reverse"> 
      <?php include 'add_material_modal.php'; ?>
    </div>
    
	  <table id="MaterialTable" class="table table-striped" style="width:100%">
        <thead>
			<center>
            <tr>
            <th width='5%'>
              ID
            </th>
			      <th width='45%'>
              ชื่อวัตถุดิบ
            </th>
            <th width='20%'>
              จำนวนที่สั่งซื้อ (กิโลกรัม)
            </th>
            <th width='20%'>
              ราคาวัตถุดิบ
            </th>
            <th width='20%'>
              ตัวเลือก
            </th>
          </tr>
			</center>
        </thead>
        <tbody>
        <?php
        	$select_materials = mysqli_query($db, "SELECT * FROM `materials`");
      		if(mysqli_num_rows($select_materials) > 0){
         		while($fetch_material = mysqli_fetch_assoc($select_materials)){
        ?>
            <tr>
                <th>
                    <?=$fetch_material['material_id']?>
                </th>
				        <th>
                    <?=$fetch_material['material_name']?>
                </th>
                <th>
                    <?=$fetch_material['bought_amount']?>
                </th>
                <th>
                    <?=$fetch_material['bought_price']?>
                </th>
                <th>
                  <a class="btn btn-dark" href="../../view/log/log_materials.php?id=<?=$fetch_material['material_id']?>">ตรวจสอบการเข้าออก</a>
                    <br><br>
                    <!-- Button trigger modal -->
                    <br>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editmaterialModal<?=$fetch_material['material_id']?>">
                      แก้ไขวัตถุดิบ
                    </button>

                    <!-- Modal -->
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
                </th>
            </tr><?php
              }
            }
        ?>
        </tbody>
    </table>
  </div>

  <script>
        $(document).ready(function () {
            $("#MaterialTable").DataTable({
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
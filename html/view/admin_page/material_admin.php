<?php
require '../../inc/header.php';
require '../../inc/controller/materialcontroller.php';
include '../../inc/completes.php';
include '../../inc/errors.php';
checkadmin();
?>
<title>ระบบจัดการวัตถุดิบ (สำหรับผู้จัดการระบบ)</title>
<div class="card">
    <div class="card-body ms-2">
      <h2>วัตถุดิบ</h2>
      <div class="mb-2 d-flex flex-row-reverse"> 
        <?php include 'modal/add_material_modal.php'; ?>
      </div>
      
      <table id="MaterialTable" class="table table-striped" style="width:100%">
          <thead>
        <center>
              <tr>
              <th width='5%'>
                ID
              </th>
              <th width='35%'>
                ชื่อวัตถุดิบ
              </th>
              <th width='20%'>
                จำนวนที่สั่งซื้อ (กิโลกรัม)
              </th>
              <th width='20%'>
                ราคาวัตถุดิบ
              </th>
              <th width='30%'>
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
                    <div class="mb-3">
                      <a class="btn btn-success" href="../../view/log_page/log_materials.php?id=<?=$fetch_material['material_id']?>">ตรวจสอบการเข้าออก</a>
                    </div>
                    <div class="mb-3">
                        <?php include "modal/edit_material_modal.php"; ?>
                    </div>
                  </th>
              </tr><?php
                }
              }
          ?>
          </tbody>
      </table>
  </div>
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
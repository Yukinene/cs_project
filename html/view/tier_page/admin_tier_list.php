<?php
    $discount_list_query = "SELECT * FROM `discount` ORDER BY `discount`.`order_price` ASC";
    $select_discount_list = mysqli_query($db,$discount_list_query);
?>  
    <table id="discountTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            <th width='15%'>
              ระดับ
            </th>
            <th width='35%'>
              เมื่อผู้ใช้สั่งซื้อมียอดในคำสั่งซื้อเสร็จสิ้นรวมกันถึง
            </th>
            <th width='15%'>
              ส่วนลด
            </th>
            <th width='20%'>
              ตัวเลือก
            </th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($select_discount_list) > 0){
            while($fetch_discount_list = mysqli_fetch_assoc($select_discount_list)){
        ?>
            <tr>
                <th>
                    <?=$fetch_discount_list['tier']?>
                </th>
                <th>
                    <?=$fetch_discount_list['order_price']?>
                </th>
                <th>
                    <?=$fetch_discount_list['discount_percentage']?>
                </th>
                <th>
                    <form action="" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="tier" id="tier" value="<?=$fetch_discount_list['tier']?>">
                      <input type="submit" class="btn btn-danger" onClick="return confirm('ต้องการยกเลิก<?=$fetch_discount_list['tier']?>หรือไม่?')" value="ยกเลิก" name="del_dis">
                    </form>
                </th>
            </tr><?php
              }
            }
        ?>
        </tbody>
    </table>
  
<script>
        $(document).ready(function () {
            $("#discountTable").DataTable({
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

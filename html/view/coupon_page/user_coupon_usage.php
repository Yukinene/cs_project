<?php
    $coupon_usage_list = "SELECT * FROM `coupon_usage` WHERE `user_id` = ".$user['id'];
    $coupon_usage_list_query = mysqli_query($db,$coupon_usage_list);
?>
<h3 class ="mt-2">ประวัติการใช้คูปอง</h3>
<div class="table-responsive">
    <table id="couponusageTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            <th width='75%'>
                คูปอง
            </th>
            <th width='25%'>
                เวลาที่ใช้งาน
            </th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($coupon_usage_list_query) > 0){
            while($fetch_coupon_usage_list = mysqli_fetch_assoc($coupon_usage_list_query)){
        ?>
            <tr>
                <th>
                    <?=$fetch_coupon_usage_list['coupon_name']?>
                </th>
                <th>
                    <?=date("Y-m-d", strtotime($fetch_coupon_usage_list['usage_date']))?>
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
            $("#couponusageTable").DataTable({
              "order": [[ 0, "desc" ]],
        "responsive": true,
        "ordering": false,
        lengthMenu: [
            [5, 10],
            [5, 10]
          ],
        "pageLength": 10,
        language: 
        {
          url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/th.json'
        }
            });
        });
</script>
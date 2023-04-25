<?php
    $coupon_list_query = mysqli_query($db,"SELECT * FROM `coupons`");
?>
<h3 class ="mt-2">คูปองในระบบ</h3>
<div class="table-responsive">
    <table id="couponTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            <th width='50%'>
              คูปอง
            </th>
            <th width='25%'>
              ส่วนลด
            </th>
            <th width='25%'>
                วันหมดอายุ
            </th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($coupon_list_query) > 0){
            while($fetch_coupon_list = mysqli_fetch_assoc($coupon_list_query)){
        ?>
            <tr>
                <th>
                    <?=$fetch_coupon_list['coupon_name']?>
                </th>
                <th>
                    <?=$fetch_coupon_list['coupon_price']?>
                </th>
                <th>
                    <?=date("Y-m-d", strtotime($fetch_coupon_list['expire_date']))?>
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
            $("#couponTable").DataTable({
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
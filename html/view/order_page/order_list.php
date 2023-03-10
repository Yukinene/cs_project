<?php
    if (checkrole('admin')) {
        $order_list_query = "SELECT * FROM `orders`";
    }
    else {
        $username = $_SESSION['username'];
        $user_info_query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($db, $user_info_query);
        $user = mysqli_fetch_assoc($result);
        $order_list_query = "SELECT * FROM `orders` WHERE `user_id` = '".$user['id']."'";
    }
    $select_order_list = mysqli_query($db,$order_list_query);
    
?>
    <h2>รายการคำสั่งซื้อ</h2>
    <table id="orderTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            <th width='5%'>
              ID
            </th>
            <th width='15%'>
              จำนวนเงินทั้งหมด
            </th>
            <th width='20%'>
              สถานะ
            </th>
            <th width='20%'>
              ตัวเลือก
            </th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($select_order_list) > 0){
            while($fetch_order_list = mysqli_fetch_assoc($select_order_list)){
        ?>
            <tr>
                <th>
                    <?=$fetch_order_list['id']?>
                </th>
                <th>
                    <?=$fetch_order_list['amount']?>
                </th>
                <th>
                    <?=$order_status[$fetch_order_list['status']]?>
                </th>
                <th>
                    <?= '<a class="btn btn-primary" href="../order_page/show_order.php?id='.$fetch_order_list['id'].'">ดู</a>' ?>
                </th>
            </tr><?php
              }
            }
        ?>
        </tbody>
    </table>



<script>
        $(document).ready(function () {
            $("#orderTable").DataTable({
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
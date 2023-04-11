<?php
    $user_order_list_query = "SELECT * FROM `user_order` WHERE `user` = '".$user['id']."'";
    $user_order_list = mysqli_query($db,$user_order_list_query);
?>
<div class="table-responsive">
    <table id="userorderTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            <th width='50%'>
              เดือน / ปี
            </th>
            <th width='50%'>
              จำนวนเงิน
            </th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($user_order_list) > 0){
            while($fetch_user_order = mysqli_fetch_assoc($user_order_list)){
        ?>
            <tr>
                <th>
                    <?=$month[$fetch_user_order['month']]?> / <?=$fetch_user_order['year']?>
                </th>
                <th>
                    <?=$fetch_user_order['amount']?>
                </th>
            </tr><?php
              }
            }
        ?>
        </tbody>
    </table>
</div>
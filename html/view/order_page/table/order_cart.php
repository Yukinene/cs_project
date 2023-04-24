<h5 class="card-title mt-2">สินค้าที่ซื้อ</h5>
<div class="table-responsive">
    <table id="cartTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th width='5%'>
                    ลำดับ
                </th>
                <th width='40%'>
                    สินค้า
                </th>
                <th width='10%'>
                    จำนวน
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display the cart
                $order_cart_check = 0 ;
                if(mysqli_num_rows($order_cart) > 0){
                    while($fetch_order_cart = mysqli_fetch_assoc($order_cart)){
                        $products = "SELECT * FROM `products` WHERE `product_id` = '".$fetch_order_cart['product_id']."'";
                        $product = mysqli_fetch_array(mysqli_query($db, $products));
                        echo '<tr>';
                        echo '<th>' . $i . '</th>';
                        echo '<th>' . $product['product_name'] . '</th>';
                        echo '<th>' . $fetch_order_cart['quantity'] . '</th>';
                        echo '</tr>';
                        if ($product['product_amount'] < $fetch_order_cart['quantity']) {
                            $order_cart_check = $order_cart_check + 1;
                        }
                        $i++;
                        }
                    }
            ?>
        </tbody>
    </table>
</div>

<table id="cartTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            <th width='5%'>
              ลำดับ
            </th>
            <th width='15%'>
              
            </th>
            <th width='40%'>
              สินค้า
            </th>
            <th width='10%'>
              จำนวน
            </th>
            <th width='10%'>
              ราคา
            </th>
            <th width='20%'>
              ตัวเลือก
            </th>
          </tr>
        </thead>
        <tbody>
            <?php
            // Display the cart
            foreach($cart as $item => $quantity) {
              $products = "SELECT * FROM `products` WHERE `product_id` = '".$item."'";
              $product = mysqli_fetch_array(mysqli_query($db, $products)); ?>
              <tr>
                  <th><?=$i?></th>
                  <th><img src="../../images/products_image/<?=$product['product_img']?>" width="150" height="75" alt=""></th>
                  <th><?=$product['product_name']?></th>
                  <th><?=$quantity?></th>
                  <th><?=$product['product_price']*$quantity?></th>
                  <th>
                    <form action="" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="product_id" value="<?=$item?>">
                      <div class="col mb-2">
                        <?php if($quantity < 50)
                        { ?>
                          <input type="submit" class="btn btn-success" value="เพิ่ม" name="add_to_cart">
                          <input type="submit" class="btn btn-success" value="เพิ่ม 10 ชิ้น" name="add_quantity_10">
                        <?php } ?>
                      </div>
                      <div class="col mb-2">
                        <?php if($quantity > 1)
                        { ?>
                          <input type="submit" class="btn btn-warning" value="ลด" name="remove_quantity">
                        <?php } ?>
                        <?php if($quantity > 10)
                        { ?>
                          <input type="submit" class="btn btn-warning" value="ลด 10 ชิ้น" name="remove_quantity_10">
                        <?php } ?>
                      </div>
                      <input type="submit" class="btn btn-danger" onClick="return confirm('ยกเลิกการสั่ง <?=$product['product_name']?>?')" value="ลบ" name="remove">
                    </form>
                  </th>
              </tr><?php
              $totalamount += $product['product_price']*$quantity;
              $i++;
            }
            ?>
        </tbody>
      </table>
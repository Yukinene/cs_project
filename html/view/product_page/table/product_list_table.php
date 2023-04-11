<div class="table-responsive">
<table id="ProductTable" class="table table-striped" style="width:100%">
        <thead>
			<center>
            <tr>
            <th width='5%'>
              ID
            </th>
			<th width='5%'>
              
            </th>
			      <th width='40%'>
              ชื่อ
            </th>
            <th width='15%'>
              ราคาผลิตภัณฑ์
            </th>
            <th width='15%'>
              สถานะ
            </th>
            <th width='20%'>
              ตัวเลือก
            </th>
          </tr>
			</center>
        </thead>
        <tbody>
        <?php
        	$select_products = mysqli_query($db, "SELECT * FROM `products`");
      		if(mysqli_num_rows($select_products) > 0){
         		while($fetch_product = mysqli_fetch_assoc($select_products)){
        ?>
            <tr>
                <th>
                    <?=$fetch_product['product_id']?>
                </th>
				<th>
					<div class="card">
						<img style="padding: 5px; max-height: 400px; width: 150px;" src="../../images/products_image/<?php echo $fetch_product['product_img']; ?>" alt="">
					</div>
                </th>
				        <th>
                    <?=$fetch_product['product_name']?>
                </th>
                <th>
                    <?=$fetch_product['product_price']?>
                </th>
                <th>
                    <?php
                    if ($fetch_product['product_status'] === "active") {
                      echo "พร้อมให้บริการ";
                    }
                    else
                    {
                      echo "ไม่พร้อมให้บริการ";
                    }
                    ?>
                </th>
                <th>
                  <div class="mb-3">
                      <form action="" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="product_id" id="product_id" value="<?=$fetch_product['product_id']?>">
                      <input type="hidden" name="product_status" id="product_status" value="<?=$fetch_product['product_status']?>">
                      <?php
                      if ($fetch_product['product_status'] === "active") 
                      {?>
                        <input type="submit" class="btn btn-danger" value="ปิดการขาย" name="change_status">
                      <?php }
                      else { ?>
                        <input type="submit" class="btn btn-success" value="เปิดการขาย" name="change_status">
                      <?php }
                      ?>
                      </form>
                  </div>
                  <div class="mb-3">
                  <a class="btn btn-primary" href="../product_page/show_product.php?id=<?=$fetch_product['product_id']?>" role="button">ดูข้อมูลผลิตภัณฑ์</a>
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
            $("#ProductTable").DataTable({
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

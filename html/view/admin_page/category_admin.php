<?php
require '../../inc/header.php';
checkadmin();
if (isset($_POST['add_cate'])) {
    $category = mysqli_real_escape_string($db, $_POST['category']);
    $category_check = "SELECT * FROM `category` WHERE `category` = '".$category."' LIMIT 1";
    $result = mysqli_query($db,$category_check);
    $check = mysqli_fetch_assoc($result);
    if ($check) { // if check exists
        array_push($errors, "ประเภทสินค้านี้มีอยู่ในระบบ");
      }
    else {
      $query = "INSERT INTO `category`(`category`) 
      VALUES ('$category')";
  	  mysqli_query($db, $query);
      array_push($completes, "เพิ่มประเภทสินค้าสำเร็จ");
    }
}
if (isset($_POST['del_cate'])) {
  $category = mysqli_real_escape_string($db, $_POST['category']);
  $category_check = "SELECT * FROM `category` WHERE `category` = '".$category."' LIMIT 1";
  $result = mysqli_query($db,$category_check);
  $check = mysqli_fetch_assoc($result);
  if ($check) { // if check exists
    $query = "DELETE FROM `category` WHERE `category` = '".$category."'";
    mysqli_query($db, $query);
    $product_category_del_query = "UPDATE `products` SET `product_category`='' WHERE `product_category` = '".$category."'";
    mysqli_query($db, $product_category_del_query);
    array_push($completes, "ลบสำเร็จ");
    }
  else {
    array_push($errors, "ประเภทสินค้านี้ไม่มีอยู่ในระบบ");
  }
}
?>
<title>ระบบจัดการประเภทสินค้า (สำหรับผู้จัดการระบบ)</title>
<?php 
	include '../../inc/complete.php';
    include '../../inc/errors.php'; 
?>
<div class="mb-2 d-flex flex-row-reverse"> 
      <?php include 'modal/add_category_modal.php'; ?>
</div>

<?php
    $category_list_query = "SELECT * FROM `category`";
    $select_category_list = mysqli_query($db,$category_list_query);
    
?>
    <h2>ประเภทสินค้า</h2>
    <table id="categoryTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
            <th width='75%'>
              ประเภท
            </th>
            <th width='25%'>
              ตัวเลือก
            </th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($select_category_list) > 0){
            while($fetch_category_list = mysqli_fetch_assoc($select_category_list)){
        ?>
            <tr>
                <th>
                    <?=$fetch_category_list['category']?>
                </th>
                <th>
                    <form action="" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="category" id="category" value="<?=$fetch_category_list['category']?>">
                      <input type="submit" class="btn btn-danger" value="ลบ" name="del_cate">
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
            $("#categoryTable").DataTable({
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
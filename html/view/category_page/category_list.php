<?php
    $category_list_query = "SELECT * FROM `categories`";
    $select_category_list = mysqli_query($db,$category_list_query);
?>
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
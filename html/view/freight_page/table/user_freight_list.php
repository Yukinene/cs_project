<div class="table-responsive">
    <table id="FreightTable" class="table table-striped" style="width:100%">
        <thead>
			<center>
            <tr>
            <th width='20%'>
              จังหวัด
            </th>
            <th width='20%'>
              ค่าขนส่ง
            </th>
          </tr>
			</center>
        </thead>
        <tbody>
        <?php
        $freight_list_query = mysqli_query($db,"SELECT * FROM `freight` WHERE `province_id` != 0");
        if (mysqli_num_rows($freight_list_query) > 0) {
            while($fetch_freight = mysqli_fetch_assoc($freight_list_query)){
        ?>
            <tr>
                <th>
                    <?php 
                    if ($fetch_freight['province_id'] != 0) {
                        $fetch_province = mysqli_fetch_assoc(mysqli_query($db,
                        "SELECT * FROM `provinces` WHERE `id` = ".$fetch_freight['province_id']));
                        echo $fetch_province['name_th'];
                    } else {
                        echo "จังหวัดอื่นๆทั่วประเทศไทย";
                    }
                    ?>
                </th>
                <th>
                    <?=$fetch_freight['price']?>
                </th>
            </tr>
            <?php
                }
            }
        $default_fetch_freight = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `freight` WHERE `province_id` = 0"));
        ?>
            <tr>
                <th>
                    จังหวัดอื่นๆทั่วประเทศไทย
                </th>
                <th>
                    <?=$default_fetch_freight['price']?>
                </th>
            </tr>
        </tbody>
    </table>
</div>
<script>
        $(document).ready(function () {
            $("#FreightTable").DataTable({
              "order": [[ 0, "desc" ]],
        "responsive": true,
        "ordering": false,
        lengthMenu: [
            [5, 10, 25],
            [5, 10, 25]
          ],
        "pageLength": 5,
        language: 
        {
          url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/th.json'
        }
            });
        });
</script>
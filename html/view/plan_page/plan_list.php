<?php
  require "post/add_plan.php";
  $select_plans = mysqli_query($db, "SELECT * FROM `plans`");
?>
<div class="table-responsive">
<table id="PlanTable" class="table table-striped" style="width:100%">
        <thead>
			<center>
            <tr>
            <th width='5%'>
              แผน
            </th>
            <th width='65%'>
              
            </th>
            <th width='15%'>
              สถานะ
            </th>
            <th width='15%'>
              ตัวเลือก
            </th>
          </tr>
			</center>
        </thead>
        <tbody>
        <?php
      		if(mysqli_num_rows($select_plans) > 0){
         		while($fetch_plan = mysqli_fetch_assoc($select_plans)){
        ?>
            <tr>
                <th>
                    <?=$fetch_plan['plan_id']?>
                </th>
                <th>

                </th>
				<th>
                    <?=$fetch_plan['status']?>
                </th>
                <th>
                    <?= '<a class="btn btn-primary" href="../plan_page/show_plan.php?id='.$fetch_plan['plan_id'].'">ดู</a>' ?>
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
            $("#PlanTable").DataTable({
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
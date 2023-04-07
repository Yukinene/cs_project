<?php
    $check_plans = mysqli_query($db, "SELECT * FROM `plans` WHERE `status` != 'เสร็จสิ้น'");
    if (mysqli_num_rows($check_plans) < 1) {
        ?>        
        <div class="mb-2 d-flex flex-row-reverse">
            <form method="post" action="" enctype="multipart/form-data">
                <button class="btn btn-primary" type="submit" name="add_plan">
                    เพิ่มแผนการผลิต
                </button>
            </form>  
        </div>
        <?php      
    }
?>
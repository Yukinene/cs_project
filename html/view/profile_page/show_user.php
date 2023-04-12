<div class="card">
    <div class="card-body">
        <h2 class="card-title">ข้อมูลผู้ใช้</h2>
            <div class="mb-2 d-flex flex-row-reverse gap-3">
                <a class="btn btn-warning" href="edit_user.php">แก้ไขข้อมูล</a>
            </div>
            <div class="row mb-2">
                <label class="col-sm-2 col-form-label">ชื่อผู้ใช้</label>
                <label class="col-sm-10 col-form-label" name="username"><?= $user['username']?></label>
            </div>
            <div class="row mb-2">
                <label class="col-sm-2 col-form-label">ขื่อ</label>
                <label class="col-sm-10 col-form-label" name="name"><?=$user['name']?></label>
            </div>
            <div class="row mb-2">
                <label class="col-sm-2 col-form-label">นามสกุล</label>
                <label class="col-sm-10 col-form-label" name="surname"><?= $user['surname']?></label>
            </div>
            <div class="row mb-2">
                <label class="col-sm-2 col-form-label">อีเมล</label>
                <label class="col-sm-10 col-form-label" name="email"><?=$user['email']?></label>
            </div>
    </div>
</div>
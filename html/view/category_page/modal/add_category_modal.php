<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcategoryModal">
  เพิ่มประเภท
</button>

<!-- Modal -->
<div class="modal fade" id="addcategoryModal" tabindex="-1" aria-labelledby="addcategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addproductModalLabel">เพิ่มประเภท</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
				<label>ประเภท</label>
				<input class="form-control" type="text" name="category" max=255 required>
	    </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit" name="add_cate">เพิ่มประเภท</button>
      </div>
    </form>
    </div>
  </div>
</div>
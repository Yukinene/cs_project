<?php
  if (count($completes) > 0) : ?>
  <div class="success">
  	<?php foreach ($completes as $complete) : ?>
		<div class="alert alert-success" role="alert">
		สำเร็จ : <?php echo $complete ?>
		</div>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
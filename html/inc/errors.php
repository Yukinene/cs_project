<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
		<div class="alert alert-danger" role="alert">
		ผิดพลาด : <?php echo $error ?>
		</div>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
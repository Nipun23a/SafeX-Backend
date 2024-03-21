<?php  if (count($errors) > 0) : ?>
  <div class="errors" style="text-align: center;color:red;font-size:15px;">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
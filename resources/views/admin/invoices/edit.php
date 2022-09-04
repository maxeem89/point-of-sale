<?php
var_dump($data->item);
?>
 <?php foreach ($data as  $item) : ?>
	<h1>
	 <?php 
	 echo '<pre>';
	 var_dump($item);
	 ?>
</h1>
<?php endforeach; ?>

     
<?php
	include('footer.php');
?>
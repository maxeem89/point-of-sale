<div class="container">
	<h1 class="text-center">Show Invoicec Details</h1>
	<hr>
	<div>
		<label>item name</label>
		<div class="card w-100">
			<ul class="list-group list-group-flush">
				<?php foreach ($data->item as  $item) : ?>
					<li class="list-group-item"> <?= $item['name']; ?> price <?= $item['selling_price_per_unit']; ?>
				
				</li>
				<?php endforeach; ?>
			</ul>



		</div>
		<div class="d-flex p-0 ">
			<label>
				total: <?= $item['total']; ?><br>
				seller Name: <?= $item['user_name']; ?>
			</label>
		</div>
	</div>
</div>
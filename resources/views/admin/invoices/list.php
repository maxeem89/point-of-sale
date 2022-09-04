<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<h1>Invoice List</h1>
<hr>

<div class="row">

	<div class="col-xs-12">

		<div id="response" class="alert alert-success" style="display:none;">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<div class="message"></div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Manage Invoices</h4>
			</div>
			<div class="panel-body form-group form-group-sm">
				<table class="table table-striped table-hover table-bordered" id="data-table1" cellspacing="0">
					<thead>
						<tr>
							<th>Invoice ID</th>
							<th>Entered User</th>
							<th>Total</th>
							<th>Rigstration Date</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data->invoices as  $invoice) : ?>
							<tr>
								<td><?= $invoice->id ?></td>
								<td><?= $invoice->user_id ?></td>
								<td><?= $invoice->total ?></td>
								<td><?= $invoice->created_at ?></td>
								<td>
									<i class="fa-solid fa-pen-to-square"><a href="/admin/invoices/edit?id=<?= $invoice->id ?>" class="btn btn-primary btn-xs">
											<span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></i>

									<a href="" class="btn btn-info btn-xs" target="_blank">
										<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
									<a href="/admin/invoices/delete?id=<?= $invoice->id ?>" class="btn btn-danger btn-xs delete-invoice">
										<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>

							</tr>
						<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div>

		<div id="delete_invoice" class="modal fade">




			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Delete Invoice</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete this invoice?</p>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
						<button type="button" data-dismiss="modal" class="btn">Cancel</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
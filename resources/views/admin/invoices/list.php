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

									<a href="/admin/invoices/single?id=<?= $invoice->id ?>" class="btn btn-info btn-xs">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
											<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
										</svg> </a>

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
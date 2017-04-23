<?php ?>
<div class="container" ng-app="inventoryHome" ng-controller="supplierctrl">
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newUserModal">Add New Supplier</button>

				<!-- Add Modal -->
				<div class="modal fade" id="newUserModal" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Add new Supplier</h4>
							</div>
							<div class="modal-body">
								<form name="new_user">
									<div class="form-group">
										<label for="name">Supplier name</label>
										<input type="text" class="form-control" name="name" ng-model="cat.name" required>
										<span ng-show="new_user.name.$touched && new_user.name.$invalid">This field is required.</span>
									</div>
									<button type="button" class="btn btn-default" ng-click="add(cat)">Submit</button>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>

				<!-- Edit Modal -->
				<div class="modal fade" id="editModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Edit</h4>
							</div>
							<div class="modal-body">
								<form name="new_user">
									<div class="form-group">
										<label for="name">Category name</label>
										<input type="text" class="form-control" name="name" ng-model="cat.inv_supplier_name">
									</div>
									<button type="button" class="btn btn-default" ng-disabled="new_user.$invalid" ng-click="edit(cat)">Submit</button>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>				

				<!--List of all categories -->
				<h2>All Supplier</h2>
				<div class="table-responsive">          
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="supplier in suppliers | orderBy:'inv_supplier_name'">
								<td>{{supplier.id}}</td>
								<td>{{supplier.inv_supplier_name}}</td>
								<td>
									<button type="button" class="btn btn-default" ng-click="edit_modal(supplier)">Edit</button>
									<button type="button" class="btn btn-default" ng-click="delete(supplier.id)">Delete</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
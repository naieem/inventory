<?php ?>
<div class="container" ng-app="inventoryHome" ng-controller="inventoryctrl">
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newUserModal">Add New Inventory</button>
			<!-- Add Modal -->
			<div class="modal fade" id="newUserModal" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Add new Inventory</h4>
						</div>
						<div class="modal-body">
							<h1>Date:{{cat.inv_inventory_date}}</h1>
							<h2>Location:{{show_location}}</h2>
							<form name="new_user">
								<div class="form-group">
									<label for="name">Date</label>
									<div class="dropdown">
										<a class="dropdown-toggle" id="dropdown2" role="button" data-toggle="dropdown" data-target="#" href="#">
											<div class="input-group"><input type="text" class="form-control" data-ng-model="cat.inv_inventory_date"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											</div>
										</a>
										<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<datetimepicker data-ng-model="cat.inv_inventory_date" data-datetimepicker-config="{ dropdownSelector: '#dropdown2' }"/>
										</ul>
									</div>
								</div>
								<div class="form-group">
									<label for="name">User</label>
									<select name="parent" ng-model="cat.wp_users_id_users" class="form-control">
										<option value="{{ user.data.ID }}" ng-repeat="user in users">{{ user.data.display_name }}</option>
									</select>
								</div>
								<div class="form-group">
									<label for="name">Location</label>
									<select name="" ng-model="cat.inv_location_inv_location_id" class="form-control" ng-change="change_location(cat.inv_location_inv_location_id)">
										<option value="{{ location.id }}" ng-repeat="location in locations">
											{{ location.inv_location_name }}</option>
										</select>
									</div>
									<div class="form-group">
										<label for="name">Supplier</label>
										<select name="" class="form-control" ng-model="cat.supplier">
											<option ng-repeat="supplier in suppliers" value="{{ supplier.id }}">{{supplier.inv_supplier_name}}</option>
										</select>
									</div>
									<div class="form-group">
										<label for="name">Product</label>
										<select name="" ng-model="cat.product" class="form-control">
											<option value="{{ product.id }}" ng-repeat="product in products">{{ product.inv_product_name }}</option>
										</select>
									</div>
									<div class="form-group">
										<label for="name">Amount</label>
										<input type="text" name="amount" class="form-control" name="name" ng-model="cat.amount">
									</div>
									
									<div class="form-group">
										<label for="name">Unit</label>
										<input type="text" class="form-control" ng-disabled="true" name="name" ng-value="1" value="1" placeholder="1" ng-model="cat.unit" ng-init="cat.unit=1" required>
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
										<label for="name">Name</label>
										<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_location_name" required>

									</div>
									<div class="form-group">
										<label for="name">Parent</label>
										<select name="parent" ng-model="edit_cat.inv_location_parent" class="form-control">
											<option value="{{ location.id }}" ng-repeat="location in locations">{{ location.inv_location_name }}</option>
										</select>
									</div>
									<div class="form-group">
										<label for="name">Street Address</label>
										<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_location_street_address">
									</div>

									<div class="form-group">
										<label for="name">City</label>
										<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_location_city">
									</div>

									<div class="form-group">
										<label for="name">Province</label>
										<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_location_province">
									</div>

									<div class="form-group">
										<label for="name">Postal Code</label>
										<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_location_postal_code" required>
									</div>

									<div class="form-group">
										<label for="name">Country</label>
										<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_location_country" required>
									</div>

									<button type="button" class="btn btn-default" ng-click="edit(edit_cat)">Submit</button>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>				

				<!--List of all categories -->
				<h2>All Inventory</h2>
				<div class="table-responsive">          
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Date</th>
								<th>Location</th>
								<th>Product</th>
								<th>Supplier</th>
							<!-- <th>Province</th>
							<th>Postal</th>
							<th>Country</th> -->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="inventory in inventories">
							<td>{{inventory.id}}</td>
							<td>{{inventory.inv_inventory_date | datetime }}</td>
							<td><parent info="locations" cid="inventory.inv_location_inv_location_id" field="inv_location_name"></parent></td>
							<td>
							<parent info="products" cid="inventory.inv_product_id_inv_product" field="inv_product_name"></parent></td>
							<td>
							<parent info="suppliers" cid="inventory.inv_supplier_inv_supplier_id" field="inv_supplier_name"></parent>
							<td>
								<button type="button" class="btn btn-default" ng-click="edit_modal(inventory)">Edit</button>
								<button type="button" class="btn btn-default" ng-click="delete(inventory.id)">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
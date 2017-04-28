<?php ?>
<style type="text/css" media="screen">
	[ng\:cloak], [ng-cloak], .ng-cloak {
		display: none !important;
	}
</style>
<div class="container" ng-app="inventoryHome" ng-controller="inventoryctrl" ng-cloak>
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
							<h1>Date:{{cat.inv_inventory_date | datetime}}</h1>
							<h2>Location:{{show_location}}</h2>
							<form name="new_user">
								<div class="form-group">
									<label for="name">Date</label>
									<div class="dropdown">
										<a class="dropdown-toggle" id="dropdown2" role="button" data-toggle="dropdown" data-target="#" href="#">
											<div class="input-group"><input type="text" class="form-control" ng-model="cat.inv_inventory_date"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											</div>
										</a>
										<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<datetimepicker ng-model="cat.inv_inventory_date" data-datetimepicker-config="{ dropdownSelector: '#dropdown2' }"/>
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
											{{ location.inv_location_name }}
										</option>
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
									<input type="text" class="form-control" ng-disabled="true" name="name" ng-value="1" value="1" placeholder="1" ng-model="cat.unit" ng-init="cat.unit='1'">
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
							<h1>Date:{{edit_cat.inv_inventory_date | datetime}}</h1>
							<h2>Location:{{show_location}}</h2>
							<form name="new_user">
								<div class="form-group">
									<label for="name">Date</label>
									<div class="dropdown">
										<a class="dropdown-toggle" id="dropdown2" role="button" data-toggle="dropdown" data-target="#" href="#">
											<div class="input-group"><input type="text" class="form-control" ng-model="edit_cat.inv_inventory_date"><span class= "input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											</div>
										</a>
										<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<datetimepicker ng-model="edit_cat.inv_inventory_date" data-datetimepicker-config="{ dropdownSelector: '#dropdown2' }"/>
										</ul>
									</div>
								</div>
								<div class="form-group">
									<label for="name">User</label>
									<select name="parent" ng-model="edit_cat.wp_users_id_users" class="form-control">
										<option value="{{ user.data.ID }}" ng-repeat="user in users">{{ user.data.display_name }}</option>
									</select>
								</div>
								<div class="form-group">
									<label for="name">Location</label>
									<select name="" ng-model="edit_cat.inv_location_inv_location_id" class="form-control" ng-change="change_location(edit_cat.inv_location_inv_location_id)">
										<option value="{{ location.id }}" ng-repeat="location in locations">
											{{ location.inv_location_name }}
										</option>
									</select>
								</div>
								<div class="form-group">
									<label for="name">Supplier</label>
									<select name="" class="form-control" ng-model="edit_cat.inv_supplier_inv_supplier_id">
										<option ng-repeat="supplier in suppliers" value="{{ supplier.id }}">{{supplier.inv_supplier_name}}</option>
									</select>
								</div>
								<div class="form-group">
									<label for="name">Product</label>
									<select name="" ng-model="edit_cat.inv_product_id_inv_product" class="form-control">
										<option value="{{ product.id }}" ng-repeat="product in products">{{ product.inv_product_name }}</option>
									</select>
								</div>
								<div class="form-group">
									<label for="name">Amount</label>
									<input type="text" name="amount" class="form-control" name="name" ng-model="edit_cat.inv_inventory_line_amount">
								</div>

								<div class="form-group">
									<label for="name">Unit</label>
									<input type="text" class="form-control" ng-disabled="true" name="name" ng-value="1" ng-value="inventory.inv_inventory_units_inv_inventory_units_id" ng-model="edit_cat.inv_inventory_units_inv_inventory_units_id">
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
			<p>
				<img ng-show="loading" src="<?php echo plugins_url( '/images/gears.gif', dirname(__FILE__) );?>">
			</p>
			<div class="table-responsive">          
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
							<th>Location</th>
							<th>Product</th>
							<th>Supplier</th>
							<th>Amount</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="inventory in inventories">
							<td>{{inventory.id}}</td>
							<td>{{inventory.inv_inventory_date | datetime }}</td>
							<td><parent info="locations" cid="inventory.inv_location_inv_location_id" field="inv_location_name"></parent></td>
							<td>
								<parent info="products" cid="inventory.inv_product_id_inv_product" field="inv_product_name"></parent>
							</td>
							<td>
								<parent info="suppliers" cid="inventory.inv_supplier_inv_supplier_id" field="inv_supplier_name"></parent>
							</td>
							<td>
								{{inventory.inv_inventory_line_amount}}
							</td>
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
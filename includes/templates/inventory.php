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
							<h2>Date:{{cat.inv_inventory_date | datetime}}</h2>
							<h2>Location:{{show_location}}</h2>
							<form name="new_user">
								<div class="form-group">
									<label for="name">Date</label>
									<div class="dropdown">
										<a class="dropdown" id="dropdown2" role="button" data-toggle="dropdown" data-target="#" href="#">
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
										<option value="{{ user.data.ID }}" ng-repeat="user in users| orderBy:'display_name'">{{ user.data.display_name }}</option>
									</select>
								</div>
								<div class="form-group">
									<label for="name">Location</label>
									<select name="" ng-change="change_location(cat.inv_location_inv_location_id)" ng-model="cat.inv_location_inv_location_id" class="form-control">
										<optgroup ng-repeat="x in grandParent| orderBy:'inv_location_name'" label="{{x[0].inv_location_name}}">
											<option ng-repeat="child in x.children| orderBy:'inv_location_name'" value="{{child.id}}">{{child.inv_location_name}}</option>
										</optgroup>
									</select>
								</div>
								<div class="form-group">
									<label for="name">Supplier</label>
									<select name="" class="form-control" ng-model="cat.supplier">
										<option ng-repeat="supplier in suppliers| orderBy:'inv_customer_name'" value="{{ supplier.id }}">{{supplier.inv_supplier_name}}</option>
									</select>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-large btn-block btn-info" ng-click="add_element()">Add Product</button>
								</div>

								<div class="panel panel-default" ng-repeat="product in newProduct">
									<div class="panel-body">
										<div class="form-inline">
											<div class="form-group">
												<label for="name">Product</label>
												<select name="" ng-model="product.ID" class="form-control">
													<option value="{{ product.id }}" ng-repeat="product in products| orderBy:'inv_product_name'">{{ product.inv_product_name }}</option>
												</select>
											</div>
											<div class="form-group">
												<label for="name">Amount</label>
												<input type="text" name="amount" class="form-control" name="name" ng-model="product.amount">
											</div>

											<div class="form-group">
												<label for="name">Unit</label>
												<select name="" ng-model="product.unit" class="form-control">
													<option value="{{ unit.id }}" ng-repeat="unit in units| orderBy:'inv_inventory_units_name'">{{ unit.inv_inventory_units_name }}</option>
												</select>
											</div>
											<button class="remove" ng-click="removeField($index)">X</button>
										</div>
									</div>
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
							<h2>Date:{{edit_cat.inv_inventory_date | datetime}}</h2>
							<h2>Location:{{show_location}}</h2>
							<form name="new_user">
								<div class="form-group">
									<label for="name">Date</label>
									<div class="dropdown">
										<a class="dropdown" id="dropdown2" role="button" data-toggle="dropdown" data-target="#" href="#">
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
										<option value="{{ user.data.ID }}" ng-repeat="user in users| orderBy:'display_name'">{{ user.data.display_name }}</option>
									</select>
								</div>
								<!-- <div class="form-group">
									<label for="name">Location</label>
									<select name="" ng-model="edit_cat.inv_location_inv_location_id" class="form-control" ng-change="change_location(edit_cat.inv_location_inv_location_id)">
										<option value="{{ location.id }}" ng-repeat="location in locations">
											{{ location.inv_location_name }}
										</option>
									</select>
								</div> -->

								<div class="form-group">
									<label for="name">Location</label>
									<select name="" ng-model="edit_cat.inv_location_inv_location_id" class="form-control" ng-change="change_location(edit_cat.inv_location_inv_location_id)">
										<optgroup ng-repeat="x in grandParent| orderBy:'inv_location_name'" label="{{x[0].inv_location_name}}">
											<option ng-repeat="child in x.children| orderBy:'inv_location_name'" value="{{child.id}}">{{child.inv_location_name}}</option>
										</optgroup>
									</select>
								</div>
								
								<div class="form-group">
									<label for="name">Supplier</label>
									<select name="" class="form-control" ng-model="supplier">
										<option ng-repeat="supplier in suppliers| orderBy:'inv_supplier_name'" value="{{ supplier.id }}">{{supplier.inv_supplier_name}}</option>
									</select>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-large btn-block btn-info" ng-click="add_element_edit()">Add Product</button>
								</div>
								<div class="panel panel-default" ng-repeat="product in editProduct">
									<div class="panel-body">
										<div class="form-inline">
											<div class="form-group">
												<label for="name">Product</label>
												<select name="" ng-model="product.inv_product_id_inv_product" class="form-control">
													<option value="{{ prd.id }}" ng-repeat="prd in products| orderBy:'inv_product_name'">{{ prd.inv_product_name }}</option>
												</select>
											</div>
											<div class="form-group">
												<label for="name">Amount</label>
												<input type="text" name="amount" class="form-control" name="name" ng-model="product.inv_inventory_line_amount">
											</div>

											<div class="form-group">
												<label for="name">Unit</label>
												<select name="" ng-model="product.inv_inventory_units_inv_inventory_units_id" class="form-control">
													<option value="{{ unit.id }}" ng-repeat="unit in units| orderBy:'inv_inventory_units_name'">{{ unit.inv_inventory_units_name }}</option>
												</select>
											</div>
											<button class="remove" ng-click="removeFieldEdit($index)">X</button>
										</div>
									</div>
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
			<p>
			<center>
			Filter:<input type="text" name="" value="" ng-model="search" placeholder="search">
			View <select ng-model="viewby" ng-change="setItemsPerPage(viewby)"><option>50</option><option>100</option><option>300</option></select> records at a time.
			</center>
			</p>
			<pagination total-items="totalItems" max-size="maxSize" ng-model="currentPage" ng-change="pageChanged()" class="pagination-sm" items-per-page="itemsPerPage"></pagination>          
				        
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
							<th>Location</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="inventory in inventories.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter :search ">
							<td>{{inventory.id}}</td>
							<td>{{inventory.inv_inventory_date | datetime }}</td>
							<td><parent info="locations" cid="inventory.inv_location_inv_location_id" field="inv_location_name"></parent></td>
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
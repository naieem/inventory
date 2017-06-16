<?php ?>
<style type="text/css" media="screen">
	[ng\:cloak], [ng-cloak], .ng-cloak {
		display: none !important;
	}
</style>
<div class="container" ng-app="inventoryHome" ng-controller="locationctrl" ng-cloak>
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newUserModal">Add New Location</button>
			<!-- Add Modal -->
			<div class="modal fade" id="newUserModal" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Add new Location</h4>
						</div>
						<div class="modal-body">
							<form name="new_user">
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" class="form-control" name="name" ng-model="cat.inv_location_name" required>
									
								</div>
								<div class="form-group">
									<label for="name">Parent</label>
									<select name="parent" ng-model="cat.inv_location_parent" class="form-control">
									<option value="0">Self</option>
										<option value="{{ location.id }}" ng-repeat="location in locations">{{ location.inv_location_name }}</option>
									</select>
								</div>
								<div class="form-group">
									<label for="name">Street Address</label>
									<input type="text" class="form-control" name="name" ng-model="cat.inv_location_street_address">
								</div>

								<div class="form-group">
									<label for="name">City</label>
									<input type="text" class="form-control" name="name" ng-model="cat.inv_location_city">
								</div>

								<div class="form-group">
									<label for="name">Province</label>
									<input type="text" class="form-control" name="name" ng-model="cat.inv_location_province">
								</div>

								<div class="form-group">
									<label for="name">Postal Code</label>
									<input type="text" class="form-control" name="name" ng-model="cat.inv_location_postal_code" required>
								</div>

								<div class="form-group">
									<label for="name">Country</label>
									<!-- <input type="text" class="form-control" name="name" ng-model="cat.inv_location_country" required> -->
									<select class="form-control select2" name="currency" ng-model="cat.inv_location_country">
										<option ng-repeat="countries in country" value="{{countries.id}}">{{countries.country_name}}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="name">Customer</label>
									<select class="form-control" name="currency" ng-model="cat.inv_location_inv_customer_id">
										<option ng-repeat="customers in customer" value="{{customers.id}}">{{customers.inv_customer_name}}</option>
									</select>
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
									<option value="0">Self</option>
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
									<!-- <input type="text" class="form-control" name="name" ng-model="edit_cat.inv_location_country" required> -->
									<select class="form-control select2" name="country" ng-model="edit_cat.inv_location_country">
										<option ng-repeat="countries in country" value="{{countries.id}}">{{countries.country_name}}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="name">Customer</label>
									<select class="form-control" name="currency" ng-model="edit_cat.inv_location_inv_customer_id">
										<option ng-repeat="customers in customer" value="{{customers.id}}">{{customers.inv_customer_name}}</option>
									</select>
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
			<h2>All Location</h2>
			<p>
				<img ng-show="loading" src="<?php echo plugins_url( '/images/gears.gif', dirname(__FILE__) );?>">
			</p>
			<div class="table-responsive">          
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Parent</th>
							<th>Street</th>
							<th>City</th>
							<th>Province</th>
							<th>Postal</th>
							<th>Country</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="location in locations">
							<td>{{location.id}}</td>
							<td>{{location.inv_location_name}}</td>
							<td>
							<span ng-show="location.inv_location_parent=='0'">Self</span>
							<parent ng-show="location.inv_location_parent!='0'" info="locations" cid="location.inv_location_parent" field="inv_location_name"></parent></td>
							<td>{{location.inv_location_street_address}}</td>
							<td>{{location.inv_location_city}}</td>
							<td>{{location.inv_location_province}}</td>
							<td>{{location.inv_location_postal_code}}</td>
							<td>
							<parent info="country" cid="location.inv_location_country" field="country_name"></parent></td>
							<!-- <td>{{recipe.inv_recipe_name}}</td>
							<td><parent info="categories" cid="recipe.inv_recipe_category_inv_recipe_category_id" field="inv_recipe_cat_name"></parent></td>
							<td><parent info="products" cid="recipe.inv_product_id_inv_product" field="inv_product_name"></parent></td>					
							<td><parent info="recipies" cid="recipe.inv_recipe_inv_recipe_id" field="inv_recipe_name"></parent></td>
							<td>{{recipe.inv_recipe_instructions}}</td> -->
							<td>
								<button type="button" class="btn btn-default" ng-click="edit_modal(location)">Edit</button>
								<button type="button" class="btn btn-default" ng-click="delete(location.id)">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
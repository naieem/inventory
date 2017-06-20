<?php ?>
<style type="text/css" media="screen">
	[ng\:cloak], [ng-cloak], .ng-cloak {
		display: none !important;
	}
</style>
<div class="container" ng-app="inventoryHome" ng-controller="salesctrl" ng-cloak>
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newUserModal">Add New Sales</button>
			<!-- Add Modal -->
			<div class="modal fade" id="newUserModal" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Add new Sales</h4>
						</div>
						<div class="modal-body">
							<h2>Date:{{cat.datetime | datetime}}</h2>
							<h2>Customer:{{show_location}}</h2>
							<form name="new_user">
								<div class="form-group">
									<label for="name">Date</label>
									<div class="dropdown">
										<a class="dropdown" id="dropdown2" role="button" data-toggle="dropdown" data-target="#" href="#">
											<div class="input-group"><input type="text" class="form-control" ng-model="cat.datetime"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											</div>
										</a>
										<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<datetimepicker ng-model="cat.datetime" data-datetimepicker-config="{ dropdownSelector: '#dropdown2' }"/>
										</ul>
									</div>
								</div>
								<div class="form-group">
									<label for="name">Customer</label>
									<select name="parent" ng-model="cat.customer" class="form-control" ng-change="change_customer(cat.customer)">
										<option value="{{ customer.id }}" ng-repeat="customer in customers">{{ customer.inv_customer_name }}</option>
									</select>
								</div>
								<div class="form-group">
									<label for="name">Location</label>
									<select name="" ng-model="cat.location" class="form-control">
										<optgroup ng-repeat="x in grandParent" label="{{x[0].inv_location_name}}">
											<option ng-repeat="child in x.children" value="{{child.id}}">{{child.inv_location_name}}</option>
										</optgroup>
									</select>
								</div>
								
								<!-- <div class="form-group">
									<label for="name">Total</label>
									<input type="text" name="amount" class="form-control" name="name" ng-model="cat.total" numbers-only>
								</div> -->
								<div class="form-group">
									<button type="button" class="btn btn-large btn-block btn-info" ng-click="add_element('recipe')">Add Line</button>
								</div>
								<div class="panel panel-default" ng-repeat="recipe in newReciepe">
									<div class="panel-body">
										<div class="form-inline">
											<div class="form-group">
												<label for="name">Recipe</label>
												<select name="parent" ng-model="recipe.ID" class="form-control">
													<option value="{{ recipe.id }}" ng-repeat="recipe in recipes">{{ recipe.inv_recipe_name }}</option>
												</select>
											</div>

											<div class="form-group">
												<label for="name">Quantity</label>
												<input type="text" name="amount" class="form-control" name="name" ng-model="recipe.qty" numbers-only>
											</div>
											<div class="form-group">
												<label for="name">Currency</label>
												<select name="parent" ng-model="recipe.currency" class="form-control">
													<option value="{{ currency.id }}" ng-repeat="currency in currencies">{{ currency.inv_currency_code }}</option>
												</select>
											</div>
											<button class="remove" ng-click="removeField($index,'recipe')">X</button>
										</div>
									</div>
								</div>

								<button type="button" class="btn btn-default" ng-click="add(cat)">Submit&nbsp&nbsp
								<img ng-show="showloader" src="<?php echo plugins_url( '/images/rolling.gif', dirname(__FILE__) );?>"></button>
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
							<h2>Date:{{edit_cat.inv_order_datetime | datetime}}</h2>
							<h2>Customer:{{show_location}}</h2>
							<form name="new_user">
								<div class="form-group">
									<label for="name">Date</label>
									<div class="dropdown">
										<a class="dropdown" id="dropdown2" role="button" data-toggle="dropdown" data-target="#" href="#">
											<div class="input-group"><input type="text" class="form-control" ng-model="edit_cat.inv_order_datetime"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											</div>
										</a>
										<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<datetimepicker ng-model="edit_cat.inv_order_datetime" data-datetimepicker-config="{ dropdownSelector: '#dropdown2' }"/>
										</ul>
									</div>
								</div>
								<div class="form-group">
									<label for="name">Customer</label>
									<select name="parent" ng-model="edit_cat.inv_customer_inv_customer_id" class="form-control" ng-change="change_customer(edit_cat.inv_customer_inv_customer_id)">
										<option value="{{ customer.id }}" ng-repeat="customer in customers">{{ customer.inv_customer_name }}</option>
									</select>
								</div>
								<!-- <div class="form-group">
									<label for="name">Total</label>
									<input type="text" name="amount" class="form-control" name="name" ng-model="edit_cat.inv_order_total">
								</div> -->
								<div class="form-group">
									<label for="name">Location</label>
									<select name="" ng-model="edit_cat.inv_order_location_id" class="form-control">
										<optgroup ng-repeat="x in grandParent" label="{{x[0].inv_location_name}}">
											<option ng-repeat="child in x.children" value="{{child.id}}">{{child.inv_location_name}}</option>
										</optgroup>
									</select>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-large btn-block btn-info" ng-click="add_element_edit('recipe')">Add Line</button>
								</div>
								<div class="panel panel-default" ng-repeat="recipe in editReciepe">
									<div class="panel-body">
										<div class="form-inline">
											<div class="form-group">
												<label for="name">Recipe</label>
												<select name="parent" ng-model="recipe.inv_recipe_id_inv_recipe" class="form-control">
													<option value="{{ recipe.id }}" ng-repeat="recipe in recipes">{{ recipe.inv_recipe_name }}</option>
												</select>
											</div>

											<div class="form-group">
												<label for="name">Quantity</label>
												<input type="text" name="amount" class="form-control" name="name" ng-model="recipe.inv_order_detail_recipe_amount" numbers-only>
											</div>
											<div class="form-group">
												<label for="name">Currency</label>
												<select name="parent" ng-model="recipe.inv_currency_inv_currency_id" class="form-control">
													<option value="{{ currency.id }}" ng-repeat="currency in currencies">{{ currency.inv_currency_code }}</option>
												</select>
											</div>
											<button class="remove" ng-click="removeFieldEdit($index,'recipe')">X</button>
										</div>
									</div>
								</div>
								<!-- <div class="form-group">
									<label for="name">Recipe</label>
									<select name="parent" ng-model="edit_cat.inv_recipe_id_inv_recipe" class="form-control">
										<option value="{{ recipe.id }}" ng-repeat="recipe in recipes">{{ recipe.inv_recipe_name }}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="name">Quantity</label>
									<input type="text" name="amount" class="form-control" name="name" ng-model="edit_cat.inv_order_line_qty">
								</div>

								<div class="form-group">
									<label for="name">Currency</label>
									<select name="parent" ng-model="edit_cat.inv_currency_inv_currency_id" class="form-control">
										<option value="{{ currency.id }}" ng-repeat="currency in currencies">{{ currency.inv_currency_code }}</option>
									</select>
								</div> -->

								<button type="button" class="btn btn-default" ng-click="edit(edit_cat)">Submit&nbsp&nbsp
								<img ng-show="showloader" src="<?php echo plugins_url( '/images/rolling.gif', dirname(__FILE__) );?>"></button>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>				

			<!--List of all categories -->
			<h2>All Sales</h2>
			<p>
				<img ng-show="loading" src="<?php echo plugins_url( '/images/gears.gif', dirname(__FILE__) );?>">
			</p>
			<div class="table-responsive">          
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
							<!-- <th>Total</th> -->
							<!-- <th>Recipe</th> -->
							<th>Customer</th>
							<!-- <th>Quantity</th>-->
							<th>Location</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="order in orders">
							<td>{{order.inv_order_orderid}}</td>
							<td>{{order.inv_order_datetime | datetime }}</td>
							<!-- <td>{{order.inv_order_total}}</td> -->
							<!-- <td>
								<parent info="recipes" cid="order.inv_recipe_id_inv_recipe" field="inv_recipe_name"></parent>
							</td> -->
							<td>
								<parent info="customers" cid="order.inv_customer_inv_customer_id" field="inv_customer_name"></parent>
							</td>
							<td>
								<parent info="locations" cid="order.inv_order_location_id" field="inv_location_name"></parent>
							</td>
							<!-- <td>
								{{order.inv_order_line_qty}}
							</td>
							<td>
								<parent info="currencies" cid="order.inv_currency_inv_currency_id" field="inv_currency_code"></parent>
							</td> -->
							<td>
								<button type="button" class="btn btn-default" ng-click="edit_modal(order)">Edit</button>
								<button type="button" class="btn btn-default" ng-click="delete(order.inv_order_orderid)">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
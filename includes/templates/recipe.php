<?php ?>
<style type="text/css" media="screen">
	[ng\:cloak],
	[ng-cloak],
	.ng-cloak {
		display: none !important;
	}
</style>
<div class="container" ng-app="inventoryHome" ng-controller="recipectrl" ng-cloak>
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newUserModal">Add New Recipe</button>

			<!-- Add Modal -->
			<div class="modal fade" id="newUserModal" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Add new recipe</h4>
						</div>
						<div class="modal-body">
							<form name="new_user">
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" class="form-control" name="name" ng-model="cat.name" required>

								</div>
								<div class="form-group">
									<label for="name">Category</label>
									<select name="" ng-model="cat.category" class="form-control">
										<optgroup ng-repeat="x in grandParent" label="{{x[0].inv_recipe_cat_name}}">
											<option ng-repeat="child in x.children" value="{{child.id}}">{{child.inv_recipe_cat_name}}</option>
										</optgroup>

									</select>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-large btn-block btn-info" ng-click="add_element('product')">Add Product</button>
									<button type="button" class="btn btn-large btn-block btn-info" ng-click="add_element('recipe')">Add Recipe</button>
								</div>
								<div class="panel panel-default" ng-repeat="product in newProducts">
									<div class="panel-body">
										<div class="form-inline">
											<label for="name">Product</label>
											<select name="" ng-model="product.ID" class="form-control">
												<option value="{{ product.id }}" ng-repeat="product in products">{{ product.inv_product_name }}</option>
											</select>
											<div class="form-group">
												<label for="name">Quantity</label>
												<input type="text" class="form-control" name="name" ng-model="product.qty" required>
											</div>

											<!-- <div class="form-group">
												<label for="name">Unit</label>
												<input type="text" class="form-control" ng-disabled="true" name="name" ng-value="1" value="1" placeholder="1" ng-model="product.unit"
												ng-init="product.unit=1" required>
											</div> -->
											<div class="form-group">
												<label for="name">Unit</label>
												<select name="" ng-model="product.unit" class="form-control">
													<option value="{{ unit.id }}" ng-repeat="unit in units">{{ unit.inv_inventory_units_name }}</option>
												</select>
											</div>
											<button class="remove" ng-click="removeField($index,'product')">X</button>
										</div>
									</div>
								</div>

								<div class="panel panel-default" ng-repeat="recipe in newReciepe">
									<div class="panel-body">
										<div class="form-inline">
											<label for="name">Recipe</label>
											<select name="" ng-model="recipe.ID" class="form-control">

												<option value="{{ recipe.id }}" ng-repeat="recipe in recipies">
													{{ recipe.inv_recipe_name }}</option>
												</select>
												<div class="form-group">
													<label for="name">Quantity</label>
													<input type="text" class="form-control" name="name" ng-model="recipe.qty" required>
												</div>

												<!-- <div class="form-group">
													<label for="name">Unit</label>
													<input type="text" class="form-control" ng-disabled="true" name="name" ng-value="1" value="1" placeholder="1" ng-model="recipe.unit"
													ng-init="recipe.unit=1" required>
												</div> -->
												<div class="form-group">
													<label for="name">Unit</label>
													<select name="" ng-model="recipe.unit" class="form-control">
														<option value="{{ unit.id }}" ng-repeat="unit in units">{{ unit.inv_inventory_units_name }}</option>
													</select>
												</div>
												<button class="remove" ng-click="removeField($index,'recipe')">X</button>
											</div>
										</div>
									</div>

								<div class="form-group">
									<label for="name">Selling Price</label>
									<input type="text" class="form-control" name="name" ng-model="cat.selling_price" required>
								</div>


							<!--<div class="form-inline">
								<label for="name">Recipe</label>
								<select name="" ng-model="cat.recipe" class="form-control">
									<option value=""></option>
									<option value="{{ recipe.id }}" ng-repeat="recipe in recipies">
										{{ recipe.inv_recipe_name }}</option>
									</select>
								</div>-->



								<div class="form-group">
									<label for="name">Instructions</label>
									<textarea name="" ng-model="cat.instructions" class="form-control"></textarea>
								</div>

								<button type="button" class="btn btn-default" ng-click="add(cat)">Submit&nbsp&nbsp
									<img ng-show="showloader" src="<?php echo plugins_url( '/images/rolling.gif', dirname(__FILE__) );?>">
								</button>
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
									<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_recipe_name" required>

								</div>
								<div class="form-group">
									<label for="name">Category</label>
									<select name="" ng-model="edit_cat.inv_recipe_category_inv_recipe_category_id" class="form-control">
										<optgroup ng-repeat="x in grandParent" label="{{x[0].inv_recipe_cat_name}}">
											<option ng-repeat="child in x.children" value="{{child.id}}">{{child.inv_recipe_cat_name}}</option>
										</optgroup>
									</select>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-large btn-block btn-info" ng-click="add_element_edit('product')">Add Product</button>
									<button type="button" class="btn btn-large btn-block btn-info" ng-click="add_element_edit('recipe')">Add Recipe</button>
								</div>
								<div class="panel panel-default" ng-repeat="product in editProducts">
									<div class="panel-body">
										<div class="form-inline">
											<label for="name">Product</label>
											<select name="" ng-model="product.inv_product_id_inv_product" class="form-control">
												<option value="{{ product.id }}" ng-repeat="product in products">{{ product.inv_product_name }}</option>
											</select>
											<div class="form-group">
												<label for="name">Quantity</label>
												<input type="text" class="form-control" name="name" ng-model="product.inv_product_has_inv_recipe_qty" required>
											</div>

											<!-- <div class="form-group">
												<label for="name">Unit</label>
												<input type="text" class="form-control" ng-disabled="true" name="name" ng-value="1" value="1" placeholder="1" ng-model="product.inv_inventory_units_inv_inventory_units_id"
												ng-init="product.inv_inventory_units_inv_inventory_units_id=1" required>
											</div> -->
											<div class="form-group">
													<label for="name">Unit</label>
													<select name="" ng-model="product.inv_inventory_units_inv_inventory_units_id" class="form-control">
														<option value="{{ unit.id }}" ng-repeat="unit in units">{{ unit.inv_inventory_units_name }}</option>
													</select>
												</div>
											<button class="remove" ng-click="removeField_edit($index,'product')">X</button>
										</div>
									</div>
								</div>

								<div class="panel panel-default" ng-repeat="recipe in editReciepe">
									<div class="panel-body">
										<div class="form-inline">
											<label for="name">Recipe</label>
											<select name="" ng-model="recipe.inv_recipe_inv_recipe_id" class="form-control">

												<option value="{{ recipe.id }}" ng-repeat="recipe in recipies">
													{{ recipe.inv_recipe_name }}</option>
												</select>
												<div class="form-group">
													<label for="name">Quantity</label>
													<input type="text" class="form-control" name="name" ng-model="recipe.inv_product_has_inv_recipe_qty" required>
												</div>

												<!-- <div class="form-group">
													<label for="name">Unit</label>
													<input type="text" class="form-control" ng-disabled="true" name="name" ng-value="1" value="1" placeholder="1" ng-model="recipe.inv_inventory_units_inv_inventory_units_id"
													ng-init="recipe.inv_inventory_units_inv_inventory_units_id=1" required>
												</div> -->
												<div class="form-group">
													<label for="name">Unit</label>
													<select name="" ng-model="recipe.inv_inventory_units_inv_inventory_units_id" class="form-control">
														<option value="{{ unit.id }}" ng-repeat="unit in units">{{ unit.inv_inventory_units_name }}</option>
													</select>
												</div>
												<button class="remove" ng-click="removeField_edit($index,'recipe')">X</button>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="name">Instructions</label>
										<textarea name="" ng-model="edit_cat.inv_recipe_instructions" class="form-control"></textarea>
									</div>
									<div class="form-group">
										<label for="name">Selling Price</label>
										<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_recipe_selling_price" required>
									</div>

									<button type="button" class="btn btn-default" ng-click="edit(edit_cat)">Submit&nbsp&nbsp
										<img ng-show="showloader" src="<?php echo plugins_url( '/images/rolling.gif', dirname(__FILE__) );?>">
									</button>

								

								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>
				<!--List of all categories -->
				<h2>All Recipe</h2>
				<p>
					<img ng-show="loading" src="<?php echo plugins_url( '/images/gears.gif', dirname(__FILE__) );?>">
				</p>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Category</th>
							<!-- <th>Product</th>
							<th>Recipe</th> -->
							<th>Instruction</th>
							<th>Selling price</th>
							<!-- <th>Quantity</th> -->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="recipe in recipies">
							<td>{{recipe.id}}</td>
							<td>{{recipe.inv_recipe_name}}</td>
							<td>
								<parent info="categories" cid="recipe.inv_recipe_category_inv_recipe_category_id" field="inv_recipe_cat_name"></parent>
							</td>
							<!-- <td>
								<parent info="products" cid="recipe.inv_product_id_inv_product" field="inv_product_name"></parent>
							</td>
							<td>
								<parent info="recipies" cid="recipe.inv_recipe_inv_recipe_id" field="inv_recipe_name"></parent>
							</td>-->
							<td>{{recipe.inv_recipe_instructions}}</td>
							<td>{{recipe.inv_recipe_selling_price}}</td>
							<!--<td>{{recipe.inv_product_has_inv_recipe_qty}}</td> -->
							<td>
								<button type="button" class="btn btn-default" ng-click="edit_modal(recipe,recipe.id)">Edit</button>
								<button type="button" class="btn btn-default" ng-click="delete(recipe.id)">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
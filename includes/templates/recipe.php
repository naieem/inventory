<?php ?>
<div class="container" ng-app="inventoryHome" ng-controller="recipectrl">
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
										<option value="{{ category.id }}" ng-repeat="category in categories">{{ category.inv_recipe_cat_name }}</option>
									</select>
								</div>
								<div class="form-group">
									<label for="name">Ingredients</label>
									<select name="" ng-model="cat.ingredients" class="form-control">
										<option value="1">Product</option>
										<option value="2">Recipe</option>
									</select>
								</div>

								<div class="form-group" ng-show="cat.ingredients=='1'">
									<label for="name">Product</label>
									<select name="" ng-model="cat.product" class="form-control">
									<option value=""></option>
										<option value="{{ product.id }}" ng-repeat="product in products">{{ product.inv_product_name }}</option>
									</select>
								</div>

								<div class="form-group" ng-show="cat.ingredients=='2'">
									<label for="name">Recipe</label>
									<select name="" ng-model="cat.recipe" class="form-control">
									<option value=""></option>
										<option value="{{ recipe.id }}" ng-repeat="recipe in recipies">
										{{ recipe.inv_recipe_name }}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="name">Quantity</label>
									<input type="text" class="form-control" name="name" ng-model="cat.qty" required>
								</div>

								<div class="form-group">
									<label for="name">Unit</label>
									<input type="text" class="form-control" name="name" ng-model="cat.unit" required>
								</div>

								<div class="form-group">
									<label for="name">Instructions</label>
									<textarea name="" ng-model="cat.instructions"class="form-control"></textarea>
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
									<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_recipe_name" required>
									
								</div>
								<div class="form-group">
									<label for="name">Category</label>
									<select name="" ng-model="edit_cat.inv_recipe_category_inv_recipe_category_id" class="form-control">
										<option value="{{ category.id }}" ng-repeat="category in categories">{{ category.inv_recipe_cat_name }}</option>
									</select>
								</div>
								<div class="form-group">
									<label for="name">Ingredients</label>
									<select name="" ng-model="edit_cat.ingredients" class="form-control">
										<option value="1">Product</option>
										<option value="2">Recipe</option>
									</select>
								</div>

								<div class="form-group" ng-show="edit_cat.ingredients=='1'">
									<label for="name">Product</label>
									<select name="" ng-model="edit_cat.inv_product_id_inv_product" class="form-control">
										<option value="{{ product.id }}" ng-repeat="product in products">{{ product.inv_product_name }}</option>
									</select>
								</div>

								<div class="form-group" ng-show="edit_cat.ingredients=='2'">
									<label for="name">Recipe</label>
									<select name="" ng-model="edit_cat.inv_recipe_inv_recipe_id" class="form-control">
										<option value="{{ recipe.id }}" ng-repeat="recipe in recipies">
										{{ recipe.inv_recipe_name }}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="name">Quantity</label>
									<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_product_has_inv_recipe_qty" required>
								</div>

								<div class="form-group">
									<label for="name">Unit</label>
									<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_inventory_units_inv_inventory_units_id" required>
								</div>

								<div class="form-group">
									<label for="name">Instructions</label>
									<textarea name="" ng-model="edit_cat.inv_recipe_instructions"class="form-control"></textarea>
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
			<h2>All Recipe</h2>
			<div class="table-responsive">          
					<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Category</th>
							<th>Product</th>
							<th>Recipe</th>
							<th>Instruction</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="recipe in recipies">
							<td>{{recipe.id}}</td>
							<td>{{recipe.inv_recipe_name}}</td>
							<td><parent info="categories" cid="recipe.inv_recipe_category_inv_recipe_category_id" field="inv_recipe_cat_name"></parent></td>
							<td><parent info="products" cid="recipe.inv_product_id_inv_product" field="inv_product_name"></parent></td>					
							<td><parent info="recipies" cid="recipe.inv_recipe_inv_recipe_id" field="inv_recipe_name"></parent></td>
							<td>{{recipe.inv_recipe_instructions}}</td>
							<td>
								<button type="button" class="btn btn-default" ng-click="edit_modal(recipe)">Edit</button>
								<button type="button" class="btn btn-default" ng-click="delete(recipe.id)">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php ?>
<div class="container" ng-app="inventoryHome" ng-controller="recipectctrl">
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newUserModal">Add New Category</button>

				<!-- Add Modal -->
				<div class="modal fade" id="newUserModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Add new Category</h4>
							</div>
							<div class="modal-body">
								<form name="new_user">
									<div class="form-group">
										<label for="name">Category name</label>
										<input type="text" class="form-control" name="name" ng-model="cat.name" required>
										
									</div>

									<div class="form-group">
										<label for="email">Category Description</label>
										<textarea name="description" class="form-control"  ng-model="cat.desc"></textarea>
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
										<input type="text" class="form-control" name="name" ng-model="cat.inv_recipe_cat_name" required>
									</div>

									<div class="form-group">
										<label for="email">Category Description</label>
										<textarea name="description" class="form-control"  ng-model="cat.inv_recipe_cat_desc"></textarea>
									</div>
									<button type="button" class="btn btn-default" ng-click="edit(cat)">Submit</button>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>				

				<!--List of all categories -->
				<h2>All category</h2>
				<div class="table-responsive">          
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Description</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="category in categories | orderBy:'inv_product_cat_name'">
								<td>{{category.id}}</td>
								<td>{{category.inv_recipe_cat_name}}</td>
								<td>{{category.inv_recipe_cat_desc}}</td>

								<td>
									<button type="button" class="btn btn-default" ng-click="edit_modal(category)">Edit</button>
									<button type="button" class="btn btn-default" ng-click="delete(category.id)">Delete</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
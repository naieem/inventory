<?php ?>
<style type="text/css" media="screen">
	[ng\:cloak], [ng-cloak], .ng-cloak {
		display: none !important;
	}
</style>
<div class="container" ng-app="inventoryHome" ng-controller="pcatctrl" ng-cloak>
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
								<div class="form-group">
									<label for="">Category parent</label>
									<select class="form-control" name="parent" ng-model="cat.parent">
										<option value="0">Self</option>
										<option value="{{category.id}}" ng-repeat="category in categories">{{category.inv_product_cat_name}} 
										</option>
									</select>
								</div>
								<button type="button" class="btn btn-default" ng-click="add_cat(cat)">Submit</button>
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
									<input type="text" class="form-control" name="name" ng-model="cat.inv_product_cat_name" required>
									<span ng-show="new_user.name.$touched && new_user.name.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="email">Category Description</label>
									<textarea name="description" class="form-control"  ng-model="cat.inv_product_cat_desc"></textarea>
								</div>
								<div class="form-group">
									<label for="">Category parent</label>
									<select class="form-control" name="parent" ng-model="cat.inv_product_cat_parent">
										<option value="0">Self</option>
										<option value="{{category.id}}" ng-repeat="category in categories">{{category.inv_product_cat_name}} 
										</option>
									</select>
								</div>
								<button type="button" class="btn btn-default" ng-disabled="new_user.$invalid" ng-click="edit_cat(cat)">Submit</button>
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
			<p>
				<img ng-show="loading" src="<?php echo plugins_url( '/images/gears.gif', dirname(__FILE__) );?>">
			</p>
			<div class="table-responsive">          
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Description</th>
							<th>Parent</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="category in categories | orderBy:'inv_product_cat_name'">
							<td>{{category.id}}</td>
							<td>{{category.inv_product_cat_name}}</td>
							<td>{{category.inv_product_cat_desc}}</td>
							<td><parent info="categories" cid="category.inv_product_cat_parent" field="inv_product_cat_name"></parent></td>

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
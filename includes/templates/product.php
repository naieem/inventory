<?php ?>
<style type="text/css" media="screen">
	[ng\:cloak], [ng-cloak], .ng-cloak {
		display: none !important;
	}
</style>
<div class="container" ng-app="inventoryHome" ng-controller="productctrl" ng-cloak>
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newUserModal">Add New Product</button>

			<!-- Add Modal -->
			<div class="modal fade" id="newUserModal" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Add new Product</h4>
						</div>
						<div class="modal-body">
							<form name="new_user">
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" class="form-control" name="name" ng-model="cat.name" required>
									
								</div>

								<div class="form-group">
									<label for="name">Barcode</label>
									<input type="text" class="form-control" name="name" ng-model="cat.barcode" required>
								</div>

								<div class="form-group">
									<label for="name">Size</label>
									<input type="text" class="form-control" name="name" ng-model="cat.size" required>
									
								</div>

								<div class="form-group">
									<label for="name">Full weight</label>
									<input type="text" class="form-control" name="name" ng-model="cat.fweight" required>
								</div>

								<div class="form-group">
									<label for="name">Empty Weight</label>
									<input type="text" class="form-control" name="name" ng-model="cat.eweight" required>
								</div>

								<div class="form-group">
									<label for="name">Cost</label>
									<input type="text" class="form-control" name="name" ng-model="cat.cost" required>
									
								</div>
								<!-- <div class="form-group">
									<label for="name">Category</label>
									<select name="" ng-model="cat.category" class="form-control">
										<option value="{{ category.id }}" ng-repeat="category in parentCategories">{{ category.inv_product_cat_name }}</option>
									</select>
								</div> -->

								<div class="form-group">
									<label for="name">Category</label>
									<select name="" ng-model="cat.category" class="form-control">
										<optgroup ng-repeat="x in grandParent" label="{{x[0].inv_product_cat_name}}">
											<option ng-repeat="child in x.children" value="{{child.id}}">{{child.inv_product_cat_name}}</option>
										</optgroup>

									</select>
								</div>

								<div class="form-group">
									<label for="name">Supplier</label>
									<select name="" class="form-control" ng-model="cat.supplier">
										<option ng-repeat="supplier in suppliers" value="{{ supplier.id }}">{{supplier.inv_supplier_name}}</option>
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
									<input type="text" class="form-control" name="name" ng-model="cat.inv_product_name" required>
									
								</div>

								<div class="form-group">
									<label for="name">Barcode</label>
									<input type="text" class="form-control" name="name" ng-model="cat.inv_product_barcode" required>
								</div>

								<div class="form-group">
									<label for="name">Size</label>
									<input type="text" class="form-control" name="name" ng-model="cat.inv_product_size" required>
									
								</div>

								<div class="form-group">
									<label for="name">Full weight</label>
									<input type="text" class="form-control" name="name" ng-model="cat.inv_product_full_weight" required>
									
								</div>

								<div class="form-group">
									<label for="name">Empty Weight</label>
									<input type="text" class="form-control" name="name" ng-model="cat.inv_product_empty_weight" required>
									
								</div>

								<div class="form-group">
									<label for="name">Cost</label>
									<input type="text" class="form-control" name="name" ng-model="cat.inv_product_cost" required>
									
								</div>
								<div class="form-group">
									<label for="name">Category</label>
									<select name="" ng-model="cat.inv_product_category_id" class="form-control">
										<optgroup ng-repeat="x in grandParent" label="{{x[0].inv_product_cat_name}}">
											<option ng-repeat="child in x.children" value="{{child.id}}">{{child.inv_product_cat_name}}</option>
										</optgroup>
									</select>
								</div>
								<div class="form-group">
									<label for="name">Supplier</label>
									<select name="" class="form-control" ng-model="cat.inv_product_supplier_id">
										<option ng-repeat="supplier in suppliers" value="{{ supplier.id }}">{{supplier.inv_supplier_name}}</option>
									</select>
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
			<h2>All Product</h2>
			<p>
				<img ng-show="loading" src="<?php echo plugins_url( '/images/gears.gif', dirname(__FILE__) );?>">
			</p>
			<div class="table-responsive">          
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Barcode</th>
							<th>Size</th>
							<th>Full weight</th>
							<th>Empty weight</th>
							<th>Cost</th>
							<th>Category</th>
							<th>Supplier</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="product in products">
							<td>{{product.id}}</td>
							<td>{{product.inv_product_name}}</td>
							<td>{{product.inv_product_barcode}}</td>
							<td>{{product.inv_product_size}}</td>					
							<td>{{product.inv_product_full_weight}}</td>
							<td>{{product.inv_product_empty_weight}}</td>
							<td>{{product.inv_product_cost}}</td>
							<td><parent info="categories" cid="product.inv_product_category_id" field="inv_product_cat_name"></parent></td>

							<td><parent info="suppliers" cid="product.inv_product_supplier_id" field="inv_supplier_name"></parent></td>
							<td>
								<button type="button" class="btn btn-default" ng-click="edit_modal(product)">Edit</button>
								<button type="button" class="btn btn-default" ng-click="delete(product.id)">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
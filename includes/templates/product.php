<?php ?>
<style type="text/css" media="screen">
	[ng\:cloak], [ng-cloak], .ng-cloak {
		display: none !important;
	}
	.error{
		color: red;
	}
</style>
<div class="container" ng-app="inventoryHome" ng-controller="productctrl" ng-cloak>
	<div class="row">
		<div class="col-md-12">
			<button type="button" class="btn btn-info btn-lg"  ng-click="show_modal()">Add New Product</button>

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
									<span class="error" ng-show="new_user.name.$touched && new_user.name.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="name">Barcode</label>
									<input type="text" class="form-control" name="barcode" ng-model="cat.barcode" required>
									<span class="error" ng-show="new_user.barcode.$touched && new_user.barcode.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="name">Size</label>
									<input type="text" class="form-control" name="size" ng-model="cat.size" required>
									<span class="error" ng-show="new_user.size.$touched && new_user.size.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="name">Unit</label>
									<select name="unit" ng-model="cat.inv_product_size_unit" class="form-control">
										<option ng-repeat="unit in units | orderBy:'inv_inventory_units_name'" value="{{unit.id}}">{{unit.inv_inventory_units_name}}</option>
									</select>
								</div>


								<div class="form-group">
									<label for="name">Full weight</label>
									<input type="text" class="form-control" name="fweight" ng-model="cat.fweight" required>
									<span class="error" ng-show="new_user.fweight.$touched && new_user.fweight.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="name">Empty Weight</label>
									<input type="text" class="form-control" name="eweight" ng-model="cat.eweight" >
									<span class="error" ng-show="new_user.eweight.$touched && new_user.eweight.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="name">Weight Unit</label>
									<select name="unit" ng-model="cat.inv_product_weight_unit" class="form-control">
										<option ng-repeat="unit in units | orderBy:'inv_inventory_units_name'" value="{{unit.id}}">{{unit.inv_inventory_units_name}}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="name">Cost</label>
									<input type="text" class="form-control" name="cost" ng-model="cat.cost" required>
									<span class="error" ng-show="new_user.cost.$touched && new_user.cost.$invalid">This field is required.</span>			
								</div>

								<div class="form-group">
									<label for="name">Cost Currency</label>
									<select name="parent" ng-model="cat.currency" class="form-control">
										<option value="{{ currency.id }}" ng-repeat="currency in currencies | orderBy:'inv_currency_code'">{{ currency.inv_currency_code }}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="name">Category</label>
									<select name="category" ng-model="cat.category" class="form-control">
										<optgroup ng-repeat="x in grandParent | orderBy:'inv_product_cat_name'" label="{{x.inv_product_cat_name}}">
											<option ng-repeat="child in x.children | orderBy:'inv_product_cat_name'" value="{{child.id}}">{{child.inv_product_cat_name}}</option>
										</optgroup>
									</select>
									<span class="error" ng-show="new_user.category.$touched && new_user.category.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="name">Supplier</label>
									<select name="supplier" class="form-control" ng-model="cat.supplier">
										<option ng-repeat="supplier in suppliers | orderBy:'inv_supplier_name'" value="{{ supplier.id }}">{{supplier.inv_supplier_name}}</option>
									</select>
									<span class="error" ng-show="new_user.supplier.$touched && new_user.supplier.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="name">Supplier's Product code</label>
									<input type="text" class="form-control" name="cost" ng-model="cat.inv_product_supplier_prodcode">
								</div>

								<div class="form-group">
									<label for="name">Country</label>
									<!-- <input type="text" class="form-control" name="name" ng-model="cat.inv_location_country" required> -->
									<select class="form-control select2" name="currency" ng-model="cat.inv_product_country">
										<option ng-repeat="countries in country" value="{{countries.id}}">{{countries.country_name}}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="name">Region</label>
									<input type="text" class="form-control" name="cost" ng-model="cat.inv_product_region">
								</div>
								<div class="form-group">
									<label for="name">Supplier's Product code</label>
									<input type="text" class="form-control" name="cost" ng-model="cat.inv_product_supplier_prodcode">
								</div>
								<div class="form-group">
									<label for="name">Sous-region</label>
									<input type="text" class="form-control" name="cost" ng-model="cat.inv_product_sous_region">
								</div>
								<div class="form-group">
									<label for="name">Appellation</label>
									<input type="text" class="form-control" name="cost" ng-model="cat.inv_product_aoc">
								</div>

								<div class="form-group">
									<label for="name">Classification</label>
									<input type="text" class="form-control" name="cost" ng-model="cat.inv_product_classification">
								</div>
								<div class="form-group">
									<label for="name">Producteur</label>
									<input type="text" class="form-control" name="cost" ng-model="cat.inv_product_producteur">
								</div>
								<div class="form-group">
									<label for="name">Color</label>
									<input type="text" class="form-control" name="cost" ng-model="cat.inv_product_couleur">
								</div>

								<div class="form-group">
									<label for="name">Image url</label>
									<input type="text" class="form-control" name="cost" ng-model="cat.inv_product_image_url">
								</div>

								<button type="button" class="btn btn-default" ng-disabled="new_user.$invalid" ng-click="add(cat)">Submit</button>
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
							<form name="new_user_edit">
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_product_name" required>
									<span class="error" ng-show="new_user_edit.name.$touched && new_user_edit.name.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="name">Barcode</label>
									<input type="text" class="form-control" name="barcode" ng-model="edit_cat.inv_product_barcode" required>
									<span class="error" ng-show="new_user_edit.barcode.$touched && new_user_edit.barcode.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="name">Size</label>
									<input type="text" class="form-control" name="size" ng-model="edit_cat.inv_product_size" required>
									<span class="error" ng-show="new_user_edit.size.$touched && new_user_edit.size.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="name">Unit</label>
									<select name="unit" ng-model="edit_cat.inv_product_size_unit" class="form-control">
										<option ng-repeat="unit in units | orderBy:'inv_inventory_units_name'" value="{{unit.id}}">{{unit.inv_inventory_units_name}}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="name">Full weight</label>
									<input type="text" class="form-control" name="fweight" ng-model="edit_cat.inv_product_full_weight" required>
									<span class="error" ng-show="new_user_edit.fweight.$touched && new_user_edit.fweight.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="name">Empty Weight</label>
									<input type="text" class="form-control" name="eweight" ng-model="edit_cat.inv_product_empty_weight">
									<span class="error" ng-show="new_user_edit.eweight.$touched && new_user_edit.eweight.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
									<label for="name">Weight Unit</label>
									<select name="unit" ng-model="edit_cat.inv_product_weight_unit" class="form-control">
										<option ng-repeat="unit in units | orderBy:'inv_inventory_units_name'" value="{{unit.id}}">{{unit.inv_inventory_units_name}}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="name">Cost</label>
									<input type="text" class="form-control" name="cost" ng-model="edit_cat.inv_product_cost" required>
									<span class="error" ng-show="new_user_edit.cost.$touched && new_user_edit.cost.$invalid">This field is required.</span>
								</div>

								<div class="form-group">
								<label for="name">Cost Currency</label>
									<select name="parent" ng-model="edit_cat.inv_product_cost_currency" class="form-control">
										<option value="{{ currency.id }}" ng-repeat="currency in currencies | orderBy:'inv_currency_code'">{{ currency.inv_currency_code }}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="name">Category</label>
									<select name="category" ng-model="edit_cat.inv_product_category_id" class="form-control">
										<optgroup ng-repeat="x in grandParent | orderBy:'inv_product_cat_name'" label="{{x.inv_product_cat_name}}">
											<option ng-repeat="child in x.children | orderBy:'inv_product_cat_name'" value="{{child.id}}">{{child.inv_product_cat_name}}</option>
										</optgroup>
									</select>
									<span class="error" ng-show="new_user_edit.category.$touched && new_user_edit.category.$invalid">This field is required.</span>
								</div>
								<div class="form-group">
									<label for="name">Supplier</label>
									<select name="supplier" class="form-control" ng-model="edit_cat.inv_product_supplier_id">
										<option ng-repeat="supplier in suppliers | orderBy:'inv_supplier_name'" value="{{ supplier.id }}">{{supplier.inv_supplier_name}}</option>
									</select>
									<span class="error" ng-show="new_user_edit.supplier.$touched && new_user_edit.supplier.$invalid">This field is required.</span>
								</div>


								<div class="form-group">
									<label for="name">Supplier's Product code</label>
									<input type="text" class="form-control" name="cost" ng-model="edit_cat.inv_product_supplier_prodcode">
								</div>

								<div class="form-group">
									<label for="name">Country</label>
									<!-- <input type="text" class="form-control" name="name" ng-model="edit_cat.inv_location_country" required> -->
									<select class="form-control select2" name="currency" ng-model="edit_cat.inv_product_country">
										<option ng-repeat="countries in country | orderBy:'country_name'" value="{{countries.id}}">{{countries.country_name}}</option>
									</select>
								</div>

								<div class="form-group">
									<label for="name">Region</label>
									<input type="text" class="form-control" name="cost" ng-model="edit_cat.inv_product_region">
								</div>
								<div class="form-group">
									<label for="name">Supplier's Product code</label>
									<input type="text" class="form-control" name="cost" ng-model="edit_cat.inv_product_supplier_prodcode">
								</div>
								<div class="form-group">
									<label for="name">Sous-region</label>
									<input type="text" class="form-control" name="cost" ng-model="edit_cat.inv_product_sous_region">
								</div>
								<div class="form-group">
									<label for="name">Appellation</label>
									<input type="text" class="form-control" name="cost" ng-model="edit_cat.inv_product_aoc">
								</div>

								<div class="form-group">
									<label for="name">Classification</label>
									<input type="text" class="form-control" name="cost" ng-model="edit_cat.inv_product_classification">
								</div>
								<div class="form-group">
									<label for="name">Producteur</label>
									<input type="text" class="form-control" name="cost" ng-model="edit_cat.inv_product_producteur">
								</div>
								<div class="form-group">
									<label for="name">Color</label>
									<input type="text" class="form-control" name="cost" ng-model="edit_cat.inv_product_couleur">
								</div>

								<div class="form-group">
									<label for="name">Image url</label>
									<input type="text" class="form-control" name="cost" ng-model="edit_cat.inv_product_image_url">
								</div>


								<button type="button" class="btn btn-default" ng-disabled="new_user_edit.$invalid"  ng-click="edit(edit_cat)">Submit</button>
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
			<p>
			<center>
			Filter:<input type="text" name="" value="" ng-model="search" placeholder="search">
			View <select ng-model="viewby" ng-change="setItemsPerPage(viewby)"><option>50</option><option>100</option><option>300</option></select> records at a time.
			</center>
			</p>
			<uib-pagination boundary-links="true" max-size="maxSize" total-items="filterData.length"  ng-model="currentPage" class="pagination-sm" previous-text=" Previous" next-text="Next" first-text="First" last-text="Last"></uib-pagination>          
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
						<tr ng-repeat="product in filterData= (products | filter : search) | limitTo:viewby:viewby*(currentPage-1)">
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
				<uib-pagination boundary-links="true" max-size="maxSize" total-items="filterData.length"  ng-model="currentPage" class="pagination-sm" previous-text=" Previous" next-text="Next" first-text="First" last-text="Last"></uib-pagination>          
			</div>
		</div>
	</div>
</div>
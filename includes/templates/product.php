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
							<form name="new_user" id="new_product" validate>
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" class="form-control" name="name" ng-model="cat.name" required>
								</div>

								<div class="form-group">
									<label for="name">Barcode</label>
									<input type="text" class="form-control" name="barcode" ng-model="cat.barcode">
								</div>

								<div class="form-group">
									<label for="name">Size</label>
									<input type="text" class="form-control" name="size" ng-model="cat.size" required>
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
								</div>

								<div class="form-group">
									<label for="name">Empty Weight</label>
									<input type="text" class="form-control" name="eweight" ng-model="cat.eweight" >
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
								</div>

								<div class="form-group">
									<label for="name">Supplier</label>
									<select name="supplier" class="form-control" ng-model="cat.supplier">
										<option ng-repeat="supplier in suppliers | orderBy:'inv_supplier_name'" value="{{ supplier.id }}">{{supplier.inv_supplier_name}}</option>
									</select>
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

								<button type="button" class="btn btn-default" submit-button="true" ng-click="add(cat)">Submit</button>
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
							<form name="new_user_edit"  id="edit_product" validate>
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" class="form-control" name="name" ng-model="edit_cat.inv_product_name" required>
									
								</div>

								<div class="form-group">
									<label for="name">Barcode</label>
									<input type="text" class="form-control" name="barcode" ng-model="edit_cat.inv_product_barcode">
								</div>

								<div class="form-group">
									<label for="name">Size</label>
									<input type="text" class="form-control" name="size" ng-model="edit_cat.inv_product_size" required>
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
								</div>

								<div class="form-group">
									<label for="name">Empty Weight</label>
									<input type="text" class="form-control" name="eweight" ng-model="edit_cat.inv_product_empty_weight">
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
								</div>
								<div class="form-group">
									<label for="name">Supplier</label>
									<select name="supplier" class="form-control" ng-model="edit_cat.inv_product_supplier_id">
										<option ng-repeat="supplier in suppliers | orderBy:'inv_supplier_name'" value="{{ supplier.id }}">{{supplier.inv_supplier_name}}</option>
									</select>
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


								<button type="button" class="btn btn-default" submit-button="true"  ng-click="edit(edit_cat)">Submit</button>
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
			
			<datatable templateurl="table.html"></datatable>  

			</dv>
		</div>
	</div>
</div>
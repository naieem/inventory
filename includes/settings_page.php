<?php
/*
* Settings page configurations
* By:Naieem Mahmud Supto
* Version:1.0.0
*/


/**
* Register a custom menu page.
*/
add_action('admin_menu', 'inventory_menu_page');


/**
* Adds a new top-level page to the administration menu.
*/
function inventory_menu_page() {
	add_menu_page(
__( 'Inventory', 'inventory_supto' ), // Page Title
__( 'Inventory System', 'inventory_supto'), // Menu Title
'manage_options', // Capability
'inventory-home', //slug
'inventory_home_page', // functions to display content
''
);

	/* User submenu */
	add_submenu_page(
'inventory-home', // Parent slug
'Inventory Users', // Page Title
'Inventory user', // menu Title
'manage_options', // capability
'inventory-user', // slug
'inventory_user_func' // callback function
);

	/* Product submenu */
	add_submenu_page(
'inventory-home', // Parent slug
'Inventory Product', // Page Title
'Inventory Product', // menu Title
'manage_options', // capability
'inventory-product', // slug
'inventory_product_func' // callback function
);

	/* Product submenu */
	add_submenu_page(
'inventory-home', // Parent slug
'Inventory Product category', // Page Title
'Inventory product category', // menu Title
'manage_options', // capability
'inventory-product-category', // slug
'inventory_product_cat_func' // callback function
);

	/* Product submenu */
	add_submenu_page(
'inventory-home', // Parent slug
'Inventory Product supplier', // Page Title
'Inventory product supplier', // menu Title
'manage_options', // capability
'inventory-product-supplier', // slug
'inventory_product_supl_func' // callback function
);

}

/**
* Disply callback for the inventory home.
*/
function inventory_home_page() {
	?>
	<div class="container" ng-app="inventoryHome" ng-controller="homectrl">
		<div class="row">
			<h1>Inventory Home</h1>
			<form name="new_user">


				<button type="button" class="btn btn-default" ng-click="hello()">Submit</button>
			</form>
		</div>
	</div>
	<?php
}

/**
* Disply callback for the inventory user.
*/
function inventory_user_func() {
	?>
	<div class="container" ng-app="inventoryHome" ng-controller="userctrl">
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newUserModal">Add New User</button>

				<!-- Modal -->
				<div class="modal fade" id="newUserModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Add new user</h4>
							</div>
							<div class="modal-body">
								<form name="new_user">
									<div class="form-group">
										<label for="name">Customer name</label>
										<input type="text" class="form-control" name="name" ng-model="customer.name" required>
										<span ng-show="new_user.name.$touched && new_user.name.$invalid">This field is required.</span>
									</div>

									<div class="form-group">
										<label for="email">Customer Email</label>
										<input type="email" class="form-control" name="email" ng-model="customer.email" required>
										<span ng-show="new_user.email.$touched && new_user.email.$invalid">This field is required.</span>
									</div>
									<div class="form-group">
										<label for="phonenumber">Customer Phone number</label>
										<input type="number" class="form-control" name="phone" ng-model="customer.phone" required>
										<span ng-show="new_user.phone.$touched && new_user.phone.$invalid">This field is required.</span>
									</div>
									<div class="form-group">
										<label for="company">Customer Company</label>
										<input type="text" name="company" class="form-control" ng-model="customer.company" required>
										<span ng-show="new_user.company.$touched && new_user.company.$invalid">This field is required.</span>
									</div>
									<div class="form-group">
										<label for="streat">Customer Street Address</label>
										<input type="text" class="form-control" name="street" ng-model="customer.street" required>
										<span ng-show="new_user.street.$touched && new_user.street.$invalid">This field is required.</span>
									</div>


									<div class="form-group">
										<label for="email">Customer City</label>
										<input type="text" class="form-control" name="city" ng-model="customer.city" required>
										<span ng-show="new_user.city.$touched && new_user.city.$invalid">This field is required.</span>
									</div>
									<div class="form-group">
										<label for="province">Customer Province</label>
										<input type="text" name="province" class="form-control" ng-model="customer.province" required>
										<span ng-show="new_user.province.$touched && new_user.province.$invalid">This field is required.</span>
									</div>
									<div class="form-group">
										<label for="postal">Customer Postal</label>
										<input type="text" name="postal" class="form-control" ng-model="customer.postal" required>
										<span ng-show="new_user.postal.$touched && new_user.postal.$invalid">This field is required.</span>
									</div>
									<div class="form-group">
										<label for="Country">Customer Country</label>
										<input type="text" class="form-control" name="country" ng-model="customer.country" required>
										<span ng-show="new_user.country.$touched && new_user.country.$invalid">This field is required.</span>
									</div>

									<div class="form-group">
										<label for="currency">Curerncy:</label>
										<select class="form-control" required name="currency" ng-model="customer.currency">
											<option ng-repeat="currencies in currency" ng-value=" currencies.id">{{currencies.inv_currency_code}}</option>
										</select>
										<span ng-show="new_user.currency.$touched && new_user.currency.$invalid">This field is required.</span>
									</div>

									<button type="button" class="btn btn-default" ng-disabled="new_user.$invalid" ng-click="add_user(customer)">Submit</button>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>

				<!--List of all users -->
				<h2>All Users</h2>
				<div class="table-responsive">          
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone Number</th>
								<th>Company</th>
								<th>Street</th>
								<th>City</th>
								<th>Province</th>
								<th>Postal</th>
								<th>Currency</th>
								<th>Country</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="user in users | orderBy:'inv_customer_name'">
								<td>{{$index}}</td>
								<td>{{user.inv_customer_name}}</td>
								<td>{{user.inv_customer_email}}</td>
								<td>{{user.inv_customer_phone_number}}</td>
								<td>{{user.inv_customer_company}}</td>
								<td>{{user.inv_customer_street_address}}</td>
								<td>{{user.inv_customer_city}}</td>
								<td>{{user.inv_customer_province}}</td>
								<td>{{user.inv_customer_postal_code}}</td>
								<td>{{user.inv_currency_code}}</td>
								<td>{{user.inv_customer_country}}</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php
}


/**
* Disply callback for the inventory product.
*/
function inventory_product_func() {
	?>
	<div class="container" ng-app="inventoryHome" ng-controller="homectrl">
		<div class="row">
			<h1>Inventory Home</h1>
			<form name="new_user">


				<button type="button" class="btn btn-default" ng-click="hello()">Submit</button>
			</form>
		</div>
	</div>
	<?php
}


/**
* Disply callback for the inventory product category.
*/
function inventory_product_cat_func() {
	?>
	<div class="container" ng-app="inventoryHome" ng-controller="pcatctrl">
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#newUserModal">Add New Category</button>

				<!-- Modal -->
				<div class="modal fade" id="newUserModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Add new user</h4>
							</div>
							<div class="modal-body">
								<form name="new_user">
									<div class="form-group">
										<label for="name">Category name</label>
										<input type="text" class="form-control" name="name" ng-model="cat.name" required>
										<span ng-show="new_user.name.$touched && new_user.name.$invalid">This field is required.</span>
									</div>

									<div class="form-group">
										<label for="email">Category Description</label>
										<textarea name="description" class="form-control"  ng-model="cat.desc"></textarea>
									</div>
									<div class="form-group">
										<label for="">Category parent</label>
										<select class="form-control" name="parent" ng-model="cat.parent">
											<option value="0">none</option>
											<option value="{{category.id}}" ng-repeat="category in categories">{{category.inv_product_cat_name}} 
											</option>
										</select>
									</div>
									<button type="button" class="btn btn-default" ng-disabled="new_user.$invalid" ng-click="add_cat(cat)">Submit</button>
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
								<th>Parent</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="category in categories | orderBy:'inv_product_cat_name'">
								<td>{{category.id}}</td>
								<td>{{category.inv_product_cat_name}}</td>
								<td>{{category.inv_product_cat_desc}}</td>
								<td><parent info="categories" cid="category.inv_product_cat_parent"></parent></td>

								<td>
								<button type="button" class="btn btn-default" ng-click="edit(category.id)">Edit</button>
								<button type="button" class="btn btn-default" ng-click="delete(category.id)">Delete</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php
}

/**
* Disply callback for the inventory product supplier.
*/
function inventory_product_supl_func() {
	?>
	<div class="container" ng-app="inventoryHome" ng-controller="homectrl">
		<div class="row">
			<h1>Inventory Home</h1>
			<form name="new_user">


				<button type="button" class="btn btn-default" ng-click="hello()">Submit</button>
			</form>
		</div>
	</div>
	<?php
}
?>
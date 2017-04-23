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
	include_once('templates/user.php');
}


/**
* Disply callback for the inventory product.
*/
function inventory_product_func() {
	include_once('templates/product.php');
}


/**
* Disply callback for the inventory product category.
*/
function inventory_product_cat_func() {
	include_once('templates/product_category.php');
}

/**
* Disply callback for the inventory product supplier.
*/
function inventory_product_supl_func() {
include_once('templates/product_supplier.php');	
}
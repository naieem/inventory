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
'Inventory Customer', // Page Title
'Inventory Customer', // menu Title
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

	/* Product submenu */
	add_submenu_page(
'inventory-home', // Parent slug
'Inventory recipe category', // Page Title
'Inventory recipe category', // menu Title
'manage_options', // capability
'inventory-recipe-category', // slug
'inventory_recipe_cat_func' // callback function
);

	/* Recipe submenu */
	add_submenu_page(
'inventory-home', // Parent slug
'Inventory recipe', // Page Title
'Inventory recipe', // menu Title
'manage_options', // capability
'inventory-recipe', // slug
'inventory_recipe_func' // callback function
);
	/* Location submenu */
	add_submenu_page(
'inventory-home', // Parent slug
'Inventory Location', // Page Title
'Inventory location', // menu Title
'manage_options', // capability
'inventory-location', // slug
'inventory_location_func' // callback function
);
	/* Inventory submenu */
	add_submenu_page(
'inventory-home', // Parent slug
'Inventory', // Page Title
'Inventory', // menu Title
'manage_options', // capability
'inventory-inventory', // slug
'inventory_inventory_func' // callback function
);

	/* Inventory submenu */
	add_submenu_page(
'inventory-home', // Parent slug
'Inventory Order', // Page Title
'Inventory Order', // menu Title
'manage_options', // capability
'inventory-order', // slug
'inventory_order_func' // callback function
);

}

/**
* Disply callback for the inventory home.
*/
function inventory_home_page() {
	?>
	<div class="container" ng-app="inventoryHome" ng-controller="homectrl">
		<div class="row">
			<form method="post" action="options.php">
				<?php
		// This prints out all hidden setting fields
		// settings_fields( $option_group )
				settings_fields( 'database-configuration-fields' );
		// do_settings_sections( $page )
				do_settings_sections( 'inventory-db-config' );
				?>
				<?php submit_button('Save Changes'); ?>
			</form>
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

/**
* Disply callback for the inventory recipe category.
*/
function inventory_recipe_cat_func() {
	include_once('templates/recipe_category.php');	
}

/**
* Disply callback for the inventory recipe category.
*/
function inventory_recipe_func() {
	include_once('templates/recipe.php');	
}

/**
* Disply callback for the inventory location.
*/
function inventory_location_func() {
	include_once('templates/location.php');	
}

/**
* Disply callback for the inventory listing page.
*/
function inventory_inventory_func() {
	include_once('templates/inventory.php');	
}
/**
* Disply callback for the inventory order page.
*/
function inventory_order_func() {
	include_once('templates/order.php');	
}


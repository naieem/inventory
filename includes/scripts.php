<?php


/*********************************
load javascript and css
**********************************/


function aim_load_styles() {
	
	wp_enqueue_style('pstyle', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
	
	
	wp_enqueue_style('select2css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css');
	
	
	wp_enqueue_style('ui', 'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
	
	
	wp_enqueue_style('datetime', 'https://cdn.rawgit.com/dalelotts/angular-bootstrap-datetimepicker/master/src/css/datetimepicker.css');
	
	wp_enqueue_style('style', WP_PLUGIN_URL . '/inventory/includes/css/style.css');
	
	
}

add_action('admin_enqueue_scripts', 'aim_load_styles');

add_action('wp_enqueue_scripts', 'aim_load_styles');

function aim_load_js() {
	
	
	/**
 *
 * Custom initilization scripts
 *
 */
	
	
	wp_register_script('ajax_script', WP_PLUGIN_URL . '/inventory/includes/js/myscript.js');
	
	
	
	/**
 *
 * Scripts for individual pages
 *
 */
	
	
	wp_register_script('customer', WP_PLUGIN_URL . '/inventory/includes/js/customer.js');
	
	wp_register_script('pcat', WP_PLUGIN_URL . '/inventory/includes/js/product_category.js');
	
	wp_register_script('supplier', WP_PLUGIN_URL . '/inventory/includes/js/supplier.js');
	
	wp_register_script('product', WP_PLUGIN_URL . '/inventory/includes/js/product.js');
	
	wp_register_script('rcat', WP_PLUGIN_URL . '/inventory/includes/js/recipe_category.js');
	
	wp_register_script('recipe', WP_PLUGIN_URL . '/inventory/includes/js/recipe.js');
	
	wp_register_script('location', WP_PLUGIN_URL . '/inventory/includes/js/location.js');
	
	wp_register_script('inventory', WP_PLUGIN_URL . '/inventory/includes/js/inventory.js');
	
	wp_register_script('order', WP_PLUGIN_URL . '/inventory/includes/js/order.js');
	
	wp_register_script('sales', WP_PLUGIN_URL . '/inventory/includes/js/sales.js');
	
	wp_register_script('purchase', WP_PLUGIN_URL . '/inventory/includes/js/purchase.js');
	
	
	wp_localize_script( 'ajax_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	
	
	
	/**
 *
 * Third party script included
 *
 */
	
	wp_enqueue_script('lodash', 'https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js');
	
	wp_enqueue_script( 'jquery' );
	
	
	wp_enqueue_script( 'ui', 'https://code.jquery.com/ui/1.8.16/jquery-ui.js');
	
	
	wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), 3.3, true);
	
	
	wp_enqueue_script( 'momentjs', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js');
	
	
	wp_enqueue_script( 'angular', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js');

	wp_enqueue_script( 'datetime', 'https://cdn.rawgit.com/dalelotts/angular-bootstrap-datetimepicker/master/src/js/datetimepicker.js');
	
	
	wp_enqueue_script( 'datetimecustom', 'https://cdn.rawgit.com/dalelotts/angular-bootstrap-datetimepicker/master/src/js/datetimepicker.templates.js');
	
	wp_enqueue_script( 'pagination', 'https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-1.1.2.js');
	
	
	wp_enqueue_script( 'Select2js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js');
	
	
	
	/**
 *
 * including custom scripts
 *
 */
	
	
	wp_enqueue_script( 'ajax_script' );
	
	wp_enqueue_script( 'customer' );
	
	wp_enqueue_script( 'pcat' );
	
	wp_enqueue_script( 'supplier' );
	
	wp_enqueue_script( 'product' );
	
	wp_enqueue_script( 'rcat' );
	
	wp_enqueue_script( 'recipe' );
	
	wp_enqueue_script( 'location' );
	
	wp_enqueue_script( 'inventory' );
	
	wp_enqueue_script( 'order' );
	
	wp_enqueue_script( 'sales' );
	
	wp_enqueue_script('purchase');
	
}

add_action('admin_enqueue_scripts', 'aim_load_js');

add_action('wp_enqueue_scripts', 'aim_load_js');


?>
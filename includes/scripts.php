<?php

/*********************************
load javascript and css
**********************************/

function aim_load_styles() {
		wp_enqueue_style('pstyle', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
		wp_enqueue_style('datetime', 'https://cdn.rawgit.com/dalelotts/angular-bootstrap-datetimepicker/master/src/css/datetimepicker.css');

}
add_action('admin_enqueue_scripts', 'aim_load_styles');

function aim_load_js() {
		wp_register_script('ajax_script', WP_PLUGIN_URL . '/inventory/includes/js/myscript.js');
	    wp_localize_script( 'ajax_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

   wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
   wp_enqueue_script( 'momentjs', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js');

   wp_enqueue_script( 'angular', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js');
   wp_enqueue_script( 'datetime', 'https://cdn.rawgit.com/dalelotts/angular-bootstrap-datetimepicker/master/src/js/datetimepicker.js');

   wp_enqueue_script( 'datetimecustom', 'https://cdn.rawgit.com/dalelotts/angular-bootstrap-datetimepicker/master/src/js/datetimepicker.templates.js');
   wp_enqueue_script( 'ajax_script' );
}
add_action('admin_enqueue_scripts', 'aim_load_js');

?>
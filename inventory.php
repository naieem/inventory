<?php
/**
 * Plugin Name: Inventory
 * Description: Inventory Plugin for everyone
 * Version: 1.0
 * Author: Naieem Mahmud Supto
 * Author URI:http://naieem.github.io
*/

/* Load plugin textdomain */
add_action( 'plugins_loaded', 'aia_load_textdomain' );

function aia_load_textdomain() {
  load_plugin_textdomain( 'aia', dirname( plugin_basename( __FILE__ ) ) . '/inventory/languages' ); 
}

/*********************************
global variables
**********************************/
/* external db connection file*/

//$aim_plugin_name = 'Inventory';

/*********************************
includes
**********************************/

/*
* All js and css file inclusion
*/
include('includes/scripts.php');
/*
* admin menu initializing codes
*/
include('includes/settings_page.php');
include('includes/data-processing.php'); //this saves data
// include('includes/display-functions.php'); //display content functions
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
includes
**********************************/
/*
* All js and css file inclusion
*/
include('includes/scripts.php');
/*
* admin menu initializing codes
*/
include('includes/settings_api.php');
include('includes/settings_page.php');
include('includes/data-processing.php'); //this saves data

/*********************************
global variables
**********************************/
/* external db connection file*/
$options = get_option('db_config');
$dbHost     = $options['host'];
$dbUsername = $options['username'];
$dbPassword = $options['password'];
$dbName     = $options['db'];
include('includes/db.php');
global $db;
$db= new DBCONNECTION($dbHost,$dbUsername,$dbPassword,$dbName);
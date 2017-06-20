<?php
/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */
add_action( 'admin_init','register_settings' );
function register_settings(){

	add_settings_section(
		'remote-database-settings-section',
		'Remote Database Configuration',
		'settings_section_info',
		'inventory-db-config'
		);

	/**
	 *
	 * Settings fields configuration
	 *
	 */
	
		// add_settings_field( $id, $title, $callback, $page, $section, $args )
	add_settings_field(
		'host', 
		'Host Url', 
		'host_url_setting', 
		'inventory-db-config', 
		'remote-database-settings-section'
		);

	add_settings_field(
		'db', 
		'Database Name', 
		'dbname_setting', 
		'inventory-db-config', 
		'remote-database-settings-section'
		);

	add_settings_field(
		'username', 
		'Username', 
		'username_setting', 
		'inventory-db-config', 
		'remote-database-settings-section'
		);
	add_settings_field(
		'password', 
		'Password', 
		'password_setting', 
		'inventory-db-config', 
		'remote-database-settings-section'
		);
		// register_setting( $option_group, $option_name, $sanitize_callback )
	register_setting( 'database-configuration-fields', 'db_config', 'settings_validate');
	/**
	 *
	 * Callback functions for settings field
	 *
	 */
	
	function settings_section_info() {
		echo '<p>Add remote database access configuration information</p>';
	}

	function host_url_setting() {
		$options = get_option('db_config');
		?><input type="text" name="db_config[host]" value="<?php echo $options['host']; ?>" /><?php
	}
	function dbname_setting() {
		$options = get_option('db_config');
		?><input type="text" name="db_config[db]" value="<?php echo $options['db']; ?>" /><?php
	}

	function username_setting() {
		$options = get_option('db_config');
		?><input type="text" name="db_config[username]" value="<?php echo $options['username']; ?>" /><?php
	}
	function password_setting() {
		$options = get_option('db_config');
		?><input type="text" name="db_config[password]" value="<?php echo $options['password']; ?>" /><?php
	}
	function settings_validate($arr_input) {
		$options = get_option('db_config');
		$options['some-setting'] = trim( $arr_input['some-setting'] );
		return $options;
	}
	/**
	 *
	 * Callback functions for settings field end
	 *
	 */
	
}

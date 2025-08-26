<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.fiverr.com/muneebkhan21
 * @since             1.0.0
 * @package           Frontend_File_Upload
 *
 * @wordpress-plugin
 * Plugin Name:       Frontend File Upload
 * Plugin URI:        https://github.com/MuneebKhan1996
 * Description:       Allows users to upload files from frontend directly in WordPress storage
 * Version:           1.0.0
 * Author:            Muneeb Khan
 * Author URI:        https://www.fiverr.com/muneebk21
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       frontend-file-upload
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('FRONTEND_FILE_UPLOAD_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-frontend-file-upload-activator.php
 */
function activate_frontend_file_upload()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-frontend-file-upload-activator.php';
	Frontend_File_Upload_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-frontend-file-upload-deactivator.php
 */
function deactivate_frontend_file_upload()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-frontend-file-upload-deactivator.php';
	Frontend_File_Upload_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_frontend_file_upload');
register_deactivation_hook(__FILE__, 'deactivate_frontend_file_upload');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-frontend-file-upload.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_frontend_file_upload()
{

	$plugin = new Frontend_File_Upload();
	$plugin->run();

}
run_frontend_file_upload();
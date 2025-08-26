<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.fiverr.com/muneebkhan21
 * @since      1.0.0
 *
 * @package    Frontend_File_Upload
 * @subpackage Frontend_File_Upload/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Frontend_File_Upload
 * @subpackage Frontend_File_Upload/includes
 * @author     Bravo Six <rmkhan1996@hotmail.com>
 */
class Frontend_File_Upload_i18n
{


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain(
			'frontend-file-upload',
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
		);

	}



}
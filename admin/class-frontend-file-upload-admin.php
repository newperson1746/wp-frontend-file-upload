<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.fiverr.com/muneebkhan21
 * @since      1.0.0
 *
 * @package    Frontend_File_Upload
 * @subpackage Frontend_File_Upload/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Frontend_File_Upload
 * @subpackage Frontend_File_Upload/admin
 * @author     Bravo Six <rmkhan1996@hotmail.com>
 */
class Frontend_File_Upload_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action("admin_menu", array($this, "ffu_add_new_menu_items"));
		add_action('wp_ajax_ffu_file_delete_ajax', array($this, 'ffu_file_delete_ajax'));
		add_action('wp_ajax_nopriv_ffu_file_delete_ajax', array($this, 'ffu_file_delete_ajax'));


	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Frontend_File_Upload_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Frontend_File_Upload_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/frontend-file-upload-admin.css', array(), $this->version, 'all');

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Frontend_File_Upload_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Frontend_File_Upload_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/frontend-file-upload-admin.js', array('jquery'), $this->version, false);
		wp_localize_script($this->plugin_name, 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
		wp_enqueue_script($this->plugin_name);
	}

	public function ffu_add_new_menu_items()
	{
		add_menu_page(
			esc_html__("File Uploader"),
			esc_html__("File Uploader"),
			"manage_options",
			"ffu-options",
			array($this, "ffu_admin_menu_item"),
			"dashicons-plus-alt",
			100
		);
	}

	public function ffu_admin_menu_item()
	{
		global $wpdb;
		$res = $wpdb->get_results("select p1.post_content, p1.post_name, p1.post_mime_type, p1.guid
            FROM {$wpdb->posts} p1
            WHERE p1.post_type LIKE 'attachment'
        ");

		$path = wp_upload_dir()['path'];


		echo '<h2>File Uploader</h2>';

		echo '<div class="ffu_table_wrap">';
		echo '<table class="fb_table">';
		echo '  <head>';
		echo '      <th>';
		echo '          Username';
		echo '      </th>';
		echo '      <th>';
		echo '          Filename';
		echo '      </th>';
        echo '      <th>';
        echo '          mime-type';
        echo '      </th>';
		echo '      <th>';
		echo '          Downloadfile';
		echo '      </th>';
		echo '      <th>';
		echo '          Select';
		echo '      </th>';
		echo '  </head>';
		echo '  <body>';

		foreach ($res as $key => $value) {
			$value = (array) $value;
			$user_name = $value['post_content'];
			echo '<tr>';
			echo '  <td>' . esc_html($value['post_content']) . '</td>';
			echo '  <td>' . esc_html($value['post_name']) . '</td>';
			echo '  <td>' . esc_html($value['post_mime_type']) . '</td>';
			echo '  <td><a href="' . esc_html($value['guid']) . '" target="_blank"><button>Download</button></a></td>';
			echo '  <td><input type="checkbox" name="ffu_files" value="' . esc_html($value["post_name"]) . '" /></td>';
			echo '</tr>';
		}

		echo '  </body>';
		echo '</table>';
		echo '</div>';
		echo '<br />';
		echo '<br />';
		echo '<div class="ffu_delete_button_wrap">';
		echo '<button class="btn btn-danger" id="ffu-delete-button">Delete</button>';
		echo '</div>';
	}

	public function ffu_file_delete_ajax()
	{
		global $wpdb;
		$checked = rest_sanitize_array($_REQUEST['checked']);
		// var_dump($_REQUEST['checked']);
		// var_dump($checked);
		// die;
		for ($i = 0; $i < sizeof($checked); $i++) {
			$wpdb->delete($wpdb->posts, array('post_name' => $checked[$i]));
		}

		echo $checked;
		die;
	}

}

<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.fiverr.com/muneebkhan21
 * @since      1.0.0
 *
 * @package    Frontend_File_Upload
 * @subpackage Frontend_File_Upload/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Frontend_File_Upload
 * @subpackage Frontend_File_Upload/public
 * @author     Bravo Six <rmkhan1996@hotmail.com>
 */
class Frontend_File_Upload_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode('ffu-shortcode', array($this, 'ffu_file_upload_shortcode'));
		add_action('template_redirect', array($this, 'ffu_file_store'));

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/frontend-file-upload-public.css', array(), $this->version, 'all');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/frontend-file-upload-public.js', array('jquery'), $this->version, false);

	}

	public function ffu_file_upload_shortcode()
	{
		$output = '<form method="post" enctype="multipart/form-data">';
		$output .= ' <h4>Enter Details and Upload File</h4><br>';
		$output .= ' <div class="ffu-input-details">';
		$output .= '     <label>Enter Andrew ID</label>';
		$output .= '     <input type="text" id="ffu-user-name" name="ffu_user_name" class="ffu_user_name" required/> <br>';
		$output .= ' </div>';
		$output .= ' <div class="ffu-input-details">';
		$output .= '     <input type="file" name="fileToUpload[]" id="fileToUpload" multiple/><br>';
		$output .= ' </div>';
		$output .= ' <div class="ffu-input-details">';
		$output .= '     <input type="submit" name="submit" id="ffu-submit" value="Upload File" name="submit" />';
		$output .= ' </div>';
		$output .= '</form>';
		return $output;
	}

	public function ffu_file_store()
	{
		$upload_overrides = array('test_form' => false);
		if (isset($_FILES['fileToUpload'])) {
			$files = $_FILES['fileToUpload'];
			if (strlen($_FILES['fileToUpload']['error'][0] > 0)) {
				echo 'Muneeb';
			} else {
				if ($_FILES) {
					$files = $_FILES['fileToUpload'];
					foreach ($files['name'] as $key => $value) {
						if ($files['name'][$key]) {
							$file = array(
								'name' => $files['name'][$key],
								'type' => $files['type'][$key],
								'tmp_name' => $files['tmp_name'][$key],
								'error' => $files['error'][$key],
								'size' => $files['size'][$key]
							);
							$_FILES = array("fileToUpload" => $file);
							foreach ($_FILES as $file => $array) {
								$this->ffu_file_store_single($file, $_POST['ffu_user_name']);
							}
						}
					}
				}
			}
		}
	}

	public function ffu_file_store_single($file, $name)
	{

		require_once(ABSPATH . 'wp-admin/includes/image.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/media.php');

		$check = media_handle_upload($file, 0, array('post_content' => $name));

	}

}

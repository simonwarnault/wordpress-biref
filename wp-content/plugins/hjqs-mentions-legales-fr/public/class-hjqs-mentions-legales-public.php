<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Hjqs_Mentions_Legales
 * @subpackage Hjqs_Mentions_Legales/public
 * @author     Your Name <email@example.com>
 */
class Hjqs_Mentions_Legales_Public {

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
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hjqs_Mentions_Legales_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hjqs_Mentions_Legales_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hjqs-mentions-legales-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hjqs_Mentions_Legales_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hjqs_Mentions_Legales_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hjqs-mentions-legales-public.js', array( 'jquery' ), $this->version, false );

	}

	public function active_shortcode(){
		add_shortcode('hjqs_ml', [$this, 'render_mentions_legales']);
		add_shortcode('hjqs_cgv', [$this, 'render_cgv']);
		add_shortcode('hjqs_pdc', [$this, 'render_pdc']);
	}


	/**
	 * Display Mentions légales
	 *
	 * @since 1.0.0
	 */
	public function render_mentions_legales(){
		ob_start();
		include plugin_dir_path( __FILE__ ) . 'partials/hjqs-mentions-legales-public-ml.php';
		return ob_get_clean();
	}

	/**
	 * Display Conditions générales de vente
	 *
	 * @since 1.0.0
	 */
	public function render_cgv(){
		ob_start();
		include plugin_dir_path( __FILE__ ) . 'partials/hjqs-mentions-legales-public-cgv.php';
		return ob_get_clean();
	}

	/**
	 * Display Politique de confidentialité
	 *
	 * @since 1.0.0
	 */
	public function render_pdc(){
		ob_start();
		include plugin_dir_path( __FILE__ ) . 'partials/hjqs-mentions-legales-public-pdc.php';
		return ob_get_clean();
	}
}

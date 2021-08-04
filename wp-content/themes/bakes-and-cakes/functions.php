<?php
/**
 * Bakes And Cakes functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bakes_And_Cakes
*/

$bakes_and_cakes_theme_data = wp_get_theme();
if( ! defined( 'BAKES_AND_CAKES_THEME_VERSION' ) ) define ( 'BAKES_AND_CAKES_THEME_VERSION', $bakes_and_cakes_theme_data->get( 'Version' ) );
if( ! defined( 'BAKES_AND_CAKES_THEME_NAME' ) ) define( 'BAKES_AND_CAKES_THEME_NAME', $bakes_and_cakes_theme_data->get( 'Name' ) );

if (!function_exists('bakes_and_cakes_setup')):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
*/
function bakes_and_cakes_setup() {
	/*
			* Make theme available for translation.
			* Translations can be filed in the /languages/ directory.
			* If you're building a theme based on Bakes And Cakes, use a find and replace
			* to change 'bakes-and-cakes' to the name of your theme in all the template files.
	*/
	load_theme_textdomain('bakes-and-cakes', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
			* Let WordPress manage the document title.
			* By adding theme support, we declare that this theme does not use a
			* hard-coded <title> tag in the document head, and expect WordPress to
			* provide it for us.
	*/
	add_theme_support('title-tag');

	/*
			* Enable support for Post Thumbnails on posts and pages.
			*
			* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support('post-thumbnails');

	/* Custom Logo */
	add_theme_support( 'custom-logo', array(
		'header-text' => array( 'site-title', 'site-description' ),
	) );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(array(
		'primary' => esc_html__('Primary', 'bakes-and-cakes'),
	));

	/*
			* Switch default core markup for search form, comment form, and comments
			* to output valid HTML5.
	*/
	add_theme_support('html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	));

	/*
			* Enable support for Post Formats.
			* See https://developer.wordpress.org/themes/functionality/post-formats/
	*/
	add_theme_support('post-formats', array(
		'aside',
		'status',
		'video',
		'quote',
		'link',
	));

	// show excerpt in page 
	add_post_type_support( 'page', 'excerpt' );

	// Set up the WordPress core custom background feature.
	add_theme_support('custom-background', apply_filters('bakes_and_cakes_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	)));

	//Custom Image Sizes
	add_image_size('bakes-and-cakes-post-thumb', 60, 60, true);
	add_image_size('bakes-and-cakes-about-thumb', 600, 400, true);
	add_image_size('bakes-and-cakes-product-thumb', 235, 235, true);
	add_image_size('bakes-and-cakes-slider', 1920, 500, true);
	add_image_size('bakes-and-cakes-image-full', 1139, 498, true);
	add_image_size('bakes-and-cakes-image', 750, 400, true);
	add_image_size('bakes-and-cakes-staff-thumb', 487, 527, true);
	add_image_size('bakes-and-cakes-blog-thumb', 280, 255, true);
	add_image_size('bakes-and-cakes-events-thumb', 255, 255, true);
	add_image_size('bakes-and-cakes-schema', 600, 60, true);
}
endif;
add_action('after_setup_theme', 'bakes_and_cakes_setup');

/**
 * Return sidebar layouts for pages
*/
function bakes_and_cakes_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'bakes_and_cakes_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'bakes_and_cakes_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bakes_and_cakes_content_width() {
	$GLOBALS['content_width'] = apply_filters('bakes_and_cakes_content_width', 750);
}
add_action('after_setup_theme', 'bakes_and_cakes_content_width', 0);

/**
* Adjust content_width value according to template.
*
* @return void
*/
function bakes_and_cakes_template_redirect_content_width() {     
	// Full Width in the absence of sidebar.
	if( is_page() ){
	   $sidebar_layout = bakes_and_cakes_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) ) ) $GLOBALS['content_width'] = 1170;
        
	}elseif ( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
		$GLOBALS['content_width'] = 1170;
	}
}
add_action( 'template_redirect', 'bakes_and_cakes_template_redirect_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bakes_and_cakes_widgets_init() {
	register_sidebar(array(
		'name' => esc_html__('Right Sidebar', 'bakes-and-cakes'),
		'id' => 'right-sidebar',
		'description' => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => esc_html__('Google Map Widget', 'bakes-and-cakes'),
		'id' => 'google-map',
		'description' => __( 'Widget for Google map section( Use Text widget for Google Map ).','bakes-and-cakes'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer First', 'bakes-and-cakes'),
		'id' => 'footer-first',
		'description' => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer Second', 'bakes-and-cakes'),
		'id' => 'footer-second',
		'description' => __( 'Here you can use text widget to display Contact Form.','bakes-and-cakes'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer Third', 'bakes-and-cakes'),
		'id' => 'footer-third',
		'description' => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}
add_action('widgets_init', 'bakes_and_cakes_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function bakes_and_cakes_scripts() {
	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	
	wp_enqueue_style( 'animate', get_template_directory_uri( ). '/css' . $build . '/animate' . $suffix . '.css' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri( ). '/css' . $build . '/owl.carousel' . $suffix . '.css' );
	wp_enqueue_style( 'bakes-and-cakes-google-fonts', bakes_and_cakes_fonts_url() );
	wp_enqueue_style( 'bakes-and-cakes-style', get_stylesheet_uri(), array(), BAKES_AND_CAKES_THEME_VERSION );
	
	if( bakes_and_cakes_is_woocommerce_activated() )
    wp_enqueue_style( 'bakes-and-cakes-woocommerce-style', get_template_directory_uri(). '/css' . $build . '/woocommerce' . $suffix . '.css', array('bakes-and-cakes-style'), BAKES_AND_CAKES_THEME_VERSION );
 
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array('jquery'), '2.2.1', true);
    wp_enqueue_script( 'owlcarousel2-a11ylayer', get_template_directory_uri() . '/js' . $build . '/owlcarousel2-a11ylayer' . $suffix . '.js', array('owl-carousel'), '0.2.1', true );
	wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );
    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '5.6.3', true );
    wp_enqueue_script( 'bakes-and-cakes-modal-accessibility', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ), BAKES_AND_CAKES_THEME_VERSION, true );
	wp_register_script( 'bakes-and-cakes-custom', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array('jquery'), BAKES_AND_CAKES_THEME_VERSION, true);
	
    $slider_auto      = get_theme_mod( 'bakes_and_cakes_slider_auto', '1' );
    $slider_loop      = get_theme_mod( 'bakes_and_cakes_slider_loop', '1' );
    $slider_pager     = get_theme_mod( 'bakes_and_cakes_slider_control', '1' );    
    $slider_animation = get_theme_mod( 'bakes_and_cakes_slider_animation', 'slide' );
    $slider_speed     = get_theme_mod( 'bakes_and_cakes_slider_speed', '7000' );
    $animation_speed  = get_theme_mod( 'bakes_and_cakes_animation_speed', '600' );
    
    $array = array(
        'auto'      => esc_attr( $slider_auto ),
        'loop'      => esc_attr( $slider_loop ),
        'pager'     => esc_attr( $slider_pager ),
        'animation' => esc_attr( $slider_animation ),
        'speed'     => absint( $slider_speed ),
        'a_speed'   => absint( $animation_speed ),
        'url'       => admin_url( 'admin-ajax.php' ),
        'rtl'       => is_rtl(),
    );
    
    wp_localize_script( 'bakes-and-cakes-custom', 'bakes_and_cakes_data', $array );
    wp_enqueue_script( 'bakes-and-cakes-custom' );

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'bakes_and_cakes_scripts');

function bakes_and_cakes_admin_scripts() {
	wp_enqueue_style( 'bakes-and-cakes-admin-style',get_template_directory_uri().'/inc/css/admin.css','', BAKES_AND_CAKES_THEME_VERSION ); 
}
add_action( 'admin_enqueue_scripts', 'bakes_and_cakes_admin_scripts' );

if( ! function_exists( 'bakes_and_cakes_customizer_js' ) ) :
/** 
 * Registering and enqueuing scripts/stylesheets for Customizer controls.
 */ 
function bakes_and_cakes_customizer_js() {
    wp_enqueue_script( 'bakes-and-cakes-customizer-js', get_template_directory_uri() . '/inc/js/customizer.js', array('jquery'), BAKES_AND_CAKES_THEME_VERSION, true  );
}
endif;
add_action( 'customize_controls_enqueue_scripts', 'bakes_and_cakes_customizer_js' );


if ( ! function_exists( 'bakes_and_cakes_excerpt_more' ) ) :
/**
* Replaces "[...]" (appended to automatically generated excerpts) with ... * 
*/
function bakes_and_cakes_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'bakes_and_cakes_excerpt_more' );

if ( ! function_exists( 'bakes_and_cakes_excerpt_length' ) ) :
/**
* Changes the default 55 character in excerpt 
*/
function bakes_and_cakes_excerpt_length( $length ) {
	return is_admin() ? $length : 50;
}
endif;
add_filter( 'excerpt_length', 'bakes_and_cakes_excerpt_length', 999 );

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'bakes_and_cakes_is_woocommerce_activated' ) ) {	
	function bakes_and_cakes_is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Custom functions for meta box.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 *Rara Recent Post Widget.
 *
 */
require get_template_directory() . '/inc/widget-recent-post.php';

/**
 *Rara Popular Post Widget.
 *
 */
require get_template_directory() . '/inc/widget-popular-post.php';

/**
 *Social Media Widget.
 *
 */
require get_template_directory() . '/inc/widget-social-links.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Add theme compatibility function for woocommerce if active
*/
if( bakes_and_cakes_is_woocommerce_activated() ){
    require get_template_directory() . '/inc/woocommerce-functions.php';    
}

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Info Section
 */
require get_template_directory() . '/inc/info.php';

/**
 * Demo Content Section
 */
require get_template_directory() . '/inc/demo-content.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';

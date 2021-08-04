<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bakes_And_Cakes
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head itemscope itemtype="https://schema.org/WebSite">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'bakes-and-cakes' ); ?></a>
	<header id="masthead" class="site-header" role="banner" itemscope itemtype="https://schema.org/WPHeader">
	    <div class="header-t">
			  <div class="container">
				 <div class="site-branding" itemscope itemtype="https://schema.org/Organization">
    			<?php 
              if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                the_custom_logo();
              } ?>
              <div class="text-logo">
    			    <?php if ( is_front_page() ) : ?>
                  <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
              <?php else : ?>
                  <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
              <?php endif;
    			   $description = get_bloginfo( 'description', 'display' );
    			if ( $description || is_customize_preview() ) : ?>
    				<p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
    			<?php endif; ?>
        </div>
    		</div><!-- .site-branding -->
        <button class="menu-opener" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
          <span></span>
          <span></span>
          <span></span>
        </button>
			</div>
		</div>
    <div class="mobile-menu-wrapper">
      <nav id="mobile-site-navigation" class="main-navigation mobile-navigation">        
        <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
             <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
            <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'bakes-and-cakes' ); ?>">
                  <?php
                      wp_nav_menu( array(
                          'theme_location' => 'primary',
                          'menu_id'        => 'mobile-primary-menu',
                          'menu_class'     => 'nav-menu main-menu-modal',
                      ) );
                  ?>
            </div>
        </div>
      </nav><!-- #mobile-site-navigation -->
    </div>

		<nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

  <?php $enable_slider    = get_theme_mod('bakes_and_cakes_ed_slider');
        $enabled_sections = bakes_and_cakes_get_sections();  
        $ed_breadcrumbs   = get_theme_mod('bakes_and_cakes_ed_breadcrumb');
        
        if( (is_front_page() || is_page_template('template-home.php')) && $enable_slider ) {
          
          do_action('bakes_and_cakes_slider');
       
        }
        echo '<div id="acc-content">'; // added for accessibility purpose

        if( is_home() || ! $enabled_sections || ! ( is_front_page()  || is_page_template( 'template-home.php' ) ) ){ 
   	       
          echo '<div class="container">';
	          
            echo '<div id="content" class="site-content">'; 
              
              if($ed_breadcrumbs){ do_action('bakes_and_cakes_breadcrumbs'); }
        } ?>

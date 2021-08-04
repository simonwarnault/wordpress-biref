<?php 
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bakes And Cakes
*/

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bakes_and_cakes_body_classes( $classes ) {

    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if( is_404() ) {
      $classes[] = 'error';
    }

    // Adds a class of custom-background-image to sites with a custom background image.
    if ( get_background_image() ) {
        $classes[] = 'custom-background-image';
    }
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
        $classes[] = 'custom-background-color';
    }
       
    if( ! is_active_sidebar( 'right-sidebar' ) || is_page_template( 'template-home.php' ) || is_search()) {
        $classes[] = 'full-width'; 
    }

    if(is_page()){
        $bakes_and_cakes_post_class = bakes_and_cakes_sidebar_layout();
        if( $bakes_and_cakes_post_class == 'no-sidebar' )
            $classes[] = 'full-width';
    }
    if( bakes_and_cakes_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || 'product' === get_post_type() ) && ! is_active_sidebar( 'shop-sidebar' ) ){
      $classes[] = 'full-width';
    }

    return $classes;
}
add_filter( 'body_class', 'bakes_and_cakes_body_classes' );

/**
 * Custom Bread Crumb
 *
 * @link http://www.qualitytuts.com/wordpress-custom-breadcrumbs-without-plugin/
 */
 
function bakes_and_cakes_breadcrumbs_cb() {    
    global $post;
    
    $post_page   = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front  = get_option( 'show_on_front' ); //What to show on the front page
    $showCurrent = get_theme_mod( 'bakes_and_cakes_ed_current', '1' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $delimiter   = get_theme_mod( 'bakes_and_cakes_breadcrumb_separator', __( '>', 'bakes-and-cakes' ) ); // delimiter between crumbs
    $home        = get_theme_mod( 'bakes_and_cakes_breadcrumb_home_text', __( 'Home', 'bakes-and-cakes' ) ); // text for the 'Home' link
    $before      = '<span class="current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'; // tag before the current crumb
    $after       = '</span>'; // tag after the current crumb
      
    $depth = 1;    
    echo '<div id="crumbs" itemscope itemtype="https://schema.org/BreadcrumbList"><span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url() ) . '" class="home_crumb"><span itemprop="name">' . esc_html( $home ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
        if( is_home() && ! is_front_page() ){            
            $depth = 2;
            if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_post_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;          
        }elseif( is_category() ){            
            $depth = 2;
            $thisCat = get_category( get_query_var( 'cat' ), false );
            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $post_page ) ) . '"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;  
            }

            if ( $thisCat->parent != 0 ) {
                $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                $parent_categories = explode( ',', $parent_categories );

                foreach ( $parent_categories as $parent_term ) {
                    $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                    if( is_object( $parent_obj ) ){
                        $term_url    = get_term_link( $parent_obj->term_id );
                        $term_name   = $parent_obj->name;
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                        $depth ++;
                    }
                }
            }

            if( $showCurrent ) echo $before . '<span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;

        }elseif( is_tag() ){            
            $queried_object = get_queried_object();
            $depth = 2;

            if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_tag_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;    
        }elseif( is_author() ){            
            $depth = 2;
            global $author;
            $userdata = get_userdata( $author );
            if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $userdata->display_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;  
        }elseif( is_day() ){            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'bakes-and-cakes' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'bakes-and-cakes' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            $depth ++;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'bakes-and-cakes' ) ), get_the_time( __( 'm', 'bakes-and-cakes' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'bakes-and-cakes' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            $depth ++;
            if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'd', 'bakes-and-cakes' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
             
        }elseif( is_month() ){            
            $depth = 2;
            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'bakes-and-cakes' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'bakes-and-cakes' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            $depth++;
            if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'F', 'bakes-and-cakes' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
        }elseif( is_year() ){            
            $depth = 2;
            if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'bakes-and-cakes' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
        }elseif( is_single() && !is_attachment() ) {
            //For Woocommerce single product            
            if( bakes_and_cakes_is_woocommerce_activated() && 'product' === get_post_type() ){ 
                if ( wc_get_page_id( 'shop' ) ) { 
                    //Displaying Shop link in woocommerce archive page
                    $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                    if ( ! $_name ) {
                        $product_post_type = get_post_type_object( 'product' );
                        $_name = $product_post_type->labels->singular_name;
                    }
                    echo ' <a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name) . '</span></a> ' . '<span class="separator">' . $delimiter . '</span>';
                }
            
                if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                    $main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );

                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth++;
                        }
                    }
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $main_term ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $main_term->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                }
            
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                               
            }else{ 
                //For Post                
                $cat_object       = get_the_category();
                $potential_parent = 0;
                $depth            = 2;
                
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';  
                    $depth++;
                }
                
                if( is_array( $cat_object ) ){ //Getting category hierarchy if any
        
                    //Now try to find the deepest term of those that we know of
                    $use_term = key( $cat_object );
                    foreach( $cat_object as $key => $object ){
                        //Can't use the next($cat_object) trick since order is unknown
                        if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                            $use_term = $key;
                            $potential_parent = $object->term_id;
                        }
                    }
                    
                    $cat = $cat_object[$use_term];
              
                    $cats = get_category_parents( $cat, false, ',' );
                    $cats = explode( ',', $cats );

                    foreach ( $cats as $cat ) {
                        $cat_obj = get_term_by( 'name', $cat, 'category' );
                        if( is_object( $cat_obj ) ){
                            $term_url    = get_term_link( $cat_obj->term_id );
                            $term_name   = $cat_obj->name;
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth ++;
                        }
                    }
                }
    
                if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                             
            }        
        }elseif( is_page() ){            
            $depth = 2;
            if( $post->post_parent ){            
                global $post;
                $depth = 2;
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                
                while( $parent_id ){
                    $current_page  = get_post( $parent_id );
                    $breadcrumbs[] = $current_page->ID;
                    $parent_id     = $current_page->post_parent;
                }
                $breadcrumbs = array_reverse( $breadcrumbs );
                for ( $i = 0; $i < count( $breadcrumbs); $i++ ){
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>';
                    if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
                    $depth++;
                }

                if ( $showCurrent ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" /></span>'. $after;      
            }else{
                if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
            }
        }elseif( is_search() ){            
            $depth = 2;
            if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html__( 'Search Results for "', 'bakes-and-cakes' ) . esc_html( get_search_query() ) . esc_html__( '"', 'bakes-and-cakes' ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
        }elseif( bakes_and_cakes_is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){ 
            //For Woocommerce archive page        
            $depth = 2;
            if ( wc_get_page_id( 'shop' ) ) { 
                //Displaying Shop link in woocommerce archive page
                $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                if ( ! $_name ) {
                    $product_post_type = get_post_type_object( 'product' );
                    $_name = $product_post_type->labels->singular_name;
                }
                echo ' <a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name) . '</span></a> ' . '<span class="separator">' . $delimiter . '</span>';
            }
            $current_term = $GLOBALS['wp_query']->get_queried_object();
            if( is_product_category() ){
                $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                $ancestors = array_reverse( $ancestors );
                foreach ( $ancestors as $ancestor ) {
                    $ancestor = get_term( $ancestor, 'product_cat' );    
                    if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                        $depth ++;
                    }
                }
            }           
            if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $current_term->name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;           
        }elseif( bakes_and_cakes_is_woocommerce_activated() && is_shop() ){ //Shop Archive page
            $depth = 2;
            if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
                return;
            }
            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
            $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
    
            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }
            if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;                    
        }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {            
            $depth = 2;
            $post_type = get_post_type_object(get_post_type());
            if( get_query_var('paged') ){
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />';
                echo ' <span class="separator">' . $delimiter . '</span></span> ' . $before . sprintf( __('Page %s', 'bakes-and-cakes'), get_query_var('paged') ) . $after;
            }elseif( is_archive() ){
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }else{
                echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
            }              
        }elseif( is_attachment() ){            
            $depth  = 2;
            $parent = get_post( $post->post_parent );
            $cat    = get_the_category( $parent->ID );
            if( $cat ){
                $cat = $cat[0];
                echo get_category_parents( $cat, TRUE, ' <span class="separator">' . $delimiter . '</span> ');
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $parent->post_title ) . '<span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . ' <span class="separator">' . $delimiter . '</span></span>';
            }
            if( $showCurrent ) echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;   
        }elseif ( is_404() ){
            if( $showCurrent ) echo $before . esc_html__( '404 Error - Page not Found', 'bakes-and-cakes' ) . $after;
        }
        if( get_query_var('paged') ) echo __( ' (Page', 'bakes-and-cakes' ) . ' ' . get_query_var('paged') . __( ')', 'bakes-and-cakes' );        
        echo '</div>';
}   // end bakes_and_cakes_breadcrumbs()

add_action( 'bakes_and_cakes_breadcrumbs', 'bakes_and_cakes_breadcrumbs_cb' );

if( ! function_exists( 'bakes_and_cakes_slider_cb' )):
/**
 * Callback for Home Page Slider 
**/
function bakes_and_cakes_slider_cb(){
    
    $bakes_and_cakes_slider_caption  = get_theme_mod( 'bakes_and_cakes_slider_caption', '1' );
    $bakes_and_cakes_slider_readmore = get_theme_mod( 'bakes_and_cakes_slider_readmore', __( 'Continue Reading', 'bakes-and-cakes' ) );
    $bakes_and_cakes_slider_cat      = get_theme_mod( 'bakes_and_cakes_slider_cat' );
    
    if( $bakes_and_cakes_slider_cat ){
        $bakes_and_cakes_qry = new WP_Query ( array( 
            'post_type'     => 'post', 
            'post_status'   => 'publish',
            'posts_per_page'=> -1,                    
            'cat'           => $bakes_and_cakes_slider_cat,
            'order'         => 'ASC'
        ) );
        
        if( $bakes_and_cakes_qry->have_posts() ){?>
           <div class="banner">
                 <ul id="slider" class="owl-carousel">
                    <?php
                    while( $bakes_and_cakes_qry->have_posts() ){
                        $bakes_and_cakes_qry->the_post();
                        $bakes_and_cakes_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'bakes-and-cakes-slider' );
                    ?>
                        <?php if( has_post_thumbnail() ){?>
                        <li>
                            <img src="<?php echo esc_url( $bakes_and_cakes_image[0] ); ?>" alt="<?php the_title_attribute(); ?>" />
                            <?php if( $bakes_and_cakes_slider_caption ){ ?>
                            <div class="banner-text">
                                <div class="container">
                                    <div class="text">
                                        <strong class="title"><?php the_title(); ?></strong>
                                        <?php the_excerpt(); ?>
                                        <a class="btn" href="<?php the_permalink(); ?>"><?php echo esc_html( $bakes_and_cakes_slider_readmore );?></a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </li>
                        <?php } ?>
                    <?php
                    }
                    ?>
                    </ul>
                </div>
            <?php
        }
        wp_reset_postdata();       
    }    
 }

endif;

add_action( 'bakes_and_cakes_slider', 'bakes_and_cakes_slider_cb' );


function bakes_and_cakes_get_sections(){

    $bakes_and_cakes_sections = array(
            
            'about-section' => array(
                'id' => 'about',
                'class' => 'intro'
              ),

            'product-section' => array(
                'id' => 'product',
                'class' => 'featured'
              ),

            'events-section' => array(
                'id' => 'events',
                'class' => 'special'
              ),

            'our-staff-section' => array(
                'id' => 'staff',
                'class' => 'our-staff'
              ),

            'testimonial-section' => array(
                'id' => 'testimonials',
                'class' => 'testimonial'
              ),

            'blog-section' => array(
                'id' => 'blog',
                'class' => 'blog-section'
              ),

            'promotional-section' => array(
                'id' => 'promotional',
                'class' => 'promotional-block'
              ),
      );
    $bakes_and_cakes_enabled_section = array();
    foreach ( $bakes_and_cakes_sections as $bakes_and_cakes_section ) {
        
        if ( esc_attr( get_theme_mod( 'bakes_and_cakes_ed_' . $bakes_and_cakes_section['id'] . '_section' ) ) == 1 ){
            $bakes_and_cakes_enabled_section[] = array(
                'id' => $bakes_and_cakes_section['id'],
                'class' => $bakes_and_cakes_section['class']
            );
        }
    }
    return $bakes_and_cakes_enabled_section;
  }

function bakes_and_cakes_bg_image_settings(){

       $bakes_and_cakes_bg_images = array(
         
        'staff-section' => array(
            'bgimage' => 'staff'
        ),

        'promotional-section' => array(
            'bgimage' => 'promotional'
        ) 
      );
    $bakes_and_cakes_bg = array();
    foreach($bakes_and_cakes_bg_images as $bakes_and_cakes_bg_image){
    
    if( get_theme_mod( 'bakes_and_cakes_' . $bakes_and_cakes_bg_image['bgimage'] . '_background_image' ) ){
       $bakes_and_cakes_bg[] = array(
        'bgimage' => $bakes_and_cakes_bg_image['bgimage']
        );
    }
  }
  return  $bakes_and_cakes_bg;
 }

if( ! function_exists( 'bakes_and_cakes_footer_top' ) ) :
/**
 * Footer Top
 *  
*/
function bakes_and_cakes_footer_top(){
    ?>
    <div class="footer-t">
        <div class="row">
            <div class="three-cols">
                <div class="col">   
                    <?php  
                    if (is_active_sidebar('footer-first')) {
                        dynamic_sidebar('footer-first');
                    } ?>
                </div>
                <div class="col center">   
                    <section class="widget widget_contact_form">    
                    <?php   
                        if (is_active_sidebar('footer-second')) { ?>
                            <div class="form-holder"> 
                                <?php dynamic_sidebar('footer-second'); ?>
                            </div>
                    <?php } ?>
                    </section>
                </div>
                <div class="col">
                    <?php if (is_active_sidebar('footer-third')) {
                            dynamic_sidebar('footer-third');
                        } ?>
                </div>
            </div>    
        </div>
    </div>
<?php
}
endif;
add_action( 'bakes_and_cakes_footer_top', 'bakes_and_cakes_footer_top' );

if( ! function_exists( 'bakes_and_cakes_footer_info' ) ) :
/**
 * Footer Info
 * 
*/
function bakes_and_cakes_footer_info(){
    $copyright_text = get_theme_mod( 'bakes_and_cakes_footer_copyright_text' );
    ?>
    <div class="site-info">        
        <span>
        <?php 
            if( $copyright_text ){
                echo wp_kses_post( $copyright_text );
            }else{
                esc_html_e( '&copy; ', 'bakes-and-cakes' ); 
                echo date_i18n( esc_html__( 'Y', 'bakes-and-cakes' ) );
                echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>.';    
            }
        ?>
        </span>
        <?php echo esc_html__( 'Bakes and Cakes | Developed By', 'bakes-and-cakes' ); ?>
        <a href="<?php echo esc_url( 'https://rarathemes.com/' ); ?>" rel="nofollow" target="_blank">
            <?php echo esc_html__( 'Rara Theme', 'bakes-and-cakes' ); ?>
        </a>
        <?php printf(esc_html__('Powered by %s', 'bakes-and-cakes'), '<a href="' . esc_url(__('https://wordpress.org/', 'bakes-and-cakes')) . '">WordPress.</a>'); ?>

        <?php 
            if ( function_exists( 'the_privacy_policy_link' ) ) {
                the_privacy_policy_link( '<span class="policy_link">', '</span>');
            } 
        ?>

    </div><!-- .site-info -->
<?php
}
endif;
add_action( 'bakes_and_cakes_footer', 'bakes_and_cakes_footer_info' );

/**
 * Ajax Callback for Team section
*/
function bakes_and_cakes_home_team_ajax(){

    $id   = $_POST['id'];
    $staff_cat = get_theme_mod('bakes_and_cakes_staff_section_cat');
    $response  = '';

    $args = array( 
        'title'               => $id,
        'post_status'         => 'publish',
        'cat'                 => $staff_cat,    
        'ignore_sticky_posts' => true,
    );
    
    $bakes_and_cakes_qry = new WP_Query( $args );
    if( !empty( $id ) && $bakes_and_cakes_qry->have_posts() ){
        while( $bakes_and_cakes_qry->have_posts() ){ 
            $bakes_and_cakes_qry->the_post(); 
            
            $response .= '<div class="img-holder">';
            $response .= has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'bakes-and-cakes-staff-thumb' ) : bakes_and_cakes_get_fallback_svg( 'bakes-and-cakes-staff-thumb', false );
            $response .= '</div>';
            $response .= '<div class="text-holder">';
            $response .= '<strong class="name">' . esc_html( get_the_title() ) . '</strong>';
            $response .= wpautop(  wp_kses_post( get_the_content() ) );
            $response .= '</div>';   

            
        }
        wp_reset_postdata(); 
    }
    echo $response;
    
    wp_die();
}
add_action( 'wp_ajax_bakes_and_cakes_team_ajax', 'bakes_and_cakes_home_team_ajax' );
add_action( 'wp_ajax_nopriv_bakes_and_cakes_team_ajax', 'bakes_and_cakes_home_team_ajax' ); 

/**
 * Query if Rara One Click Demo Import id activate
*/
function is_rocdi_activated(){
    return class_exists( 'RDDI_init' ) ? true : false;
}

if( ! function_exists( 'bakes_and_cakes_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function bakes_and_cakes_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'bakes-and-cakes' ) : __( 'Name', 'bakes-and-cakes' ) );
    $email    = ( $req ? __( 'Email*', 'bakes-and-cakes' ) : __( 'Email', 'bakes-and-cakes' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'bakes-and-cakes' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'bakes-and-cakes' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'bakes-and-cakes' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'bakes-and-cakes' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'bakes_and_cakes_change_comment_form_default_fields' );

if( ! function_exists( 'bakes_and_cakes_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function bakes_and_cakes_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'bakes-and-cakes' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'bakes-and-cakes' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'bakes_and_cakes_change_comment_form_defaults' );

if( ! function_exists( 'bakes_and_cakes_single_post_schema' ) ) :
/**
 * Single Post Schema
 *
 * @return string
 */
function bakes_and_cakes_single_post_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'bakes-and-cakes-schema' );
        $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $excerpt     = bakes_and_cakes_escape_text_tags( $post->post_excerpt );
        $content     = $excerpt === "" ? mb_substr( bakes_and_cakes_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
        $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

        $args = array(
            "@context"  => "https://schema.org",
            "@type"     => $schema_type,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id"   => esc_url( get_permalink( $post->ID ) )
            ),
            "headline"      => esc_html( get_the_title( $post->ID ) ),
            "datePublished" => esc_html( get_the_time( DATE_ISO8601, $post->ID ) ),
            "dateModified"  => esc_html( get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ) ),
            "author"        => array(
                "@type"     => "Person",
                "name"      => bakes_and_cakes_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
            ),
            "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
        );

        if ( has_post_thumbnail( $post->ID ) ) :
            $args['image'] = array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            );
        endif;

        if ( ! empty( $custom_logo_id ) ) :
            $args['publisher'] = array(
                "@type"       => "Organization",
                "name"        => esc_html( get_bloginfo( 'name' ) ),
                "description" => wp_kses_post( get_bloginfo( 'description' ) ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            );
        endif;

        echo '<script type="application/ld+json">' , PHP_EOL;
        if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
            echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) , PHP_EOL;
        } else {
            echo wp_json_encode( $args ) , PHP_EOL;
        }
        echo '</script>' , PHP_EOL;
    }
}
endif;
add_action( 'wp_head', 'bakes_and_cakes_single_post_schema' );

if( ! function_exists( 'bakes_and_cakes_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function bakes_and_cakes_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'bakes_and_cakes_admin_notice' ) ) :
/**
 * Admin notice for getting started page
*/
function bakes_and_cakes_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'bakes_and_cakes_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'bakes-and-cakes' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'bakes-and-cakes' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=bakes-and-cakes-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'bakes-and-cakes' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?bakes_and_cakes_admin_notice=1"><?php esc_html_e( 'Dismiss', 'bakes-and-cakes' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'bakes_and_cakes_admin_notice' );

if( ! function_exists( 'bakes_and_cakes_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function bakes_and_cakes_update_admin_notice(){
    if ( isset( $_GET['bakes_and_cakes_admin_notice'] ) && $_GET['bakes_and_cakes_admin_notice'] = '1' ) {
        update_option( 'bakes_and_cakes_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'bakes_and_cakes_update_admin_notice' );

if( ! function_exists( 'bakes_and_cakes_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function bakes_and_cakes_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'bakes_and_cakes_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function bakes_and_cakes_get_fallback_svg( $post_thumbnail, $echo = true ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = bakes_and_cakes_get_image_sizes( $post_thumbnail );
     
    if( $image_size && $echo ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#dad5d5;"></rect>
            </svg>
        </div>
        <?php
    }else{
        $image_size_return = '<div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 ' . esc_attr( $image_size['width'] ) .' '. esc_attr( $image_size['height'] ) .'" preserveAspectRatio="none">
             <rect width="'. esc_attr( $image_size['width'] ) .' " height=" '.esc_attr( $image_size['height'] ). ' " style="fill:#dad5d5;"></rect>
            </svg>
        </div>';

        return $image_size_return;
    }
}
endif;

/**
 * Function to exclude posts in blog index page
 */
function bakes_and_cakes_exclude_posts_for_blogpage( $query ) {
    $show_on_front   = get_option( 'show_on_front' );
    $ed_slider       = get_theme_mod( 'bakes_and_cakes_ed_slider' );
	$slider_category = get_theme_mod( 'bakes_and_cakes_slider_cat' );

    if ( ! is_admin() && $query->is_home() && $query->is_main_query() && $ed_slider && 'posts' == $show_on_front ) {
        if( $slider_category ){
            $query->set( 'category__not_in', $slider_category );
        }
    }
}
add_action( 'pre_get_posts', 'bakes_and_cakes_exclude_posts_for_blogpage' );
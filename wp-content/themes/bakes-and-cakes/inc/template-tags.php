<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bakes_And_Cakes
 */

if ( ! function_exists( 'bakes_and_cakes_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function bakes_and_cakes_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )

	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
    
        $categories_list = get_the_category_list( esc_html__( ', ', 'bakes-and-cakes' ) );
		if ( $categories_list && bakes_and_cakes_categorized_blog() ) {
			echo '<span class="tags">' . $categories_list . '</span>'; // WPCS: XSS OK.
		}
}
endif;

if ( ! function_exists( 'bakes_and_cakes_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function bakes_and_cakes_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() && is_single() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'bakes-and-cakes' ) );
		if ( $tags_list ) {
			echo '<span class="tags-links"><i class="fa fa-tags" aria-hidden="true"></i>' . $tags_list . '</span>'; // WPCS: XSS OK.
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'bakes-and-cakes' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function bakes_and_cakes_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'bakes_and_cakes_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'bakes_and_cakes_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so bakes_and_cakes_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so bakes_and_cakes_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in bakes_and_cakes_categorized_blog.
 */
function bakes_and_cakes_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'bakes_and_cakes_categories' );
}
add_action( 'edit_category', 'bakes_and_cakes_category_transient_flusher' );
add_action( 'save_post',     'bakes_and_cakes_category_transient_flusher' );

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

if( ! function_exists( 'bakes_and_cakes_fonts_url' ) ) :
/**
 * Register custom fonts.
 */
function bakes_and_cakes_fonts_url() {
	$fonts_url = '';

	/*
	* translators: If there are characters in your language that are not supported
	* by Open Sans, translate this to 'off'. Do not translate into your own language.
	*/
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'bakes-and-cakes' );
	
	/*
	* translators: If there are characters in your language that are not supported
	* by Niconne, translate this to 'off'. Do not translate into your own language.
	*/
	$lato = _x( 'on', 'Niconne font: on or off', 'bakes-and-cakes' );

	if ( 'off' !== $open_sans || 'off' !== $lato ) {
		$font_families = array();

		if( 'off' !== $open_sans ){
			$font_families[] = 'Open Sans:400,400italic,700';
		}

		if( 'off' !== $lato ){
			$font_families[] = 'Niconne';
		}

		$query_args = array(
			'family'  => urlencode( implode( '|', $font_families ) ),
			'display' => urlencode( 'fallback' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url( $fonts_url );
}
endif;
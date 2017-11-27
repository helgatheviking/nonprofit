<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

define( 'FL_CHILD_VERSION', '1.1.0' );


/**
 * Theme Setup
 */
add_action( 'after_setup_theme', 'nonprofit_setup' );
function nonprofit_setup(){

	// load childtheme text domain
	load_child_theme_textdomain( 'non-profit', get_stylesheet_directory() . '/languages' );

	// add post-formats 
	add_theme_support( 'post-formats', array( 'link', 'video', 'image' ) );

	// add custom images
	add_image_size( 'banner', 1080, 450, true );
	if( class_exists( 'Woothemes_Features' ) ){
		add_image_size( 'feature-thumbnail', 9999, 50 ); 
	}
	if( function_exists( 'Woothemes_Our_Team' ) ){
		add_image_size( 'team-thumbnail', 350, 350, true );	
	}
	add_image_size( 'news-thumbnail', 350, 250, true );
	add_image_size( 'facebook-thumbnail', 600, 315, true );
}



/**
 * Enqueue styles and scripts.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function nonprofit_scripts() {
	$suffix = SCRIPT_DEBUG || WP_DEBUG ? '' : '.min';
	wp_enqueue_style( 'main-style',  get_stylesheet_directory_uri() . '/style' . $suffix . '.css' );
}
add_action( 'wp_enqueue_scripts', 'nonprofit_scripts', 20 );



/* **********************************************
   Features by WooThemes
 ************************************************/

add_filter( 'woothemes_features_item_template', 'nonprofit_features_item_template', 10, 2 );
function nonprofit_features_item_template($tpl, $args){
  if( isset( $args['category'] ) ){
		$tpl = '<div class="%%CLASS%%">%%IMAGE%%</div>';
	} 
	return $tpl;
}

add_filter( 'woothemes_features_template', 'nonprofit_features_template', 10, 2 );
function nonprofit_features_template($html, $post){
	$html = str_replace( 'href=', 'target="_blank" href=', $html );
	return $html;
}


add_filter( 'woothemes_features_image_size', 'nonprofit_features_thumbnail_size', 10, 2 );
function nonprofit_features_thumbnail_size($size, $post){
	return 'feature_thumbnail';
}


/* **********************************************
   Our Team by WooThemes
 ************************************************/

// use specific thumbnail
add_filter( 'woothemes_get_our_team_args', 'nonprofit_our_team_thumbnail_size', 10, 2 );
function nonprofit_our_team_thumbnail_size( $args ){
	$args['size'] = 'team-thumbnail';
	return $args;
}

// use a different template for the single team member
add_filter( 'make_template_content_single', 'nonprofit_template_content_single', 10, 2 );
function nonprofit_template_content_single( $template, $post ){
	if( 'team-member' == get_post_type( $post ) ){
		$template = 'single-team-member';
	}
	return $template;
}

/* **********************************************
   WooCommerce
 ************************************************/




/* **********************************************
   Facebook Photo Fetcher
 ************************************************/

// remove credit text
add_filter( 'fpf_default_albumparams', 'nonprofit_hide_facebook_photo_fetcher_cred' );
function nonprofit_hide_facebook_photo_fetcher_cred( $args ){
	$args['hideCred'] = true;
	return $args;
}


/* **********************************************
	WordPress SEO by Yoast
 ************************************************/

// remove credit text
add_filter( 'wpseo_opengraph_image_size', 'nonprofit_wpseo_opengraph_image_size' );
function nonprofit_wpseo_opengraph_image_size( $size ){
	return 'facebook-thumbnail';
}


/* **********************************************
   Beaver Builder
 ************************************************/

// fix BB available sizes
add_filter( 'image_size_names_choose', 'nonprofit_custom_sizes' );
function nonprofit_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'banner' => __( 'Banner', 'non-profit' ),
    ) );
}

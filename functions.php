<?php

// Add google font icons
add_action('wp_head', function() {
	echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />';
	// add font "Oswald"
	echo '<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;700&display=swap" rel="stylesheet">';
});

// add customize javascript
add_action('wp_enqueue_scripts', function(){
	if(!is_front_page() && !is_home() && !is_archive() && !is_single()) {
		wp_register_script('about-us-page', get_stylesheet_directory_uri() . '/js/about-us-page.js', array('jquery'), '0.0.3', true);
		wp_enqueue_script('about-us-page');
	}
	if(is_home() || is_archive() ) {
		// if have change need to use version from 0.1.5
		wp_register_script('blog-relative-page', get_stylesheet_directory_uri() . '/js/blog-relative-page.js', array('jquery'), '0.1.4', true);
		wp_enqueue_script('blog-relative-page');
	}
	wp_register_script('sticky-social-box', get_stylesheet_directory_uri() . '/js/sticky-social-box.js', array('jquery'), '0.0.4', true);
	wp_enqueue_script('sticky-social-box');
	if(is_single()) {
		wp_register_script('book-givingaway-event', get_stylesheet_directory_uri() . '/js/book-givingaway-event.js', array('jquery'), '0.0.1', true);
		wp_enqueue_script('book-givingaway-event');
	}
});

// JS for admin dashboard
add_action('admin_enqueue_scripts', function(){
	if(is_admin()){
		wp_register_script('script-for-wp-admin', get_stylesheet_directory_uri() . '/js/script-for-wp-admin.js', array('jquery'), '0.0.2', true);
		wp_enqueue_script('script-for-wp-admin');
	}
});

// Turn off auto gen <p> of contact form 7
add_filter('wpcf7_autop_or_not', false);

// Add posted date under title in blog homepage
add_filter('the_title', function ($title, $id) {
    // Check if we are on the blog homepage and the post type is 'post'
    if ((is_home() || is_archive()) && get_post_type($id) === 'post') {
        $post_date = get_the_date('d/m/Y', $id); // Get the post creation date
        $title .= '<div class="post-date">' . $post_date . '</div>';
    }
    return $title;
}, 10, 2);

// Change "Sản phẩm tương tự" title in single product to
add_filter('woocommerce_product_related_products_heading', function(){
	return "Dự án tương tự";
});

// Include other php
include('custom-shortcodes.php');
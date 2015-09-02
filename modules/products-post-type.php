<?php
/*=============================================
=          Create Review Post Type           =
=============================================*/
function review_post_type() {
	register_taxonomy_for_object_type('category', 'Products');
	register_post_type('Products',
		array(
			'labels' => array(
				'name'               => __('Products', 'Products'),
				'singular_name'      => __('Review', 'Products'),
				'add_new'            => __('Add New', 'Products'),
				'add_new_item'       => __('Add New Review', 'Products'),
				'edit'               => __('Edit', 'Products'),
				'edit_item'          => __('Edit Review', 'Products'),
				'new_item'           => __('New Review', 'Products'),
				'view'               => __('View Review', 'Products'),
				'view_item'          => __('View Review', 'Products'),
				'search_items'       => __('Search Review', 'Products'),
				'not_found'          => __('No Review Posts found', 'Products'),
				'not_found_in_trash' => __('No Review Posts found in Trash', 'Products'),
			),
			'public'       => true,
			'hierarchical' => true,
			'has_archive'  => true,
			'supports'     => array(
				'title',
				'editor',
				'thumbnail',
			),
			'can_export' => true,
			'taxonomies' => array(
				'category',
			),
			'menu_icon'         => 'dashicons-welcome-write-blog',
			'capability_type'   => 'post',
			'show_in_nav_menus' => true,
		));
}
add_action('init', 'review_post_type');
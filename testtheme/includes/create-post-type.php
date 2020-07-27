<?php
    add_action( 'init', 'caitheme_header_menu_create_post_type' );
    function caitheme_header_menu_create_post_type(){

        register_post_type( 'slides',
	        array(
	            'labels' => array(
	                'name' => 'Slides',
	                'singular_name' => 'Slides',
	                /*'add_new' => 'Add slide',
	                'add_new_item' => 'Add slide',
	                'edit' => 'Edit',
	                'edit_item' => 'Edit',
	                'new_item' => 'New slide',
	                'view' => 'View slide',
	                'view_item' => 'View slide',
	                'search_items' => 'Search',
	                'not_found' => 'Slides not found',
	                'not_found_in_trash' => 'Slides not found',
	                'parent' => 'Parent slide'*/
	            ),
				'public' => true,
	            'publicly_queryable' => false,
	            'menu_icon' => 'dashicons-images-alt2',
	            'menu_position' => 15,
	            'supports' => array( 'title', 'editor', 'thumbnail'),
	            'taxonomies' => array( 'post' ),
				'has_archive' => false,
	            'query_posts' => false,
	            'query_var' => false,
	            'rewrite' => false
	        )
	    );

    }
?>

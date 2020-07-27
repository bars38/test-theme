<?php
	/* Clean wordpress head and footer */
	require_once locate_template('/includes/remove-wordpress-code.php');          		// Options framework
	/* Create post type */
	require_once locate_template('/includes/create-post-type.php');
	/*  Ajax functions */
	//require_once locate_template('/includes/ajax.php');
	/*  Social meta */
	//require_once locate_template('/includes/social-meta.php');
	/*  Widgets */
	//require_once locate_template('/includes/widget.php');

	add_action('after_setup_theme','testtheme_after_setup');

	function testtheme_after_setup(){
		/* Register menu */
		register_nav_menus( array(
			'header_menu' => __( 'Main menu', 'testtheme' ),
		) );


		/* Add theme thumbnail size */
		add_theme_support('post-thumbnails');

		add_theme_support('automatic-feed-links');
		add_theme_support('custom-background');
		add_theme_support('custom-header');
		add_theme_support('title-tag');
	}
	add_image_size('page_slide_thumb', 1920, 900, true);
	add_image_size('post_medium', 300, 200, array( 'center', 'center' ) );
	add_image_size('post_max_medium', 600, 500, array( 'center', 'center' ) );

	function testtheme_scripts(){
		wp_deregister_style( 'open-sans' );
		wp_enqueue_style('style_css', esc_url( get_template_directory_uri() ).'/assets/css/style.css');
		wp_enqueue_style('responsive_css', esc_url( get_template_directory_uri() ).'/assets/css/responsive.css');

		wp_deregister_script('jquery');
		wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', '', '', false);
		//wp_enqueue_script('jquery_ui', 'https://code.jquery.com/ui/1.12.0/jquery-ui.js', '', '', true);
		wp_enqueue_script('testtheme_bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', '', '', true);
		wp_enqueue_script('testtheme_global', esc_url( get_template_directory_uri() ).'/assets/js/global.js', '', '', true);
		wp_enqueue_script('ajax_event', esc_url( get_template_directory_uri() ).'/assets/js/ajax.js', '', '', true);
		$translation_array = array( 'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-nonce') );
		wp_localize_script('ajax_event', 'object_url', $translation_array);

	}
	add_action('wp_enqueue_scripts','testtheme_scripts');

	function testtheme_footer_style(){
		wp_enqueue_style('bootstrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', false);
	}
	add_action( 'get_footer', 'testtheme_footer_style' );

	function testtheme_header_menu(){
		if ( has_nav_menu( 'header_menu' ) ){
			$settings = array(
				'theme_location' => 'header_menu',
				'container'      => '',
				'container_class'=> '',
				'container_id'   => 'main-menu',
				'menu_class'     => 'navbar-nav justify-content-end'
			);
			wp_nav_menu($settings);
		} else {
			echo '<span class="no-menu">Please, create menu <a href="' . esc_url(admin_url('nav-menus.php')) . '" target="_blank">Menu</a></span>';
		}
	}



//  ----------------------------------------------

// Add menu in customizer
function true_customizer_init( $wp_customize ) {

	$true_transport = 'tstMessage';


	// Adding section
	$wp_customize->add_section(
		'true_display_options',
		array(
			'title'     => 'Footer text',
			'priority'  => 200,
			'description' => 'Настройте внешний вид вашего сайта'
		)
	);



	// Text in a footer
	$wp_customize->add_setting(
		'true_footer_copyright_text', // id
		array(
			'default'            => 'All rights protected.',
			'sanitize_callback'  => 'true_sanitize_copyright',
			'transport'          => $true_transport
		)
	);
	$wp_customize->add_control(
		'true_footer_copyright_text',
		array(
			'section'  => 'true_display_options',
			'label'    => 'Copyright',
			'type'     => 'text'
		)
	);



}

add_action( 'customize_register', 'true_customizer_init' );

/*
 * Function for saving text
 */
function true_sanitize_copyright( $value ) {
	return strip_tags( stripslashes( $value ) ); // remove slashes and html
}




// Update user ajax

	add_action( 'wp_ajax_nopriv_texttheme_subsform', 'texttheme_subsform' );
	add_action( 'wp_ajax_texttheme_subsform', 'texttheme_subsform' );

    function texttheme_subsform(){


            $email = sanitize_email( $_POST['email_test'] ); //sanitize email

            global $wpdb;
            $table_name = $wpdb->prefix . 'emails_list';
            $wpdb->query( $wpdb->prepare( " INSERT INTO $table_name ( email ) VALUES ( %s ) ", array( $email ) ) ); // add email to db
            echo "Thank you! Your email ".$email." was added.";
            die;
    }
// ### Update user ajax


// Define table with emails

global $wpdb;
$table_name = $wpdb->prefix . 'emails_list';

// Create table in DB

function emails_list_create_db() {

	global $wpdb;
	$my_products_db_version = '0.2';
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'emails_list';


            $sql = "CREATE TABLE $table_name (
                    id bigint(20) NOT NULL AUTO_INCREMENT,
                    `email` VARCHAR(255) NOT NULL,
                    PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
            add_option( 'emails_list_db_version', $my_products_db_version );

            $url = get_site_url();

}
// ### Create table in DB

// Function "create table" if not exists

if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {

	emails_list_create_db();


}

// ### Create table if not exists



// Menu Emails list in admin
add_action('admin_menu', 'emails_list_menu');

function emails_list_menu(){
        add_menu_page( 'Email list', 'Emails list', 'manage_options', 'emails_list_m', 'emails_list_init' );

}


// Page with emails

function emails_list_init(){
                
                // Prevent to unauthorize access to this page
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.')    );
		}

    echo "<h1>Your emails here!</h1>";

    global $wpdb;
    $table_name = $wpdb->prefix . 'emails_list';

     // Get emails from DB
     $sql = "SELECT * FROM $table_name ";
     $datas = $wpdb->get_results($sql);

     // Ouptup list of emails
     echo '<ul>';
     foreach ($datas as $val) {
         echo '<li>'.$val->email.'</a></li>';
     }

     echo '</ul>';
}



// Create custom post type function for «Attachments»
function create_posttype() {
 
    register_post_type( 'attachments',
    // create custom post options
        array(
            'labels' => array(
                'name' => __( 'Attachments' ),
                'singular_name' => __( 'Attachment' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'attachments'),
            'show_in_rest' => true,
 
        )
    );
}
// hook for our function cpt
add_action( 'init', 'create_posttype' );


/*
* Creating a function to create our cpt
*/
 
function custom_post_type() {
 
// set UI labels for cpt
    $labels = array(
        'name'                => _x( 'Attachments', 'Post Type General Name', 'texttheme' ),
        'singular_name'       => _x( 'Attachment', 'Post Type Singular Name', 'texttheme' ),
        'menu_name'           => __( 'Attachments', 'texttheme' ),
        'parent_item_colon'   => __( 'Parent Attachment', 'texttheme' ),
        'all_items'           => __( 'All Attachments', 'texttheme' ),
        'view_item'           => __( 'View Attachment', 'texttheme' ),
        'add_new_item'        => __( 'Add New Attachment', 'texttheme' ),
        'add_new'             => __( 'Add New', 'texttheme' ),
        'edit_item'           => __( 'Edit Attachment', 'texttheme' ),
        'update_item'         => __( 'Update Attachment', 'texttheme' ),
        'search_items'        => __( 'Search Attachment', 'texttheme' ),
        'not_found'           => __( 'Not Found', 'texttheme' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'texttheme' ),
    );
     
// set other options for cpt
     
    $args = array(
        'label'               => __( 'attachment', 'texttheme' ),
        'description'         => __( 'Attachment', 'texttheme' ),
        'labels'              => $labels,
        // features this CPT supports in editor
        'supports'            => false,
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
 
    );
     
    // Registering your Custom Post Type
    register_post_type( 'attachment', $args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_type', 0 );
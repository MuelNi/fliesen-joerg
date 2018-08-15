<?php

/**
 * functions and definitions
 *
 * @package WordPress
 */


// theme setup
function jr_theme_setup() {
	add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
	add_image_size('mobile_thumb', 800, 800, false);
	add_image_size('big_thumb', 1920, 1080, false);
	
	register_nav_menus( array(
		'main-menu' => esc_html__( 'Main Menu' ),
		'footer-menu' => esc_html__( 'Footer Menu' ),
	));
}
add_action( 'after_setup_theme', 'jr_theme_setup' );


// post types
include get_template_directory().'/includes/post-types/services.php';

// Remove Update Notifications
function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');

// title tag
add_filter( 'document_title_separator', 'jr_document_title_separator' );
function jr_document_title_separator( $sep ) {
    $sep = "|";
    return $sep;
}

// Enqueue CSS/JavaScript
function jr_enqueue_scripts() {
    wp_enqueue_script('jquery.min', get_template_directory_uri() . '/js/jquery-2.1.4.min.js',  array( 'jquery' ), null, false );
    wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr-latest.js',  array( 'jquery' ), null, false );
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js',  array( 'jquery' ), null, true );
    wp_enqueue_script('lazy', get_template_directory_uri() . '/js/jquery.lazy.min.js',  array( 'jquery' ), null, true );
	if ( is_page_template( 'tpl-home.php' ) ) {
		wp_enqueue_style( 'slick', get_template_directory_uri().'/css/slick.css', '', null );
		wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js',  array( 'jquery' ), null, true );
	}
	wp_enqueue_script('matchHeight', get_template_directory_uri() . '/js/jquery.matchHeight.js',  array( 'jquery' ), null, true );
    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js',  array( 'jquery' ), null, true );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', '', null );
    wp_enqueue_style( 'bootstrap-grid', get_template_directory_uri().'/css/bootstrap-grid.min.css', '', null );
    wp_enqueue_style( 'bootstrap-reboot', get_template_directory_uri().'/css/bootstrap-reboot.min.css', '', null );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', '', null );
    wp_enqueue_style( 'style', get_template_directory_uri().'/style.css', '', null );
}
add_action( 'wp_enqueue_scripts', 'jr_enqueue_scripts' );

// contact form 7
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// get attachment ID
function jr_get_attachment_id_by_url( $url ) {
    global $wpdb;
    $dir = wp_upload_dir();
    $path = $url;
    if ( 0 === strpos( $path, $dir['baseurl'] . '/' ) ) {
        $path = substr( $path, strlen( $dir['baseurl'] . '/' ) );
    }
    $sql = $wpdb->prepare(
        "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value = %s",
        $path
    );
    $post_id = $wpdb->get_var( $sql );
    if ( ! empty( $post_id ) ) {
        return (int) $post_id;
    }
}

// get the content
function jr_get_the_content(){
	$content = get_the_content();
	$content = apply_filters( 'the_content', $content );
	return $content;
}

// hide editor on specific page
function hide_editor() {

  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;

  $template_file = get_post_meta($post_id, '_wp_page_template', true);
  $pgname = get_the_title($post_id);

  if($template_file == 'tpl-home.php'){
    remove_post_type_support('page', 'editor');
    remove_post_type_support('page', 'thumbnail');
  }
}
add_action( 'admin_init', 'hide_editor' );

show_admin_bar(false);

// change email address
function wpb_sender_email( $original_email_address ) {
    return 'no-reply@test.de';
}
function wpb_sender_name( $original_email_from ) {
	return 'Test';
}
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );

// theme options
function theme_settings_page() { ?>
	    <div class="wrap">
	    <h1>Theme Optionen</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php }

function display_meta_description_element() { ?>
    	<textarea id="meta_description" class="text" cols="50" rows="10" name="meta_description"><?php echo get_option('meta_description'); ?></textarea>
    <?php }
function display_google_analytics_element() { ?>
    	<textarea id="google_analytics" class="text" cols="50" rows="10" name="google_analytics"><?php echo get_option('google_analytics'); ?></textarea>
    <?php }
function display_social_media_facebook_element() { ?>
    	<input id="social_media_facebook" style="width:350px" type="text" name="social_media_facebook" value="<?php echo get_option('social_media_facebook'); ?>" />
    <?php }
function display_social_media_twitter_element() { ?>
    	<input id="social_media_twitter" style="width:350px" type="text" name="social_media_twitter" value="<?php echo get_option('social_media_twitter'); ?>" />
    <?php }
function display_social_media_youtube_element() { ?>
    	<input id="social_media_youtube" style="width:350px" type="text" name="social_media_youtube" value="<?php echo get_option('social_media_youtube'); ?>" />
    <?php }

function display_theme_panel_fields() {
	add_settings_section("section", "Optionen", null, "theme-options");
	add_settings_field("meta_description", "Meta Description", "display_meta_description_element", "theme-options", "section");
    register_setting("section", "meta_description");
	add_settings_field("google_analytics", "Google Analytics Code (Tracking-Code-Snippet)", "display_google_analytics_element", "theme-options", "section");
    register_setting("section", "google_analytics");
	add_settings_field("social_media_facebook", "Facebook Konto", "display_social_media_facebook_element", "theme-options", "section");
    register_setting("section", "social_media_facebook");
	add_settings_field("social_media_twitter", "Twitter Konto", "display_social_media_twitter_element", "theme-options", "section");
    register_setting("section", "social_media_twitter");
	add_settings_field("social_media_youtube", "YouTube Konto", "display_social_media_youtube_element", "theme-options", "section");
    register_setting("section", "social_media_youtube");
}
add_action("admin_init", "display_theme_panel_fields");

function add_theme_menu_item() {
	add_menu_page("Theme Optionen", "Theme Optionen", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}
add_action("admin_menu", "add_theme_menu_item");

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

?>
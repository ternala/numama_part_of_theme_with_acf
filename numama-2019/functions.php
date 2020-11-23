<?php

/*
 * Add theme supports.
*/
add_action('init', 'numama_add_theme_supports');
function numama_add_theme_supports() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
}


/*
 * Register nav menu locations.
*/
register_nav_menu('main_menu', 'Main menu' );
register_nav_menu('footer_menu','Footer menu');


/*
 * Disable wp emoji.
*/
add_action( 'init', 'disable_wp_emojicons' );
function disable_wp_emojicons() {

	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
add_filter( 'emoji_svg_url', '__return_false' );



/*
 * Add fields to customize.
*/
add_action('customize_register', function($customizer) {
	/* Start Customizer */
	/* Section header */
	$customizer->add_panel(
		'nm_header',
		array(
			'title' => 'Header',
		)
	);
	$customizer->add_section(
		'nm_header_logo',
		array(
			'title' => 'Logo',
			'priority' => 11,
			'panel' => 'nm_header'
		)
	);
	$customizer->add_setting(
		'logo_image'
	);
	$customizer->add_control(
		new WP_Customize_Image_Control(
			$customizer,
			'logo_image',
			array(
				'label' => __('Upload a logo(ONLY SVG)', 'numama'),
				'section' => 'nm_header_logo',
				'settings' => 'logo_image',
			)
		)
	);
	$customizer->add_section(
		'nm_header_button',
		array(
			'title' => 'Button',
			'priority' => 11,
			'panel' => 'nm_header'
		)
	);
	$customizer->add_setting('button_text');
	$customizer->add_control(
		'button_text',
		array(
			'description' => 'If, this field is empty, button not display',
			'label' => "Button text",
			'section' => 'nm_header_button',
		)
	);
	$customizer->add_setting('button_link');
	$customizer->add_control(
		'button_link',
		array(
			'label' => "Button link",
			'section' => 'nm_header_button',
		)
	);
	/* End section header */
	/* Start section footer */
	$customizer->add_panel(
		'nm_footer',
		array(
			'title' => 'Footer',
		)
	);
	$customizer->add_section(
		'nm_footer_logo',
		array(
			'title' => 'Logo',
			'priority' => 11,
			'panel' => 'nm_footer'
		)
	);
	$customizer->add_setting(
		'logo_footer'
	);
	$customizer->add_control(
		new WP_Customize_Image_Control(
			$customizer,
			'logo_footer',
			array(
				'label' => __('Upload a logo(ONLY SVG)', 'numama'),
				'section' => 'nm_footer_logo',
				'settings' => 'logo_footer',
			)
		)
	);
	$customizer->add_section(
		'nm_footer_social',
		array(
			'title' => 'Social',
			'priority' => 11,
			'panel' => 'nm_footer'
		)
	);
	$customizer->add_setting('footer_facebook');
	$customizer->add_control(
		'footer_facebook',
		array(
			'label' => 'Facebook',
			'section' => 'nm_footer_social',
		)
	);
	$customizer->add_setting('footer_instagram');
	$customizer->add_control(
		'footer_instagram',
		array(
			'label' => 'Instagram',
			'section' => 'nm_footer_social',
		)
	);
	$customizer->add_setting('footer_twitter');
	$customizer->add_control(
		'footer_twitter',
		array(
			'label' => 'Twitter',
			'section' => 'nm_footer_social',
		)
	);
	$customizer->add_setting('footer_appstore');
	$customizer->add_control(
		'footer_appstore',
		array(
			'label' => 'App Store link',
			'section' => 'nm_footer_social',
		)
	);
	/* End section footer */
});


/*
 * Load custom wp backery visual composer shortcodes.
*/
add_action('load_textdomain', 'load_vc_function');
function load_vc_function(){
	load_template(TEMPLATEPATH .'/functions-vc.php');
}


/*
 * Custom html for login / logout link in menu.
*/
add_filter( 'wp_nav_menu_items', 'nm_loginout_menu_link', 10, 2 );
function nm_loginout_menu_link( $items, $args ) {
	if ($args->theme_location == 'primary') {
		if (is_user_logged_in()) {
			$items .= '<li class="right"><a href="'. wp_logout_url() .'">'. __("Log Out") .'</a></li>';
		} else {
			$items .= '<li class="right"><a href="'. wp_login_url(get_permalink()) .'">'. __("Log In") .'</a></li>';
		}
	}
	return $items;
}


/*
 * Hide admin bar for users without administrator capability.
*/
add_action('init', 'none_admin_bar');
function none_admin_bar()
{
	if (!current_user_can('manage_options')) {
		show_admin_bar(false);
	} else {
		show_admin_bar(true);
	}
}


/*
 * Add acf options page.
*/
add_action('acf/init', 'my_acf_init');
function my_acf_init() {

	if( function_exists('acf_add_options_page') ) {

		$option_page = acf_add_options_page(array(
			'page_title' 	=> __('Tags settings', 'numama'),
			'menu_title' 	=> __('Tags settings', 'numama'),
			'menu_slug' 	=> 'tags_settings',
		));

		$order_settings_page = acf_add_options_page(array(
            'page_title' 	=> __('Create order settings', 'numama'),
            'menu_title' 	=> __('Create order settings', 'numama'),
            'menu_slug' 	=> 'create_order_settings',
        ));
		$order_mail_templates = acf_add_options_page(array(
			'page_title' 	=> __('Mail templates', 'numama'),
			'menu_title' 	=> __('Mail templates', 'numama'),
			'menu_slug' 	=> 'mail_templates',
		));
		$order_sms_templates = acf_add_options_page(array(
			'page_title' 	=> __('SMS templates', 'numama'),
			'menu_title' 	=> __('SMS templates', 'numama'),
			'menu_slug' 	=> 'sms_templates',
		));

	}

}


/*
 * ACF Dynamic change of values for "attributes" fields.
*/
function acf_load_color_field_choices( $field ) {

	// reset choices
	$field['choices'] = array();
	$count = 0;
	while (have_rows('tags','option')){
		the_row('option');
		$field['choices'][$count] = get_sub_field('label');
		$count++;
	}
	return $field;

}
add_filter('acf/load_field/name=attributes','acf_load_color_field_choices');
add_filter('acf/load_field/name=attributes_1', 'acf_load_color_field_choices');
add_filter('acf/load_field/name=attributes_2','acf_load_color_field_choices');
add_filter('acf/load_field/name=attributes_3','acf_load_color_field_choices');
add_filter('acf/load_field/name=attributes_4','acf_load_color_field_choices');




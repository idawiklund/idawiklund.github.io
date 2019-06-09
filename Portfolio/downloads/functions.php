<?php

function responsiveboat_setup() {

	add_image_size('rb_latest_news_photo', 480, 480, true);

}
add_action('after_setup_theme', 'responsiveboat_setup');

/* Theme Customizer */
function responsiveboat_customize_register( $wp_customize ) {

	$responsiveboat_parent_theme = get_template();
	if( !empty($responsiveboat_parent_theme) && ($responsiveboat_parent_theme == 'zerif-pro') ):
	
		/* Remove About us section */
		$wp_customize->remove_panel('panel_6');
		
	else:
	
		/* Remove About us section and Contact us */
		$wp_customize->remove_panel('panel_about');
		$wp_customize->remove_section('zerif_aboutus_settings_section');
		$wp_customize->remove_section('zerif_aboutus_main_section');
		$wp_customize->remove_section('zerif_aboutus_feat1_section');
		$wp_customize->remove_section('zerif_aboutus_feat2_section');
		$wp_customize->remove_section('zerif_aboutus_feat3_section');
		$wp_customize->remove_section('zerif_aboutus_feat4_section');
		$wp_customize->remove_section('zerif_aboutus_clients_section');
		$wp_customize->remove_section('zerif_contactus_section');
		
	endif;

    /**************************************/
    /********** Big title image **********/
    /*************************************/
	
	if( !empty($responsiveboat_parent_theme) && ($responsiveboat_parent_theme == 'zerif-pro') ):
	
		$wp_customize->add_setting( 'rb_bigtitle_logo', array('sanitize_callback' => 'esc_url_raw' , 'default' => get_stylesheet_directory_uri().'/images/logo-small.png'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rb_bigtitle_logo', array(
			'label'    => __( 'Header Logo', 'responsiveboat' ),
			'section'  => 'zerif_bigtitle_texts_section',
			'priority'    => 7,
		)));
	
	else:
	
		$wp_customize->add_setting( 'rb_bigtitle_logo', array('sanitize_callback' => 'esc_url_raw' , 'default' => get_stylesheet_directory_uri().'/images/logo-small.png'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rb_bigtitle_logo', array(
			'label'    => __( 'Header Logo', 'responsiveboat' ),
			'section'  => 'zerif_bigtitle_section',
			'priority'    => 7,
		)));
	
	endif;

    /**************************************/
    /********   About me section *********/
    /*************************************/

    $wp_customize->add_section( 'rb_aboutyou_section' , array(
        'title'       => __( 'About you section', 'responsiveboat' ),
        'priority'    => 34
    ));

    /* about you show/hide */
    $wp_customize->add_setting( 'rb_aboutyou_show', array('sanitize_callback' => 'responsiveboat_sanitize_text'));
    $wp_customize->add_control(
        'rb_aboutyou_show',
        array(
            'type' => 'checkbox',
            'label' => __('Hide about you section?','responsiveboat'),
            'section' => 'rb_aboutyou_section',
            'priority'    => 1,
        )
    );

    /* title */
    $wp_customize->add_setting( 'rb_aboutyou_title', array('sanitize_callback' => 'responsiveboat_sanitize_text','default' => __('About you','responsiveboat')));
    $wp_customize->add_control( 'rb_aboutyou_title', array(
        'label'    => __( 'Title', 'responsiveboat' ),
        'section'  => 'rb_aboutyou_section',
        'priority'    => 2,
    ));

    /* subtitle */
    $wp_customize->add_setting( 'rb_aboutyou_subtitle', array('sanitize_callback' => 'responsiveboat_sanitize_text','default' => __('Use this section to showcase important details about you.','responsiveboat')));
    $wp_customize->add_control( 'rb_aboutyou_subtitle', array(
        'label'    => __( 'Subtitle', 'responsiveboat' ),
        'section'  => 'rb_aboutyou_section',
        'priority'    => 3,
    ));

    /* text */
    $wp_customize->add_setting( 'rb_aboutyou_text', array('sanitize_callback' => 'responsiveboat_sanitize_text','default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec massa enim. Aliquam viverra at est ullamcorper sollicitudin. Proin a leo sit amet nunc malesuada imperdiet pharetra ut eros.<br><br> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec massa enim. Aliquam viverra at est ullamcorper sollicitudin. Proin a leo sit amet nunc malesuada imperdiet pharetra ut eros. <br><br>Mauris vel nunc at ipsum fermentum pellentesque quis ut massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas non adipiscing massa. Sed ut fringilla sapien. Cras sollicitudin, lectus sed tincidunt cursus, magna lectus vehicula augue, a lobortis dui orci et est.','responsiveboat')));
    $wp_customize->add_control( 'rb_aboutyou_text', array(
        'label'    => __( 'Text', 'responsiveboat' ),
        'section'  => 'rb_aboutyou_section',
        'priority'    => 4,
    ));

    /* image */
    $wp_customize->add_setting( 'rb_aboutyou_image', array('sanitize_callback' => 'esc_url_raw' , 'default' => get_stylesheet_directory_uri().'/images/about.jpg'));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rb_aboutyou_image', array(
        'label'    => __( 'Image', 'responsiveboat' ),
        'section'  => 'rb_aboutyou_section',
        'priority'    => 5,
    )));

}
add_action( 'customize_register', 'responsiveboat_customize_register', 20 );


function responsiveboat_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

add_action( 'wp_enqueue_scripts', 'responsiveboat_enqueue_styles' );
function responsiveboat_enqueue_styles() {

	wp_enqueue_style( 'responsiveboat-font', '//fonts.googleapis.com/css?family=Titillium+Web:400,300,300italic,200italic,200,400italic,600,600italic,700,700italic,900');

	wp_enqueue_style( 'responsiveboat-style', get_template_directory_uri() . '/style.css', array('zerif_bootstrap_style') );

}

function responsiveboat_custom_script_fix1()
{
	wp_enqueue_script('responsiveboat-script', get_stylesheet_directory_uri() . '/js/responsive_boat_script.js', array(), '201202067', true);
}
add_action( 'wp_enqueue_scripts', 'responsiveboat_custom_script_fix1' );

function responsiveboat_remove_style_child(){
	remove_action('wp_print_scripts','zerif_php_style');
}

add_action( 'wp_enqueue_scripts', 'responsiveboat_remove_style_child', 100 );

/* get first image from a post content or get a default image */
function responsiveboat_get_first_image_from_post() {

	global $post, $posts;

	$zerif_first_img = '';
	ob_start();
	ob_end_clean();

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $zerif_matches);

	if( !empty($zerif_matches[1][0]) ):
		$zerif_first_img = '<img src="'.$zerif_matches[1][0].'">';
	endif;

	if(empty($zerif_first_img)):
		$zerif_first_img = '<img src="'.get_template_directory_uri().'/images/blank-latestposts.png'.'">';
	endif;

	return $zerif_first_img;

}

/**
 * Notice in Customize to announce the theme is not maintained anymore
 */
function responsive_boat_customize_register( $wp_customize ) {

	require_once get_stylesheet_directory() . '/class-ti-notify.php';

	$wp_customize->register_section_type( 'Ti_Notify' );

	$wp_customize->add_section(
		new Ti_Notify(
			$wp_customize,
			'ti-notify',
			array(
				'text'     => sprintf( __( 'This child theme is not maintained anymore, consider using the parent theme %1$s or check-out our latest free one-page theme: %2$s.','responsiveboat' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=zerif-lite' ) . '">%s</a>', 'Zerif Lite' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=hestia' ) . '">%s</a>', 'Hestia' ) ),
				'priority' => 0,
			)
		)
	);

	$wp_customize->add_setting( 'responsive-boat-notify', array(
	        'sanitize_callback' => 'esc_html',
    ) );

	$wp_customize->add_control( 'responsive-boat-notify', array(
		'label'    => __( 'Notification', 'responsiveboat' ),
		'section'  => 'ti-notify',
		'priority' => 1,
	) );
}

add_action( 'customize_register', 'responsive_boat_customize_register' );

/**
 * Notice in admin dashboard to announce the theme is not maintained anymore
 */
function responsive_boat_admin_notice() {

	global $pagenow;

	if ( is_admin() && ( 'themes.php' == $pagenow ) && isset( $_GET['activated'] ) ) {
		echo '<div class="updated notice is-dismissible"><p>';
		printf( __( 'This child theme is not maintained anymore, consider using the parent theme %1$s or check-out our latest free one-page theme: %2$s.','responsiveboat' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=zerif-lite' ) . '">%s</a>', 'Zerif Lite' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=hestia' ) . '">%s</a>', 'Hestia' ) );
		echo '</p></div>';
	}
}

add_action( 'admin_notices', 'responsive_boat_admin_notice', 99 );

function responsiveboat_background_fix(){
	return array(
		'default-image' => get_stylesheet_directory_uri().'/images/bg.jpg',
		'default-repeat'         => 'no-repeat',
		'default-position-x'     => 'center',
		'default-attachment'     => 'fixed'
	);
}
add_filter('wp_themeisle_custom_background_args','responsiveboat_background_fix');
function responsiveboat_setup_fix() {

	register_default_headers( array(
		'wheel' => array(
			'url'           => get_stylesheet_directory_uri().'/images/bg.jpg',
			'thumbnail_url' => get_stylesheet_directory_uri().'/images/bg.jpg',
			'description'   => __( 'Header', 'responsiveboat' )
		)
	) );
}
add_action('after_setup_theme', 'responsiveboat_setup_fix');
function responsive_boat_style_fix() {

	$custom_css = "
                .testimonial .section-header .white-text{
                        color: #404040;
                }
                .big-title-container .btn.red-btn, .big-title-container .btn.green-btn {
                    background: rgba(255, 255, 255, 0.15);
                }";
	wp_add_inline_style( 'responsiveboat-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'responsive_boat_style_fix' );

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

// END ENQUEUE PARENT ACTION

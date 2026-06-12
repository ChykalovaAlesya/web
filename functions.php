<?php
/**
 * web functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package web
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.2' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function web_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on web, use a find and replace
		* to change 'web' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'web', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'web' ),
            'mob-menu' => esc_html__( 'Mob', 'web' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'web_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'web_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function web_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'web_content_width', 640 );
}
add_action( 'after_setup_theme', 'web_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function web_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'web' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'web' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'web_widgets_init' );


/**
 * Включаем поддержку WooCommerce
 */
add_action('after_setup_theme', function() {
    add_theme_support('woocommerce');
});

/**
 * Enqueue scripts and styles.
 */
function web_scripts() {
    // Получаем выбранный шрифт из настроек кастомайзера
    $font_choice = get_theme_mod('web_font_choice', 'Inter');

    // Подключаем соответствующий шрифт
    if ( $font_choice === 'Montserrat' ) {
        wp_enqueue_style('montserrat-font', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap', array(), null);
    } elseif ( $font_choice === 'Roboto' ) {
        wp_enqueue_style('roboto-font', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap', array(), null);
    } elseif ( $font_choice === 'Open Sans' ) {
        wp_enqueue_style('open-sans-font', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@100..900&display=swap', array(), null);
    } elseif ( $font_choice === 'Lato' ) {
        wp_enqueue_style('lato-font', 'https://fonts.googleapis.com/css2?family=Lato:wght@100..900&display=swap', array(), null);
    }
	elseif ( $font_choice === 'Geologica' ) {
        wp_enqueue_style('geologica-font', 'https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&display=swap', array(), null);
    }

    // Inter — design-system font (Figma)
    wp_enqueue_style( 'inter-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', array(), null );

    // Swiper
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), null );
    wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true );

    // Оставшиеся стили
    wp_enqueue_style( 'web-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( '404-css', get_template_directory_uri() . '/inc/assets/css/404.css', array(), _S_VERSION );
    wp_enqueue_style( 'web-general', get_template_directory_uri() . '/inc/assets/css/general-styles.css', array(), _S_VERSION );
    wp_enqueue_style('header-css', get_template_directory_uri() . '/inc/assets/css/header.css', array(), _S_VERSION);
    wp_enqueue_style('footer-css', get_template_directory_uri() . '/inc/assets/css/footer.css', array(), _S_VERSION);
    wp_enqueue_style('popups-css', get_template_directory_uri() . '/inc/assets/css/popups.css', array(), _S_VERSION);
    wp_enqueue_style( 'web-css', get_template_directory_uri() . '/inc/assets/css/cust.css', array(), _S_VERSION );

    wp_deregister_script( 'jquery' ); 
    wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'jquery' );

    // Подключаем JS для попапов
wp_enqueue_script('popups-js', get_template_directory_uri() . '/inc/assets/js/popups.js', array('jquery'), _S_VERSION, true);

    wp_enqueue_script( 'web-js', get_template_directory_uri() . '/inc/assets/js/main.js', array('jquery'), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'web_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/back/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/back/template-functions.php';

/**
 * Custom.
 */
require get_template_directory() . '/inc/back/cust.php';

/**
 * ACF: options page, "Виграні справи" CPT, homepage + site field groups.
 */
require get_template_directory() . '/inc/back/acf.php';


/**
 * Auto install plugins.
 */
require get_template_directory() . '/inc/back/class-tgm-plugin-activation.php';

/**
 * Required plugins.
 */
add_action('tgmpa_register', 'my_theme_register_required_plugins');

function my_theme_register_required_plugins() {
    $plugins = array(
        // Плагины из репозитория WordPress
        array(
            'name' => 'Cyr-To-Lat',
            'slug' => 'cyr2lat',
            'required' => true,
        ),
        array(
            'name' => 'Classic Editor',
            'slug' => 'classic-editor',
            'required' => true,
        ),
        array(
            'name' => 'Advanced Database Cleaner',
            'slug' => 'advanced-database-cleaner',
            'required' => true,
        ),
        array(
            'name' => 'SVG Support',
            'slug' => 'svg-support',
            'required' => true,
        ),
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => true,
        ),
        array(
            'name' => 'Yoast SEO',
            'slug' => 'wordpress-seo',
            'required' => true,
        ),
        // Плагин из локальной папки
        array(
            'name' => 'Advanced Custom Fields Pro', 
            'slug' => 'advanced-custom-fields-pro', 
            'source' => get_template_directory() . '/my-plugins/advanced-custom-fields-pro.zip', 
            'required' => true, 
        )
    );

    $config = array(
        'id' => 'web',
        'default_path' => '', 
        'menu' => 'tgmpa-install-plugins',
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => true,
        'message' => '',
    );

    tgmpa($plugins, $config);
}


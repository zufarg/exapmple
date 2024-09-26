<?php

/**
 * merit functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package merit
 */

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}
function add_custom_mime_types($mimes)
{
    $mimes['ico'] = 'image/x-icon';
    return $mimes;
}
add_filter('upload_mimes', 'add_custom_mime_types');


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function merit_setup()
{
    /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on merit, use a find and replace
		* to change 'merit' to the name of your theme in all the template files.
		*/
    load_theme_textdomain('merit', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
    add_theme_support('title-tag');

    /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
    add_theme_support('post-thumbnails');

    add_theme_support('woocommerce');


    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'merit'),
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
            'merit_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

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
add_action('after_setup_theme', 'merit_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function merit_content_width()
{
    $GLOBALS['content_width'] = apply_filters('merit_content_width', 640);
}
add_action('after_setup_theme', 'merit_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function merit_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'merit'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'merit'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'merit_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function merit_scripts()
{
    wp_enqueue_style('merit-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('merit-style', 'rtl', 'replace');

    wp_enqueue_script('merit-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }


    wp_enqueue_style('test', get_template_directory_uri() . '/assets/css/test.css');
    wp_enqueue_style('intlTelInputMin', get_template_directory_uri() . '/assets/css/intlTelInput.min.css');
    wp_enqueue_style('swiper-css', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css');
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/main.css');






    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js', '1.0', true);
    wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', '1.0', true);
    //    wp_enqueue_script('intlTellJ', get_template_directory_uri() . '/assets/js/intlTelInput-jquery.js', '1.0', true);
    //    wp_enqueue_script('intlTellJMin', get_template_directory_uri() . '/assets/js/intlTelInput-jquery.min.js', '1.0', true);

    wp_enqueue_script('gsap', get_template_directory_uri() . '/assets/js/libs/gsap/gsap.min.js', '1.0', true);
    wp_enqueue_script('scroll_trigger', get_template_directory_uri() . '/assets/js/libs/gsap/ScrollTrigger.min.js', '1.0', true);
    wp_enqueue_script('scroll_smoother', get_template_directory_uri() . '/assets/js/libs/gsap/ScrollSmoother.min.js', '1.0', true);
    wp_enqueue_script('scroll_plugin', get_template_directory_uri() . '/assets/js/libs/gsap/ScrollToPlugin.min.js', '1.0', true);
    wp_enqueue_script('flip', get_template_directory_uri() . '/assets/js/Flip.min.js', '1.0', true);
    wp_enqueue_script('text_plugin', get_template_directory_uri() . '/assets/js/TextPlugin.min.js', '1.0', true);
    wp_enqueue_script('observe', get_template_directory_uri() . '/assets/js/Observer.min.js', '1.0', true);

    //wp_enqueue_script('intlTell', get_template_directory_uri() . '/assets/js/intlTelInput.js', '1.0', true);
    wp_enqueue_script('intlTellMin', get_template_directory_uri() . '/assets/js/intlTelInput.min.js', '1.0', true);
    wp_enqueue_script('utils', get_template_directory_uri() . '/assets/js/utils.js', '1.0', true);

    wp_enqueue_script('search-suggestions', get_template_directory_uri() . '/assets/js/search-form-suggestion.js', array('jquery'), null, true);
    wp_localize_script('search-suggestions', 'ajaxurl', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
//    wp_enqueue_script('search-suggestions', get_template_directory_uri() . '/assets/js/search-form-suggestion.js', '1.0', true);
//    wp_localize_script('search-suggestions', 'ajaxurl', array(
//        'ajax_url' => admin_url('admin-ajax.php')
//    ));

    wp_enqueue_script('slider', get_template_directory_uri() . '/assets/js/slider.js', '1.0', true);
    wp_enqueue_script('app', get_template_directory_uri() . '/assets/js/app.js', '1.0', true);
    wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', '1.0', true);
}
add_action('wp_enqueue_scripts', 'merit_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

function custom_theme_menus()
{
    register_nav_menus(
        array(
            'primary-menu' => 'Меню в шапке',
            'footer-menu'  => 'Меню в футере',
            'mobile-menu' => 'Мобильное меню'
        )
    );
}
add_action('init', 'custom_theme_menus');


function theme_customizer_settings($wp_customize)
{
    // Add a section for custom settings
    $wp_customize->add_section('theme_custom_settings', array(
        'title'    => __('Merit Chemicals Info', 'your-theme-textdomain'),
        'priority' => 200,
    ));



    // Add a setting for custom option
    $wp_customize->add_setting('address_header', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('address_header', array(
        'label'    => __('Адрес на шапке сайта', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));


    // Add a setting for custom option
    $wp_customize->add_setting('phone_tj', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('phone_tj', array(
        'label'    => __('Номер телефона Таджикистан', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));

    // Add a setting for custom option
    $wp_customize->add_setting('phone_tj_sec', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('phone_tj_sec', array(
        'label'    => __('Номер телефона Таджикистан 2', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));


    // Add a setting for custom option
    $wp_customize->add_setting('address_tj', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('address_tj', array(
        'label'    => __('Адрес Таджикистан', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));


    $wp_customize->add_setting('phone_msk', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('phone_msk', array(
        'label'    => __('Номер телефона Москва', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));

    $wp_customize->add_setting('phone_msk_sec', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('phone_msk_sec', array(
        'label'    => __('Номер телефона Москва 2', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));



    // Add a setting for custom option
    $wp_customize->add_setting('address_msk', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('address_msk', array(
        'label'    => __('Адрес Москва', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));

    $wp_customize->add_setting('phone_turk', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('phone_turk', array(
        'label'    => __('Номер телефона Турция', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));

    $wp_customize->add_setting('phone_turk_sec', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('phone_turk_sec', array(
        'label'    => __('Номер телефона Турция 2', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));


    // Add a setting for custom option
    $wp_customize->add_setting('address_turk', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('address_turk', array(
        'label'    => __('Адрес Турция', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));


    $wp_customize->add_setting('phone_kz', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('phone_kz', array(
        'label'    => __('Номер телефона Казахстан', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));

    $wp_customize->add_setting('phone_kz_sec', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('phone_kz_sec', array(
        'label'    => __('Номер телефона Казахстан 2', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));



    // Add a setting for custom option
    $wp_customize->add_setting('address_kz', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('address_kz', array(
        'label'    => __('Адрес Казахстан', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));

    $wp_customize->add_setting('phone_uz', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('phone_uz', array(
        'label'    => __('Номер телефона Узбекистан', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));

    $wp_customize->add_setting('phone_uz_sec', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('phone_uz_sec', array(
        'label'    => __('Номер телефона Узбекистан 2', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));



    // Add a setting for custom option
    $wp_customize->add_setting('address_uz', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('address_uz', array(
        'label'    => __('Адрес Узбекистан', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));


    // Add a setting for custom option
    $wp_customize->add_setting('email', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    // Add a control for custom option
    $wp_customize->add_control('email', array(
        'label'    => __('Email', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings',
        'priority' => 10,
        'type'     => 'text', // Set the control type as text input
    ));




    // social links
    $wp_customize->add_section('theme_custom_settings_social', array(
        'title'    => __('Социальные сети', 'your-theme-textdomain'),
        'priority' => 200,
    ));
    $wp_customize->add_setting('youtube', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    $wp_customize->add_control('youtube', array(
        'label'    => __('Youtube', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings_social',
        'priority' => 10,
        'type'     => 'url', // Set the control type as text input
    ));

    $wp_customize->add_setting('linked', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    $wp_customize->add_control('linked', array(
        'label'    => __('Linked In', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings_social',
        'priority' => 10,
        'type'     => 'url', // Set the control type as text input
    ));


    $wp_customize->add_setting('facebook', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    $wp_customize->add_control('facebook', array(
        'label'    => __('Facebook', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings_social',
        'priority' => 10,
        'type'     => 'url', // Set the control type as text input
    ));


    $wp_customize->add_setting('instagram', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    $wp_customize->add_control('instagram', array(
        'label'    => __('Instagram', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings_social',
        'priority' => 10,
        'type'     => 'url', // Set the control type as text input
    ));


    $wp_customize->add_setting('telegram', array(
        'default'           => '',
        'type'              => 'theme_mod', // Set the type as 'theme_mod' to store the value as theme modification
        'capability'        => 'edit_theme_options', // Set the capability required to edit this setting
        'sanitize_callback' => 'sanitize_text_field', // Set the sanitization callback for the value
    ));

    $wp_customize->add_control('telegram', array(
        'label'    => __('Telegram', 'your-theme-textdomain'),
        'section'  => 'theme_custom_settings_social',
        'priority' => 10,
        'type'     => 'url', // Set the control type as text input
    ));
}
add_action('customize_register', 'theme_customizer_settings');



function custom_post_type()
{
    $labels = array(
        'name'               => __('Новости'),
        'singular_name'      => __('Новость'),
        'add_new'            => __('Добавить новую новость'),
        'add_new_item'       => __('Добавить новую новость'),
        'edit_item'          => __('Редактировать новость'),
        'new_item'           => __('Новая новость'),
        'all_items'          => __('Все новости'),
        'view_item'          => __('Посмотреть новость'),
        'search_items'       => __('Поиск новости'),
        'not_found'          => __('Ничего не найдено'),
        'not_found_in_trash' => __('Ничего не найдено в корзине'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Новости')
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'show_in_rest' => true,
        'menu_position' => 5,
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite'       => array('slug' => 'news'),
        'menu_icon' => 'dashicons-media-document'
    );

    register_post_type('news', $args);




    $labels = array(
        'name'               => __('Партнеры'),
        'singular_name'      => __('Партнер'),
        'add_new'            => __('Добавить нового партнера'),
        'add_new_item'       => __('Добавить нового партнера'),
        'edit_item'          => __('Редактировать партнера'),
        'new_item'           => __('Новый клиент'),
        'all_items'          => __('Все партнеры'),
        'view_item'          => __('Посмотреть партнера'),
        'search_items'       => __('Поиск партнера'),
        'not_found'          => __('Ничего не найдено'),
        'not_found_in_trash' => __('Ничего не найдено в корзине'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Партнеры')
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'menu_position' => 5,
        'supports'      => array('title', 'thumbnail'),
        'rewrite'       => array('slug' => 'partners'),
        'menu_icon' => 'dashicons-businessman'
    );

    register_post_type('partners', $args);



    $labels = array(
        'name'               => __('Сертификаты'),
        'singular_name'      => __('Сертификат'),
        'add_new'            => __('Добавить сертификат'),
        'add_new_item'       => __('Добавить сертификат'),
        'edit_item'          => __('Редактировать сертификат'),
        'new_item'           => __('Новый сертификат'),
        'all_items'          => __('Все сертификаты'),
        'view_item'          => __('Посмотреть сертификат'),
        'search_items'       => __('Поиск сертификата'),
        'not_found'          => __('Ничего не найдено'),
        'not_found_in_trash' => __('Ничего не найдено в корзине'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Сертификаты')
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'menu_position' => 5,
        'supports'      => array('title', 'thumbnail'),
        'rewrite'       => array('slug' => 'certificates'),
        'menu_icon' => 'dashicons-text-page'
    );

    register_post_type('certificates', $args);
}
add_action('init', 'custom_post_type');










//Социальные сети
function renderSocial()
{
    $youtube = get_theme_mod('youtube');
    $linked = get_theme_mod('linked');
    $facebook = get_theme_mod('facebook');
    $instagram = get_theme_mod('instagram');
    $telegram = get_theme_mod('telegram');

    if (!empty($youtube)) {
        echo '<a href="' . esc_url($youtube) . '"><img src="' . esc_url(get_template_directory_uri() . '/assets/icons/social-media/header/2.svg') . '" alt="Youtube" class="i-socmedia" /></a>';
    }
    if (!empty($linked)) {
        echo '<a href="' . esc_url($linked) . '"><img src="' . esc_url(get_template_directory_uri() . '/assets/icons/social-media/header/3.svg') . '" alt="LinkedIn" class="i-socmedia" /></a>';
    }
    if (!empty($facebook)) {
        echo '<a href="' . esc_url($facebook) . '"><img src="' . esc_url(get_template_directory_uri() . '/assets/icons/social-media/header/4.svg') . '" alt="Facebook" class="i-socmedia" /></a>';
    }
    if (!empty($instagram)) {
        echo '<a href="' . esc_url($instagram) . '"><img src="' . esc_url(get_template_directory_uri() . '/assets/icons/social-media/header/1.svg') . '" alt="Instagram" class="i-socmedia" /></a>';
    }
    if (!empty($telegram)) {
        echo '<a href="' . esc_url($telegram) . '"><img src="' . esc_url(get_template_directory_uri() . '/assets/icons/social-media/header/5.svg') . '" alt="Telegram" class="i-socmedia" /></a>';
    }
}

//Новости
function display_news_titles()
{

    $news_img_args = array(
        'post_type' => 'news', // Указываем кастомный пост-тип
        'posts_per_page' => -1,    // Получаем все записи
    );

    $partners_query = new WP_Query($news_img_args);
    $iterator = 1;
    if ($partners_query->have_posts()) :
        while ($partners_query->have_posts()) : $partners_query->the_post();
            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full'); // Получаем URL миниатюры
?>
            <?php if ($thumbnail): ?>
                <img src="<?= esc_url($thumbnail); ?>" alt="" class="img-news img-<?= $iterator ?> active" />
            <?php endif; ?>
    <?php
            $iterator++;
        endwhile;
    endif;
    wp_reset_postdata(); // Сбрасываем данные поста после запроса


    $args = array(
        'post_type' => 'news', // Custom post type
        'posts_per_page' => -1, // Get all posts
    );

    $partners_query = new WP_Query($args);
    ?>
    <div class="flex-col-start">
        <div class="container-news-titles">
            <span class="span-block"><?=pll__('Новостной блог')?></span>
            <h2 class="title"><?=pll__('Последние новости')?></h2>
            <?php
            if ($partners_query->have_posts()) :
                while ($partners_query->have_posts()) : $partners_query->the_post();
                    $title = get_the_title();
            ?>
                    <div class="news-title">
                        <h3 class="news-title-title">
                            <span>01</span> <span><?= esc_attr($title); ?></span>
                        </h3>
                        <a href="<?= get_permalink() ?>" class="news-title-else"><?=pll__('Подробнее')?> →</a>
                    </div>
            <?php
                endwhile;
            else :
                echo '<p>'.pll__('Новости не найдены').'</p>';
            endif;
            ?>
        </div>
        <?php

        wp_reset_postdata(); // Reset post data

        // Determine the news page ID based on the current language
        $news_page_id = pll_get_post(98);

        // Display the "Все новости компании →" button
        ?>
        <a href="<?= get_page_link($news_page_id) ?>" class="btn-news-all">
            <?= pll__('Все новости компании → '); ?>
        </a>
    </div>
<?php
}

//Новости Мобилка
function display_news_titles_mobile()
{

    $args = array(
        'post_type' => 'news', // Custom post type
        'posts_per_page' => -1, // Get all posts
    );

    $partners_query = new WP_Query($args);
?>
    <div class="container-mobile-news">
        <span class="span-block"> <?=pll__('Новостной блог')?> </span>
        <h2 class="title"><?=pll__('Последние новости')?></h2>
        <div class="swiper news-cards">
            <div class="swiper-wrapper">
                <?php
                if ($partners_query->have_posts()) :
                    while ($partners_query->have_posts()) : $partners_query->the_post();
                        $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full'); // Получаем URL миниатюры
                        $title = get_the_title();
                ?>
                        <div class="swiper-slide item-news-card">
                            <img src="<?= esc_url($thumbnail); ?>" alt="" class="img-item-news-card" />
                            <h4 class="title-item-news-card"><?= esc_attr($title); ?></h4>
                            <a href="<?= get_permalink() ?>" class="else-item-news-card"><?=pll__('Подробнее')?> →</a>
                        </div>
                <?php
                    endwhile;
                else :
                    echo '<p>'.pll__('Новости не найдены').'</p>';
                endif;
                ?>
            </div>
        </div>
        <?php

        wp_reset_postdata(); // Reset post data

        // Determine the news page ID based on the current language
        $news_page_id = pll_get_post(98);

        // Display the "Все новости компании →" button
        ?>
        <a href="<?= get_page_link($news_page_id) ?>" class="btn-all-news">
            <?= pll__('Все новости компании → '); ?>
        </a>
    </div>
    <?php
}

//Сертификаты
function display_certificates_slider()
{
    $args = array(
        'post_type' => 'certificates', // Указываем кастомный пост-тип
        'posts_per_page' => -1,    // Получаем все записи
    );

    $certificates_query = new WP_Query($args);

    if ($certificates_query->have_posts()) :
        while ($certificates_query->have_posts()) : $certificates_query->the_post();
            $title = get_the_title();
            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full'); // Получаем URL миниатюры
    ?>
            <div class="swiper-slide partner">
                <?php if ($thumbnail): ?>
                    <img src="<?= esc_url($thumbnail); ?>" alt="<?= esc_attr($title); ?>" />
                <?php endif; ?>
            </div>
        <?php
        endwhile;
    else :
        echo '<p>Сертификаты не найдены</p>';
    endif;
    wp_reset_postdata(); // Сбрасываем данные поста после запроса
}

//Партнеры
function display_partners_slider()
{
    $args = array(
        'post_type' => 'partners', // Указываем кастомный пост-тип
        'posts_per_page' => -1,    // Получаем все записи
    );

    $partners_query = new WP_Query($args);

    if ($partners_query->have_posts()) :
        while ($partners_query->have_posts()) : $partners_query->the_post();
            $title = get_the_title();
            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full'); // Получаем URL миниатюры
        ?>
            <div class="swiper-slide partner">
                <?php if ($thumbnail): ?>
                    <img src="<?= esc_url($thumbnail); ?>" alt="<?= esc_attr($title); ?>" />
                <?php endif; ?>
            </div>
            <?php
        endwhile;
    else :
        echo '<p>Партнеры не найдены</p>';
    endif;
    wp_reset_postdata(); // Сбрасываем данные поста после запроса
}


//Вывод картинок на слайдере Вакансии, Стажировка и Главная
function render_img_bg_slider($slider, $media_file)
{
    if (have_rows($slider)) :
        while (have_rows($slider)) : the_row();
            $media = get_sub_field($media_file);
            if ($media['type'] == 'image') : ?>
                <img src="<?= esc_url($media['url']) ?>" alt="fon_img" class="swiper-slide fon-mainPage" />
            <?php elseif ($media && $media['type'] == 'video') :
                $video_class = is_front_page() ? 'swiper-slide' : 'swiper-slide fon-mainPage'; ?>
                <video
                    id="fon-mainSlider-1"
                    class="<?= esc_attr($video_class); ?>"
                    autoplay
                    muted
                    loop>
                    <source src="<?= esc_url($media['url']) ?>" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
        <?php endif;
        endwhile;
    else : ?>
        <p>Медиа не найдено</p>
        <?php endif;
}

//Вывод текста на слайдере Вакансии и Стажировка
function render_text_slider($slider_name, $slider_title, $slider_text)
{
    if (have_rows($slider_name)) :
        while (have_rows($slider_name)) : the_row();
            $title = get_sub_field($slider_title);
            $text = get_sub_field($slider_text);
            $allowed_tags = array(
                'think' => array(),
                'br' => array()
                // Добавьте другие теги по мере необходимости
            );

            // Условие для главной страницы
            if (is_front_page()) :
        ?>
                <div class="swiper-slide container-title">
                    <div class="flex-center">
                        <img src="<?= get_template_directory_uri() ?>/assets/icons/bublick.svg" alt="o" class="note" />
                        <span><?= esc_html($title) ?></span>
                    </div>
                    <h1 class="title">
                        <?= wp_kses($text, $allowed_tags); ?>
                    </h1>
                </div>
            <?php else : ?>
                <div class="swiper-slide container-title">
                    <div class="flex-center"><?= esc_html($title) ?></div>
                    <h1 class="title">
                        <?= wp_kses($text, $allowed_tags); ?>
                    </h1>
                </div>
        <?php endif;
        endwhile;
    else : ?>
        <p>Слайдеры не найдены</p>
        <?php endif;
}






//Старница категории, отоброжение товаров
function load_subcategory_products()
{
    $subcategory_id = intval($_POST['subcategory_id']);

    // Получаем товары для выбранной подкатегории
    $products = wc_get_products([
        'category' => [get_term($subcategory_id)->slug],
        'limit' => -1, // Вывод всех товаров
    ]);

    if (!empty($products)) {
        foreach ($products as $product) {
        ?>
            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="card-prodct">
                <span class="title-product"><?php echo esc_html($product->get_name()); ?></span>
                <span class="link-else"><?=pll__('Подробнее')?></span>
            </a>
        <?php
        }
    } else {
        echo '<p>' . pll__('Товары не найдены') . '</p>';
    }

    wp_die();
}
add_action('wp_ajax_load_subcategory_products', 'load_subcategory_products');
add_action('wp_ajax_nopriv_load_subcategory_products', 'load_subcategory_products');







// Выводит рекомендации продуктов
function render_recommended_products()
{

    // Получаем текущий продукт
    $product = wc_get_product(get_the_ID());

    // Получаем категории продукта
    $product_cats = wp_get_post_terms($product->get_id(), 'product_cat');

    $subcategory = null;

    // Проходим по всем категориям, чтобы найти подкатегорию (не родительскую категорию)
    if (!empty($product_cats) && !is_wp_error($product_cats)) {
        foreach ($product_cats as $cat) {
            if ($cat->parent != 0) {  // Если категория имеет родителя, она считается подкатегорией
                $subcategory = $cat;
                break;  // Берем первую найденную подкатегорию
            }
        }
    }

    // Если подкатегория найдена
    if ($subcategory) {
        // Запрос на получение продуктов из той же подкатегории
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 8, // Количество продуктов для вывода
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $subcategory->term_id,
                    'operator' => 'IN',
                ),
            ),
            'post__not_in' => array($product->get_id()), // Исключаем текущий продукт
        );

        $related_products = new WP_Query($args);

        if ($related_products->have_posts()) {
        ?>

            <div class="recomandation">
                <h3 class="title"><?=pll__('Рекомендации')?></h3>
                <div class="swiper slider-recomendation">
                    <div class="swiper-wrapper cads-product">
                        <?php
                        while ($related_products->have_posts()) {
                            $related_products->the_post();
                        ?>
                            <a href="<?= get_permalink() ?>" class="swiper-slide card-prodct">
                                <span class="title-product"><?= get_the_title() ?></span>
                                <span class="link-else"><?=pll__('Подробнее')?> </span>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <img
                    src="<?= get_template_directory_uri() ?>/assets/img/btn-sertificats-prev.svg"
                    alt=""
                    class="slider-btn-prev-recomendation" />
                <img
                    src="<?= get_template_directory_uri() ?>/assets/img/btn-sertificats-next.svg"
                    alt=""
                    class="slider-btn-next-recomendation" />
            </div>
            <?php
        }

        // Восстанавливаем оригинальные данные поста
        wp_reset_postdata();
    } else {
        //echo '<p>' . __('Продукты не найдены', 'your-textdomain') . '</p>';
    }
};



//Кастомное меню start
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {

        if ($depth == 0) {
            $products_title = pll__('Продукция');
            $career_title = pll__('Карьера');

            // For custom links
            if ($item->title == $products_title) {
                $output .= '<li class="navbar-link submenu-link">';
                $output .= '<span>' . $products_title . '</span>';
                $output .= '<img src="' . get_template_directory_uri() . '/assets/img/triangel-gray.svg" class="triangel" />';
                $output .= '</li>';

                $categories = get_terms([
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                    'parent' => 0, // Только родительские категории
                ]);

                if (! empty($categories) && ! is_wp_error($categories)) :
                    $output .= '<div class="container-submenu">';
            ?>

                    <?php $output .= '<ul class="submenu">'; ?>
                    <?php foreach ($categories as $category) :
                        $subcategories = get_terms([
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false,
                            'parent' => $category->term_id,
                        ]);
                    ?>

                        <?php
                        $dataCategory = "";
                        if (! empty($subcategories) && ! is_wp_error($subcategories)) {
                            $dataCategory = esc_attr($category->slug);
                        }
                        $output .= '<a href="' . get_term_link($category) . '" class="container-navbar-submenu-title" data-category="' . $dataCategory . '">';
                        $output .= '<span>' . esc_html($category->name) . '</span>';
                        $output .= '<img src="' . get_template_directory_uri() . '/assets/img/submenu.svg" class="triangel" />';
                        $output .= '</a>';
                        ?>
                    <?php endforeach; ?>
                    <?php $output .= '</ul>'; ?>

                    <?php foreach ($categories as $category) :
                        $subcategories = get_terms([
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false,
                            'parent' => $category->term_id,
                        ]);

                        if (! empty($subcategories) && ! is_wp_error($subcategories)) : ?>

                            <?php
                            $output .= '<ul class="submenu-categories" data-category="' . esc_attr($category->slug) . '">';
                            foreach ($subcategories as $subcategory) {
                                $output .= '<li class="categories-submenu-title">';
                                //                            $output .= '<a href="'.get_term_link($subcategory).'">'.esc_html($subcategory->name).'</a>';
                                $output .= '<a href="' . add_query_arg('subcategory', $subcategory->term_id, get_term_link($category)) . '" data-subcategory-id="' . esc_attr($subcategory->term_id) . '">' . esc_html($subcategory->name) . '</a>';
                                $output .= '</li>';
                            }
                            // Add other categories here
                            $output .= '</ul>';
                            ?>
<?php endif;
                    endforeach;
                    $output .= '</div>';
                endif;
            } elseif ($item->title == $career_title) {
                $output .= '<li class="navbar-link submenu-link-cariere">';
                $output .= '<span>' . $career_title . '</span>';
                $output .= '<img src="' . get_template_directory_uri() . '/assets/img/triangel-gray.svg" class="triangel" />';
                $output .= '</li>';

                $locations = get_nav_menu_locations();
                $menu_items = wp_get_nav_menu_items($locations['primary-menu']);

                $child_items = get_child_menu_items($item->ID, $menu_items);
                if (!empty($child_items)) {
                    $output .= '<div class="container-submenu-cariere">';
                    $output .= '<ul class="submenu">';
                    foreach ($child_items as $child_item) {
                        $output .= '<a href="' . esc_url($child_item->url) . '" class="container-navbar-submenu-title"><span>' . esc_html($child_item->title) . '</span><img src="' . get_template_directory_uri() . '/assets/img/submenu.svg" alt="" class="navbar-submenu-icon" /></a>';
                    }
                    $output .= '</ul>';
                    $output .= '</div>';
                }
            } else {
                $output .= '<a href="' . esc_attr($item->url) . '" class="navbar-link">' . esc_html($item->title) . '</a>';
            }
        }
    }
}

function my_nav_menu($args)
{
    $args = array_merge([
        'container'       => false,
        'echo'            => false,
        'items_wrap'      => '<nav class="navbar">%3$s</nav>',
        'depth'           => 10,
        'walker'          => new Custom_Walker_Nav_Menu()
    ], $args);

    echo wp_nav_menu($args);
}


function get_child_menu_items($parent_id, $menu_items)
{
    $child_items = array();
    foreach ($menu_items as $menu_item) {
        if ($menu_item->menu_item_parent == $parent_id) {
            $child_items[] = $menu_item;
        }
    }
    return $child_items;
}
//Кастомное меню end

// print countries in footers
function print_countries_footer($count = 0, $offset = 0) {
    $countries = get_posts([
        'post_type' => 'countries',
        'posts_per_page' => -1,
        'lang' => pll_current_language()
    ]);

    if($count == -1) {
        $count = count($countries);
    }

    for ($j = $offset; $j < $count ; $j++) { 
        $country = $countries[$j];
        ?>
            <li class="link-line span-list-country"><?=$country->post_title?></li>
            <li>
                <strong class="link-line"><?=pll__('Номер')?>:</strong>
                <?php
                $phones = get_field('phone', $country->ID);
                $address = get_field('address', $country->ID);
                $phones = explode('|', $phones);

                $output = "";
                foreach ($phones as $i => $phone) {
                    $output .= '<a href="tel:' . esc_html(trim($phone)) . '" class="link-line span-list-phone">' . esc_html(trim($phone)) . '</a>';
                    if($i+1 < count($phones)) {
                        $output .= '<span class="span-list-phone '.($i+1).'">|</span>';
                    }
                }
                echo $output;
                ?>
            </li>
            <li class="link-line">
                <strong class="link-line"><?=pll__('Адрес')?>:</strong>
                <span class="span-list-adress">
                    <?= $address; ?>
                </span>
            </li>
            <!-- НЕ УБИРАТЬ -->
            <li></li>					
        <?php
    }
}
//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types; 
} 
add_action('upload_mimes', 'add_file_types_to_uploads');


// Вакансии
pll_register_string('current_vacancies', 'Актуальные вакансии');
pll_register_string('our_advantages', 'Наши преимущества');
pll_register_string('more_than_seventeen', 'Мы, более 17 лет являемся одним из лидеров на рынке дистрибуции
				химического сырья и готовой продукции в Республике Узбекистан и по
				всей Центральной Азии.');
pll_register_string('career_growth', 'Карьерный рост');
pll_register_string('book_club', 'Книжный клуб');
pll_register_string('medical_examination', 'Медосмотр');
pll_register_string('business_trips', 'Командировки');
pll_register_string('sport', 'Спорт');
pll_register_string('education', 'Обучение');
pll_register_string('bonuses', 'Бонусы');
pll_register_string('delicious_lunch', 'Вкусный обед');
pll_register_string('stages_of_employment', 'Этапы трудоустройства');
pll_register_string('data_not_fount', 'Данные не найдены');
pll_register_string('submit_an_application', 'Подать заявку');


// Стажировка
pll_register_string('intership', 'Стажировка');
pll_register_string('internship_stages', 'Этапы стажировки');
pll_register_string('apply_intership', 'Подать заявку на стажировку');
pll_register_string('data_not_found', 'Данные не найдены');




// Меню
pll_register_string('production', 'Продукция');
pll_register_string('career', 'Карьера');
pll_register_string('main', 'Главная');

// Новости
pll_register_string('news', 'Новости');


// Шоурум
pll_register_string('company_showroom', 'Шоурум компании');
pll_register_string('what_waits_you', 'Что вас ждет в нашем шоуруме');
pll_register_string('why_you_should_visit', 'Почему стоит посетить наш шоурум');
pll_register_string('join_us', 'Присоеденяйтесь');
pll_register_string('showroom', 'Шоурум');
pll_register_string('contact_us', 'Связаться с нами');
pll_register_string('phone_number', 'Номер телефона');
pll_register_string('address', 'Адрес');
pll_register_string('welcome_to_showroom', '<think>Добро пожаловать в шоурум</think>
                            компании «Merit Chemicals»');


// Страница продукт

pll_register_string('catalog', 'Каталог');
pll_register_string('navigation', 'Навигация');
pll_register_string('callback', 'Обратная связь');
pll_register_string('developed_by', 'Разработано iCORP');
pll_register_string('about_company', 'О компании');
pll_register_string('distribution_chemical_raw_materils', '<think>Дистрибуция химического сырья</think>
                            в Узбекистане и Центральной Азии');
pll_register_string('short_about_us', '«Merit Chemicals» с 2007-года является одним из основных
                            поставщиков химического сырья и готовой продукции.');
pll_register_string('company_in_numbers', 'Компания в цифрах');
pll_register_string('our_mission', 'НАША МИССИЯ');
pll_register_string('our_view', 'НАШЕ ВИДЕНИЕ');
pll_register_string('they_trust_us', 'Нам доверяют');
pll_register_string('our_partners', 'Наши <think>партнеры</think>');
pll_register_string('sertications', 'Сертификация');
pll_register_string('sertificate', 'Сертификаты');
pll_register_string('copyright', '© 2024 | Все права защищены');
pll_register_string('search', 'Поиск');
pll_register_string('products_404', 'Товары не найдены');





// Main
pll_register_string('officess_warehouses', 'Офисы и склады');
pll_register_string('we_provide_full_range', 'Мы предоставляем полный спектр логистических услуг: прямые
                            поставки химического сырья и грузов любым видом транспорта,
                            аренда складов и ответственное хранение.');
pll_register_string('direct_deliveries', 'Осуществляем прямые поставки');
pll_register_string('logistoc', 'Логистика');
pll_register_string('work_for_customers_clients', 'Работаем для потребителей и клиентов');
pll_register_string('our_production', 'Наша продукция');
pll_register_string('we_offer_chemical_material', 'Предлагаем химическое сырьё
                    <think>широкого спектра направлений</think>');
pll_register_string('on_market_since', 'На рынке с 2007 года');
pll_register_string('total_area', 'Общая площадь складов и офисов компании');
pll_register_string('numbers_of_partners', 'Количество партнёров из более 20 стран мира');
pll_register_string('more_than_employee', 'Более 300 сотрудников в штате');
pll_register_string('full_catalog', 'Полный каталог продукции');

// Single-news
pll_register_string('description', 'Описание');


// Single-product
pll_register_string('how_to_use', 'Применение');
pll_register_string('package', 'Упаковка');

// Search
pll_register_string('recomendation', 'Рекомендации');
pll_register_string('search_result', 'Результаты поиска');
pll_register_string('read_more', 'Подробнее');
pll_register_string('nothing_found', 'Ничего не найдено');
pll_register_string('sorry_nothing_found', 'Извините, но ничего не соответствует вашим критериям поиска. Пожалуйста, попытайтесь снова с другими ключевыми словами.');


// Footer
pll_register_string('footer_short_about', 'OOO «Merit Chemicals» — Поставщик <br />
				химического сырья и готовой продукции!');
pll_register_string('any_questions', 'Возникли вопросы');
pll_register_string('callback_form', 'Форма для связи');


// Contacts
pll_register_string('social_links', 'Социальные сети');
pll_register_string('mail_address', 'Почта');
pll_register_string('number_phone', 'Номер');
pll_register_string('office_location', 'Расположение офиса');


// Catigories page
pll_register_string('product_catalog', 'Каталог продукции');
pll_register_string('download_catalog', 'Скачать каталог');

// News
pll_register_string('news_blog', 'Новостной блог');
pll_register_string('last_news', 'Последние новости');
pll_register_string('news_404', 'Новости не найдены');
pll_register_string('all_news', 'Все новости компании → ');
pll_register_string('', '');
pll_register_string('', '');
pll_register_string('', '');
pll_register_string('', '');
pll_register_string('', '');
pll_register_string('', '');
pll_register_string('', '');
pll_register_string('', '');
pll_register_string('', '');






function product_search_ajax() {


    $query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';

    if (empty($query)) {
        wp_send_json_error('Query is empty');
    }

    if (function_exists('pll_current_language')) {
        $current_language = pll_current_language(); // Get current language
    } else {
        $current_language = ''; // Default fallback if Polylang is not active
    }


    $args = array(
        'post_type' => 'product', // Ваш тип поста
        's' => $query,            // Искать в заголовках постов
        'posts_per_page' => 5,    // Ограничение на количество результатов
        'lang' => $current_language // Filter by current language
    );

    $search_query = new WP_Query($args);

    if ($search_query->have_posts()) {
        ob_start();
        while ($search_query->have_posts()) {
            $search_query->the_post();
            $title = get_the_title();
            $permalink = get_the_permalink();
            $excerpt = wp_trim_words(get_the_excerpt(), 10); // Обрезаем описание до 10 слов
            ?>
            <div class="search-result-item">
                <a href="<?= esc_url($permalink); ?>">
                    <h3><?= esc_html($title); // Выводим название ?></h3>
                    <p><?=  esc_html($excerpt); // Выводим описание ?></p>
                </a>
            </div>
                <?php
        }
        wp_reset_postdata();

        wp_send_json_success(ob_get_clean());
    } else {
        wp_send_json_error('Ничего не найдено');
    }



}
add_action('wp_ajax_product_search_ajax', 'product_search_ajax');
add_action('wp_ajax_nopriv_product_search_ajax', 'product_search_ajax');

<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package web
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function web_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'web_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function web_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'web_pingback_header' );

/**
 * Отключение эмодзи
 */
function disable_emojis() {
    // Удаляем действия для фронтенда и админки
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    
    // Удаляем фильтры для контента, RSS и электронной почты
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji'); 
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    
    // Отключаем TinyMCE emojis
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    
    // Отключаем эмодзи в REST API
    remove_action('rest_api_init', 'wp_oembed_register_route');
}
add_action('init', 'disable_emojis');

// Отключаем TinyMCE emojis
function disable_emojis_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    }
    return array();
}

/**
 * Отключение версии WordPress
 */
remove_action('wp_head', 'wp_generator');

/**
 * Отключение wlwmanifest.xml
 */
remove_action('wp_head', 'wlwmanifest_link');

/**
 * Отключение RSD для удалённого публикации
 */
remove_action('wp_head', 'rsd_link');

/**
 * Отключение ссылок REST API в <head>
 */
remove_action('wp_head', 'rest_output_link_wp_head');

/**
 * Отключение oEmbed
 */
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

/**
 * Отключение коротких ссылок в <head>
 */
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * Отключение стилей Gutenberg 
 */
add_action('wp_enqueue_scripts', function() {
    wp_dequeue_style('wp-block-library'); // Отключение стилей блоков
    wp_dequeue_style('wp-block-library-theme'); // Отключение темы блоков
    wp_dequeue_style('wc-block-style'); // Отключение стилей блоков WooCommerce
}, 100);

/**
 * Отключение редактора блоков (Gutenberg)
 */
add_filter('use_block_editor_for_post', '__return_false');

/**
 * Отключение XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Отключение jQuery Migrate
 */
add_action('wp_default_scripts', function ($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, ['jquery-migrate']);
    }
});

/**
 * Ограничение количества ревизий постов и изменение интервала автосохранения
 */
if ( ! defined( 'WP_POST_REVISIONS' ) ) {
    define( 'WP_POST_REVISIONS', 3 ); // Устанавливаем максимальное количество ревизий
}
if ( ! defined( 'AUTOSAVE_INTERVAL' ) ) {
    define( 'AUTOSAVE_INTERVAL', 600 ); // Изменение интервала автосохранения на 10 минут
}

/**
 * Отключение комментариев
 */
add_action('init', function() {
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
});

/**
 * Отключение Heartbeat API
 */
add_action('init', function() {
    wp_deregister_script('heartbeat');
});

/**
 * Включаем ленивая загрузка для изображений
 */
add_filter('wp_get_attachment_image_attributes', function($attr) {
    $attr['loading'] = 'lazy';
    return $attr;
});

/**
 * Отключаем ненужные размеры изображений
 */
add_filter('intermediate_image_sizes_advanced', function($sizes) {
    unset($sizes['medium_large']);
    unset($sizes['1536x1536']);
    unset($sizes['2048x2048']);
    return $sizes;
});

/**
 * Отключение RSS-лент
 */
add_action('do_feed', function() {
    wp_die('RSS ленты отключены.');
}, 1);
add_action('do_feed_rdf', function() {
    wp_die('RSS ленты отключены.');
}, 1);
add_action('do_feed_rss', function() {
    wp_die('RSS ленты отключены.');
}, 1);
add_action('do_feed_rss2', function() {
    wp_die('RSS ленты отключены.');
}, 1);
add_action('do_feed_atom', function() {
    wp_die('RSS ленты отключены.');
}, 1);

/**
 * Убираем версии из URL стилей и скриптов
 */
add_filter('style_loader_src', 'remove_version_from_assets', 9999);
add_filter('script_loader_src', 'remove_version_from_assets', 9999);

function remove_version_from_assets($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

/**
 * Отключаем автоматические обновления тем и плагинов
 */
add_filter('auto_update_theme', '__return_false');
add_filter('auto_update_plugin', '__return_false');

/**
 * Добавляем предзагрузку шрифтов для ускорения загрузки
 */
add_filter('style_loader_tag', function($html, $handle) {
    if (strpos($handle, '-font') !== false) {
        return str_replace("rel='stylesheet'", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"", $html);
    }
    return $html;
}, 10, 2);

/**
 * Отключаем oEmbed функционал
 */
add_action('init', function() {
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_action('wp_head', 'rest_output_link_wp_head');
});
/**
 * Очищаем админку от ненужных пунктов меню
 */
add_action('admin_menu', function() {
    remove_menu_page('edit-comments.php'); // Удалить пункт "Комментарии"
    remove_menu_page('tools.php'); // Удалить пункт "Инструменты"
});

function custom_admin_footer() {
    echo 'Development <a href="https://webbloom.studio/" target="_blank">Webbloom Studio</a>';
}
add_filter('admin_footer_text', 'custom_admin_footer');






/**
 * отключение блоков на главном экране админ панели
 */
function remove_default_dashboard_widgets() {
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // На виду
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');    // Деятельность
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');   // Швидка чернетка
    remove_meta_box('dashboard_primary', 'dashboard', 'side');       // Новости и заходи WordPress
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal'); // Стан здоров'я сайту
	remove_meta_box('e-dashboard-overview', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'remove_default_dashboard_widgets');

/**
 * кастом мета боксы в дашборд
 */
function custom_dashboard_widgets() {
    // Добавляем метабокс для вставки кода и скриптов в header
    wp_add_dashboard_widget(
        'custom_header_code_widget',
        'Code to header',
        'custom_header_code_widget_display'
    );

    // Добавляем метабокс для вставки кода и скриптов в footer
    wp_add_dashboard_widget(
        'custom_footer_code_widget',
        'Code to footer',
        'custom_footer_code_widget_display'
    );
}
add_action('wp_dashboard_setup', 'custom_dashboard_widgets');

// Функция для отображения метабокса для header
function custom_header_code_widget_display() {
    ?>
    <form method="post" action="options.php">
        <?php
        settings_fields('custom_dashboard_header_code_group');
        do_settings_sections('custom_dashboard_header_code_group');
        ?>
        <textarea name="custom_header_code" rows="10" cols="50" class="large-text"><?php echo esc_attr(get_option('custom_header_code')); ?></textarea>
        <?php submit_button(); ?>
    </form>
    <?php
}

// Функция для отображения метабокса для footer
function custom_footer_code_widget_display() {
    ?>
    <form method="post" action="options.php">
        <?php
        settings_fields('custom_dashboard_footer_code_group');
        do_settings_sections('custom_dashboard_footer_code_group');
        ?>
        <textarea name="custom_footer_code" rows="10" cols="50" class="large-text"><?php echo esc_attr(get_option('custom_footer_code')); ?></textarea>
        <?php submit_button(); ?>
    </form>
    <?php
}

// Регистрируем настройки
function custom_dashboard_code_settings() {
    register_setting('custom_dashboard_header_code_group', 'custom_header_code');
    register_setting('custom_dashboard_footer_code_group', 'custom_footer_code');
}
add_action('admin_init', 'custom_dashboard_code_settings');

// Выводим код сразу после открывающего тега <head>
function insert_custom_header_code() {
    $custom_header_code = get_option('custom_header_code');
    if ($custom_header_code) {
        echo $custom_header_code;
    }
}
add_action('wp_head', 'insert_custom_header_code', 1);

// Выводим код перед закрывающим тегом </body>
function insert_custom_footer_code() {
    $custom_footer_code = get_option('custom_footer_code');
    if ($custom_footer_code) {
        echo $custom_footer_code;
    }
}
add_action('wp_footer', 'insert_custom_footer_code', 20);

/**
 * 
 */
add_action('wp_dashboard_setup', 'remove_only_plugin_dashboard_widgets', 100);
function remove_only_plugin_dashboard_widgets() {
    global $wp_meta_boxes;

    // Оставляем твои виджеты
    $allowed_widgets = ['custom_header_code_widget', 'custom_footer_code_widget'];

    // Удаляем виджеты, кроме твоих
    foreach ($wp_meta_boxes['dashboard']['normal']['core'] as $widget_id => $widget) {
        if (!in_array($widget_id, $allowed_widgets)) {
            unset($wp_meta_boxes['dashboard']['normal']['core'][$widget_id]);
        }
    }
    foreach ($wp_meta_boxes['dashboard']['side']['core'] as $widget_id => $widget) {
        if (!in_array($widget_id, $allowed_widgets)) {
            unset($wp_meta_boxes['dashboard']['side']['core'][$widget_id]);
        }
    }
}


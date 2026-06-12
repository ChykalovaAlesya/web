<?php
/**
 * ACF: options page, "Виграні справи" CPT, and local field groups for the
 * homepage + site (header/footer) content.
 *
 * Everything is defined in code (version-controlled). The VALUES are edited in
 * wp-admin. All template output falls back to sensible defaults via web_f() /
 * web_rows(), so the site renders correctly even before any field is filled and
 * even if ACF is not active.
 *
 * @package web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* =========================================================================
 * Safe getters (work with ACF inactive / empty values)
 * ====================================================================== */

/** Scalar field with fallback. */
function web_f( $name, $default = '', $post_id = false ) {
	if ( function_exists( 'get_field' ) ) {
		$v = get_field( $name, $post_id );
		if ( null !== $v && '' !== $v && false !== $v && array() !== $v ) {
			return $v;
		}
	}
	return $default;
}

/** Option (site-settings) field with fallback. */
function web_opt( $name, $default = '' ) {
	return web_f( $name, $default, 'option' );
}

/** Repeater rows with fallback to a default array. */
function web_rows( $name, $default = array(), $post_id = false ) {
	if ( function_exists( 'have_rows' ) && have_rows( $name, $post_id ) ) {
		$rows = get_field( $name, $post_id );
		if ( ! empty( $rows ) ) {
			return $rows;
		}
	}
	return $default;
}

/* =========================================================================
 * Options page — "Налаштування сайту" (header / footer / contacts)
 * ====================================================================== */
add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}
	acf_add_options_page( array(
		'page_title' => __( 'Налаштування сайту', 'web' ),
		'menu_title' => __( 'Налаштування сайту', 'web' ),
		'menu_slug'  => 'web-settings',
		'capability' => 'edit_theme_options',
		'icon_url'   => 'dashicons-admin-generic',
		'position'   => 59,
		'redirect'   => false,
	) );
} );

/* =========================================================================
 * CPT — "Виграні справи" (won cases)
 * ====================================================================== */
add_action( 'init', function () {
	register_post_type( 'case', array(
		'labels'       => array(
			'name'          => __( 'Виграні справи', 'web' ),
			'singular_name' => __( 'Справа', 'web' ),
			'add_new_item'  => __( 'Додати справу', 'web' ),
			'edit_item'     => __( 'Редагувати справу', 'web' ),
			'menu_name'     => __( 'Виграні справи', 'web' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-awards',
		'menu_position'=> 25,
		'supports'     => array( 'title', 'editor', 'thumbnail' ),
		'rewrite'      => array( 'slug' => 'cases' ),
		'show_in_rest' => true,
	) );
} );

/* =========================================================================
 * Local field groups
 * ====================================================================== */
add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$icon_choices = array(
		'svc-mil'    => 'Військове (svc-mil)',
		'svc-car'    => 'Авто (svc-car)',
		'svc-scales' => 'Терези (svc-scales)',
		'svc-family' => 'Сім’я (svc-family)',
		'svc-doc'    => 'Документ (svc-doc)',
		'svc-clock'  => 'Годинник (svc-clock)',
	);

	/* ---- helpers to keep field defs compact ---------------------------- */
	$txt  = function ( $key, $label, $default = '' ) {
		return array( 'key' => $key, 'label' => $label, 'name' => preg_replace( '/^field_/', '', $key ), 'type' => 'text', 'default_value' => $default );
	};
	$area = function ( $key, $label, $default = '' ) {
		return array( 'key' => $key, 'label' => $label, 'name' => preg_replace( '/^field_/', '', $key ), 'type' => 'textarea', 'new_lines' => 'wpautop', 'default_value' => $default );
	};

	/* =====================================================================
	 * GROUP 1 — Site settings (header / footer / contacts)  [options page]
	 * ================================================================== */
	acf_add_local_field_group( array(
		'key'    => 'group_web_site',
		'title'  => __( 'Налаштування сайту', 'web' ),
		'fields' => array(

			array( 'key' => 'tab_site_contacts', 'label' => 'Контакти', 'type' => 'tab' ),
			$txt( 'field_web_phone', 'Телефон (текст)', '(067) 287-00-44' ),
			$txt( 'field_web_phone_href', 'Телефон (посилання)', 'tel:+380672870044' ),
			$txt( 'field_web_email', 'Email', 'r.smolin@gmail.com' ),
			$txt( 'field_web_header_cta', 'Кнопка в хедері', 'Отримати консультацію' ),

			array( 'key' => 'tab_site_social', 'label' => 'Соцмережі', 'type' => 'tab' ),
			$txt( 'field_web_tg', 'Telegram URL', 'https://t.me/' ),
			$txt( 'field_web_fb', 'Facebook URL', '#' ),
			$txt( 'field_web_ig', 'Instagram URL', '#' ),
			$txt( 'field_web_yt', 'YouTube URL', '#' ),

			array( 'key' => 'tab_site_nav', 'label' => 'Меню (хедер)', 'type' => 'tab' ),
			array(
				'key' => 'field_web_nav', 'label' => 'Пункти меню', 'name' => 'nav_items', 'type' => 'repeater',
				'button_label' => 'Додати пункт', 'layout' => 'table',
				'sub_fields' => array( $txt( 'field_web_nav_label', 'Назва' ), $txt( 'field_web_nav_url', 'Посилання' ) ),
			),
			array(
				'key' => 'field_web_mega', 'label' => 'Мега-меню «Послуги»', 'name' => 'mega_columns', 'type' => 'repeater',
				'button_label' => 'Додати колонку', 'layout' => 'block',
				'sub_fields' => array(
					$txt( 'field_web_mega_title', 'Заголовок колонки' ),
					array(
						'key' => 'field_web_mega_items', 'label' => 'Пункти', 'name' => 'items', 'type' => 'repeater',
						'button_label' => 'Додати пункт', 'layout' => 'table',
						'sub_fields' => array( $txt( 'field_web_mega_item_label', 'Назва' ), $txt( 'field_web_mega_item_url', 'Посилання' ) ),
					),
				),
			),

			array( 'key' => 'tab_site_footer', 'label' => 'Футер', 'type' => 'tab' ),
			$area( 'field_web_footer_tagline', 'Опис під логотипом', 'Юридичний захист, консультації та повний супровід — з акцентом на результат.' ),
			array(
				'key' => 'field_web_footer_services', 'label' => 'Колонка «Послуги»', 'name' => 'footer_services', 'type' => 'repeater',
				'button_label' => 'Додати', 'layout' => 'table',
				'sub_fields' => array( $txt( 'field_web_fs_label', 'Назва' ), $txt( 'field_web_fs_url', 'Посилання' ) ),
			),
			array(
				'key' => 'field_web_footer_pubs', 'label' => 'Колонка «Публікації»', 'name' => 'footer_publications', 'type' => 'repeater',
				'button_label' => 'Додати', 'layout' => 'table',
				'sub_fields' => array( $txt( 'field_web_fp_label', 'Назва' ), $txt( 'field_web_fp_url', 'Посилання' ) ),
			),
			$txt( 'field_web_copyright', 'Копірайт', '© 2015–2026. Адвокат Роман Сімутін. Всі права захищені.' ),
		),
		'location' => array( array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'web-settings' ) ) ),
	) );

	/* =====================================================================
	 * GROUP 2 — Homepage content  [front page]
	 * ================================================================== */
	acf_add_local_field_group( array(
		'key'    => 'group_web_home',
		'title'  => __( 'Контент головної сторінки', 'web' ),
		'fields' => array(

			array( 'key' => 'tab_home_hero', 'label' => 'Hero', 'type' => 'tab' ),
			$txt( 'field_home_hero_eyebrow', 'Локація (над заголовком)', 'Київ, Бровари' ),
			$txt( 'field_home_hero_title', 'Заголовок', 'Адвокат Сімутін Роман' ),
			$area( 'field_home_hero_text', 'Текст', 'Захист у кримінальних, військових, сімейних справах. Телефонуйте!' ),
			$txt( 'field_home_hero_cta', 'Кнопка 1 (текст)', 'Отримати консультацію' ),
			$txt( 'field_home_hero_cta2', 'Кнопка 2 (текст)', 'Послуги' ),
			array( 'key' => 'field_home_hero_image', 'label' => 'Фонове фото (hero)', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ),

			array( 'key' => 'tab_home_intro', 'label' => 'Досвід та місія', 'type' => 'tab' ),
			$txt( 'field_home_intro_eyebrow', 'Надзаголовок', 'Досвід та місія' ),
			$txt( 'field_home_intro_title', 'Заголовок', 'Адвокат із 20-річним стажем' ),
			$area( 'field_home_intro_text', 'Текст (абзаци)', '' ),

			array( 'key' => 'tab_home_services', 'label' => 'Послуги', 'type' => 'tab' ),
			$txt( 'field_home_services_eyebrow', 'Надзаголовок', 'Послуги' ),
			$txt( 'field_home_services_title', 'Заголовок', 'Ключові напрямки юридичного захисту' ),
			array(
				'key' => 'field_home_services_small', 'label' => 'Картки (малі)', 'name' => 'services_small', 'type' => 'repeater',
				'button_label' => 'Додати картку', 'layout' => 'block',
				'sub_fields' => array(
					array( 'key' => 'field_hss_icon', 'label' => 'Іконка', 'name' => 'icon', 'type' => 'select', 'choices' => $icon_choices ),
					$txt( 'field_hss_title', 'Заголовок' ), $area( 'field_hss_text', 'Текст' ), $txt( 'field_hss_cta', 'Кнопка', 'Отримати захист' ),
				),
			),
			array(
				'key' => 'field_home_services_wide', 'label' => 'Картки (широкі)', 'name' => 'services_wide', 'type' => 'repeater',
				'button_label' => 'Додати картку', 'layout' => 'block',
				'sub_fields' => array(
					array( 'key' => 'field_hsw_icon', 'label' => 'Іконка', 'name' => 'icon', 'type' => 'select', 'choices' => $icon_choices ),
					$txt( 'field_hsw_title', 'Заголовок' ), $area( 'field_hsw_text', 'Текст' ), $txt( 'field_hsw_cta', 'Кнопка' ),
				),
			),

			array( 'key' => 'tab_home_why', 'label' => 'Переваги', 'type' => 'tab' ),
			$txt( 'field_home_why_eyebrow', 'Надзаголовок', 'Переваги' ),
			$txt( 'field_home_why_title', 'Заголовок', 'Чому варто обрати саме адвоката Романа Сімутіна?' ),
			array(
				'key' => 'field_home_why_items', 'label' => 'Пункти', 'name' => 'why_items', 'type' => 'repeater',
				'button_label' => 'Додати пункт', 'layout' => 'block',
				'sub_fields' => array( $txt( 'field_hwi_title', 'Заголовок' ), $area( 'field_hwi_text', 'Текст' ) ),
			),
			array( 'key' => 'field_home_why_image', 'label' => 'Фото', 'name' => 'why_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium' ),

			array( 'key' => 'tab_home_cases', 'label' => 'Виграні справи', 'type' => 'tab' ),
			$txt( 'field_home_cases_eyebrow', 'Надзаголовок', 'Практика' ),
			$txt( 'field_home_cases_title', 'Заголовок', 'Виграні справи' ),
			array( 'key' => 'field_home_cases_note', 'label' => '', 'type' => 'message', 'message' => 'Картки беруться з розділу «Виграні справи» (CPT).' ),

			array( 'key' => 'tab_home_stats', 'label' => 'Статистика', 'type' => 'tab' ),
			$txt( 'field_home_stats_eyebrow', 'Надзаголовок', 'Цифри' ),
			$txt( 'field_home_stats_title', 'Заголовок', 'Статистика та реальні досягнення' ),
			$area( 'field_home_stats_lead', 'Опис', 'Ми оперуємо цифрами, які підтверджують нашу ефективність. Кожен відсоток – це реальна доля людини, яку вдалося змінити на краще.' ),
			array(
				'key' => 'field_home_stats_items', 'label' => 'Показники', 'name' => 'stats_items', 'type' => 'repeater',
				'button_label' => 'Додати показник', 'layout' => 'table',
				'sub_fields' => array( $txt( 'field_hsi_value', 'Значення (%)' ), $txt( 'field_hsi_label', 'Підпис' ) ),
			),

			array( 'key' => 'tab_home_faq', 'label' => 'FAQ', 'type' => 'tab' ),
			$txt( 'field_home_faq_eyebrow', 'Надзаголовок', 'FAQ' ),
			$txt( 'field_home_faq_title', 'Заголовок', 'Часті запитання' ),
			array(
				'key' => 'field_home_faq_items', 'label' => 'Запитання', 'name' => 'faq_items', 'type' => 'repeater',
				'button_label' => 'Додати запитання', 'layout' => 'block',
				'sub_fields' => array( $txt( 'field_hfi_q', 'Запитання' ), $area( 'field_hfi_a', 'Відповідь' ) ),
			),

			array( 'key' => 'tab_home_blog', 'label' => 'Блог', 'type' => 'tab' ),
			$txt( 'field_home_blog_eyebrow', 'Надзаголовок', 'Блог' ),
			$txt( 'field_home_blog_title', 'Заголовок', 'Статті та публікації' ),
			array( 'key' => 'field_home_blog_note', 'label' => '', 'type' => 'message', 'message' => 'Картки беруться з останніх записів блогу (Записи).' ),

			array( 'key' => 'tab_home_cta', 'label' => 'CTA', 'type' => 'tab' ),
			$txt( 'field_home_cta_title', 'Заголовок', 'Потрібна допомога?' ),
			$area( 'field_home_cta_text', 'Текст', 'Ми зможемо її надати.' ),
			$txt( 'field_home_cta_btn', 'Кнопка (текст)', 'Отримати консультацію' ),
		),
		'location' => array( array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ) ),
		'menu_order' => 0,
	) );

	/* =====================================================================
	 * GROUP 3 — "Виграні справи" CPT fields
	 * ================================================================== */
	acf_add_local_field_group( array(
		'key'    => 'group_web_case',
		'title'  => __( 'Дані справи', 'web' ),
		'fields' => array(
			$txt( 'field_case_tag', 'Тег (категорія)', '' ),
			$txt( 'field_case_num', 'Номер справи', '' ),
			$area( 'field_case_excerpt', 'Короткий опис', '' ),
		),
		'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'case' ) ) ),
		'position' => 'acf_after_title',
	) );
} );

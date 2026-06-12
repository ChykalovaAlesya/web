<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package web
 */

$phone        = web_opt( 'phone', '(067) 287-00-44' );
$phone_href   = web_opt( 'phone_href', 'tel:+380672870044' );
$header_cta   = web_opt( 'header_cta', __( 'Отримати консультацію', 'web' ) );

/*
 * Menu / mega-menu columns / nav links come from the "Налаштування сайту" ACF
 * options page; the arrays below are the Figma defaults / fallback used when a
 * field is empty (or ACF is inactive). Structure is unchanged so the markup
 * below works for both sources.
 */
$services_columns = web_rows( 'mega_columns', array(
	array(
		'title' => __( 'Військове право', 'web' ),
		'items' => array(
			array( 'label' => __( 'Відстрочка від мобілізації', 'web' ), 'url' => '#' ),
			array( 'label' => __( 'Демобілізація / звільнення зі служби', 'web' ), 'url' => '#' ),
			array( 'label' => __( "Виплати військовим (при звільненні, сім'ям загиблих)", 'web' ), 'url' => '#' ),
			array( 'label' => __( 'Оскарження рішень ВЛК', 'web' ), 'url' => '#' ),
		),
	),
	array(
		'title' => __( 'Захист водіїв', 'web' ),
		'items' => array(
			array( 'label' => __( 'Адвокат по ДТП', 'web' ), 'url' => '#' ),
			array( 'label' => __( 'Стаття 130 КУпАП', 'web' ), 'url' => '#' ),
		),
	),
	array(
		'title' => __( 'Кримінальні справи', 'web' ),
		'items' => array(
			array( 'label' => __( 'Захист підозрюваного / обвинуваченого', 'web' ), 'url' => '#' ),
			array( 'label' => __( 'Економічні злочини', 'web' ), 'url' => '#' ),
			array( 'label' => __( "Злочини проти життя та здоров'я", 'web' ), 'url' => '#' ),
		),
	),
	array(
		'title' => __( 'Сімейні справи', 'web' ),
		'items' => array(
			array( 'label' => __( 'Розлучення, поділ майна', 'web' ), 'url' => '#' ),
			array( 'label' => __( 'Аліменти', 'web' ), 'url' => '#' ),
			array( 'label' => __( 'Спори про дітей', 'web' ), 'url' => '#' ),
		),
	),
), 'option' );

$nav_items = web_rows( 'nav_items', array(
	array( 'label' => __( 'Про нас', 'web' ), 'url' => '#about' ),
	array( 'label' => __( 'Блог', 'web' ), 'url' => '#blog' ),
	array( 'label' => __( 'Виграні справи', 'web' ), 'url' => '#cases' ),
	array( 'label' => __( 'Ціни', 'web' ), 'url' => '#prices' ),
), 'option' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<header id="masthead" class="site-header">
			<div class="container header-inner">

				<div class="site-branding">
					<?php if (has_custom_logo()) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="text-logo" rel="home">
							<span class="text-logo__name"><?php bloginfo('name'); ?></span>
							<span class="text-logo__role"><?php esc_html_e('Адвокат', 'web'); ?></span>
						</a>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Головне меню', 'web'); ?>">
					<ul class="primary-menu">

						<li class="menu-item menu-item-has-children has-mega">
							<a href="#services" class="mega-toggle">
								<?php esc_html_e('Послуги', 'web'); ?>
								<?php echo get_svg_icon('chevron'); ?>
							</a>

							<div class="mega-menu">
								<div class="container mega-menu__inner">
									<?php foreach ($services_columns as $col) : ?>
										<div class="mega-col">
											<h4 class="mega-col__title"><?php echo esc_html($col['title']); ?></h4>
											<ul class="mega-col__list">
												<?php foreach ($col['items'] as $item) : ?>
													<li>
														<a href="<?php echo esc_url($item['url']); ?>" class="open-popup" data-popup-id="service-panel">
															<?php echo esc_html($item['label']); ?>
														</a>
													</li>
												<?php endforeach; ?>
											</ul>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</li>

						<?php foreach ($nav_items as $item) : ?>
							<li class="menu-item">
								<a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav><!-- #site-navigation -->

				<div class="header-actions">
					<a href="<?php echo esc_attr($phone_href); ?>" class="header-phone">
						<?php echo get_svg_icon('phone'); ?>
						<span><?php echo esc_html($phone); ?></span>
					</a>

					<a href="#" class="btn btn--gold open-popup" data-popup-id="telegram">
						<?php echo esc_html($header_cta); ?>
					</a>

					<form role="search" method="get" class="header-search" action="<?php echo esc_url(home_url('/')); ?>">
						<button type="button" class="header-search__toggle" aria-label="<?php esc_attr_e('Пошук', 'web'); ?>">
							<?php echo get_svg_icon('search'); ?>
						</button>
						<input type="search" class="header-search__field" name="s" placeholder="<?php esc_attr_e('Пошук...', 'web'); ?>" autocomplete="off">
					</form>

					<button type="button" class="menu-toggle open-popup" data-popup-id="mob-menu" aria-controls="mob-nav" aria-expanded="false" aria-label="<?php esc_attr_e('Меню', 'web'); ?>">
						<?php echo get_svg_icon('burger'); ?>
					</button>
				</div>

			</div>
		</header><!-- #masthead -->

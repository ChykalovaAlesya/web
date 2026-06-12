<?php

/**
 * The template for displaying the footer.
 *
 * Markup matches the Figma "Footer" component (logo + tagline / Послуги /
 * Публікації / Контакти + socials, then a copyright bar). Content is driven by
 * the "Налаштування сайту" ACF options page, with Figma defaults as fallback.
 *
 * @package web
 */

$phone      = web_opt( 'phone', '(067) 287-00-44' );
$phone_href = web_opt( 'phone_href', 'tel:+380672870044' );
$email      = web_opt( 'email', 'r.smolin@gmail.com' );
$tagline    = web_opt( 'footer_tagline', __( 'Юридичний захист, консультації та повний супровід — з акцентом на результат.', 'web' ) );
$copyright  = web_opt( 'copyright', __( '© 2015–2026. Адвокат Роман Сімутін. Всі права захищені.', 'web' ) );

$footer_services = web_rows( 'footer_services', array(
	array( 'label' => __( 'Військове право', 'web' ),     'url' => '#' ),
	array( 'label' => __( 'Захист водія', 'web' ),        'url' => '#' ),
	array( 'label' => __( 'Кримінальні справи', 'web' ),  'url' => '#' ),
	array( 'label' => __( 'Сімейне право', 'web' ),       'url' => '#' ),
	array( 'label' => __( 'Продаж інструкцій', 'web' ),   'url' => '#' ),
	array( 'label' => __( 'Онлайн консультація', 'web' ), 'url' => '#' ),
), 'option' );

$footer_pubs = web_rows( 'footer_publications', array(
	array( 'label' => __( 'Статті та публікації', 'web' ), 'url' => '#blog' ),
	array( 'label' => __( 'Виграні справи', 'web' ),       'url' => '#cases' ),
), 'option' );

$socials = array(
	'telegram'  => web_opt( 'social_telegram', '' ),
	'facebook'  => web_opt( 'social_facebook', '' ),
	'instagram' => web_opt( 'social_instagram', '' ),
	'youtube'   => web_opt( 'social_youtube', '' ),
);
?>

<footer id="colophon" class="site-footer">
	<div class="container footer-inner">

		<div class="footer-col footer-col--brand">
			<div class="footer-logo">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-logo" rel="home">
						<span class="text-logo__name"><?php bloginfo( 'name' ); ?></span>
						<span class="text-logo__role"><?php esc_html_e( 'Адвокат', 'web' ); ?></span>
					</a>
				<?php endif; ?>
			</div>
			<p class="footer-tagline"><?php echo esc_html( $tagline ); ?></p>
		</div>

		<nav class="footer-col footer-col--links" aria-label="<?php esc_attr_e( 'Послуги', 'web' ); ?>">
			<h4 class="footer-col__title"><?php esc_html_e( 'Послуги', 'web' ); ?></h4>
			<ul class="footer-list">
				<?php foreach ( $footer_services as $item ) : ?>
					<li><a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<nav class="footer-col footer-col--links" aria-label="<?php esc_attr_e( 'Публікації', 'web' ); ?>">
			<h4 class="footer-col__title"><?php esc_html_e( 'Публікації', 'web' ); ?></h4>
			<ul class="footer-list">
				<?php foreach ( $footer_pubs as $item ) : ?>
					<li><a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<div class="footer-col footer-col--contacts">
			<h4 class="footer-col__title"><?php esc_html_e( 'Контакти', 'web' ); ?></h4>
			<ul class="footer-contacts">
				<?php if ( $phone ) : ?>
					<li>
						<a href="<?php echo esc_attr( $phone_href ); ?>">
							<?php echo get_svg_icon( 'phone' ); ?>
							<span><?php echo esc_html( $phone ); ?></span>
						</a>
					</li>
				<?php endif; ?>
				<?php if ( $email ) : ?>
					<li>
						<a href="mailto:<?php echo esc_attr( $email ); ?>">
							<?php echo get_svg_icon( 'mail' ); ?>
							<span><?php echo esc_html( $email ); ?></span>
						</a>
					</li>
				<?php endif; ?>
			</ul>

			<div class="footer-socials">
				<?php foreach ( $socials as $network => $url ) : ?>
					<?php if ( $url ) : ?>
						<a class="footer-social footer-social--<?php echo esc_attr( $network ); ?>" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( ucfirst( $network ) ); ?>">
							<?php echo get_svg_icon( $network ); ?>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>

	</div><!-- .footer-inner -->

	<div class="footer-bottom">
		<div class="container">
			<p class="footer-copy"><?php echo esc_html( $copyright ); ?></p>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php get_template_part( 'template-parts/popups' ); ?>
<?php wp_footer(); ?>

</body>

</html>

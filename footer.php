<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package web
 */

?>

<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="site-info">
			<a href="<?php echo esc_url(__('https://wordpress.org/', 'web')); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf(esc_html__('Proudly powered by %s', 'web'), 'WordPress');
				?>
			</a>
			<span class="sep"> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf(esc_html__('Theme: %1$s by %2$s.', 'web'), 'web', '<a href="https://webbloom.studio/">webbloom</a>');
			?>
		</div><!-- .site-info -->
	</div><!-- .container -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php get_template_part('template-parts/popups'); ?>
<?php wp_footer(); ?>

</body>

</html>
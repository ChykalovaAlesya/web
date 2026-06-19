<?php
/**
 * Single post — handles both won-case posts (category «vyhrani-spravy») and
 * blog posts. Built from Figma 525-6595 (case) / 525-6470 (blog): hero with
 * breadcrumb + meta, two-column body (content + aside cards), related posts.
 *
 * @package web
 */

get_header();

$phone      = web_opt( 'phone', '(067) 287-00-44' );
$phone_href = web_opt( 'phone_href', 'tel:+380672870044' );
$won        = get_category_by_slug( 'vyhrani-spravy' );
$won_id     = $won ? (int) $won->term_id : 0;

while ( have_posts() ) :
	the_post();
	$pid      = get_the_ID();
	$is_case  = in_category( 'vyhrani-spravy', $pid );
	$sub      = web_post_subcat( $pid );
	$num      = web_f( 'case_num', '', $pid );
	$registry = web_f( 'case_registry', '', $pid );
	$thumb    = get_the_post_thumbnail_url( $pid, 'large' );
	$base_url   = $is_case ? ( $won_id ? get_category_link( $won_id ) : home_url( '/' ) ) : home_url( '/blog/' );
	$base_label = $is_case ? __( 'Виграні справи', 'web' ) : __( 'Блог', 'web' );
	$eyebrow    = $sub ? $sub->name : ( $is_case ? __( 'Практика', 'web' ) : __( 'Блог', 'web' ) );
	?>

	<main id="primary" class="site-main post-single <?php echo $is_case ? 'is-case' : 'is-blog'; ?>">

		<!-- ============ HERO ============ -->
		<section class="about-hero post-hero">
			<div class="container">
				<nav class="about-hero__crumbs" aria-label="breadcrumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Головна', 'web' ); ?></a>
					<span class="about-hero__sep"><?php echo get_svg_icon( 'chevron' ); ?></span>
					<a href="<?php echo esc_url( $base_url ); ?>"><?php echo esc_html( $base_label ); ?></a>
					<?php if ( $sub ) : ?>
						<span class="about-hero__sep"><?php echo get_svg_icon( 'chevron' ); ?></span>
						<a href="<?php echo esc_url( get_category_link( $sub->term_id ) ); ?>"><?php echo esc_html( $sub->name ); ?></a>
					<?php endif; ?>
					<span class="about-hero__sep"><?php echo get_svg_icon( 'chevron' ); ?></span>
					<span class="about-hero__crumb-current"><?php the_title(); ?></span>
				</nav>
				<h1 class="about-hero__title"><?php the_title(); ?></h1>
				<div class="post-hero__meta">
					<?php if ( $is_case ) : ?>
						<?php if ( $num ) : ?>
							<span class="post-hero__case"><?php echo get_svg_icon( 'svc-doc' ); ?><?php printf( esc_html__( 'Справа %s', 'web' ), esc_html( $num ) ); ?></span>
						<?php endif; ?>
					<?php else : ?>
						<?php if ( $sub ) : ?><span class="post-hero__cat"><?php echo esc_html( $sub->name ); ?></span><?php endif; ?>
						<span class="post-hero__date"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
					<?php endif; ?>
				</div>
			</div>
			<button type="button" class="fp-tg-float open-popup" data-popup-id="telegram" aria-label="<?php esc_attr_e( 'Написати в Telegram', 'web' ); ?>">
				<?php echo get_svg_icon( 'telegram' ); ?>
			</button>
		</section>

		<!-- ============ BODY ============ -->
		<section class="post-body-section">
			<div class="container post-body__grid">
				<div class="post-body">
					<?php if ( $thumb ) : ?>
						<div class="post-body__media"><img src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>"></div>
					<?php endif; ?>
					<?php if ( $is_case ) : ?>
						<h2 class="post-body__h"><?php esc_html_e( 'Деталі справи', 'web' ); ?></h2>
					<?php endif; ?>
					<div class="post-body__content">
						<?php the_content(); ?>
					</div>
					<?php if ( $is_case && $registry ) : ?>
						<h2 class="post-body__h"><?php esc_html_e( 'Посилання на реєстр', 'web' ); ?></h2>
						<a class="post-body__registry" href="<?php echo esc_url( $registry ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $registry ); ?></a>
					<?php endif; ?>
				</div>

				<aside class="post-aside">
					<div class="post-aside__card">
						<span class="post-aside__icon"><?php echo get_svg_icon( 'headset' ); ?></span>
						<h3 class="post-aside__title"><?php esc_html_e( 'Потрібна консультація?', 'web' ); ?></h3>
						<p class="post-aside__text"><?php esc_html_e( "Зв'яжіться зараз — швидко розберемося у вашій ситуації.", 'web' ); ?></p>
						<a href="<?php echo esc_attr( $phone_href ); ?>" class="btn btn--gold post-aside__btn">
							<?php echo get_svg_icon( 'phone' ); ?><span><?php echo esc_html( $phone ); ?></span>
						</a>
					</div>
					<div class="post-aside__card">
						<span class="post-aside__icon"><?php echo get_svg_icon( 'svc-doc' ); ?></span>
						<h3 class="post-aside__title"><?php esc_html_e( 'Практична інструкція', 'web' ); ?></h3>
						<p class="post-aside__text"><?php esc_html_e( 'Пояснюємо все, що треба знати у вашій ситуації — простою мовою.', 'web' ); ?></p>
						<a href="<?php echo esc_url( web_consult_url() ); ?>" class="btn btn--soft post-aside__btn">
							<?php esc_html_e( 'Отримати інструкцію', 'web' ); ?><?php echo get_svg_icon( 'arrow-right' ); ?>
						</a>
					</div>
				</aside>
			</div>
		</section>

		<!-- ============ RELATED ============ -->
		<?php
		$rel_args = array(
			'post_type'           => 'post',
			'posts_per_page'      => 4,
			'post__not_in'        => array( $pid ),
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true,
		);
		if ( $is_case ) {
			if ( $won_id ) { $rel_args['category__in'] = array( $won_id ); }
		} elseif ( $won_id ) {
			$rel_args['category__not_in'] = array( $won_id );
		}
		$rel = new WP_Query( $rel_args );
		if ( $rel->have_posts() ) :
			?>
			<section class="post-related">
				<div class="container">
					<span class="section-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
					<h2 class="section-title"><?php esc_html_e( 'Також читайте:', 'web' ); ?></h2>
					<div class="<?php echo $is_case ? 'fp-cases__grid' : 'fp-articles__grid'; ?>">
						<?php
						while ( $rel->have_posts() ) :
							$rel->the_post();
							if ( $is_case ) {
								web_render_case_card( get_the_ID() );
							} else {
								web_render_article_card( get_the_ID() );
							}
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
			</section>
		<?php endif; ?>

	</main><!-- #primary -->

<?php endwhile; ?>

<?php get_footer(); ?>

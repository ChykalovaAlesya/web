<?php
/**
 * Shared archive listing — Figma 525-5922 (cases) / 525-6238 (blog).
 * Mode passed via query var `web_archive_mode` = 'case' | 'blog'.
 * Category filter via ?c=<slug>; pagination preserves it.
 *
 * @package web
 */

$mode    = get_query_var( 'web_archive_mode' );
$is_case = ( 'case' === $mode );

$won    = get_category_by_slug( 'vyhrani-spravy' );
$won_id = $won ? (int) $won->term_id : 0;

$active = isset( $_GET['c'] ) ? sanitize_title( wp_unslash( $_GET['c'] ) ) : '';
$paged  = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
$base_link = $is_case ? ( $won_id ? get_category_link( $won_id ) : home_url( '/' ) ) : home_url( '/blog/' );

/* ---- main query ---- */
$args = array( 'post_type' => 'post', 'posts_per_page' => 12, 'paged' => $paged, 'ignore_sticky_posts' => true );
$tax  = array( 'relation' => 'AND' );
if ( $is_case && $won_id ) {
	$tax[] = array( 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => array( $won_id ) );
} elseif ( ! $is_case && $won_id ) {
	$tax[] = array( 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => array( $won_id ), 'operator' => 'NOT IN' );
}
if ( $active ) {
	$term = get_term_by( 'slug', $active, 'category' );
	if ( $term ) {
		$tax[] = array( 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => array( $term->term_id ) );
	}
}
if ( count( $tax ) > 1 ) {
	$args['tax_query'] = $tax;
}
$q = new WP_Query( $args );

/* ---- filter chips ---- */
$chips = array();
if ( $is_case && $won_id ) {
	foreach ( get_posts( array( 'post_type' => 'post', 'posts_per_page' => -1, 'fields' => 'ids', 'category' => $won_id ) ) as $cid ) {
		foreach ( get_the_category( $cid ) as $c ) {
			if ( (int) $c->term_id !== $won_id ) {
				$chips[ $c->term_id ] = $c;
			}
		}
	}
} else {
	foreach ( get_categories( array( 'hide_empty' => true ) ) as $c ) {
		if ( (int) $c->term_id !== $won_id && 'uncategorized' !== $c->slug ) {
			$chips[ $c->term_id ] = $c;
		}
	}
}
?>

<main id="primary" class="site-main archive-page <?php echo $is_case ? 'is-cases' : 'is-blog'; ?>">

	<!-- ============ HERO ============ -->
	<section class="about-hero archive-hero">
		<div class="container">
			<nav class="about-hero__crumbs" aria-label="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Головна', 'web' ); ?></a>
				<span class="about-hero__sep"><?php echo get_svg_icon( 'chevron' ); ?></span>
				<span><?php echo esc_html( $is_case ? __( 'Виграні справи', 'web' ) : __( 'Блог', 'web' ) ); ?></span>
			</nav>
			<h1 class="about-hero__title">
				<?php echo esc_html( $is_case ? __( 'Виграні справи — факти замість обіцянок', 'web' ) : __( 'Статті та публікації', 'web' ) ); ?>
			</h1>
			<p class="about-hero__text">
				<?php echo esc_html( $is_case ? __( 'Кожна справа тут — реальний клієнт, реальний суд, реальне рішення.', 'web' ) : __( 'Юридичні поради, зміни в законодавстві та кейси з практики — простою мовою.', 'web' ) ); ?>
			</p>
		</div>
		<button type="button" class="fp-tg-float open-popup" data-popup-id="telegram" aria-label="<?php esc_attr_e( 'Написати в Telegram', 'web' ); ?>">
			<?php echo get_svg_icon( 'telegram' ); ?>
		</button>
	</section>

	<?php if ( $is_case ) : ?>
		<!-- ============ STATS ============ -->
		<section class="fp-stats">
			<div class="container">
				<span class="section-eyebrow"><?php esc_html_e( 'Цифри', 'web' ); ?></span>
				<h2 class="section-title section-title--flush"><?php esc_html_e( 'Статистика', 'web' ); ?></h2>
				<div class="fp-stats__grid">
					<?php
					$stats = array(
						array( '94', __( 'Мобілізація', 'web' ) ), array( '83', __( 'ДТП', 'web' ) ), array( '100', __( 'Кримінал', 'web' ) ),
						array( '86', __( 'Сімейні', 'web' ) ), array( '100', __( 'ОТГ в КУпАП', 'web' ) ), array( '89', __( 'Спадщина', 'web' ) ),
					);
					foreach ( $stats as $s ) :
						?>
						<div class="stat">
							<span class="stat__value"><?php echo esc_html( $s[0] ); ?><span class="stat__pct">%</span></span>
							<span class="stat__label"><?php echo esc_html( $s[1] ); ?></span>
							<span class="stat__sub"><?php esc_html_e( 'виграно', 'web' ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- ============ LISTING ============ -->
	<section class="archive-listing">
		<div class="container">
			<?php if ( $is_case ) : ?>
				<span class="section-eyebrow"><?php esc_html_e( 'Виграні справи', 'web' ); ?></span>
				<h2 class="section-title section-title--flush"><?php esc_html_e( 'Практика', 'web' ); ?></h2>
			<?php endif; ?>

			<?php if ( $chips ) : ?>
				<div class="filter-chips">
					<a class="filter-chip<?php echo $active ? '' : ' is-active'; ?>" href="<?php echo esc_url( $base_link ); ?>"><?php esc_html_e( 'Всі', 'web' ); ?></a>
					<?php foreach ( $chips as $c ) : ?>
						<a class="filter-chip<?php echo ( $active === $c->slug ) ? ' is-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( 'c', $c->slug, $base_link ) ); ?>"><?php echo esc_html( $c->name ); ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( $q->have_posts() ) : ?>
				<div class="<?php echo $is_case ? 'fp-cases__grid' : 'fp-articles__grid'; ?> archive-grid">
					<?php
					while ( $q->have_posts() ) :
						$q->the_post();
						if ( $is_case ) {
							web_render_case_card( get_the_ID() );
						} else {
							web_render_article_card( get_the_ID() );
						}
					endwhile;
					?>
				</div>

				<?php
				$links = paginate_links( array(
					'base'      => trailingslashit( $base_link ) . 'page/%#%/',
					'format'    => '',
					'current'   => $paged,
					'total'     => (int) $q->max_num_pages,
					'add_args'  => $active ? array( 'c' => $active ) : array(),
					'type'      => 'array',
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
				) );
				if ( $links ) :
					?>
					<nav class="archive-pagination"><?php echo implode( '', $links ); /* phpcs:ignore */ ?></nav>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p class="archive-empty"><?php esc_html_e( 'Поки що немає записів у цій категорії.', 'web' ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<!-- ============ CTA ============ -->
	<section class="about-cta">
		<div class="container">
			<div class="about-cta__box">
				<div class="about-cta__text">
					<span class="about-cta__eyebrow"><?php echo esc_html( $is_case ? __( 'КОНСУЛЬТАЦІЯ', 'web' ) : __( 'ТЕЛЕГРАМ СПІЛЬНОТА', 'web' ) ); ?></span>
					<h2 class="about-cta__title"><?php echo esc_html( $is_case ? __( 'Маєте схожу ситуацію? Розберемося.', 'web' ) : __( 'Отримуйте актуальні новини першими', 'web' ) ); ?></h2>
					<p><?php echo esc_html( $is_case ? __( 'Розкажіть про свою справу — оцінимо перспективи та підкажемо стратегію.', 'web' ) : __( 'Зміни в законодавстві, кейси з практики та поради — долучайтесь до нашої ТГ-спільноти.', 'web' ) ); ?></p>
				</div>
				<?php if ( $is_case ) : ?>
					<a href="<?php echo esc_url( web_consult_url() ); ?>" class="btn btn--gold about-cta__btn">
						<?php esc_html_e( 'Записатися на консультацію', 'web' ); ?><?php echo get_svg_icon( 'arrow-right' ); ?>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( web_opt( 'social_telegram', 'https://t.me/' ) ); ?>" class="btn btn--gold about-cta__btn" target="_blank" rel="noopener">
						<?php echo get_svg_icon( 'telegram' ); ?><span><?php esc_html_e( 'Приєднатись', 'web' ); ?></span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>

</main><!-- #primary -->

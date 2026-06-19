<?php
/**
 * Template for the "Ціни" page (slug: tsiny).
 *
 * Built from Figma node 560-3737. Price tables (title + optional description |
 * gold price), FAQ (reuses .fp-faq), "Чому обирають нас" cards and the CTA box
 * (reuses .about-cta). Content is hard-coded from the design.
 *
 * @package web
 */

get_header();

/** Render a price table from an array of rows: array('title','desc','price'). */
if ( ! function_exists( 'web_price_table' ) ) {
	function web_price_table( $rows ) {
		$out = '<div class="price-table">';
		foreach ( $rows as $r ) {
			$out .= '<div class="price-row"><div class="price-row__title">' . esc_html( $r['title'] );
			if ( ! empty( $r['desc'] ) ) {
				$out .= '<span class="price-row__desc">' . esc_html( $r['desc'] ) . '</span>';
			}
			$out .= '</div><div class="price-row__price">' . esc_html( $r['price'] ) . '</div></div>';
		}
		$out .= '</div>';
		return $out;
	}
}

$hero_title = web_f( 'prices_hero_title', __( 'Ціни на послуги адвоката Сімутіна', 'web' ) );
$hero_text  = web_f( 'prices_hero_text', __( 'Вартість послуг адвоката в Києві залежить від складності справи та обсягу необхідних процесуальних дій. У Адвокатському бюро Романа Сімутіна діє прозора система оплати, яку ми фіксуємо в договорі — без прихованих платежів під час розв\'язання ваших правових питань.', 'web' ) );

$base_title   = web_f( 'prices_base_title', __( 'Базові юридичні послуги', 'web' ) );
$mil_title    = web_f( 'prices_mil_title', __( 'Військовий адвокат: ТЦК, ВЛК, Мобілізація', 'web' ) );
$mil_lead     = web_f( 'prices_mil_lead', __( "Це найбільш затребувані послуги у 2026 році. Ми забезпечуємо захист прав військовозобов'язаних на кожному етапі.", 'web' ) );
$driver_title = web_f( 'prices_driver_title', __( 'Захист водіїв', 'web' ) );
$note = web_f( 'prices_note', __( "До вартості юридичних послуг не входять судовий збір, переклади, поштові відправлення, послуги кур'єрської служби, нотаріальні послуги тощо.", 'web' ) );

$base_rows = web_rows( 'prices_base_rows', array(
	array( 'title' => __( 'Консультація адвоката', 'web' ),               'desc' => __( 'Детальний аналіз ситуації та розробка стратегії захисту', 'web' ), 'price' => __( '2 000 грн', 'web' ) ),
	array( 'title' => __( 'Складання скарг та заяв', 'web' ),             'desc' => '', 'price' => __( 'від 2 000 грн', 'web' ) ),
	array( 'title' => __( 'Адвокатський запит', 'web' ),                  'desc' => __( 'Офіційне отримання інформації від держорганів за 5 днів', 'web' ), 'price' => __( 'від 3 000 грн', 'web' ) ),
	array( 'title' => __( 'Ознайомлення з матеріалами справи', 'web' ),   'desc' => __( 'Виїзд до суду, фотофіксація та юридичний аналіз документів', 'web' ), 'price' => __( 'від 4 000 грн', 'web' ) ),
	array( 'title' => __( 'Представництво в судах', 'web' ),              'desc' => '', 'price' => __( 'від 3 000 грн', 'web' ) ),
	array( 'title' => __( 'Правовий аналіз договорів', 'web' ),           'desc' => '', 'price' => __( 'від 5 500 грн', 'web' ) ),
	array( 'title' => __( 'Розробка індивідуального договору', 'web' ),   'desc' => '', 'price' => __( 'від 8 000 грн', 'web' ) ),
) );

$mil_rows = web_rows( 'prices_mil_rows', array(
	array( 'title' => __( 'Оформлення відстрочки від мобілізації', 'web' ), 'desc' => __( 'Вивчення документів, підготовка заяви та супровід', 'web' ), 'price' => __( '4 000 грн', 'web' ) ),
	array( 'title' => __( 'Представництво в ТЦК під час мобілізації', 'web' ), 'desc' => '', 'price' => __( 'від 5 000 грн/год', 'web' ) ),
	array( 'title' => __( 'Оскарження рішень ВЛК', 'web' ),                'desc' => '', 'price' => __( 'від 7 000 грн', 'web' ) ),
	array( 'title' => __( 'Терміновий виїзд адвоката в ТЦК', 'web' ),      'desc' => __( 'При затриманні, порушенні прав або примусовому доставленні', 'web' ), 'price' => __( '7 000 грн/год', 'web' ) ),
	array( 'title' => __( 'Оскарження незаконних дій ТЦК', 'web' ),        'desc' => __( 'Затримання, порушення процедур ВЛК тощо', 'web' ), 'price' => __( 'від 6 000 грн', 'web' ) ),
	array( 'title' => __( 'Звільнення з ТЦК при незаконному затриманні', 'web' ), 'desc' => '', 'price' => __( 'від 20 000 грн', 'web' ) ),
	array( 'title' => __( 'Допомога в оформленні інвалідності/ЛКК', 'web' ), 'desc' => '', 'price' => __( 'від 10 000 грн', 'web' ) ),
) );

$driver_rows = web_rows( 'prices_driver_rows', array(
	array( 'title' => __( 'Повернення водійського посвідчення (ст. 130 КУпАП)', 'web' ), 'desc' => __( "Скасування протоколів за п'яне водіння та захист у суді до результату", 'web' ), 'price' => __( 'від 10 000 грн', 'web' ) ),
	array( 'title' => __( 'Допомога при ДТП', 'web' ), 'desc' => '', 'price' => __( 'від 3 000 грн', 'web' ) ),
) );

$faqs = array(
	array( 'q' => __( 'Чи входить у вартість консультації підготовка документів?', 'web' ), 'a' => __( 'Консультація передбачає правовий аналіз. Підготовка скарг або заяв оплачується окремо відповідно до прайсу.', 'web' ) ),
	array( 'q' => __( 'Чому виїзд у ТЦК оплачується погодинно?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чи можна отримати безкоштовну консультацію?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чи гарантуєте ви повернення прав за статтею 130 КУпАП?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Що входить у послугу «Оформлення відстрочки»?', 'web' ), 'a' => '' ),
);

$why = array(
	array( 'char' => '₴',        'title' => __( 'Фіксована ціна', 'web' ), 'text' => __( 'Ви знаєте вартість до початку роботи. Жодних доплат у процесі.', 'web' ) ),
	array( 'icon' => 'svc-scales', 'title' => __( 'Спеціалізація', 'web' ), 'text' => __( 'Ми – профільні адвокати у найскладніших справах.', 'web' ) ),
	array( 'icon' => 'svc-clock',  'title' => __( 'Швидкість', 'web' ),    'text' => __( 'Терміновий виїзд адвоката в ТЦК або на місце ДТП здійснюється миттєво після дзвінка.', 'web' ) ),
);

$phone      = web_opt( 'phone', '(067) 287-00-44' );
$phone_href = web_opt( 'phone_href', 'tel:+380672870044' );
?>

<main id="primary" class="site-main prices-page">

	<!-- ============ HERO ============ -->
	<section class="about-hero">
		<div class="container">
			<nav class="about-hero__crumbs" aria-label="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Головна', 'web' ); ?></a>
				<span class="about-hero__sep"><?php echo get_svg_icon( 'chevron' ); ?></span>
				<span><?php esc_html_e( 'Ціни', 'web' ); ?></span>
			</nav>
			<h1 class="about-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
			<p class="about-hero__text"><?php echo esc_html( $hero_text ); ?></p>
		</div>
		<button type="button" class="fp-tg-float open-popup" data-popup-id="telegram" aria-label="<?php esc_attr_e( 'Написати в Telegram', 'web' ); ?>">
			<?php echo get_svg_icon( 'telegram' ); ?>
		</button>
	</section>

	<!-- ============ BASE SERVICES ============ -->
	<section class="price-section">
		<div class="container">
			<span class="section-eyebrow"><?php esc_html_e( 'Ціни', 'web' ); ?></span>
			<h2 class="section-title section-title--flush"><?php echo esc_html( $base_title ); ?></h2>
			<?php echo web_price_table( $base_rows ); ?>
			<p class="price-note"><?php echo esc_html( $note ); ?></p>
		</div>
	</section>

	<!-- ============ MILITARY ============ -->
	<section class="price-section">
		<div class="container">
			<span class="section-eyebrow"><?php esc_html_e( 'Ціни', 'web' ); ?></span>
			<h2 class="section-title"><?php echo esc_html( $mil_title ); ?></h2>
			<p class="price-section__lead"><?php echo esc_html( $mil_lead ); ?></p>
			<?php echo web_price_table( $mil_rows ); ?>
		</div>
	</section>

	<!-- ============ DRIVERS ============ -->
	<section class="price-section">
		<div class="container">
			<span class="section-eyebrow"><?php esc_html_e( 'Ціни', 'web' ); ?></span>
			<h2 class="section-title section-title--flush"><?php echo esc_html( $driver_title ); ?></h2>
			<?php echo web_price_table( $driver_rows ); ?>
		</div>
	</section>

	<!-- ============ FAQ ============ -->
	<section class="fp-faq prices-faq">
		<div class="container">
			<span class="section-eyebrow"><?php esc_html_e( 'FAQ', 'web' ); ?></span>
			<h2 class="section-title section-title--flush"><?php esc_html_e( 'Часті запитання', 'web' ); ?></h2>
			<div class="fp-faq__list">
				<?php foreach ( $faqs as $i => $faq ) : ?>
					<details class="faq-item"<?php echo 0 === $i ? ' open' : ''; ?>>
						<summary class="faq-item__q">
							<span><?php echo esc_html( $faq['q'] ); ?></span>
							<span class="faq-item__icon"><?php echo get_svg_icon( 'chevron' ); ?></span>
						</summary>
						<?php if ( ! empty( $faq['a'] ) ) : ?>
							<div class="faq-item__a"><?php echo wp_kses_post( wpautop( $faq['a'] ) ); ?></div>
						<?php endif; ?>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ WHY US ============ -->
	<section class="price-why">
		<div class="container">
			<span class="section-eyebrow"><?php esc_html_e( 'Переваги', 'web' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'Чому обирають нас', 'web' ); ?></h2>
			<div class="price-why__grid">
				<?php foreach ( $why as $w ) : ?>
					<article class="price-why-card">
						<span class="price-why-card__icon">
							<?php echo isset( $w['char'] ) ? esc_html( $w['char'] ) : get_svg_icon( $w['icon'] ); ?>
						</span>
						<h3 class="price-why-card__title"><?php echo esc_html( $w['title'] ); ?></h3>
						<p class="price-why-card__text"><?php echo esc_html( $w['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ CTA ============ -->
	<section class="about-cta">
		<div class="container">
			<div class="about-cta__box">
				<div class="about-cta__text">
					<span class="about-cta__eyebrow"><?php esc_html_e( 'КОНСУЛЬТАЦІЯ', 'web' ); ?></span>
					<h2 class="about-cta__title"><?php esc_html_e( 'Потрібна допомога адвоката з прозорими умовами?', 'web' ); ?></h2>
					<p><?php esc_html_e( 'Не чекайте, поки ситуація стане критичною. Отримайте професійну допомогу за чесною ціною вже сьогодні!', 'web' ); ?></p>
				</div>
				<a href="<?php echo esc_attr( $phone_href ); ?>" class="btn btn--gold about-cta__btn">
					<?php echo get_svg_icon( 'phone' ); ?>
					<span><?php echo esc_html( $phone ); ?></span>
				</a>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php get_footer(); ?>

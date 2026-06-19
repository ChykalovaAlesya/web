<?php
/**
 * Template for the "Онлайн консультація" page (slug: online-konsultatsiya).
 *
 * Built from Figma node 572-4217. The request form is Contact Form 7
 * ("Онлайн консультація", styled via .ccf__* classes — see create-cf7 + cust.css)
 * embedded in the hero and again mid-page. Reuses homepage components
 * (.fp-intro / .svc-card / .fp-faq).
 *
 * @package web
 */

get_header();

$img = get_template_directory_uri() . '/inc/assets/img';

/** Render the styled "Онлайн консультація" CF7 form (looked up by title). */
if ( ! function_exists( 'web_consult_form' ) ) {
	function web_consult_form() {
		$cf = get_posts( array( 'post_type' => 'wpcf7_contact_form', 'title' => 'Онлайн консультація', 'posts_per_page' => 1, 'fields' => 'ids' ) );
		if ( empty( $cf ) ) {
			return '';
		}
		$hash   = get_post_meta( $cf[0], '_hash', true );
		$idattr = $hash ? $hash : $cf[0];
		return do_shortcode( '[contact-form-7 id="' . esc_attr( $idattr ) . '" title="Онлайн консультація"]' );
	}
}

$benefits = array(
	array( 'lead' => __( 'Правовий аналіз ситуації:', 'web' ),                'text' => __( 'Я детально вивчаю ваші обставини з точки зору чинного законодавства та актуальної судової практики.', 'web' ) ),
	array( 'lead' => __( 'Оцінка ризиків і перспектив:', 'web' ),             'text' => __( 'Чесно пояснюю шанси на успіх, можливі ризики та найефективніші варіанти захисту.', 'web' ) ),
	array( 'lead' => __( 'Покроковий план дій:', 'web' ),                     'text' => __( 'Ви отримуєте чіткий алгоритм: що робити далі, які документи готувати та як діяти у вашій ситуації.', 'web' ) ),
	array( 'lead' => __( 'Аналіз документів та професійний висновок:', 'web' ), 'text' => __( 'Перевіряю протоколи, договори, повістки чи інші документи та надаю юридичну оцінку.', 'web' ) ),
);

$directions = array(
	array( 'icon' => 'svc-mil',    'title' => __( 'Військовий адвокат: Мобілізація та ВЛК', 'web' ), 'text' => __( "Роз'яснення щодо мобілізації, ВЛК, отримання відстрочки, виплати пораненим.", 'web' ) ),
	array( 'icon' => 'svc-car',    'title' => __( 'Захист водіїв: ст. 130 КУпАП', 'web' ),            'text' => __( "Термінова допомога при складанні протоколів за керування у стані сп'яніння.", 'web' ) ),
	array( 'icon' => 'svc-scales', 'title' => __( 'Кримінальні провадження', 'web' ),                'text' => __( 'Консультації щодо поведінки під час обшуку, затримання чи допиту.', 'web' ) ),
	array( 'icon' => 'svc-family', 'title' => __( 'Сімейні та спадкові спори', 'web' ),               'text' => __( 'Алгоритм розлучення, аліментів, поділу майна та спадщини без присутності в суді.', 'web' ) ),
);

$faqs = array(
	array( 'q' => __( 'Чи має онлайн-консультація таку ж юридичну силу, як особиста зустріч?', 'web' ), 'a' => __( 'Безумовно. Юридична значимість інформації та рекомендацій не залежить від формату зустрічі. Усі поради базуються на чинному законодавстві України та моєму практичному досвіді.', 'web' ) ),
	array( 'q' => __( 'Як швидко я отримаю відповідь після оформлення заявки?', 'web' ), 'a' => '' ),
	array( 'q' => __( "Яким чином відбувається зв'язок?", 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чи можу я під час онлайн-консультації показати документи?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чи конфіденційна така консультація?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чи допоможе онлайн-консультація у справах ТЦК та мобілізації?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Як оплатити онлайн-консультацію?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чи можна після консультації замовити повний супровід справи?', 'web' ), 'a' => '' ),
	array( 'q' => __( "Що робити, якщо під час онлайн-консультації перерветься зв'язок (через блекаут чи мережу)?", 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чи працює онлайн-консультація для тих, хто перебуває за кордоном?', 'web' ), 'a' => '' ),
);
?>

<main id="primary" class="site-main consult-page">

	<!-- ============ HERO + FORM ============ -->
	<section class="consult-hero">
		<div class="container consult-hero__inner">
			<div class="consult-hero__content">
				<nav class="about-hero__crumbs" aria-label="breadcrumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Головна', 'web' ); ?></a>
					<span class="about-hero__sep"><?php echo get_svg_icon( 'chevron' ); ?></span>
					<a href="<?php echo esc_url( home_url( '/poslugy/' ) ); ?>"><?php esc_html_e( 'Послуги', 'web' ); ?></a>
					<span class="about-hero__sep"><?php echo get_svg_icon( 'chevron' ); ?></span>
					<span><?php esc_html_e( 'Онлайн консультація', 'web' ); ?></span>
				</nav>
				<h1 class="about-hero__title"><?php esc_html_e( 'Маєте питання? Звʼяжіться з нами.', 'web' ); ?></h1>
				<p class="about-hero__text"><?php esc_html_e( 'Відповідь протягом 1 години в робочий час. При екстрених ситуаціях — реагуємо миттєво.', 'web' ); ?></p>
			</div>
			<div class="consult-form-card">
				<h2 class="consult-form-card__title"><?php esc_html_e( 'Залишити заявку на консультацію', 'web' ); ?></h2>
				<?php echo web_consult_form(); ?>
			</div>
		</div>
		<button type="button" class="fp-tg-float open-popup" data-popup-id="telegram" aria-label="<?php esc_attr_e( 'Написати в Telegram', 'web' ); ?>">
			<?php echo get_svg_icon( 'telegram' ); ?>
		</button>
	</section>

	<!-- ============ INTRO ============ -->
	<section class="fp-intro consult-intro">
		<div class="container fp-intro__inner">
			<div class="fp-intro__head">
				<span class="section-eyebrow"><?php esc_html_e( 'Переваги', 'web' ); ?></span>
				<h2 class="section-title"><?php esc_html_e( 'Чому онлайн-консультація — це ефективне рішення?', 'web' ); ?></h2>
			</div>
			<div class="fp-intro__text">
				<p><?php esc_html_e( 'У сучасному ритмі життя час — це найцінніший ресурс. Юридичні проблеми часто виникають раптово і потребують негайної реакції. Онлайн консультація адвоката (Київ, Бровари) — це можливість отримати фахову допомогу, не витрачаючи години на поїздку до офісу та очікування в чергах.', 'web' ); ?></p>
				<p><?php esc_html_e( 'Завдяки сучасним технологіям, ви можете отримати юридичний аналіз вашої ситуації, перебуваючи в будь-якій точці України чи світу. Це особливо актуально для військовослужбовців, людей, які перебувають за кордоном, або тих, хто цінує конфіденційність та власний графік.', 'web' ); ?></p>
			</div>
		</div>
	</section>

	<!-- ============ BENEFITS ============ -->
	<section class="consult-benefits">
		<div class="container">
			<span class="section-eyebrow"><?php esc_html_e( 'Допомога', 'web' ); ?></span>
			<h2 class="section-title section-title--flush"><?php esc_html_e( 'Що ви отримаєте від адвоката під час онлайн-консультації?', 'web' ); ?></h2>
			<p class="consult-benefits__lead"><?php esc_html_e( 'Консультація — це не просто «розмова по телефону». Це повноцінний юридичний продукт, який включає:', 'web' ); ?></p>
			<div class="consult-benefits__grid">
				<?php foreach ( $benefits as $b ) : ?>
					<div class="consult-benefit">
						<span class="consult-benefit__icon"><?php echo get_svg_icon( 'check' ); ?></span>
						<p class="consult-benefit__text"><strong><?php echo esc_html( $b['lead'] ); ?></strong> <?php echo esc_html( $b['text'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ DIRECTIONS (services) ============ -->
	<section class="fp-services consult-directions" id="services">
		<div class="container">
			<span class="section-eyebrow"><?php esc_html_e( 'Послуги', 'web' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'Напрямки онлайн-допомоги', 'web' ); ?></h2>
			<p class="consult-directions__lead"><?php esc_html_e( 'Як юрист (Київ, Бровари), я надаю дистанційну допомогу за такими напрямками:', 'web' ); ?></p>
			<div class="fp-services__grid">
				<?php foreach ( $directions as $d ) : ?>
					<article class="svc-card">
						<span class="svc-card__icon"><?php echo get_svg_icon( $d['icon'] ); ?></span>
						<h3 class="svc-card__title"><?php echo esc_html( $d['title'] ); ?></h3>
						<p class="svc-card__text"><?php echo esc_html( $d['text'] ); ?></p>
						<a href="#consult-form" class="svc-card__cta">
							<?php esc_html_e( 'Записатись на консультацію', 'web' ); ?>
							<?php echo get_svg_icon( 'arrow-right' ); ?>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ FORM (mid-page) ============ -->
	<section class="consult-formblock" id="consult-form">
		<div class="container">
			<div class="consult-form-card consult-form-card--wide">
				<h2 class="consult-form-card__title"><?php esc_html_e( 'Залишити заявку на консультацію', 'web' ); ?></h2>
				<?php echo web_consult_form(); ?>
			</div>
		</div>
	</section>

	<!-- ============ FAQ ============ -->
	<section class="fp-faq consult-faq">
		<div class="container">
			<span class="section-eyebrow"><?php esc_html_e( 'FAQ', 'web' ); ?></span>
			<h2 class="section-title section-title--flush"><?php esc_html_e( 'Поширені питання про онлайн-консультацію', 'web' ); ?></h2>
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

</main><!-- #primary -->

<?php get_footer(); ?>

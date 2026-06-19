<?php

/**
 * The front page template (homepage).
 *
 * Markup matches the Figma design "Simutin-Web (Copy)" → Section - HERO …→ CTA.
 * Content is driven by the page-level ACF group "Контент головної сторінки"
 * (see inc/back/acf.php). "Виграні справи" come from the `case` CPT and the
 * blog cards from the latest posts. Every value falls back to the Figma default
 * via web_f()/web_rows(), so the page renders fully before any field is set.
 *
 * @package web
 */

get_header();

$img = get_template_directory_uri() . '/inc/assets/img';

/* ---- Per-section background colours (ACF color pickers; empty = CSS default) */
$bg = array(
	'page'     => web_f( 'bg_page', '' ),
	'intro'    => web_f( 'bg_intro', '' ),
	'services' => web_f( 'bg_services', '' ),
	'why'      => web_f( 'bg_why', '' ),
	'cases'    => web_f( 'bg_cases', '' ),
	'stats'    => web_f( 'bg_stats', '' ),
	'faq'      => web_f( 'bg_faq', '' ),
	'blog'     => web_f( 'bg_blog', '' ),
	'cta'      => web_f( 'bg_cta', '' ),
);
/** Inline `style="background:.."` when a section colour is set. */
function web_bg_style( $c ) {
	return $c ? ' style="background:' . esc_attr( $c ) . '"' : '';
}

/* ---- Intro / mission (Figma: «Досвід та місія») --------------------- */
$intro_default = array(
	__( 'Я – Роман Сімутін, адвокат із понад 20-річним практичним стажем. Моя професійна діяльність зосереджена в містах Київ та Бровари, де я допомагаю громадянам та бізнесу захищати їхні права навіть у найбільш критичних ситуаціях. Також допомагаємо онлайн на всій території України.', 'web' ),
	__( 'Юридичний шлях часто виглядає як лабіринт: кожен невірний крок може коштувати свободи, майна або майбутнього. Консультуючи своїх клієнтів, я не просто надаю перелік законів, натомість я розробляю стратегію перемоги. Моя мета — ваш результат, і я докладаю максимум зусиль, щоб безнадійні справи перетворювалися на виграні. Якщо вам потрібен надійний юрист у Києві або досвідчений адвокат у Броварах, ви звернулися за адресою.', 'web' ),
);
$intro_html = web_f( 'intro_text', '' );

/* ---- Services: small cards ------------------------------------------ */
$services = web_rows( 'services_small', array(
	array( 'icon' => 'svc-mil',    'title' => __( 'Військовий адвокат: Мобілізація та ВЛК', 'web' ), 'text' => __( "Ми знаємо всі тонкощі оновленого законодавства та забезпечуємо захист конституційних прав військовозобов'язаних.", 'web' ), 'cta' => __( 'Отримати захист', 'web' ),
		'panel_lead'  => __( 'Сьогодні питання військового права є найбільш актуальними. Як адвокат (консультація Київ), я надаю повний спектр послуг щодо взаємодії з ТЦК та СП:', 'web' ),
		'panel_points' => array(
			array( 'point' => __( 'Супровід процедури мобілізації та перевірка підстав для відстрочки.', 'web' ) ),
			array( 'point' => __( 'Отримання відстрочки від мобілізації.', 'web' ) ),
			array( 'point' => __( 'Оскарження рішень ВЛК у судовому та адміністративному порядку.', 'web' ) ),
			array( 'point' => __( 'Захист у випадках незаконного затримання або доставлення до ТЦК.', 'web' ) ),
			array( 'point' => __( 'Консультації щодо бронювання працівників та виїзду за кордон.', 'web' ) ),
			array( 'point' => __( 'Демобілізація / звільнення зі служби.', 'web' ) ),
		),
		'panel_outro' => __( "Ми знаємо всі тонкощі оновленого законодавства та забезпечуємо захист конституційних прав військовозобов'язаних.", 'web' ),
	),
	array( 'icon' => 'svc-car',    'title' => __( 'Захист водія: ДТП, ст. 130 КУпАП', 'web' ),       'text' => __( 'Ми надаємо допомогу в справі за ст. 130 КУпАП і захищаємо права водія при ДТП.', 'web' ), 'cta' => __( 'Отримати захист', 'web' ) ),
	array( 'icon' => 'svc-scales', 'title' => __( 'Захист у кримінальних справах', 'web' ),          'text' => __( 'Ми розуміємо правоохоронну систему зсередини і всі моменти, коли кожна хвилина зволікання працює проти вас.', 'web' ), 'cta' => __( 'Отримати захист', 'web' ) ),
	array( 'icon' => 'svc-family', 'title' => __( 'Сімейні та спадкові спори', 'web' ),              'text' => __( 'Захищаємо ваші інтереси під час розлучення, поділу майна або боротьби за спадщину.', 'web' ), 'cta' => __( 'Отримати захист', 'web' ) ),
) );

/* ---- Services: wide highlight cards --------------------------------- */
$services_wide = web_rows( 'services_wide', array(
	array( 'icon' => 'svc-doc',   'title' => __( 'Продаж інструкцій', 'web' ),                  'text' => __( 'Готові покрокові інструкції для самостійного вирішення типових юридичних ситуацій.', 'web' ), 'cta' => __( 'Купити інструкції', 'web' ) ),
	array( 'icon' => 'svc-clock', 'title' => __( 'Договір цілодобової підтримки 24/7', 'web' ), 'text' => __( "Ваш адвокат на зв'язку у будь-який час доби. Швидке реагування на критичні ситуації.", 'web' ), 'cta' => __( 'Дізнатись більше', 'web' ) ),
) );

/* Assign a unique side-panel id to every service so each card opens its own
 * dynamic .popup-service (built at the end of this template). */
$service_panels = array();
foreach ( $services as $k => $s ) {
	$s['pid'] = 'svc-panel-s' . $k;
	$services[ $k ] = $s;
	$service_panels[] = $s;
}
foreach ( $services_wide as $k => $s ) {
	$s['pid'] = 'svc-panel-w' . $k;
	$services_wide[ $k ] = $s;
	$service_panels[] = $s;
}

/* ---- Why us (Figma: «Переваги») ------------------------------------- */
$reasons = web_rows( 'why_items', array(
	array( 'title' => __( 'Понад 20 років практики', 'web' ),    'text' => __( 'Це тисячі годин у судах та глибоке знання судової практики, що постійно змінюється.', 'web' ) ),
	array( 'title' => __( 'Знання системи зсередини', 'web' ),   'text' => __( 'Розуміння того, як працюють органи правопорядку, дає можливість діяти на випередження.', 'web' ) ),
	array( 'title' => __( 'Команда експертів', 'web' ),          'text' => __( 'Кожну справу супроводжую персонально я або вузькопрофільні спеціалісти під моїм особистим контролем.', 'web' ) ),
	array( 'title' => __( 'Складні та безнадійні справи', 'web' ), 'text' => __( 'Ми не боїмося братися за справи, від яких відмовилися інші адвокати Києва.', 'web' ) ),
) );
$why_image  = web_f( 'why_image', $img . '/why.jpg' );

/* Hero background — ACF image overrides the CSS default (inc/assets/img/hero.png). */
$hero_image = web_f( 'hero_image', '' );

/* ---- Won cases — WP posts in the «Виграні справи» category (fallback: demo).
 *      The blog section below pulls posts that are NOT in this category. ------ */
$cases       = array();
$won_cat     = get_category_by_slug( 'vyhrani-spravy' );
$won_cat_id  = $won_cat ? (int) $won_cat->term_id : 0;
if ( $won_cat_id ) {
	$cases_q = new WP_Query( array(
		'post_type'        => 'post',
		'posts_per_page'   => 8,
		'category__in'     => array( $won_cat_id ),
		'no_found_rows'    => true,
		'ignore_sticky_posts' => true,
	) );
	if ( $cases_q->have_posts() ) {
		while ( $cases_q->have_posts() ) {
			$cases_q->the_post();
			$tag = web_f( 'case_tag', '', get_the_ID() );
			if ( ! $tag ) { // fall back to the first category that isn't the «Виграні справи» bucket
				foreach ( (array) wp_get_post_terms( get_the_ID(), 'category' ) as $t ) {
					if ( (int) $t->term_id !== $won_cat_id ) { $tag = $t->name; break; }
				}
			}
			$cases[] = array(
				'tag'  => $tag,
				'num'  => web_f( 'case_num', '', get_the_ID() ),
				'text' => web_f( 'case_excerpt', get_the_title(), get_the_ID() ),
				'img'  => get_the_post_thumbnail_url( get_the_ID(), 'large' ),
				'url'  => get_permalink( get_the_ID() ),
			);
		}
		wp_reset_postdata();
	}
}
if ( empty( $cases ) ) {
	$cases = array(
		array( 'tag' => __( 'Мобілізація', 'web' ),      'num' => '',               'text' => __( 'Два супер насичені дні позаду: невтомно відбивалися від незаконних затримань на блокпостах. Спойлер: успішно.', 'web' ), 'img' => $img . '/case-1.jpg', 'url' => '#' ),
		array( 'tag' => __( 'Спадщина', 'web' ),         'num' => '№ 358/904/22',   'text' => __( 'Справу фальсифікував нотаріус разом із родичами. Нам вдалося поновити строк для прийняття спадщини і не дали забрати квартиру.', 'web' ), 'img' => $img . '/case-2.jpg', 'url' => '#' ),
		array( 'tag' => __( 'ДТП', 'web' ),              'num' => '№ ---',          'text' => __( 'Кримінальне провадження за ДТП із смертю пішохода закрито за відсутністю складу кримінального правопорушення.', 'web' ), 'img' => $img . '/case-3.jpg', 'url' => '#' ),
		array( 'tag' => __( 'Повернення прав', 'web' ),  'num' => '№ 361/7602/23',  'text' => __( 'Вертаєшся собі спокійно з відпустки на службу, аж тут бац! – на рівному місці 130 КУпАП! Чому? Бо «не повеземо у лікарню на освідування».', 'web' ), 'img' => $img . '/case-4.jpg', 'url' => '#' ),
	);
}

/* ---- Stats ----------------------------------------------------------- */
$stats = web_rows( 'stats_items', array(
	array( 'value' => '94', 'label' => __( 'Мобілізація', 'web' ) ),
	array( 'value' => '86', 'label' => __( 'Кримінал', 'web' ) ),
	array( 'value' => '83', 'label' => __( 'ОТГ в КУпАП', 'web' ) ),
	array( 'value' => '100', 'label' => __( 'ДТП', 'web' ) ),
	array( 'value' => '100', 'label' => __( 'Сімейні', 'web' ) ),
	array( 'value' => '89', 'label' => __( 'Спадщина', 'web' ) ),
) );

/* ---- FAQ ------------------------------------------------------------- */
$faqs = web_rows( 'faq_items', array(
	array( 'q' => __( 'Чи можна оскаржити рішення ВЛК, якщо я не згоден з висновком про придатність?', 'web' ), 'a' => __( 'Так, висновок ВЛК можна оскаржити до ВЛК вищого рівня або безпосередньо до суду. Для цього необхідно надати медичні документи, що підтверджують наявність захворювань, які не були враховані комісією. Наш адвокат у Києві допоможе підготувати скаргу та зібрати необхідну доказову базу.', 'web' ) ),
	array( 'q' => __( 'Що робити, якщо мене зупинили та намагаються примусово доставити до ТЦК?', 'web' ), 'a' => '' ),
	array( 'q' => __( "Які шанси виграти справу за ст. 130 КУпАП (алкогольне сп'яніння)?", 'web' ), 'a' => '' ),
	array( 'q' => __( 'Скільки триває процес розлучення та поділу майна?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чи допомагаєте ви отримати відстрочку від мобілізації?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Що дає консультація адвоката перед відкриттям бізнесу?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Як повернути права, якщо суд першої інстанції вже виніс рішення про їх позбавлення?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Яка вартість послуг адвоката у Києві та Броварах?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чи можна оформити спадщину, якщо минуло більше 6 місяців з дня смерті?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чому важливо мати адвоката під час обшуку?', 'web' ), 'a' => '' ),
) );

/* ---- Articles / blog — latest posts (fallback: Figma demo) ----------- */
$articles   = array();
$articles_q = new WP_Query( array(
	'post_type'        => 'post',
	'posts_per_page'   => 4,
	'category__not_in' => $won_cat_id ? array( $won_cat_id ) : array(),
	'no_found_rows'    => true,
	'ignore_sticky_posts' => true,
) );
if ( $articles_q->have_posts() ) {
	while ( $articles_q->have_posts() ) {
		$articles_q->the_post();
		$cats = get_the_category();
		$articles[] = array(
			'cat'   => ! empty( $cats ) ? $cats[0]->name : '',
			'date'  => get_the_date( 'j F Y' ),
			'title' => get_the_title(),
			'img'   => get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ),
			'url'   => get_permalink(),
		);
	}
	wp_reset_postdata();
}
if ( empty( $articles ) ) {
	$articles = array(
		array( 'cat' => __( 'МОБІЛІЗАЦІЯ', 'web' ),      'date' => __( '8 квітня 2026', 'web' ), 'title' => __( 'Відкрили Резерв+ і побачили новий статус? Не поспішайте панікувати.', 'web' ), 'img' => $img . '/post-1.jpg', 'url' => '#' ),
		array( 'cat' => __( 'ПРАКТИЧНІ ПОРАДИ', 'web' ), 'date' => __( '7 квітня 2026', 'web' ), 'title' => __( 'Чи можете ви подати заяву про відстрочку поштою без особистого візиту?', 'web' ), 'img' => $img . '/post-2.jpg', 'url' => '#' ),
		array( 'cat' => __( 'МОБІЛІЗАЦІЯ', 'web' ),      'date' => __( '5 квітня 2026', 'web' ), 'title' => __( 'Бусифікація ТЦК офіційно йде в минуле. Нардеп, член комітету...', 'web' ), 'img' => $img . '/post-3.jpg', 'url' => '#' ),
		array( 'cat' => __( 'МОБІЛІЗАЦІЯ', 'web' ),      'date' => __( '1 квітня 2026', 'web' ), 'title' => __( 'Три закони про ТЦК: каратимуть за помилковий облік в «Оберіг» на 170...', 'web' ), 'img' => $img . '/post-4.jpg', 'url' => '#' ),
	);
}
?>

<?php if ( $bg['page'] ) : ?>
	<style>body{background:<?php echo esc_html( $bg['page'] ); ?>;}</style>
<?php endif; ?>
<main id="primary" class="site-main front-page">

	<!-- ============ HERO ============ -->
	<section class="fp-hero"<?php echo $hero_image ? ' style="background-image:url(' . esc_url( $hero_image ) . ')"' : ''; ?>>
		<div class="container fp-hero__inner">
			<div class="fp-hero__content">
				<span class="fp-hero__eyebrow">
					<?php echo get_svg_icon('pin'); ?>
					<?php echo esc_html( web_f('hero_eyebrow', __('Київ, Бровари', 'web') ) ); ?>
				</span>
				<h1 class="fp-hero__title"><?php echo esc_html( web_f('hero_title', __('Адвокат Сімутін Роман', 'web') ) ); ?></h1>
				<p class="fp-hero__text">
					<?php echo wp_kses_post( web_f('hero_text', __('Захист у кримінальних, військових, сімейних справах. Телефонуйте!', 'web') ) ); ?>
				</p>
				<div class="fp-hero__actions">
					<a href="<?php echo esc_url( web_consult_url() ); ?>" class="btn btn--gold">
						<?php echo esc_html( web_f('hero_cta', __('Отримати консультацію', 'web') ) ); ?>
						<?php echo get_svg_icon('arrow-right'); ?>
					</a>
					<a href="#services" class="btn btn--ghost"><?php echo esc_html( web_f('hero_cta2', __('Послуги', 'web') ) ); ?></a>
				</div>
			</div>
		</div>

		<!-- Floating telegram button -->
		<button type="button" class="fp-tg-float open-popup" data-popup-id="telegram" aria-label="<?php esc_attr_e('Написати в Telegram', 'web'); ?>">
			<?php echo get_svg_icon('telegram'); ?>
		</button>
	</section>

	<!-- ============ INTRO / MISSION ============ -->
	<section class="fp-intro"<?php echo web_bg_style( $bg['intro'] ); ?>>
		<div class="container fp-intro__inner">
			<div class="fp-intro__head">
				<span class="section-eyebrow"><?php echo esc_html( web_f('intro_eyebrow', __('Досвід та місія', 'web') ) ); ?></span>
				<h2 class="section-title"><?php echo esc_html( web_f('intro_title', __('Адвокат із 20-річним стажем', 'web') ) ); ?></h2>
			</div>
			<div class="fp-intro__text">
				<?php if ( $intro_html ) : ?>
					<?php echo wp_kses_post( $intro_html ); ?>
				<?php else : ?>
					<?php foreach ($intro_default as $p) : ?>
						<p><?php echo esc_html($p); ?></p>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- ============ SERVICES ============ -->
	<section class="fp-services" id="services"<?php echo web_bg_style( $bg['services'] ); ?>>
		<div class="container">
			<span class="section-eyebrow"><?php echo esc_html( web_f('services_eyebrow', __('Послуги', 'web') ) ); ?></span>
			<h2 class="section-title"><?php echo esc_html( web_f('services_title', __('Ключові напрямки юридичного захисту', 'web') ) ); ?></h2>

			<div class="fp-services__grid">
				<?php foreach ($services as $service) : ?>
					<article class="svc-card open-popup" data-popup-id="<?php echo esc_attr( $service['pid'] ); ?>" role="button" tabindex="0">
						<span class="svc-card__icon"><?php echo get_svg_icon($service['icon']); ?></span>
						<h3 class="svc-card__title"><?php echo esc_html($service['title']); ?></h3>
						<p class="svc-card__text"><?php echo wp_kses_post($service['text']); ?></p>
						<a href="#" class="svc-card__cta open-popup" data-popup-id="telegram">
							<?php echo esc_html($service['cta']); ?>
							<?php echo get_svg_icon('arrow-right'); ?>
						</a>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="fp-services__wide">
				<?php foreach ($services_wide as $card) : ?>
					<article class="svc-wide open-popup" data-popup-id="<?php echo esc_attr( $card['pid'] ); ?>" role="button" tabindex="0">
						<span class="svc-wide__icon"><?php echo get_svg_icon($card['icon']); ?></span>
						<div class="svc-wide__body">
							<h3 class="svc-wide__title"><?php echo esc_html($card['title']); ?></h3>
							<p class="svc-wide__text"><?php echo wp_kses_post($card['text']); ?></p>
							<a href="#" class="btn btn--gold open-popup" data-popup-id="telegram">
								<?php echo esc_html($card['cta']); ?>
								<?php echo get_svg_icon('arrow-right'); ?>
							</a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ WHY US ============ -->
	<section class="fp-why" id="about"<?php echo web_bg_style( $bg['why'] ); ?>>
		<div class="container">
			<span class="section-eyebrow"><?php echo esc_html( web_f('why_eyebrow', __('Переваги', 'web') ) ); ?></span>
			<h2 class="section-title"><?php echo esc_html( web_f('why_title', __('Чому варто обрати саме адвоката Романа Сімутіна?', 'web') ) ); ?></h2>

			<div class="fp-why__card">
				<ul class="fp-why__list">
					<?php foreach ($reasons as $reason) : ?>
						<li class="fp-why__item">
							<span class="fp-why__icon"><?php echo get_svg_icon('check'); ?></span>
							<div class="fp-why__text">
								<h3 class="fp-why__title"><?php echo esc_html($reason['title']); ?></h3>
								<p><?php echo esc_html($reason['text']); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
				<div class="fp-why__media">
					<img src="<?php echo esc_url($why_image); ?>" alt="<?php esc_attr_e('Адвокат Сімутін Роман', 'web'); ?>" loading="lazy"
					     onerror="this.style.display='none';this.parentNode.classList.add('is-empty')">
				</div>
			</div>
		</div>
	</section>

	<!-- ============ WON CASES ============ -->
	<section class="fp-cases" id="cases"<?php echo web_bg_style( $bg['cases'] ); ?>>
		<div class="container">
			<div class="fp-section-head">
				<div>
					<span class="section-eyebrow"><?php echo esc_html( web_f('cases_eyebrow', __('Практика', 'web') ) ); ?></span>
					<h2 class="section-title section-title--flush"><?php echo esc_html( web_f('cases_title', __('Виграні справи', 'web') ) ); ?></h2>
				</div>
				<div class="fp-nav">
					<button type="button" class="fp-nav__btn" data-dir="prev" aria-label="<?php esc_attr_e('Назад', 'web'); ?>">
						<svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.0909 10.1819L-1.38283e-05 5.09098L5.0909 6.67572e-05L5.9659 0.863703L2.36362 4.46598H11.6932V5.71598H2.36362L5.9659 9.30688L5.0909 10.1819Z" fill="white"/>
</svg>
					</button>
					<button type="button" class="fp-nav__btn" data-dir="next" aria-label="<?php esc_attr_e('Вперед', 'web'); ?>">
						<svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6.60227 10.1819L5.72727 9.31825L9.32955 5.71598H0V4.46598H9.32955L5.72727 0.875067L6.60227 6.67572e-05L11.6932 5.09098L6.60227 10.1819Z" fill="white"/>
						</svg>
					</button>
				</div>
			</div>

			<div class="fp-cases__grid">
				<?php foreach ($cases as $case) : ?>
					<article class="case-card">
						<div class="case-card__media">
							<img src="<?php echo esc_url($case['img']); ?>" alt="<?php echo esc_attr($case['tag']); ?>" loading="lazy"
							     onerror="this.style.display='none';this.parentNode.classList.add('is-empty')">
						</div>
						<div class="case-card__body">
							<div class="case-card__meta">
								<span class="case-card__tag"><?php echo esc_html($case['tag']); ?></span>
								<?php if (!empty($case['num'])) : ?>
									<span class="case-card__num"><?php echo esc_html($case['num']); ?></span>
								<?php endif; ?>
							</div>
							<h3 class="case-card__title"><?php echo wp_kses_post($case['text']); ?></h3>
							<a href="<?php echo esc_url( $case['url'] ); ?>" class="case-card__cta">
								<?php esc_html_e('Детальніше', 'web'); ?>
								<?php echo get_svg_icon('arrow-right'); ?>
							</a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ STATS ============ -->
	<section class="fp-stats"<?php echo web_bg_style( $bg['stats'] ); ?>>
		<div class="container">
			<span class="section-eyebrow"><?php echo esc_html( web_f('stats_eyebrow', __('Цифри', 'web') ) ); ?></span>
			<h2 class="section-title section-title--flush"><?php echo esc_html( web_f('stats_title', __('Статистика та реальні досягнення', 'web') ) ); ?></h2>
			<p class="fp-stats__lead"><?php echo esc_html( web_f('stats_lead', __('Ми оперуємо цифрами, які підтверджують нашу ефективність. Кожен відсоток – це реальна доля людини, яку вдалося змінити на краще.', 'web') ) ); ?></p>

			<div class="fp-stats__grid">
				<?php foreach ($stats as $stat) : ?>
					<div class="stat">
						<span class="stat__value"><?php echo esc_html($stat['value']); ?><span class="stat__pct">%</span></span>
						<span class="stat__label"><?php echo esc_html($stat['label']); ?></span>
						<span class="stat__sub"><?php esc_html_e('виграно', 'web'); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ FAQ ============ -->
	<section class="fp-faq"<?php echo web_bg_style( $bg['faq'] ); ?>>
		<div class="container">
			<span class="section-eyebrow"><?php echo esc_html( web_f('faq_eyebrow', __('FAQ', 'web') ) ); ?></span>
			<h2 class="section-title section-title--flush"><?php echo esc_html( web_f('faq_title', __('Часті запитання', 'web') ) ); ?></h2>
			<div class="fp-faq__list">
				<?php foreach ($faqs as $i => $faq) : ?>
					<details class="faq-item"<?php echo 0 === $i ? ' open' : ''; ?>>
						<summary class="faq-item__q">
							<span><?php echo esc_html($faq['q']); ?></span>
							<span class="faq-item__icon"><?php echo get_svg_icon('chevron'); ?></span>
						</summary>
						<?php if (!empty($faq['a'])) : ?>
							<div class="faq-item__a"><?php echo wp_kses_post( wpautop( $faq['a'] ) ); ?></div>
						<?php endif; ?>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ ARTICLES / BLOG ============ -->
	<section class="fp-articles" id="blog"<?php echo web_bg_style( $bg['blog'] ); ?>>
		<div class="container">
			<div class="fp-section-head">
				<div>
					<span class="section-eyebrow"><?php echo esc_html( web_f('blog_eyebrow', __('Блог', 'web') ) ); ?></span>
					<h2 class="section-title section-title--flush"><?php echo esc_html( web_f('blog_title', __('Статті та публікації', 'web') ) ); ?></h2>
				</div>
				<div class="fp-nav">
					<button type="button" class="fp-nav__btn" data-dir="prev" aria-label="<?php esc_attr_e('Назад', 'web'); ?>"><svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.0909 10.1819L-1.38283e-05 5.09098L5.0909 6.67572e-05L5.9659 0.863703L2.36362 4.46598H11.6932V5.71598H2.36362L5.9659 9.30688L5.0909 10.1819Z" fill="white"/>
</svg>
</button>
					<button type="button" class="fp-nav__btn" data-dir="next" aria-label="<?php esc_attr_e('Вперед', 'web'); ?>"><svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M6.60227 10.1819L5.72727 9.31825L9.32955 5.71598H0V4.46598H9.32955L5.72727 0.875067L6.60227 6.67572e-05L11.6932 5.09098L6.60227 10.1819Z" fill="white"/>
</svg>
</button>
				</div>
			</div>

			<div class="fp-articles__grid">
				<?php foreach ($articles as $article) : ?>
					<article class="article-card">
						<div class="article-card__media">
							<img src="<?php echo esc_url($article['img']); ?>" alt="<?php echo esc_attr($article['title']); ?>" loading="lazy"
							     onerror="this.style.display='none';this.parentNode.classList.add('is-empty')">
						</div>
						<div class="article-card__body">
							<div class="article-card__meta">
								<span class="article-card__cat"><?php echo esc_html($article['cat']); ?></span>
								<span class="article-card__date"><?php echo esc_html($article['date']); ?></span>
							</div>
							<h3 class="article-card__title"><?php echo esc_html($article['title']); ?></h3>
							<a href="<?php echo esc_url($article['url']); ?>" class="article-card__more">
								<?php esc_html_e('Читати', 'web'); ?>
								<?php echo get_svg_icon('arrow-right'); ?>
							</a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ CTA ============ -->
	<section class="fp-cta"<?php echo web_bg_style( $bg['cta'] ); ?>>
		<div class="container">
			<div class="fp-cta__box">
				<h2 class="fp-cta__title"><?php echo esc_html( web_f('cta_title', __('Потрібна допомога?', 'web') ) ); ?></h2>
				<p class="fp-cta__text"><?php echo esc_html( web_f('cta_text', __('Ми зможемо її надати.', 'web') ) ); ?></p>
				<a href="<?php echo esc_url( web_consult_url() ); ?>" class="btn btn--gold">
					<?php echo esc_html( web_f('cta_btn', __('Отримати консультацію', 'web') ) ); ?>
					<?php echo get_svg_icon('arrow-right'); ?>
				</a>
			</div>
		</div>
	</section>

</main><!-- #main -->

<?php
/* ============ DYNAMIC SERVICE SIDE-PANELS ============
 * One .popup-service per service card (id = $s['pid']). Content comes from the
 * service's ACF fields (panel_lead / panel_points / panel_outro); falls back to
 * the card text so every card always opens a meaningful panel. */
foreach ( $service_panels as $s ) :
	$points = ! empty( $s['panel_points'] ) ? $s['panel_points'] : array();
	$lead   = ! empty( $s['panel_lead'] ) ? $s['panel_lead'] : ( isset( $s['text'] ) ? $s['text'] : '' );
	?>
	<div class="popup popup-right popup-service" id="<?php echo esc_attr( $s['pid'] ); ?>">
		<span class="close-popup"><?php echo get_svg_icon('closepopup'); ?></span>
		<div class="popup-content service-panel">
			<span class="service-panel__icon"><?php echo get_svg_icon( ! empty( $s['icon'] ) ? $s['icon'] : 'svc-scales' ); ?></span>
			<h2 class="service-panel__title"><?php echo esc_html( $s['title'] ); ?></h2>
			<?php if ( $lead ) : ?>
				<div class="service-panel__lead"><?php echo wp_kses_post( wpautop( $lead ) ); ?></div>
			<?php endif; ?>
			<?php if ( ! empty( $points ) ) : ?>
				<ul class="service-panel__list">
					<?php foreach ( $points as $pt ) : $val = is_array( $pt ) ? ( isset( $pt['point'] ) ? $pt['point'] : reset( $pt ) ) : $pt; ?>
						<?php if ( $val ) : ?><li><?php echo esc_html( $val ); ?></li><?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if ( ! empty( $s['panel_outro'] ) ) : ?>
				<p class="service-panel__outro"><?php echo esc_html( $s['panel_outro'] ); ?></p>
			<?php endif; ?>
			<a href="#" class="btn btn--gold btn--block open-popup" data-popup-id="telegram">
				<?php echo esc_html( ! empty( $s['cta'] ) ? $s['cta'] : __( 'Отримати консультацію', 'web' ) ); ?>
				<?php echo get_svg_icon('arrow-right'); ?>
			</a>
		</div>
	</div>
<?php endforeach; ?>

<?php get_footer(); ?>

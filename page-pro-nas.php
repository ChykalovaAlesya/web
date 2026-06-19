<?php
/**
 * Template for the "Про нас" page (slug: pro-nas).
 *
 * Built from Figma "About_Us_Roman Simutin" (node 532-4038). Content is editable
 * via the ACF group "Про нас" (see inc/back/acf.php); every value falls back to
 * the Figma default through web_f()/web_rows() so the page renders fully before
 * any field is set. Reuses the homepage components (stats / why / faq) styling.
 *
 * @package web
 */

get_header();

$img = get_template_directory_uri() . '/inc/assets/img';

/* ---- Hero ----------------------------------------------------------- */
$about_title = web_f( 'about_title', __( 'Сімутін Роман: 10+ років практики', 'web' ) );
$about_text  = web_f( 'about_text', __( 'Сімутін Роман Вікторович – засновник Адвокатського бюро, адвокат із 2012 року, чия практика базується на глибокому розумінні української правової системи. Завдяки значному досвіду роботи в правоохоронних органах, Роман Сімутін забезпечує клієнтам захист, що базується на знанні внутрішньої кухні слідчих та судових процесів.', 'web' ) );
$about_cta   = web_f( 'about_cta', __( 'Отримати консультацію', 'web' ) );
$about_hero_image = web_f( 'about_hero_image', '' );

/* ---- Stats (same metrics as homepage) ------------------------------- */
$stats_lead = web_f( 'about_stats_lead', __( 'Цифри, що говорять про якість нашої роботи:', 'web' ) );
$stats = web_rows( 'about_stats', array(
	array( 'value' => '94',  'label' => __( 'Мобілізація', 'web' ) ),
	array( 'value' => '86',  'label' => __( 'Кримінал', 'web' ) ),
	array( 'value' => '83',  'label' => __( 'ОТГ в КУпАП', 'web' ) ),
	array( 'value' => '100', 'label' => __( 'ДТП', 'web' ) ),
	array( 'value' => '100', 'label' => __( 'Сімейні', 'web' ) ),
	array( 'value' => '89',  'label' => __( 'Спадщина', 'web' ) ),
) );

/* ---- Founder -------------------------------------------------------- */
$founder_name  = web_f( 'founder_name', __( 'Роман Сімутін', 'web' ) );
$founder_role  = web_f( 'founder_role', __( 'Адвокат, засновник практики', 'web' ) );
$founder_photo = web_f( 'founder_photo', '' );
$founder_points = web_rows( 'founder_points', array(
	array( 'lead' => __( '10+ років адвокатської діяльності:', 'web' ), 'text' => __( 'Офіційна практика з 2012 року, що охоплює найскладніші галузі права: кримінальне, військове, сімейне та дорожнє (ДТП, ст. 130 КУпАП).', 'web' ) ),
	array( 'lead' => __( 'Унікальна експертиза:', 'web' ), 'text' => __( 'Багаторічна служба в правоохоронній системі дозволяє адвокату бачити справу очима опонента, що є критичною перевагою під час обшуків, допитів та судових засідань.', 'web' ) ),
	array( 'lead' => __( 'Спеціалізація:', 'web' ), 'text' => __( 'Побудова стратегії захисту в безвиграшних ситуаціях, де інші бачать лише глухий кут.', 'web' ) ),
) );

/* ---- Team ----------------------------------------------------------- */
$team = web_rows( 'team_members', array(
	array( 'photo' => '', 'name' => __( 'Анастасія Бондаренко', 'web' ), 'role' => __( 'Юрисконсультант', 'web' ), 'desc' => __( 'Супроводжує клієнтів із цивільного та господарського права. Експерт з публічних закупівель.', 'web' ) ),
	array( 'photo' => '', 'name' => __( 'Ігор Марков', 'web' ), 'role' => __( 'Адвокат', 'web' ), 'desc' => __( 'Кваліфікований адвокат, працює в парі з Романом Сімутіним у складних кримінальних та цивільних провадженнях.', 'web' ) ),
	array( 'photo' => '', 'name' => __( 'Людмила', 'web' ), 'role' => __( 'Юрисконсультант', 'web' ), 'desc' => __( 'Опис.', 'web' ) ),
	array( 'photo' => '', 'name' => __( 'Валерія', 'web' ), 'role' => __( 'Юрисконсультант', 'web' ), 'desc' => __( 'Опис.', 'web' ) ),
) );

/* ---- Values --------------------------------------------------------- */
$values = web_rows( 'values_items', array(
	array( 'title' => __( 'Знання системи зсередини', 'web' ), 'text' => __( 'Ми розуміємо алгоритми роботи судів та ТЦК, що дозволяє діяти на випередження.', 'web' ) ),
	array( 'title' => __( 'Команда експертів', 'web' ), 'text' => __( 'Адвокатське бюро Романа Сімутіна – це злагоджена робота фахівців, де кожна справа проходить через багаторівневий юридичний аналіз.', 'web' ) ),
	array( 'title' => __( 'Безнадійні справи', 'web' ), 'text' => __( 'Ми спеціалізуємося на складних випадках, виправляючи чужі юридичні помилки та досягаючи результату там, де інші відступили.', 'web' ) ),
) );
$values_image = web_f( 'values_image', '' );

/* ---- FAQ ------------------------------------------------------------ */
$faqs = web_rows( 'about_faq', array(
	array( 'q' => __( 'Де територіально працює адвокат Роман Сімутін?', 'web' ), 'a' => __( 'Основні офіси розташовані в Києві та Броварах, проте ми надаємо послуги по всій Україні, зокрема через онлайн-консультації та виїзди.', 'web' ) ),
	array( 'q' => __( 'Який досвід у кримінальних справах?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чи працює адвокат із військовими справами?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чи можна отримати консультацію дистанційно?', 'web' ), 'a' => '' ),
	array( 'q' => __( 'Чим ваш підхід відрізняється від інших?', 'web' ), 'a' => '' ),
) );

/* ---- CTA ------------------------------------------------------------ */
$cta_eyebrow = web_f( 'about_cta_eyebrow', __( 'КОНСУЛЬТАЦІЯ', 'web' ) );
$cta_title   = web_f( 'about_cta_title', __( 'Шукаєте захисту, а не просто консультації?', 'web' ) );
$cta_text    = web_f( 'about_cta_text', __( 'Адвокат Роман Сімутін – це досвід, який працює на вашу користь. Запишіться на зустріч вже сьогодні!', 'web' ) );
$phone       = web_opt( 'phone', '(067) 287-00-44' );
$phone_href  = web_opt( 'phone_href', 'tel:+380672870044' );
?>

<main id="primary" class="site-main about-page">

	<!-- ============ HERO ============ -->
	<section class="about-hero"<?php echo $about_hero_image ? ' style="background-image:url(' . esc_url( $about_hero_image ) . ')"' : ''; ?>>
		<div class="container">
			<nav class="about-hero__crumbs" aria-label="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Головна', 'web' ); ?></a>
				<span class="about-hero__sep"><?php echo get_svg_icon( 'chevron' ); ?></span>
				<span><?php esc_html_e( 'Про нас', 'web' ); ?></span>
			</nav>
			<h1 class="about-hero__title"><?php echo esc_html( $about_title ); ?></h1>
			<p class="about-hero__text"><?php echo esc_html( $about_text ); ?></p>
			<a href="<?php echo esc_url( web_consult_url() ); ?>" class="btn btn--gold">
				<?php echo esc_html( $about_cta ); ?>
				<?php echo get_svg_icon( 'arrow-right' ); ?>
			</a>
		</div>
		<button type="button" class="fp-tg-float open-popup" data-popup-id="telegram" aria-label="<?php esc_attr_e( 'Написати в Telegram', 'web' ); ?>">
			<?php echo get_svg_icon( 'telegram' ); ?>
		</button>
	</section>

	<!-- ============ STATS ============ -->
	<section class="fp-stats about-stats">
		<div class="container">
			<span class="section-eyebrow"><?php esc_html_e( 'Цифри', 'web' ); ?></span>
			<h2 class="section-title section-title--flush"><?php esc_html_e( 'Досягнення в цифрах', 'web' ); ?></h2>
			<p class="fp-stats__lead"><?php echo esc_html( $stats_lead ); ?></p>
			<div class="fp-stats__grid">
				<?php foreach ( $stats as $stat ) : ?>
					<div class="stat">
						<span class="stat__value"><?php echo esc_html( $stat['value'] ); ?><span class="stat__pct">%</span></span>
						<span class="stat__label"><?php echo esc_html( $stat['label'] ); ?></span>
						<span class="stat__sub"><?php esc_html_e( 'виграно', 'web' ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ FOUNDER ============ -->
	<section class="about-founder">
		<div class="container">
			<div class="founder-card">
				<div class="founder-card__media">
					<?php if ( $founder_photo ) : ?>
						<img src="<?php echo esc_url( $founder_photo ); ?>" alt="<?php echo esc_attr( $founder_name ); ?>" loading="lazy">
					<?php endif; ?>
				</div>
				<div class="founder-card__body">
					<h2 class="founder-card__name"><?php echo esc_html( $founder_name ); ?></h2>
					<p class="founder-card__role"><?php echo esc_html( $founder_role ); ?></p>
					<ul class="founder-card__list">
						<?php foreach ( $founder_points as $p ) : ?>
							<li><strong><?php echo esc_html( $p['lead'] ); ?></strong> <?php echo esc_html( $p['text'] ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- ============ TEAM ============ -->
	<section class="about-team">
		<div class="container">
			<span class="section-eyebrow"><?php esc_html_e( 'Команда', 'web' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'Люди, які працюють на ваш результат', 'web' ); ?></h2>
			<p class="about-team__lead"><?php esc_html_e( 'Роман особисто веде кожну справу. Команда забезпечує повний супровід клієнта на всіх етапах.', 'web' ); ?></p>
			<div class="about-team__grid">
				<?php foreach ( $team as $member ) : ?>
					<article class="team-card">
						<div class="team-card__media">
							<?php if ( ! empty( $member['photo'] ) ) : ?>
								<img src="<?php echo esc_url( $member['photo'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>" loading="lazy">
							<?php endif; ?>
						</div>
						<div class="team-card__body">
							<h3 class="team-card__name"><?php echo esc_html( $member['name'] ); ?></h3>
							<span class="team-card__role"><?php echo esc_html( $member['role'] ); ?></span>
							<p class="team-card__desc"><?php echo esc_html( $member['desc'] ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ============ VALUES ============ -->
	<section class="fp-why about-values">
		<div class="container">
			<span class="section-eyebrow"><?php esc_html_e( 'Переваги', 'web' ); ?></span>
			<h2 class="section-title"><?php esc_html_e( 'Наші цінності та підхід', 'web' ); ?></h2>
			<div class="fp-why__card">
				<ul class="fp-why__list">
					<?php foreach ( $values as $v ) : ?>
						<li class="fp-why__item">
							<span class="fp-why__icon"><?php echo get_svg_icon( 'check' ); ?></span>
							<div class="fp-why__text">
								<h3 class="fp-why__title"><?php echo esc_html( $v['title'] ); ?></h3>
								<p><?php echo esc_html( $v['text'] ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
				<div class="fp-why__media">
					<img src="<?php echo esc_url( $values_image ? $values_image : $img . '/why.jpg' ); ?>" alt="<?php esc_attr_e( 'Наші цінності', 'web' ); ?>" loading="lazy"
					     onerror="this.style.display='none';this.parentNode.classList.add('is-empty')">
				</div>
			</div>
		</div>
	</section>

	<!-- ============ FAQ ============ -->
	<section class="fp-faq about-faq">
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

	<!-- ============ CTA ============ -->
	<section class="about-cta">
		<div class="container">
			<div class="about-cta__box">
				<div class="about-cta__text">
					<span class="about-cta__eyebrow"><?php echo esc_html( $cta_eyebrow ); ?></span>
					<h2 class="about-cta__title"><?php echo esc_html( $cta_title ); ?></h2>
					<p><?php echo esc_html( $cta_text ); ?></p>
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

<div id="popup-overlay" class="popup-overlay">

    <!-- Consultation form -->
    <div class="popup popup-center" id="form">
        <span class="close-popup"><?php echo get_svg_icon('closepopup'); ?></span>
        <div class="popup-content">
            <?php echo do_shortcode('[contact-form-7 id="fb7ab4f" title="Contact form 1"]'); ?>
        </div>
    </div>

    <!-- Telegram modal -->
    <div class="popup popup-center popup-telegram" id="telegram">
        <span class="close-popup"><?php echo get_svg_icon('closepopup'); ?></span>
        <div class="popup-content tg-modal">
            <span class="tg-modal__icon"><?php echo get_svg_icon('telegram'); ?></span>
            <h2 class="tg-modal__title"><?php echo esc_html__('Напишіть нам в телеграм', 'web'); ?></h2>
            <p class="tg-modal__text"><?php echo esc_html__('Опишіть свою ситуацію — відповімо швидко і підкажемо як діяти.', 'web'); ?></p>
            <div class="tg-modal__actions">
                <a href="#" class="btn btn--gold btn--block open-popup" data-popup-id="form"><?php echo esc_html__('Отримати консультацію', 'web'); ?></a>
                <span class="tg-modal__or"><?php echo esc_html__('Якщо писати не зручно', 'web'); ?></span>
                <a href="tel:+380672870044" class="btn btn--gold btn--block">
                    <?php echo get_svg_icon('phone'); ?>
                    <span><?php echo esc_html__('Зателефонувати', 'web'); ?></span>
                </a>
            </div>
        </div>
    </div>

    <!-- Service side panel -->
    <div class="popup popup-right popup-service" id="service-panel">
        <span class="close-popup"><?php echo get_svg_icon('closepopup'); ?></span>
        <div class="popup-content service-panel">
            <span class="service-panel__icon"><?php echo get_svg_icon('svc-mil'); ?></span>
            <h2 class="service-panel__title"><?php echo esc_html__('Військовий адвокат: Мобілізація та ВЛК', 'web'); ?></h2>
            <p class="service-panel__lead">
                <?php echo esc_html__('Сьогодні питання військового права є найбільш актуальними. Як адвокат (консультація Київ), я надаю повний спектр послуг щодо взаємодії з ТЦК та СП:', 'web'); ?>
            </p>
            <ul class="service-panel__list">
                <li><?php echo esc_html__('Супровід процедури мобілізації та перевірка підстав для відстрочки.', 'web'); ?></li>
                <li><?php echo esc_html__('Отримання відстрочки від мобілізації.', 'web'); ?></li>
                <li><?php echo esc_html__('Оскарження рішень ВЛК (військово-лікарської комісії) та мобілізації у судовому та адміністративному порядку.', 'web'); ?></li>
                <li><?php echo esc_html__('Захист у випадках незаконного затримання або примусового доставлення до ТЦК.', 'web'); ?></li>
                <li><?php echo esc_html__('Консультації щодо бронювання працівників та виїзду за кордон.', 'web'); ?></li>
                <li><?php echo esc_html__('Демобілізація / звільнення зі служби.', 'web'); ?></li>
                <li><?php echo esc_html__("Виплати військовим (виплати при звільненні, виплати сім'ям загиблих).", 'web'); ?></li>
            </ul>
            <p class="service-panel__outro">
                <?php echo esc_html__("Ми знаємо всі тонкощі оновленого законодавства та забезпечуємо захист конституційних прав військовозобов'язаних.", 'web'); ?>
            </p>
            <a href="#" class="btn btn--gold btn--block open-popup" data-popup-id="telegram">
                <?php echo esc_html__('Отримати захист', 'web'); ?>
                <?php echo get_svg_icon('arrow-right'); ?>
            </a>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="popup popup-top" id="mob-menu">
        <span class="close-popup"><?php echo get_svg_icon('closepopup'); ?></span>
        <div class="popup-content mob-content">
            <div class="mob-menu-logo">
                <?php the_custom_logo(); ?>
            </div>
            <nav class="mob-nav" id="mob-nav">
                <ul class="mob-menu-list">
                    <li><a href="#services"><?php echo esc_html__('Послуги', 'web'); ?></a></li>
                    <li><a href="#about"><?php echo esc_html__('Про нас', 'web'); ?></a></li>
                    <li><a href="#blog"><?php echo esc_html__('Блог', 'web'); ?></a></li>
                    <li><a href="#cases"><?php echo esc_html__('Виграні справи', 'web'); ?></a></li>
                    <li><a href="#prices"><?php echo esc_html__('Ціни', 'web'); ?></a></li>
                </ul>
                <a href="tel:+380672870044" class="mob-phone">
                    <?php echo get_svg_icon('phone'); ?>
                    <span><?php echo esc_html__('(067) 287-00-44', 'web'); ?></span>
                </a>
                <a href="#" class="btn btn--gold btn--block open-popup" data-popup-id="telegram"><?php echo esc_html__('Отримати консультацію', 'web'); ?></a>
            </nav>
        </div>
    </div>

    <!-- Thank you -->
    <div class="popup popup-center" id="thankyouPopup">
        <span class="close-popup"><?php echo get_svg_icon('closepopup'); ?></span>
        <div class="popup-content thank">
            <h2><?php echo esc_html__('Дякуємо за вашу заявку', 'web'); ?></h2>
            <p><?php echo esc_html__('Наш менеджер зконтактує з вами найближчим часом', 'web'); ?></p>
            <a href="/" class="btn btn--gold pop-bnt"><?php echo esc_html__('На головну', 'web'); ?></a>
        </div>
    </div>

</div>

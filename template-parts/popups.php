<div id="popup-overlay" class="popup-overlay">

    <div class="popup popup-center" id="form">
        <span class="close-popup"><?php echo get_svg_icon('closepopup'); ?></span>
        <div class="popup-content">
            <?php echo do_shortcode('[contact-form-7 id="fb7ab4f" title="Contact form 1"]'); ?>
        </div>
    </div>

    <div class="popup popup-top" id="mob-menu">
        <span class="close-popup"><?php echo get_svg_icon('closepopup'); ?></span>
        <div class="popup-content mob-content">
            <div class="mob-menu-logo">
                <?php the_custom_logo(); ?>
            </div>
            <nav class="mon-nav" id="mob-nav">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'mob-menu',
                        'menu_id'        => 'mob-menu',
                    )
                );
                ?>
            </nav>
        </div>
    </div>

    <div class="popup popup-center" id="thankyouPopup">
        <span class="close-popup"><?php echo get_svg_icon('closepopup'); ?></span>
        <div class="popup-content thank">
            <h2><?php echo __('Дякуємо за вашу заявку', 'web'); ?></h2>
            <p><?php echo __('Наш менеджер зконтактує з вами найближчим часом', 'web'); ?></p>
            <a href="/" class="slide-button pop-bnt"><?php echo __('На головну', 'web'); ?></a>
        </div>
    </div>

</div>
<?php
////// шеврон к меню //////
function add_menu_arrow($item_output, $item, $depth, $args)
{
    if (in_array('menu-item-has-children', $item->classes)) {
        $arrow = get_svg_icon('chevron');
        
        $item_output = str_replace('</a>', $arrow . '</a>', $item_output);
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'add_menu_arrow', 10, 4);

/////
// Функция для загрузки SVG-кодов
function load_svg_icons() {
    include get_template_directory() . '/inc/back/svg.php';
    return $svgs;
}

// Функция для вывода SVG-кода по имени
function get_svg_icon($name) {
    $svgs = load_svg_icons();
    if (isset($svgs[$name])) {
        return $svgs[$name];
    }
    return '';
}

// Шорткод для вывода SVG-кода
function svg_icon_shortcode($atts) {
    $atts = shortcode_atts(array('name' => ''), $atts, 'svg_icon');
    return get_svg_icon($atts['name']);
}
add_shortcode('svg_icon', 'svg_icon_shortcode');
////////////////
function web_customize_register( $wp_customize ) {
    // Добавляем настройку для выбора шрифта
    $wp_customize->add_setting( 'web_font_choice', array(
        'default'   => 'Montserrat',
        'transport' => 'refresh', // Обновляет страницу при выборе другого шрифта
    ));
    
    // Добавляем секцию для шрифтов
    $wp_customize->add_section( 'web_fonts_section' , array(
        'title'      => __( 'Fonts', 'web' ),
        'priority'   => 30,
    ));

    // Добавляем контрол для выбора шрифта
    $wp_customize->add_control( 'web_font_choice_control', array(
        'label'      => __( 'Choose a font', 'web' ),
        'section'    => 'web_fonts_section',
        'settings'   => 'web_font_choice',
        'type'       => 'select',
        'choices'    => array(
            'Montserrat' => 'Montserrat',
            'Roboto'     => 'Roboto',
            'Open Sans'  => 'Open Sans',
            'Lato'       => 'Lato',
            'Geologica'  => 'Geologica',
        ),
    ));
}
add_action( 'customize_register', 'web_customize_register' );
function web_custom_fonts() {
    $font_choice = get_theme_mod('web_font_choice', 'Montserrat');
    ?>
    <style>
        body {
            font-family: '<?php echo esc_html( $font_choice ); ?>', sans-serif;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'web_custom_fonts' );

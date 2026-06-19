<?php
/**
 * Blog posts index (the page set as "Сторінка записів" = Блог). Figma 525-6238.
 * Delegates to template-parts/archive-listing.php in "blog" mode.
 *
 * @package web
 */

get_header();
set_query_var( 'web_archive_mode', 'blog' );
get_template_part( 'template-parts/archive-listing' );
get_footer();

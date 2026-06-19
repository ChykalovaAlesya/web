<?php
/**
 * Archive for the "Виграні справи" category (won cases). Figma 525-5922.
 * Delegates to template-parts/archive-listing.php in "case" mode.
 *
 * @package web
 */

get_header();
set_query_var( 'web_archive_mode', 'case' );
get_template_part( 'template-parts/archive-listing' );
get_footer();

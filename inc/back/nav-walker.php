<?php
/**
 * Mega-menu nav walker for the primary menu.
 *
 * Renders the WordPress menu assigned to the `menu-1` location with the same
 * markup the header CSS expects:
 *   depth 0 — top-level item; if it has children it becomes the «Послуги»
 *             mega-toggle and its submenu is wrapped in `.mega-menu`.
 *   depth 1 — a category column (`.mega-col` + `.mega-col__title`).
 *   depth 2 — a link inside a column list (`.mega-col__list li a`).
 *
 * Manage it in wp-admin → Appearance → Menus (3-level structure). Falls back to
 * the hard-coded markup in header.php when no menu is assigned.
 *
 * @package web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Web_Mega_Walker extends Walker_Nav_Menu {

	/** Open a sub-level: depth 0 → mega wrapper, depth 1 → column list. */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( 0 === $depth ) {
			$output .= '<div class="mega-menu"><div class="container mega-menu__inner">';
		} else {
			$output .= '<ul class="mega-col__list">';
		}
	}

	/** Close a sub-level. */
	public function end_lvl( &$output, $depth = 0, $args = null ) {
		if ( 0 === $depth ) {
			$output .= '</div></div>';
		} else {
			$output .= '</ul>';
		}
	}

	/** Render one element. */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes      = empty( $item->classes ) ? array() : (array) $item->classes;
		$has_children = in_array( 'menu-item-has-children', $classes, true );
		$url          = ! empty( $item->url ) ? $item->url : '#';
		$title        = apply_filters( 'the_title', $item->title, $item->ID );

		if ( 0 === $depth ) {
			$li_class = 'menu-item';
			if ( $has_children ) {
				$li_class .= ' menu-item-has-children has-mega';
			}
			$output .= '<li class="' . esc_attr( $li_class ) . '">';
			$a_class = $has_children ? 'mega-toggle' : '';
			$output .= '<a href="' . esc_url( $url ) . '"' . ( $a_class ? ' class="' . esc_attr( $a_class ) . '"' : '' ) . '>';
			$output .= esc_html( $title );
			if ( $has_children ) {
				$output .= get_svg_icon( 'chevron' );
			}
			$output .= '</a>';
		} elseif ( 1 === $depth ) {
			// Category column. Title is a link when the category item has its own URL.
			$output .= '<div class="mega-col">';
			$heading = esc_html( $title );
			if ( $url && '#' !== $url ) {
				$heading = '<a href="' . esc_url( $url ) . '">' . esc_html( $title ) . '</a>';
			}
			$output .= '<h4 class="mega-col__title">' . $heading . '</h4>';
		} else {
			// Leaf link inside a column.
			$output .= '<li><a href="' . esc_url( $url ) . '">' . esc_html( $title ) . '</a></li>';
		}
	}

	/** Close one element (leaf links close themselves in start_el). */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		if ( 0 === $depth ) {
			$output .= '</li>';
		} elseif ( 1 === $depth ) {
			$output .= '</div>';
		}
	}
}

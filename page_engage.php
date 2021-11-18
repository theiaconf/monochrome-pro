<?php
/**
 * Monochrome Pro.
 *
 * Template Name: Engage
 *
 * This file supports design elements linked to this template.
 *
 * @package Monochrome
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/monochrome/
 */

add_action( 'genesis_before_entry_content', 'theme_prefix_show_notice' );
/**
 * Display a custom notice.
 */
function theme_prefix_show_notice() {
	echo '<p class="notice">This page has a custom template.</p>';
}

// Run the Genesis loop.
genesis();
<?php
/**
 * Monochrome Pro.
 *
 * Template Name: IAC24 (Yellow)
 *
 * This file supports design elements linked to this template.
 *
 * @package Monochrome
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/monochrome/
 */

add_action( 'genesis_after_header', 'theme_prefix_show_notice' );
function theme_prefix_show_notice() {
	echo '
		
		<div class="masthead-banner">
			<div class="text-block">
				<span class="banner-site-title">${title</span>
			</div>
		</div>
		
		';
}

// Run the Genesis loop.
genesis();

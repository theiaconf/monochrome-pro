<?php
/**
 * Monochrome Pro.
 *
 * Template Name: Register
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
				<span class="banner-site-title">IAC 22</span>
				<span class="banner-site-subtitle"><strong>[Re]</strong>Connect</span>
				<span class="banner-section-title"></span>
			</div>
		</div>
		
		';
}

// Run the Genesis loop.
genesis();
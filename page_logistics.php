<?php
/**
 * Monochrome Pro.
 *
 * Template Name: Logistics
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
		
		<div class="masthead-banner logistics">
			<div class="section-title">Logistics</div>
		</div>
		
		';
}
remove_action('genesis_entry_header', 'genesis_do_post_title');

// Run the Genesis loop.
genesis();
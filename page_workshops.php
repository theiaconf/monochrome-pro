<?php
/**
 * Monochrome Pro.
 *
 * Template Name: Workshops
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
		
		<div class="masthead-banner workshops">
		  <div class="text-block">
			<div class="section-title">Workshops</div>
		  </div>
		  <div class="cta-ticker">
		    <a href="/register">Register &gt;</a>
		  </div>
		</div>	
		';
}

function custom_body_classes($classes) {
  $classes[] = 'workshops';
  return $classes;
}

add_action('body_class', 'custom_body_classes');
remove_action('genesis_entry_header', 'genesis_do_post_title');

// Run the Genesis loop.
genesis();
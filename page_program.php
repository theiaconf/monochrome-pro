<?php
/**
 * Monochrome Pro.
 *
 * Template Name: Program
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

add_action('get_header', 'remove_page_titles');
/**
 * Selectively remove page titles only for the main program schedule using the
 * slugs 
 */
function remove_page_titles() {
  if (is_page('monday') || 
      is_page('tuesday') ||
      is_page('wednesday') ||
      is_page('thursday') ||
      is_page('friday') ||
      is_page('saturday')) {
    remove_action('genesis_entry_header', 'genesis_do_post_title');
  }
}

// Run the Genesis loop.
genesis();
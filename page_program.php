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
 * slugs. Should be removed after IAC22 if still using Wordpress.
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

/**
 * Add Program entry to navigation even though these pages really nest directly
 * underneath the Thursday schedule page. Clean up after IAC22
 */
add_filter('genesis_build_crumbs', 'iac_add_program_crumb', 10, 2);
function iac_add_program_crumb($crumbs, $args) {
  /**
   * Alter these two values to alter the resulting output
   */
  $base_slug = 'thursday';
  $title = "Program";
  // Need the page ID directly. Brittle so please take down after IAC22
  $page_id = 16884;
  
  $uri = get_permalink($page_id);
  
  $home_crumb = array_shift($crumbs);
  $program_crumb = '<a href="' . $uri . '">' . $title . '</a>' . $args['sep'];
  
  array_unshift($crumbs, $program_crumb);
  array_unshift($crumbs, $home_crumb);
  
  return $crumbs;
}

// Run the Genesis loop.
genesis();
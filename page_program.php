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
 * If there is a second record in the breadcrumbs replace it with a link called
 * "Program" that links to the Thursday (first day of main conference) for all
 * pages using the Program template. Retains the current page at the end of the
 * trail
 */
add_filter('genesis_build_crumbs', 'iac_update_breadcrumbs');
function iac_update_breadcrumbs($crumb, $args) {
    /**
    $uri = "https;//www.theiaconference.com/stage/thursday";
    $label = "Program";
    
    $crumb = "<a href=\"{$uri}\">{$label}</a>";
    return $crumb;
    */
    $crumbs[0] = "Breadcrumb 1";
    $crumbs[1] = "Breadcrumb 2";
    
    return $crumbs;
  } 
}

// Run the Genesis loop.
genesis();
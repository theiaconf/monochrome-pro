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
	echo '
		
		<div class="front-page-1 image-section">
			<div class="flexible-widgets widget-area fadeup-effect widget-full fadeInUp">
				<div class="wrap">
					<section id="textblockswidget-14" class="widget widget_textblockswidget">
						<div class="widget-wrap">
							<div class="text-block hometown-hero">
								<p>Join us online for<br>
								IAC: the information architecture conference</p>
								<h2 class="hero-title hero-theme">[Re]Connect</h2>
								<p>April 19th-23rd, 2022</p>
								<div class="secondary_cta">
									Registration opens in December
								</div>
							</div>
						</div>
					</section>
		        </div>
			</div>
		</div>
		
		';
}

// Run the Genesis loop.
genesis();
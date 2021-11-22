<?php
/**
 * Monochrome Pro.
 *
 * This file adds functions to the Monochrome Pro Theme.
 *
 * @package Monochrome
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/monochrome/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'monochrome_localization_setup' );
function monochrome_localization_setup(){

	load_child_theme_textdomain( 'monochrome-pro', get_stylesheet_directory() . '/languages' );

}

// Add the theme helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
// include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Include the Customizer CSS for the WooCommerce plugin.
// include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Include notice to install Genesis Connect for WooCommerce.
// include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Monochrome Pro' );
define( 'CHILD_THEME_URL', 'https://github.com/theiaconf/monochrome-pro' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

// Remove default Genesis Child Theme Stylesheet
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );

// Enqueue scripts and styles.
add_action( 'wp_enqueue_scripts', 'monochrome_enqueue_scripts_styles' );
function monochrome_enqueue_scripts_styles() {
// Add Anton font instead of Open Sans

	wp_enqueue_style( 'monochrome-ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), CHILD_THEME_VERSION );

	wp_enqueue_script( 'monochrome-global-script', get_stylesheet_directory_uri() . '/js/global.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'no-js-script', get_stylesheet_directory_uri() . '/js/no-js.js', array( 'jquery' ), '1.0.0', true );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'monochrome-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script( 'monochrome-responsive-menu', 'genesis_responsive_menu', monochrome_responsive_menu_settings() );

     $theme_name = defined('CHILD_THEME_NAME') && CHILD_THEME_NAME ? sanitize_title_with_dashes(CHILD_THEME_NAME) : 'child-theme';
     //$version = defined( 'CHILD_THEME_VERSION' ) && CHILD_THEME_VERSION ? CHILD_THEME_VERSION : PARENT_THEME_VERSION;
     $version = date ( "njYHi", filemtime( get_stylesheet_directory() . '/style.css' ) );
     wp_enqueue_style( $theme_name, get_stylesheet_uri(), array(), $version );
}


// Define our responsive menu settings.
function monochrome_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( 'Menu', 'monochrome-pro' ),
		'menuIconClass'    => 'ionicons-before ion-navicon',
		'subMenu'          => __( 'Submenu', 'monochrome-pro' ),
		'subMenuIconClass' => 'ionicons-before ion-chevron-down',
		'menuClasses'      => array(
			'combine' => array( ),
			'others'  => array(
				'.nav-primary',
			),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 320,
	'height'          => 120,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
	'flex-width'     => true,
) );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Remove after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );

// Add after entry widget to posts and pages
add_action( 'genesis_after_entry', 'custom_after_entry', 9 );
function custom_after_entry() {

   if ( ! is_singular( array( 'post', 'page','talk' )) )
        return;

        genesis_widget_area( 'after-entry', array(
            'before' => '<div class="after-entry widget-area">',
            'after'  => '</div>',
        ) );

}


// Add image sizes.
add_image_size( 'front-blog', 960, 540, TRUE );
add_image_size( 'sidebar-thumbnail', 80, 80, TRUE );

// Remove header right widget area.
unregister_sidebar( 'header-right' );

// Remove secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Remove site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Remove output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

// Remove navigation meta box.
// add_action( 'genesis_theme_settings_metaboxes', 'monochrome_remove_genesis_metaboxes' );
// function monochrome_remove_genesis_metaboxes( $_genesis_theme_settings_pagehook ) {

// 	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );

// }

// Register navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Header Menu', 'monochrome-pro' ) ) );

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Reposition secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_after', 'genesis_do_subnav', 12 );

// Add the search icon to the header if the option is set in the Customizer.
add_action( 'genesis_meta', 'monochrome_add_search_icon' );
function monochrome_add_search_icon() {

	$show_icon = get_theme_mod( 'monochrome_header_search', monochrome_customizer_get_default_search_setting() );

	// Exit early if option set to false.
	if ( ! $show_icon ) {
		return;
	}

	add_action( 'genesis_header', 'monochrome_do_header_search_form', 14 );
	add_filter( 'genesis_nav_items', 'monochrome_add_search_menu_item', 10, 2 );
	add_filter( 'wp_nav_menu_items', 'monochrome_add_search_menu_item', 10, 2 );

}

// Function to modify the menu item output of the Header Menu.
function monochrome_add_search_menu_item( $items, $args ) {

	$search_toggle = sprintf( '<li class="menu-item">%s</li>', monochrome_get_header_search_toggle() );

	if ( 'primary' === $args->theme_location ) {
		$items .= $search_toggle;
	}

	return $items;

}

// Reduce secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'monochrome_secondary_menu_args' );
function monochrome_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify Gravatar size in author box.
add_filter( 'genesis_author_box_gravatar_size', 'monochrome_author_box_gravatar' );
function monochrome_author_box_gravatar( $size ) {

	return 90;

}

// Customize entry meta in entry header.
// remove_action( 'genesis_before_post_content', 'genesis_post_info' );
// remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
// add_filter( 'genesis_post_info', 'monochrome_entry_meta_header' );
// function monochrome_entry_meta_header( $post_info ) {

// 	$post_info = '[post_date format="M j, Y"] &middot; [post_comments] [post_edit]';

// 	return $post_info;

// }

// Customize entry meta in entry footer.
// add_filter( 'genesis_post_meta', 'monochrome_entry_meta_footer' );
// function monochrome_entry_meta_footer( $post_meta ) {

// 	$post_meta = 'IASummit [post_categories before=""], subject [post_tags before=""]';

// 	return $post_meta;

// }

// Modify Gravatar size in entry comments.
add_filter( 'genesis_comment_list_args', 'monochrome_comments_gravatar' );
function monochrome_comments_gravatar( $args ) {

	$args['avatar_size'] = 48;

	return $args;

}

// Setup widget counts.
function monochrome_count_widgets( $id ) {

	$sidebars_widgets = wp_get_sidebars_widgets();

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

// Calculate widget count.
function monochrome_widget_area_class( $id ) {

	$count = monochrome_count_widgets( $id );

	$class = '';

	if ( $count == 1 ) {
		$class .= ' widget-full';
	} elseif ( $count % 3 == 1 ) {
		$class .= ' widget-thirds';
	} elseif ( $count % 4 == 1 ) {
		$class .= ' widget-fourths';
	} elseif ( $count % 2 == 0 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;

}


// Customize content limit read more link markup.
add_filter( 'get_the_content_limit', 'monochrome_content_limit_read_more_markup', 10, 3 );
function monochrome_content_limit_read_more_markup( $output, $content, $link ) {

	$output = sprintf( '<p>%s &#x02026;</p><p class="more-link-wrap">%s</p>', $content, str_replace( '&#x02026;', '', $link ) );

	return $output;
}

// Remove entry meta in entry footer.
// remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
// remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
// remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

// Hook before footer CTA widget area.
add_action( 'genesis_before_footer', 'monochrome_before_footer_cta' );
function monochrome_before_footer_cta() {

	genesis_widget_area( 'before-footer-cta', array(
		'before' => '<div class="before-footer-cta"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

// Add Footer widgets
genesis_register_sidebar(array(
	'id' => 'footer-left',
    'name'=>'Footer Left',
    'description' => 'This is the first column of the footer section.',
    // 'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'id' => 'footer-right',
    'name'=>'Footer Right',
    'description' => 'This is the second column of the footer section.',
    // 'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));


// Remove site footer.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Add site footer after page, customize.
add_action( 'genesis_after', 'genesis_footer_markup_open', 5 );
add_action( 'genesis_after', 'do_custom_footer' );
add_action( 'genesis_after', 'genesis_footer_markup_close', 15 );

function do_custom_footer() { ?>
	<div id="footer-widgetized">
	    <div class="wrap">
	        <div class="footer-col1">
	            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Left') ) : ?>
	                <h4><?php _e("Footer Left Widget", 'genesis'); ?></h4>
	                <p><?php _e("This is an example of a widgeted area. You can add content to this area by visiting your Widgets Panel and adding new widgets to this area.", 'genesis'); ?></p>
	            <?php endif; ?>
	        </div><!-- end .footer-col1 -->
	        <div class="footer-col2">
	            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Right') ) : ?>
	                <h4><?php _e("Footer Right Widget", 'genesis'); ?></h4>
	                <p><?php _e("This is an example of a widgeted area. You can add content to this area by visiting your Widgets Panel and adding new widgets to this area.", 'genesis'); ?></p>
	            <?php endif; ?>
	        </div><!-- end .footer-col2 -->

	    </div><!-- end .wrap -->
	</div><!-- end #footer-widgetized -->
	<?
}


// Remove "You are Here" from breadcrumbs
add_filter('genesis_breadcrumb_args', 'change_breadcrumbs_text');
function change_breadcrumbs_text( $args ) {
    $args['labels']['prefix'] = '';
    return $args;
}



// Register widget areas.

genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page 1', 'monochrome-pro' ),
	'description' => __( 'This is the front page 1 image section.', 'monochrome-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'monochrome-pro' ),
	'description' => __( 'This is the front page 2 email sign-up section.', 'monochrome-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'monochrome-pro' ),
	'description' => __( 'This is the front page 3 countdown image section.', 'monochrome-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-4',
	'name'        => __( 'Front Page 4', 'monochrome-pro' ),
	'description' => __( 'This is the front page 4 section.', 'monochrome-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'front-page-5',
	'name'        => __( 'Front Page 5', 'monochrome-pro' ),
	'description' => __( 'This is the front page 5 image section.', 'monochrome-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'front-page-6',
	'name'        => __( 'Front Page 6', 'monochrome-pro' ),
	'description' => __( 'This is the front page 6 sponsor section.', 'monochrome-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'front-page-7',
	'name'        => __( 'Front Page 7', 'monochrome-pro' ),
	'description' => __( 'This is the front page 7 last-call CTA section.', 'monochrome-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'before-footer-cta',
	'name'        => __( 'Before-Footer CTA', 'monochrome-pro' ),
	'description' => __( 'This is the call-to-ation area placed before the footer.', 'monochrome-pro' ),
) );


/****************
*****************
Copy the following functions into any new functions.php if you change the theme!
*****************
*****************

/* Adds 'no-js' class to HTML to help detect Javascript */
remove_action( 'genesis_doctype', 'genesis_do_doctype' );
add_action( 'genesis_doctype', 'genesis_do_js_doctype' );

/**
 * Echo the doctype and opening markup.
 *
 * If you are going to replace the doctype with a custom one, you must remember to include the opening <html> and
 * <head> elements too, along with the proper attributes.
 *
 * It would be beneficial to also include the <meta> tag for content type.
 *
 * The default doctype is XHTML v1.0 Transitional, unless HTML support os present in the child theme.
 *
 * @since 1.3.0
 */
function genesis_do_js_doctype() {

	if ( genesis_html5() ) {
		genesis_html5_js_doctype();
	} else {
		genesis_xhtml_js_doctype();
	}

}

/**
 * XHTML 1.0 Transitional doctype markup.
 *
 * @since 2.0.0
 */
function genesis_xhtml_js_doctype() {

	?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?> class="no-js">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<?php

}

/**
 * HTML5 doctype markup.
 *
 * @since 2.0.0
 */
function genesis_html5_js_doctype() {

	?><!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?> class="no-js">
<head <?php echo genesis_attr( 'head' ); ?>>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php

}

// Added by Kunverj for registration form
	add_filter("gform_field_value_datestamp", "populate_datestamp");
	function populate_datestamp( $value ){
		$defaultTimeZone='America/New_York';
		//$defaultTimeZone='Pacific/Honolulu';
		$oldtz=date_default_timezone_get();
		date_default_timezone_set($defaultTimeZone);
		$date = date('Ymd');
		date_default_timezone_set($oldtz);
		return $date;
	}
	add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
	add_action('wp_footer', 'gform_price_label');
    	function gform_price_label() {
    	   ?>
    	   <script type="text/javascript">
        function gform_format_option_label(fullLabel, fieldLabel, priceLabel, selectedPrice, price, formId, fieldId) {
            if ( price == 0 )
               priceLabel = " <span class='ginput_price'>" + ' ' + '</span>';
            else
               priceLabel = " <span class='ginput_price'>" + gformFormatMoney(price) + '</span>';
             return fieldLabel + priceLabel;
          }
        </script>
        <?php
       }
/* REE
	add_action( 'gform_entry_detail_content_before', function ( $form, $entry ) {
    	$use_choice_text = false;
    	$use_admin_label = false;
    	gform_delete_meta( $entry['id'], "gform_product_info_{$use_choice_text}_{$use_admin_label}" );
        gform_delete_meta( $entry['id'], 'gform_product_info_1_1' );
        gform_delete_meta( $entry['id'], 'gform_product_info__1' );
        gform_delete_meta( $entry['id'], 'gform_product_info_1_' );
        gform_delete_meta( $entry['id'], 'gform_product_info__' );
	}, 10, 2 );
END REE */
	add_filter( 'gform_product_info', 'kunverj_option_price', 10, 3 );
	function kunverj_option_price( $product_info, $form, $entry ) {
		$currency_code = $form['currency'];
	    $currency = new RGCurrency( GFCommon::get_currency($currency_code) );

		foreach( $product_info['products'] as $key => &$product ) {
			if ( $product['name'] == 'None' || $product['name'] == 'NONE'){
				unset($product_info['products'][$key]);
				continue;
			}
			if ( is_array($product['options']) ) {
				foreach( $product['options'] as $key2 => &$option ) {
					$field = GFFormsModel::get_field( $form, $key );
					$value = explode( '|', $entry[$field['id']] );
					$value = GFFormsModel::get_choice_text( $field, $value[0] );
					$value = $field->description;
					$fprice = $currency->to_money( $option['price'] );
					if ($option['field_label'] == '') {
						$value = $option['option_name'] . ' ( ' . $fprice . ' )';
					} else {
						$value = $option['field_label'] . ' - '. $option['option_name'] . ' ( ' . $fprice . ' )';
					}
					$option['option_label'] = $value;
				}
			}
		}

		return $product_info;
	}
	add_action( 'gform_validation_5', 'gform_ia' );
	add_action( 'gform_validation_8', 'gform_ia' );
	function gform_ia( $validation_result ) {

      $is_valid = true;
      $last = '';
      $first = '';

      $form = $validation_result['form'];

      foreach( $form['fields'] as &$field ) {
         if( $field->id == '16' ) {
            $fieldValue = rgpost('input_' .$field->id);
            if( strpos($fieldValue, '@fatdux.com') !== false ) {
            $field->failed_validation = true;
            $field->validation_message = "IAC cannot issue a ticket to you at this time!";
            $is_valid = false;
            }
         }
 		 if( $field->id == '12' ) {
            $first = rgpost('input_' .$field->id);
         }
 		 if( $field->id == '13' ) {
            $last = rgpost('input_' .$field->id);
            if( strcasecmp($last, 'reiss') == 0 && strcasecmp($first, 'eric') == 0 ) {
            $field->failed_validation = true;
            $field->validation_message = "IAC cannot issue a ticket to you at this time!";
            $is_valid = false;
            }
         }
 		 if( $field->id == '20' ) {
            $field->failed_validation = true;
            $field->validation_message = "You did not make any selections. IAC cannot issue a ticket to you at this time!";
            $total = rgpost('input_' .$field->id);
         }
 		 if( $field->id == '42' ) {
            $discount = rgpost('input_' .$field->id);
         }
	  }

	  if ($total == 0 && $discount == '') {
            $is_valid = false;
	  }
      if( !$is_valid ) {
         $validation_result['is_valid'] = false;
         $validation_result['form'] = $form;
      }

      return $validation_result;

   }
// Remove add user if email is already there
	add_filter( 'gform_user_registration_check_email_pre_signup_activation', '__return_false' );
	add_action("gform_user_registration_validation", "ignore_already_registered_error", 10, 3);
	function ignore_already_registered_error($form, $config, $pagenum){
 
		// Make sure we only run this code on the specified form ID
		if($form['id'] != 16) {
			return $form;
		}
 
		// Get the ID of the email field from the User Registration config
		$email_id = $config['meta']['email'];
 
		// Loop through the current form fields
		foreach($form['fields'] as &$field) {
 
		// confirm that we are on the current field ID and that it has failed validation because the email already exists
		if($field->id == $email_id && $field->validation_message == 'This email address is already registered')
			$field->failed_validation = false;
		}
 
		return $form;
 
	}
	add_filter( 'gform_disable_registration_16', 'disable_registration', 5, 3 );
	function disable_registration( $is_disabled, $form, $entry ) {
		$email = rgar($entry, '16');
		$user = get_user_by( 'email', $email );
		if ( ! empty( $user ) ) {
			return true; // disable user add
		}
	}
// Create meetings database record
		add_action( 'gform_after_submission', 'save_meeting_reg_gform' , 10, 2 );
		function save_meeting_reg_gform($entry, $form) {
			//$payment = rgar($entry, 'payment_status');
            $formid = rgar($entry, 'form_id');
			if ( $formid  == '16' || $formid == '8' ) {
                save_meeting_reg_ia($entry, $form);
				return;
			}
			return;
		}
	function save_meeting_reg_ia($entry, $form) {
		$payment = rgar($entry, 'payment_status');
		$fields = array();
		$function_ids = array();
		foreach( $form['fields'] as $field ) {
			$fields[$field['id']] =  $field['type'];
		}
		foreach( $entry as $key => $value) {
			if (  $fields[(int)$key] == 'product' || $fields[(int)$key] == 'option' )
				$function_ids[] = $key;
		}
		$functions = '';
		$funcs = array();
		foreach ( $function_ids as $function ) {
			if (isset($entry[$function]) && $entry[$function] != '') {
				$pos = strpos($entry[$function],"|");
				if ($pos > '0') {
					$functions .= substr($entry[$function],0,$pos) . ',';
					if ( substr($entry[$function],0,$pos) != 'None' )
						$funcs[] = substr($entry[$function],0,$pos);
				} else {
					$functions .= $entry[$function] . ',';
					if ( $entry[$function] != 'None' )
						$funcs[] = $entry[$function];
				}
			}
		}
  
			//global $wpdb;
			// add form data to meetings database table
		$wpdb_kunverj = new wpdb('kunverj', 'isscei60', 'i4033072_wp1', 'db.kunverj.com');
		$wpdb_kunverj->show_errors();
		$wpdb_kunverj->insert( 'meeting_registration',
			array(
				'meeting' => 'IAC21',
				'regdate' => $entry['40'],
				'mbrid' => '',
				'mbrof' => '',
				'firstname' => $entry['12'],
				'lastname' => $entry['13'],
				'title' => '',
				'org' => $entry['5'],
				'address1' => $entry['41.1'],
				'address2' => $entry['41.2'],
				'city' => $entry['41.3'],
				'state' => $entry['41.4'],
				'zip' => $entry['41.5'],
				'country' => $entry['41.6'],
				'email' => $entry['16'],
				'phone' => $entry['15'],
				'nickname' => '',
				'badgename' => $entry['12'] . ' ' . $entry['13'],
				'badgeorg' => $entry['5'],
				'badgelocation' => $entry['6'],
				'badgecountry' => $entry['7'],
				'survey_q1' => $entry['8'],
				'survey_q2' => '',
				'survey_q3' => '',
				'survey_q4' => '',
				'survey_q5' => $entry['14'],
				'firsttime' => '',
				'diet' => '',
				'comments' => $entry['25'],
				'functions' => $functions,
				'order_id' => $entry['id'],
				'is_processed' => '0'
			)
		);
		if($wpdb_kunverj->last_error !== '') {
			$str   = htmlspecialchars( $wpdb_kunverj->last_result, ENT_QUOTES );
			$query = htmlspecialchars( $wpdb_kunverj->last_query, ENT_QUOTES );
			print "<div id='error'>
			<p class='wpdberror'><strong>WordPress database error:</strong> [$str]<br />
			<code>$query</code></p>
			</div>";
		}
/* REE _ skip for now
		if (!is_dir('files'))
			wp_mkdir_p('files');
		$file = 'files/IAC20';
		$edate = substr($entry['40'],4,2) . "/" . substr($entry['40'],6,2) . "/" . substr($entry['40'],0,4);
		$reg = $edate . "\t" . $entry['57'] . "\t\t";
		$reg .= $entry['12'] . "\t" . $entry['13'] . "\t";
		$reg .= $entry['4'] . "\t" . $entry['5'] . "\t";
		$reg .= $entry['41.1'] . "\t" . $entry['41.2'] . "\t";
		$reg .= $entry['41.3'] . "\t" . $entry['41.4'] . "\t";
		$reg .= $entry['41.5'] . "\t" . $entry['41.6'] . "\t\t";
		$reg .= $entry['15'] . "\t" . "\t";
		$reg .= $entry['16'] . "\t" . $entry['3'] . "\t";
		$reg .= $entry['12'] . ' ' . $entry['13'] . "\t" . $entry['5'] . "\t";
		$reg .= $entry['6'] . "\t" . $entry['7'] . "\t";
		$reg .= $entry['8'] . "\t\t\t\t" . $entry['14'] . "\t" . $entry['81'] . "\t";
		$funcs[] = ' ';
		$funcs[] = ' ';
		$funcs[] = ' ';
		$funcs[] = ' ';
		$funcs[] = ' ';
		$reg .= $funcs['0'] . "\t" . $funcs['1'] . "\t";
		$reg .= $funcs['2'] . "\t" . $funcs['3'] . "\t";
		$reg .= $funcs['4'] . "\t\n";
		file_put_contents($file, $reg, FILE_APPEND);
 END REE */
		return;
	}


// add filter to allow Pods to have excerpts

function my_excerpt_filter ( $content ) {
   return wp_trim_words( $content, 70 );
}
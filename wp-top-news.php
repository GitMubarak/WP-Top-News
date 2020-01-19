<?php
/**
 * Plugin Name: 	WP Top News
 * Plugin URI:		http://wordpress.org/plugins/wp-top-news/
 * Description: 	This Worldwide Breaking News Headlines plugin will display the world famous newspaper's top/recent news/headlines in your Post/Page by using the shortcode: [wp_top_news]
 * Version: 		1.3
 * Author: 			Hossni Mubarak
 * Author URI: 		http://www.hossnimubarak.com
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
*/

if ( ! defined('ABSPATH') ) { exit; }

define( 'WTN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WTN_ASSETS', plugins_url( '/assets/', __FILE__ ) );
define( 'WTN_LANG', plugins_url( '/languages/', __FILE__ ) );
define( 'WTN_SLUG', plugin_basename( __FILE__ ) );
define( 'WTN_PRFX', 'wtn_' );
define( 'WTN_CLS_PRFX', 'cls-top-news-' );
define( 'WTN_VRSN', '1.2' );
define( 'WTN_TXT_DMN', 'wp-top-news' );

require_once WTN_PATH . 'inc/' . WTN_CLS_PRFX . 'master.php';
$wtn = new WTN_Master();
$wtn->wtn_run();
register_deactivation_hook( __FILE__, array($wtn, WTN_PRFX . 'unregister_settings') );
?>
<?php
// if uninstall.php is not called by WordPress, die
if ( ! defined('WP_UNINSTALL_PLUGIN') ) {
    die;
}

global $wpdb;
$wtn_tbl            = $wpdb->prefix . 'options';
$wtn_search_string  = 'wtn_%';

$wtn_sql            = $wpdb->prepare("SELECT option_name FROM $wtn_tbl WHERE option_name LIKE %s", $wtn_search_string);
$wtn_options        = $wpdb->get_results( $wtn_sql, OBJECT );

if ( is_array( $wtn_options ) && count( $wtn_options ) ) {
    foreach ( $wtn_options as $option ) {
        delete_option( $option->option_name );
        delete_site_option( $option->option_name );
    }
}
?>
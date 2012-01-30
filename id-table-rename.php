<?php
/*
Plugin Name: IgnitionDeck Table Modify
URI: http://wpbike
Description: This plugin is a part of IgnitionDeck
Version: 1.0
Author: Virtuous Giant
Author URI:
License: Local
*/

register_activation_hook(__FILE__,'script_run');
global $jal_db_version;
$jal_db_version = "1.0";

function script_run () {
    global $jal_db_version;
	
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
	//dbDelta($sql);
	add_option("jal_db_version", $jal_db_version);
}


function init_plugin() {
	global $wpdb;
	$sql = "RENAME TABLE ".$wpdb->prefix."facebookapp_settings TO ".$wpdb->prefix."ign_facebookapp_settings;
			RENAME TABLE ".$wpdb->prefix."ignitiondeck_customers TO ".$wpdb->prefix."ign_customers;
			RENAME TABLE ".$wpdb->prefix."ignitiondeck_form TO ".$wpdb->prefix."ign_form;
			RENAME TABLE ".$wpdb->prefix."mailchimp_subscription TO ".$wpdb->prefix."ign_mailchimp_subscription;
			RENAME TABLE ".$wpdb->prefix."pay_info TO ".$wpdb->prefix."ign_pay_info;
			RENAME TABLE ".$wpdb->prefix."pay_settings TO ".$wpdb->prefix."ign_pay_settings;
			RENAME TABLE ".$wpdb->prefix."products TO ".$wpdb->prefix."ign_products;
			RENAME TABLE ".$wpdb->prefix."product_settings TO ".$wpdb->prefix."ign_product_settings;
			RENAME TABLE ".$wpdb->prefix."twitterapp_settings TO ".$wpdb->prefix."ign_twitterapp_settings;
			RENAME TABLE ".$wpdb->prefix."share_buttons TO ".$wpdb->prefix."ign_share_buttons;
			";
	$sqls = explode(";", $sql);
	for ($i=0 ; $i < count($sqls) ; $i++) {
		$wpdb->query($sqls[$i]);
	}
}
add_action( 'init', 'init_plugin' );
?>
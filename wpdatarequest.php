<?php
/*
* Plugin Name: WP Data Request
* Description: Adds a request ID to Contact Form 7 posts
*/


/*
* Use the only wpcf7 hook we could find, setting priority to 1
* so it executes before any other (eg: database-saving) plugins.
*/
add_action('wpcf7_before_send_mail', 'my_conversion', 1);

function my_conversion(&$cf7){
    global $wpdb;

    $tableName = $wpdb->prefix . 'cf7dbplugin_submits';
	$query = "SELECT MAX(`field_value`) FROM `$tableName` WHERE `field_name`='referencenumber'";
	$result = $wpdb->get_var($query);

	/* Insert snarky comment about race conditions here */
    $cf7->posted_data["referencenumber"] = $result + 1;

}

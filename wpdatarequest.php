<?php
/*
* Plugin Name: WP Data Request
* Description: Adds a request ID to Contact Form 7 posts
*/


/*
* Use the only wpcf7 hook we could find, setting priority to 1
* so it executes before any other (eg: database-saving) plugins.
*/
add_filter('wpcf7_posted_data', 'sw_add_referencenumber');
/* add_action('wpcf7_before_send_mail', 'sw_add_referencenumber', 1);
*/

function sw_add_referencenumber($posted_data){
    global $wpdb;

    $posted_data["drjtest"] = "hello";
    $tableName = $wpdb->prefix . 'cf7dbplugin_submits';
    $query = "SELECT MAX(`field_value`) FROM `$tableName` WHERE `field_name`='referencenumber'";
    $result = $wpdb->get_var($query);

    /* Insert snarky comment about race conditions here */
    $posted_data["referencenumber"] = $result + 1;

    return $posted_data;
}

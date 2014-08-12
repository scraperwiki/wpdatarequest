<?php
/*
* Plugin Name: WP Data Request
* Description: Adds a request ID to Contact Form 7 posts
*
* ScraperWiki Limited
*/


/*
* The wpcf7_posted_data filter let's us add a new field that can
* be used in the emails.
*
* Can't find documentation anywhere, but it's been in Contact
* Form 7 since 3.1 apparently
* (http://wordpress.org/support/topic/is-it-possible-to-alter-posted_data-with-39).
*/
add_filter('wpcf7_posted_data', 'sw_add_referencenumber');

function sw_add_referencenumber($posted_data){
    global $wpdb;

    $tableName = $wpdb->prefix . 'cf7dbplugin_submits';
    $query = "SELECT MAX(`field_value`) FROM `$tableName` WHERE `field_name`='referencenumber'";
    $result = $wpdb->get_var($query);

    /* Insert snarky comment about race conditions here */
    $posted_data["referencenumber"] = $result + 1;

    return $posted_data;
}

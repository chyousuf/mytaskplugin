<?php

/**
 * Trigger this file on Plugin uninstall
 *  @package MyTaskPlugin
 */

if (!defined('WP_UNINSTAL_PLUGIN')) {
    die;
}
// Delete From Db
global $wpdb;
$my_table_prefix = $wpdb->prefix;
$wpdb->query("Delete From '.$my_table_prefix.'posts where post_type ='books' ");
$wpdb->query("Delete From '.$my_table_prefix.'postmeta where  post_id NOT IN (Select id From '.$my_table_prefix.'posts) ");
$wpdb->query("Delete From '.$my_table_prefix.'term_relationships where  post_id NOT IN (Select id From '.$my_table_prefix.'posts) ");

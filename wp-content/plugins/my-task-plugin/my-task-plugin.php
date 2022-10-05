<?php

/**
 * @package MyTaskPlugin
 */
/**
 Plugin Name: My Task Plugin
 Plugin URI: 
 Description: This is Task Plugin
 Version: 1.0.0
 Author:Yousuf
 */

//Security Check
defined('ABSPATH') or die('Not Allow on this page');

if (file_exists(dirname(__FILE__)) . '/vendor/autoload.php') {
  require_once dirname(__FILE__) . '/vendor/autoload.php';
}
if (file_exists(dirname(__FILE__)) . '/inc/base/shortcode.php') {
  require_once dirname(__FILE__) . '/inc/base/shortcode.php';
}

function Activate_MyTask_plugin()
{
  inc\Base\Activate::activate();
}
function Deactivate_MyTask_plugin()
{
  inc\Base\Deactivate::deactivate();
}

//Activation
register_activation_hook(__FILE__, 'Activate_MyTask_plugin');

//Deactivation
register_deactivation_hook(__FILE__, 'Deactivate_MyTask_plugin');




if (class_exists('inc\\Init')) {
  inc\Init::register_services();
}

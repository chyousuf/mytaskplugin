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

define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN_NAME', plugin_basename(__FILE__));


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

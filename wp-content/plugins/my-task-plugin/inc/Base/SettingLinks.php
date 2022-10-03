<?php

/**
 * @package MyTaskPlugin
 */

namespace inc\Base;

class SettingLinks extends BaseController
{

    function __construct()
    {
    }

    public function register()
    {
        add_filter("plugin_action_links_$this->plugin", array($this, 'Setting_links'));
    }

    //setting_function
    function Setting_links($links)
    {
        $setting_links = '<a href="admin.php?page=MyTask_plugin">Settings</a>';
        array_push($links, $setting_links);
        return $links;
    }
}

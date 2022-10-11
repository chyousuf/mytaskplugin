<?php

/**
 * @package JJCustomProPlugin
 */

namespace inc\Base;

use \inc\Base\BaseController;

class SettingLinks extends BaseController
{

    function __construct()
    {
        var_dump($this->plugin);
    }

    public function register()
    {
        add_filter("plugin_action_links_" . $this->plugin, array($this, 'Setting_links'));
    }

    //setting_function
    function Setting_links($links)
    {
        $setting_links = '<a href="admin.php?page=jjcustom_plugin">Settings</a>';
        array_push($links, $setting_links);
        return $links;
    }
}

<?php

/**
 * @package JJCustomProPlugin
 */

namespace inc\Base;

use \inc\Base\BaseController;

class Enqueue extends BaseController
{

    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    //enqueue Secript
    function enqueue()
    {
        wp_enqueue_style('jjcustomstyle', $this->plugin_url . '/asset/css/style.css');
        wp_enqueue_script('jjcustomscript', $this->plugin_url . '/asset/js/jjcustom.js');
    }
}

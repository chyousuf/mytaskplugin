<?php

/**
 * @package JJCustomProPlugin
 */

namespace inc\Base;

class CustomPostType
{

    public function register()
    {
        add_action('init', array($this, 'custom_post_type'));
    }

    function custom_post_type()
    {
        register_post_type('Books', array('public' => true, 'label' => 'Books'));
    }
}

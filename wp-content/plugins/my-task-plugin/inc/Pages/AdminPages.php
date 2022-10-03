<?php

/**
 * @package MyTaskPlugin
 */

namespace inc\Pages;

use \inc\Api\SettingsApi;

use \inc\Base\BaseController;
use \inc\Api\Callbacks\AdminCallbacks;

class AdminPages extends BaseController
{

    public $settings;

    public $callbacks;

    public $pages = array();

    public $subpages = array();

    public function register()
    {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->setPages();

        $this->setSubpages();

        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }

    public function setPages()
    {
        $this->pages = array(
            array(
                'page_title' => 'MyTask Plugin',
                'menu_title' => 'MyTask',
                'capability' => 'manage_options',
                'menu_slug' => 'MyTask_plugin',
                'callback' => array($this->callbacks, 'adminDashboard'),
                'icon_url' => 'dashicons-store',
                'position' => 110
            )
        );
    }

    public function setSubpages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'MyTask_plugin',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'MyTask_cpt',
                'callback' => array($this->callbacks, 'adminCpt')
            ),
            array(
                'parent_slug' => 'MyTask_plugin',
                'page_title' => 'Plugin Activation',
                'menu_title' => 'Plugin Activation',
                'capability' => 'manage_options',
                'menu_slug' => 'MyTask_plugin_activation',
                'callback' => array($this->callbacks, 'adminTaxonomy')
            )
        );
    }
}

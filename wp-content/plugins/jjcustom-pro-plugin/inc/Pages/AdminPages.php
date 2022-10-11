<?php

/**
 * @package JJCustomProPlugin
 */

namespace inc\Pages;

use \inc\Api\SettingsApi;

class AdminPages
{
    public $settings;
    public $pages = array();
    public $subpages = array();

    function __construct()
    {

        $this->settings = new SettingsApi();
    }

    public function register()
    {

        $this->pages = [
            [
                'page_title' => 'JJcustom Plugin',
                'menu_title' => 'JJCUSTOM',
                'capability' => 'manage_options',
                'menu_slug' => 'jjcustom_plugin',
                'callback' => function () {
                    echo '<h1>JJCustom</h1>';
                },
                'icon_url' => 'dashicons-store',
                'position' => 110


            ]
        ];

        $this->subpages = array(
            array(
                'parent_slug' => 'jjcustom_plugin',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'jjcustom_cpt',
                'callback' => function () {
                    echo '<h1>CPT Manager</h1>';
                }
            ),
            array(
                'parent_slug' => 'jjcustom_plugin',
                'page_title' => 'Custom Taxonomies',
                'menu_title' => 'Taxonomies',
                'capability' => 'manage_options',
                'menu_slug' => 'jjcustom_taxonomies',
                'callback' => function () {
                    echo '<h1>Taxonomies Manager</h1>';
                }
            ),
            array(
                'parent_slug' => 'jjcustom_plugin',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Widgets',
                'capability' => 'manage_options',
                'menu_slug' => 'jjcustom_widgets',
                'callback' => function () {
                    echo '<h1>Widgets Manager</h1>';
                }
            )
        );

        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }
}

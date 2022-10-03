<?php

/**
 * @package MyTaskPlugin
 */

namespace inc\Api;


class SettingsApi
{
    public $admin_pages = array();

    public $admin_subpages = array();

    public function register()
    {
        if (!empty($this->admin_pages)) {
            add_action('admin_menu', array($this, 'addAdminMenu'));
        }

        if (!empty($this->settings)) {
            add_action('admin_init', array($this, 'registerCustomFields'));
        }
        add_action('admin_init', array($this, 'my_task_register_settings'));
    }

    public function addPages(array $pages)
    {
        $this->admin_pages = $pages;

        return $this;
    }

    public function withSubPage(string $title = null)
    {
        if (empty($this->admin_pages)) {
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $subpage = array(
            array(
                'parent_slug' => $admin_page['menu_slug'],
                'page_title' => $admin_page['page_title'],
                'menu_title' => ($title) ? $title : $admin_page['menu_title'],
                'capability' => $admin_page['capability'],
                'menu_slug' => $admin_page['menu_slug'],
                'callback' => $admin_page['callback']
            )
        );

        $this->admin_subpages = $subpage;

        return $this;
    }

    public function addSubPages(array $pages)
    {
        $this->admin_subpages = array_merge($this->admin_subpages, $pages);

        return $this;
    }

    public function addAdminMenu()
    {
        foreach ($this->admin_pages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
        }

        foreach ($this->admin_subpages as $page) {
            add_submenu_page($page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback']);
        }
    }


    public  function my_task_register_settings()
    {
        register_setting('my_task_plugin_options', 'my_task_plugin_options', 'my_task_plugin_options_validate');
        add_settings_section('api_settings', 'API Settings', '', 'my_task_plugin');

        add_settings_field('my_task_plugin_setting_api_key', 'API Key', 'my_task_plugin_setting_api_key', 'my_task_plugin', 'api_settings');
        add_settings_field('my_task_plugin_setting_results_limit', 'Results Limit', 'my_task_plugin_setting_results_limit', 'my_task_plugin', 'api_settings');
        add_settings_field('my_task_plugin_setting_start_date', 'Start Date', 'my_task_plugin_setting_start_date', 'my_task_plugin', 'api_settings');
    }

    public function my_task_plugin_options_validate($input)
    {
        $newinput['api_key'] = trim($input['api_key']);
        if (!preg_match('/^[a-z0-9]{32}$/i', $newinput['api_key'])) {
            $newinput['api_key'] = '';
        }

        return $newinput;
    }

    // public  function my_task_plugin_section_text()
    // {
    //     echo '<p>Here you can set all the options for using the API</p>';
    // }

    public  function my_task_plugin_setting_api_key()
    {
        $options = get_option('my_task_plugin_options');
        echo "<input id='my_task_plugin_setting_api_key' name='my_task_plugin_options[api_key]' type='text' value='" . esc_attr($options['api_key']) . "' />";
    }

    public  function my_task_plugin_setting_results_limit()
    {
        $options = get_option('my_task_plugin_options');
        echo "<input id='my_task_plugin_setting_results_limit' name='my_task_plugin_options[results_limit]' type='text' value='" . esc_attr($options['results_limit']) . "' />";
    }

    public function my_task_plugin_setting_start_date()
    {
        $options = get_option('my_task_plugin_options');
        echo "<input id='my_task_plugin_setting_start_date' name='my_task_plugin_options[start_date]' type='text' value='" . esc_attr($options['start_date']) . "' />";
    }
}

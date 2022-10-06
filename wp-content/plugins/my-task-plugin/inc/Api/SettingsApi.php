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
        //License_key
        register_setting('my_task_License_key_plugin_options', 'my_task_License_key_plugin_options', array($this, 'my_task_License_key_plugin_options_validate'));
        add_settings_section('License_settings', 'License Settings', array($this, 'my_task_plugin_section_text'), 'my_task_plugin');
        add_settings_field('my_task_plugin_setting_License_key', 'License Key', array($this, 'my_task_plugin_setting_License_key'), 'my_task_plugin', 'License_settings');
        //sheet field
        register_setting('my_task_sheet_field_plugin_options', 'my_task_sheet_field_plugin_options', array($this, 'my_task_sheet_field_plugin_options_validate'));
        add_settings_section('sheet_field_settings', 'Sheet Fields Settings', array($this, 'my_task_plugin_section_text_sheet_field'), 'my_task_sheet_field_plugin');

        add_settings_field('my_task_plugin_setting_sheet_field', 'Sheet Field', array($this, 'my_task_plugin_setting_sheet_field'), 'my_task_sheet_field_plugin', 'sheet_field_settings');
    }
    //License_key
    public function my_task_License_key_plugin_options_validate($input)
    {
        if (
            !isset($_POST['awesome_form']) ||
            !wp_verify_nonce($_POST['awesome_form'], 'awesome_update')
        ) {
            add_settings_error('general', 'settings_updated', __("Sorry, your nonce was not correct. Please try again."), 'error');
        } else {
            // Handle our form data
            return $input;
        }
    }

    public  function my_task_plugin_section_text()
    {
        echo '<p>Here you can set up the Plugin Activation Key!</p><br>';
    }

    public  function my_task_plugin_setting_License_key()
    {
        $options = get_option('my_task_License_key_plugin_options');
        // var_dump($options['License_key']);exit;
        if (!empty($options['License_key'])) {
            $License_key = esc_attr($options['License_key']);
        } else {
            $License_key = '';
        }
        echo "<input id='my_task_plugin_setting_License_key' size='43' name='my_task_License_key_plugin_options[License_key]' required='required' type='text' value='" . $License_key . "' />";
    }
    //License_key


    //sheet field
    public function my_task_sheet_field_plugin_options_validate($input)
    {
        if (
            !isset($_POST['awesome_form']) ||
            !wp_verify_nonce($_POST['awesome_form'], 'awesome_update')
        ) {
            add_settings_error('general', 'settings_updated', __("Sorry, your nonce was not correct. Please try again."), 'error');
        } else {
            // Handle our form data
            return $input;
        }
    }

    public  function my_task_plugin_section_text_sheet_field()
    {

        $html = '<p>Here you can set up the Google Sheets Links!</p>
        <h3>Only Need To Add Unique key of Spread Sheet</h3>
        <h4>Example</h4>
        <p>https://docs.google.com/spreadsheets/d/1PHEBOLeNfjvx1DVcry8ui95AaK_MfX0bK6GoKcJPYYU/edit#gid=927060094</p>
        You only need to add in Field <span style="background-color:yellow;"> 1PHEBOLeNfjvx1DVcry8ui95AaK_MfX0bK6GoKcJPYYU </span>
        ';
        echo $html;
    }

    public  function my_task_plugin_setting_sheet_field()
    {

        $options = get_option('my_task_sheet_field_plugin_options');
        // $options['sheet_field']  = array();
        // var_dump($options['sheet_field']);exit;
        if (!empty($options['sheet_field'])) {
            $sheet_field = esc_attr($options['sheet_field'][0]);
        } else {
            $sheet_field = '';
        }
        echo "<input id='my_task_sheet_field' size='100' name='my_task_sheet_field_plugin_options[sheet_field][]' required='required' type='text' value='" . $sheet_field . "' /> <input type='button' id='add_more_sheet_fields' class='button button-primary' value='Add More Sheet Fields'/><br><div id='new_sheet_field'></div><input id='number_of_fields'  type='hidden' value='" . count($options['sheet_field']) . "'/>";

        if (sizeof($options['sheet_field']) > 1) {
            $i = 1;
            foreach ($options['sheet_field'] as $key => $value) {
                if ($i != 1) {
                    echo  '<div id="my_task_sheet_field-' . $key . '"><br><input  size="100" name="my_task_sheet_field_plugin_options[sheet_field][]" required="required" type="text" value="' . $value . '"></input><a 
                     class="delete-btn-class" ><input type="hidden" id="values" value="' . $key . '"/><span class="dashicons dashicons-trash"></span></a><br></div>';
                }
                $i++;
            }
        }
    }
    //sheet field
}

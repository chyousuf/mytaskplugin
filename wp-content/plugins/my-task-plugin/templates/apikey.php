<div>
    <h2>My Task Plugin Settings</h2>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">
    <?php wp_nonce_field( 'awesome_update', 'awesome_form' ); ?>
        <?php
        settings_fields('my_task_License_key_plugin_options');
        do_settings_sections('my_task_plugin'); ?>
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>" />
    </form>
</div>
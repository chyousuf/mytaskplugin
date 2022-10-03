<div>
	<?php settings_errors(); ?>
	<h2>My Task Plugin Settings</h2>
	<form action="options.php" method="post">
		<?php
		// settings_fields('my_task_plugin_options');
		// do_settings_sections('my_task_plugin'); 
		?>
		<input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>" />
	</form>
</div>
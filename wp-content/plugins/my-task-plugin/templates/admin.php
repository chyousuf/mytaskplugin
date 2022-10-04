<?php
//Get PluginLicense Key
$License_key =null;
$options = get_option('my_task_License_key_plugin_options');
// var_dump($options['License_key']);exit;
if(!empty($options['License_key'])) {
   $License_key = $options['License_key'];
}

?>
<div>
	<?php settings_errors(); ?>
	<h2>My Task Plugin Google Sheet Fields</h2>
	<form action="options.php" method="post">
	<?php wp_nonce_field( 'awesome_update', 'awesome_form' ); ?>
		<?php
		 settings_fields('my_task_sheet_field_plugin_options');
		 do_settings_sections('my_task_sheet_field_plugin'); 
		?>
		<input name="submit" class="button button-primary" <?php if($License_key==null){ ?> disabled="disabled" <?php }  ?>  type="submit" value="<?php esc_attr_e('Save'); ?>" />
	</form>
</div>

<?php $options = get_option('my_task_sheet_field_plugin_options');

var_dump($options);
?>
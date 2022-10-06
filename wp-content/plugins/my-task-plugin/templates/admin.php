<?php
//Get PluginLicense Key
$License_key = null;
$options = get_option('my_task_License_key_plugin_options');
// var_dump($options['License_key']);exit;
if (!empty($options['License_key'])) {
	$License_key = $options['License_key'];
}

?>
<div>
	<h2>My Task Plugin Google Sheet Fields</h2>
	<?php settings_errors(); ?>
	<form action="options.php" method="post">
		<?php wp_nonce_field('awesome_update', 'awesome_form'); ?>
		<?php
		settings_fields('my_task_sheet_field_plugin_options');
		do_settings_sections('my_task_sheet_field_plugin');
		?>
		<input name="submit" class="button button-primary" <?php if ($License_key == null) { ?> disabled="disabled" <?php }  ?> type="submit" value="<?php esc_attr_e('Save'); ?>" />
	</form>
	<div style="padding-top:30px;">
		<h2>Short Code Doc</h2>
		<h4>If you want all data of spread sheet use Shortcode <span style="background-color:yellow;">"[cm]"</span></h4>
		<h2>Shortcode Parameters</h2>
		<p>Shortcode have 3 parameters</p>
		<ul>
			<li><span style="background-color:yellow;">"spread_sheet_Id" </span> field id you Add in Sheet Field. i.e if you want data of sheet 2 you can give it <span style="background-color:yellow;">spread_sheet_Id='2'</span> </li>
			<li><span style="background-color:yellow;">"spread_sheet_name" </span> name is spread sheet name i.e by default its name is "Sheet1" so if you have multiple sheet you can use it like <span style="background-color:yellow;">spread_sheet_name='account_sheet'</span> </li>
			<li><span style="background-color:yellow;">"spread_sheet_range"</span> The Data range i.e A1:A20 or A1:B4 or B4:B21
				Example <span style="background-color:yellow;">spread_sheet_range="A1:A20"</span></li>
		</ul>


	</div>
</div>
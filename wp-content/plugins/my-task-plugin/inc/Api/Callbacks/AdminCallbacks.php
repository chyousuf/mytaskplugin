<?php

/**
 * @package  MyTaskPlugin
 */

namespace inc\Api\Callbacks;

use inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once("$this->plugin_path/templates/admin.php");
	}

	public function adminApiKey()
	{
		return require_once("$this->plugin_path/templates/apikey.php");
	}
}

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

	public function adminCpt()
	{
		return require_once("$this->plugin_path/templates/cpt.php");
	}

	public function adminTaxonomy()
	{
		return require_once("$this->plugin_path/templates/taxonomy.php");
	}
}

<?php
class RhclaimAdminController extends Rhclaim
{
	function init()
	{
	}

	function procRhclaimAdminInsertConfig()
	{
		$vars = Context::getRequestVars();
		$oModuleController = getController('module');

		$args = new stdClass();
		$args->browser_title = $vars->browser_title;
		$args->module = $vars->module;
		$args->mid = $vars->mid;
		$args->module_srl = $vars->module_srl;
		$args->layout_srl = $vars->layout_srl;
		$args->product_module_srl = $vars->product_module_srl;
		$args->skin = $vars->skin;

		debugPrint($args);
		if(!$args->module_srl) {
			$output = $oModuleController->insertModule($args);
			debugPrint($output);
			debugPrint('insert');
			$msg_code = 'success_registed';
		} else {
			$output = $oModuleController->updateModule($args);
			debugPrint($output);
			debugPrint('update');
			$msg_code = 'success_updated';
		}
		
		if(!in_array(Context::getRequestMethod(),array('XMLRPC','JSON')))
		{
			$returnUrl = Context::get('success_return_url') ? Context::get('success_return_url') : getNotEncodedUrl('', 'module', 'admin', 'act', 'dispRhclaimAdminConfig');
			header('location: ' . $returnUrl);
			return;
		}
	}
}

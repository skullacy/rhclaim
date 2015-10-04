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
		$oModuleController->updateModuleConfig('Rhclaim', $vars);
		if(!in_array(Context::getRequestMethod(),array('XMLRPC','JSON')))
		{
			$returnUrl = Context::get('success_return_url') ? Context::get('success_return_url') : getNotEncodedUrl('', 'module', 'admin', 'act', 'dispRhclaimAdminConfig');
			header('location: ' . $returnUrl);
			return;
		}
	}
}

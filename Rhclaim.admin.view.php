<?php
class RhclaimAdminView extends Rhclaim
{
	function init()
	{
		$this->setTemplatePath($this->module_path.'tpl');
		$this->setTemplateFile(strtolower(str_replace('dispRhclaimAdmin', '', $this->act)));
	}

	function dispRhclaimAdminConfig()
	{
		$oRhclaimModel = getModel('Rhclaim');
		$module_config = $oRhclaimModel->getConfig();
		debugPrint($module_config);
		Context::set('config', $module_config);
	}

	function dispRhclaimAdminTabEx()
	{
		//tab
	}
}

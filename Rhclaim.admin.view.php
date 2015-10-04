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
		$module_config = $oRhclaimModel->getModuleInfo();

		if(!$module_config->mid) {
			$module_config->mid = "RhClaim";
		}

		if(!$module_config->module) {
			$module_config->module = 'Rhclaim';
		}

		if(!$module_config->browser_title) {
			$module_config->browser_title = '클레임 처리';
		}

		Context::set('module_info', $module_config);

		// get the skins list
		$oModuleModel = getModel('module');
		$skin_list = $oModuleModel->getSkins($this->module_path);
		Context::set('skin_list',$skin_list);

		$mskin_list = $oModuleModel->getSkins($this->module_path, "m.skins");
		Context::set('mskin_list', $mskin_list);

		// get the layouts list
		$oLayoutModel = getModel('layout');
		$layout_list = $oLayoutModel->getLayoutList();
		Context::set('layout_list', $layout_list);

		$mobile_layout_list = $oLayoutModel->getLayoutList(0,"M");
		Context::set('mlayout_list', $mobile_layout_list);
	}

	function dispRhclaimAdminTabEx()
	{
		//tab
	}
}

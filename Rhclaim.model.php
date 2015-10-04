<?php
class RhclaimModel extends Rhclaim
{
	function init()
	{
	}

	/**
	 * @return Object config object
	 * @notice this function saves config object to private value $config.
	 */
	function getConfig()
	{
		$oModuleModel = getModel('module');
		$config = $oModuleModel->getModuleConfig('Rhclaim');
		debugPrint($config);

		return $config;
	}

	function getModuleInfo($mid = 'Rhclaim') {
		$oModuleModel = getModel('module');
		$module_info = $oModuleModel->getModuleInfoByMid($mid);
		debugPrint($module_info);
		return $module_info;
	}
}

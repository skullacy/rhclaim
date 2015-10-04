<?php
class RhclaimView extends Rhclaim
{
	function init()
	{
		if(!$skin)
		{
			$skin = 'default';
			$template_path = sprintf('%sskins/%s', $this->module_path, $skin);
		}
		else
		{
			//check theme
			$config_parse = explode('|@|', $skin);
			if (count($config_parse) > 1)
			{
				$template_path = sprintf('./themes/%s/modules/member/', $config_parse[0]);
			}
			else
			{
				$template_path = sprintf('%sskins/%s', $this->module_path, $skin);
			}
		}
		// Template path
		$this->setTemplatePath($template_path);
		$this->setTemplateFile(strtolower(str_replace('dispRhclaim', '', $this->act)));

		$oLayoutModel = getModel('layout');
		$layout_info = $oLayoutModel->getLayout($this->member_config->layout_srl);
		if($layout_info)
		{
			$this->module_info->layout_srl = $this->member_config->layout_srl;
			$this->setLayoutPath($layout_info->path);
		}

	}

    function dispRhclaimList() {

    }
}

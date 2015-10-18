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

    /**
	 * @brief 클레임 리스트
	 **/
	function dispRhclaimClaimList(){
		
		$oDocumentModel = getModel('document');

		// setup module_srl/page number/ list number/ page count
		$args = new stdClass();
		$args->module_srl = $this->module_srl;
		$args->page = Context::get('page');
		$args->list_count = $this->list_count;
		$args->page_count = $this->page_count;

		// get the search target and keyword
		$args->search_target = Context::get('search_target');
		$args->search_keyword = Context::get('search_keyword');

		// // if the category is enabled, then get the category
		// if($this->module_info->use_category=='Y')
		// {
		// 	$args->category_srl = Context::get('category');
		// }

		// setup the sort index and order index
		$args->sort_index = Context::get('sort_index');
		$args->order_type = Context::get('order_type');
		if(!in_array($args->sort_index, $this->order_target))
		{
			$args->sort_index = $this->module_info->order_target?$this->module_info->order_target:'list_order';
		}
		if(!in_array($args->order_type, array('asc','desc')))
		{
			$args->order_type = $this->module_info->order_type?$this->module_info->order_type:'asc';
		}

		// // set the current page of documents
		// $document_srl = Context::get('document_srl');
		// if(!$args->page && $document_srl)
		// {
		// 	$oDocument = $oDocumentModel->getDocument($document_srl);
		// 	if($oDocument->isExists() && !$oDocument->isNotice())
		// 	{
		// 		$page = $oDocumentModel->getDocumentPage($oDocument, $args);
		// 		Context::set('page', $page);
		// 		$args->page = $page;
		// 	}
		// }

		// // setup the list count to be serach list count, if the category or search keyword has been set
		// if($args->category_srl || $args->search_keyword)
		// {
		// 	$args->list_count = $this->search_list_count;
		// }

		// // if the consultation function is enabled,  the get the logged user information
		// if($this->consultation)
		// {
		// 	$logged_info = Context::get('logged_info');
		// 	$args->member_srl = $logged_info->member_srl;
		// }

		// setup the list config variable on context
		Context::set('list_config', $this->listConfig);
		// setup document list variables on context
		$output = $oDocumentModel->getDocumentList($args, $this->except_notice, TRUE, $this->columnList);
		debugPrint($output);
		Context::set('document_list', $output->data);
		Context::set('total_count', $output->total_count);
		Context::set('total_page', $output->total_page);
		Context::set('page', $output->page);
		Context::set('page_navigation', $output->page_navigation);
	}

	function dispRhclaimClaimWrite() {
		$oDocumentModel = getModel('document');

		// GET parameter document_srl from request
		$document_srl = Context::get('document_srl');
		$oDocument = $oDocumentModel->getDocument(0, $this->grant->manager);
		$oDocument->setDocument($document_srl);

		// get Document status config value
		Context::set('document_srl',$document_srl);
		Context::set('oDocument', $oDocument);

		// if the document exists, then setup extra variabels on context
		if($oDocument->isExists() && !$savedDoc) Context::set('extra_keys', $oDocument->getExtraVars());

	}

	
}

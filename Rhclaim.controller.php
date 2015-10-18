<?php
class RhclaimController extends Rhclaim
{
	function init()
	{
	}

	function procRhclaimSearchProducts() {

		$oDocumentModel = getModel('document');
		$oRhclaimModel = getModel('rhclaim');

		$module_config = $oRhclaimModel->getModuleInfo();
		debugPrint($module_config);

		// setup module_srl/page number/ list number/ page count
		$args = new stdClass();
		$args->module_srl = $module_config->product_module_srl;
		$args->list_count = 10;
		

		// get the search target and keyword
		$args->search_target = 'title_content';
		$args->search_keyword = Context::get('search_keyword');


		$output = $oDocumentModel->getDocumentList($args, $this->except_notice, TRUE, $this->columnList);
		debugPrint($output);
		Context::set('document_list', $output->data);
		Context::set('total_count', $output->total_count);
		Context::set('total_page', $output->total_page);
		Context::set('page', $output->page);
		Context::set('page_navigation', $output->page_navigation);





		$context = Context::getInstance();
		$context->setRequestMethod('JSON');
		
		$this->add('output_data', $output->data);
		$this->setMessage('success');
		debugPrint($this);
	}
}

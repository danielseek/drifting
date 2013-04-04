<?php
namespace FrontModule;
/**
 * Homepage presenter.
 */
class ArticlesPresenter extends BaseFrontPresenter
{	
	protected $db;
        protected function startup()
        {
            parent::startup();
        }
	public function renderDefault()
	{

        }
	public function renderShow(){
	    $this->renderDefault();
	}
	
	//Implementation of creating components without using factory methods in the parrent class
	protected function createComponent($name) {
	    $component = parent::createComponent($name);

	    if ($component !== NULL) {
		return $component;
	    }
	    return NULL;
	}
}

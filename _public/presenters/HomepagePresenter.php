<?php
namespace FrontModule;
/**
 * Homepage presenter.
 */
class HomepagePresenter extends BaseFrontPresenter
{	
	protected $db;

        protected function startup()
        {
            parent::startup();
        }
	public function renderDefault()
	{
	    $t = $this->template;
	    $t->raceTakesPlace = false;
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
	
	protected function createComponentNews($name){
	    return $this->contentFactory->createArticles($this->context->articleRepository, $this, $name);
	}
}

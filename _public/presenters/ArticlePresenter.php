<?php
namespace FrontModule;
/**
 * Homepage presenter.
 */
class ArticlePresenter extends BaseFrontPresenter
{	
	protected $db;
	protected $articlesRepository;
        protected function startup()
        {
            parent::startup();
        }
	public function injectArticlesRepository(\Natty\Repositories\ArticlesRepository $rep){
	    $this->articlesRepository = $rep;	    
	}
	public function renderDefault()
	{
	    
        }
	public function renderOne($id){
	    $t = $this->template;
	    $t->article = $this->articlesRepository->getOne($id);
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

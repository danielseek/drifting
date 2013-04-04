<?php
namespace Natty;
class ContentComponent extends \Nette\Application\UI\Control {
    /** @var string */
    protected $templateFile;
    /** @var Repositories\Repository */
    protected $repository;
    /** @var boolean */
    public $isHome = false;
    
    public $limit;
    
    public function __construct(
	Repositories\Repository $repository,
	    \Nette\ComponentModel\IContainer $parent = NULL, 
	$name = NULL) {
	    parent::__construct($parent, $name);
	    $this->repository = $repository;
    }
    public function setTemplateFile($file){
	$this->templateFile = $file;
    }
    public function render(){
	$tpl = $this->template->setFile($this->templateFile);
	$tpl->items = $this->repository->getAll();
	$tpl->isHome = $this->isHome;
	$tpl->render();	
    }
    /**
     * @param type $limit Number of posts
     */
    public function renderHome($limit){
	$tpl = $this->template->setFile($this->templateFile);
	
	$tpl->items = $this->repository->getAllPublic("cs")->limit(2);
	$tpl->limit = $limit;
	$tpl->isHome = true;
	$tpl->render();
    }
    protected function  getTemplatePath(){
	return __DIR__."/".str_replace("Presenter", null, lcfirst(join('', array_slice(explode('\\', get_class($this->parent)), -1))).".latte");
    }
}
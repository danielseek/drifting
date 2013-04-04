<?php
namespace Natty;
class GalleriesComponent extends \Nette\Application\UI\Control {
    protected $galleriesRepository;
    public $edit = false;
    public $showAsTable = false;
    public function __construct(Repositories\GalleriesRepository $galleriesRepository,\Nette\ComponentModel\IContainer $parent = NULL, $name = NULL) {
	parent::__construct($parent, $name);
	$this->galleriesRepository = $galleriesRepository;
    }    
    public function render(){
	$tpl = $this->template;
	$tpl->setFile(__DIR__."/galleries.latte");
	$tpl->edit = $this->edit;
	$tpl->showAsTable = $this->showAsTable;
	$tpl->galleries = $this->galleriesRepository->getAll();
	$tpl->render();

	
    }
}
<?php
namespace Natty;
use Natty\BaseComponent;
class DriftRacesComponent extends BaseContentComponent {
    protected $driftRacesRepository;
    public $admin = false;
    public $showAsTable = false;
    public function __construct(Repositories\DriftRacesRepository $driftRacesRepository,\Nette\ComponentModel\IContainer $parent = NULL, $name = NULL) {
	parent::__construct($parent, $name);
	$this->driftRacesRepository = $driftRacesRepository;
    }    
    public function render(){
	$this->template->races = $this->driftRacesRepository->getAll();
	$this->template->setFile($this->getTemplatePath());
	parent::render();	
    }
}
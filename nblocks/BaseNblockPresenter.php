<?php
namespace Natty\Nblocks;
abstract class BaseNblockControl extends \Nette\Application\UI\Control
{
    /** @var \Nette\Database\Connection */
    protected $db;
    protected $database;
    
    public function __construct(\Nette\ComponentModel\IContainer $parent = NULL, $name = NULL){
	parent::__construct($parent, $name);
	$this->db = $this->database = $this->presenter->context->database;
    }
    public function prepareRender(){
	$withNamespace = explode('\\',get_class($this));
	$whatever = end($withNamespace);
	$templateName= str_replace("Control", "", lcfirst($whatever));
	$this->template->setFile(__DIR__."/".ucfirst($templateName)."/".$templateName.".latte");
    }
    public function render(){
	$this->prepareRender();
	$template = $this->template;
	$template->render();
    }
}

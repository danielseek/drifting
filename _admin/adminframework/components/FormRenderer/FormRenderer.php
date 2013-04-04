<?php
namespace Natty;
Class FormRenderer extends \Nette\Application\UI\Control {
    /**@var \Nette\Application\UI\Form */
    protected $form;
    protected $useTable = true;
    public function __construct(\Nette\Application\UI\Form $form, \Nette\ComponentModel\IContainer $parent, $name) 
    {
	$form->getElementPrototype()->attributes(Array("class"=> "form-horizontal"));
	$renderer = $form->getRenderer();
	$renderer->wrappers['controls']['container'] = 'null';
	$renderer->wrappers['pair']['container'] = 'null';
	$renderer->wrappers['label']['container'] = 'null';
	$renderer->wrappers['control']['container'] = 'null';
	if(isset($form["send"])) $form["send"]->setAttribute("class","btn");
	//$form->getElementPrototype()->addAttributes(Array("class"=>"formee"));
	$this->addComponent($form, "form");
	parent::__construct($parent, $name);
    }
    public function render(){
	$t = $this->template;
	$t->useTable = $this->useTable;
	$t->setFile(__DIR__."/default.latte");
	$t->render();
    }
    public function setDefaults($values, $erase=false){
	$this["form"]->setDefaults($values, $erase);
    }
    public function setUseTable($use = true) {
	$this->useTable = $use;
    }

    public function formSubmitted($form) {
	$this->parent->formSubmitted($form);
    }
}
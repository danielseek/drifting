<?php
namespace Natty;
use Natty\Menu;
class DriftPanel extends \Nette\Application\UI\Control {
    public function __construct(\Nette\ComponentModel\IContainer $parent = NULL, $name = NULL) {
	parent::__construct($parent, $name);
    }    
    public function render(){
	$tpl = $this->template;
	$tpl->setFile(__DIR__."/driftPanel.latte");
	$tpl->render();	
    }
    public function createComponentMenu($name) {
	$m = new Menu($this, $name);
	$m->minLevel = 0;
	$m->fromArray(
	    Array(
		Array(10, "Správa závodů","RaceManager:Default", Array(
		    Array(12,"Přehled závodů", "RaceManager:Default"),
		    Array(11,"Přidat závod", "RaceManager:Add")
		    
		))
	    ), true
	);
    }
}
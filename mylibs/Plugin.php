<?php
namespace Natty\Plugins;
/**
 * Description of Plugin
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class Plugin extends \Nette\Object {
    public $name;
    public $xmlFile;
    public $controlClass;
    public $adminControlClass;
    protected $component;
    
    public function getComponent(\Nette\ComponentModel\IContainer $presenter, $name){
	if(!$this->component){
	    $this->component = new $this->controlClass($presenter, $name);	
	}
    }
    public function getAdminComponent(\Nette\ComponentModel\IContainer $parent, $name){
	if(!$this->component){
	    $this->component = new $this->adminControlClass($parent, $name);	
	}
    }
}
?>

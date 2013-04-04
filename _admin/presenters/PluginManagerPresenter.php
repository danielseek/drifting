<?php
namespace AdminModule;
use Nette\Utils\Finder;
/**
 * Description of PluginManagerPresenter
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class PluginManagerPresenter extends BaseAdminPresenter {
    /**  */
    private $plugins; 
    protected function startup(){
	parent::startup();
	$this->plugins = $this->context->plugins;
    }
    protected function renderDefault(){
	
    }
}

?>

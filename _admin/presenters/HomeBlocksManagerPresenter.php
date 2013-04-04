<?php
namespace AdminModule;
use Nette\Utils\Finder;
/**
 * Description of PluginManagerPresenter
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class HomeBlockManagerPresenter extends BaseAdminPresenter {
    /**  */
    private $homeBlocks; 
    protected function startup(){
	parent::startup();
	$this->homeBlocks = $this->context->homeBlocks;
    }
    protected function renderDefault(){
	
    }
}

?>

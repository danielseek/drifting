<?php
namespace AdminModule;
/**
 * Description of MenuManagerPresenter
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class MenuManagerPresenter extends BaseAdminPresenter {
    protected $adminMenuRepository;
    protected function startup() {
	parent::startup();
	$this->adminMenuRepository = $this->context->adminMenuRepository;
    }
    
}

?>

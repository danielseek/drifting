<?php
namespace AdminModule;
/**
 * Description of AdminPresenter
 *
 * @author Daniel Sykora (dunky.sykora@gmai.com)
 */
class DefaultPresenter extends BaseAdminPresenter {
        protected function startup()
        {
            parent::startup();
        }
        public function renderMaintenance(){
            $this->template->text = "Tato sekce je v přípravě";
        }
}
?>

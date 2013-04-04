<?php
namespace Natty;
use Nette\Application\UI\Form;
use Natty\NattyDataGrid;
use AdminModule\BaseAdminPresenter;
use \Nette\Application\UI\Control;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Manager
 *
 * @author Daniel
 */
abstract class Manager extends BaseAdminPresenter {
    protected $headline = Array();
    public function beforeRender(){
    }
    public function renderDefault() {
	
	$template = $this->template->setFile(__DIR__."/templates/default.latte");
	$template->headline = isset($this->headline["default"]) ? $this->headline["default"] : null;
    }
    public function renderAdd(){
	$template = $this->template->setFile(__DIR__."/templates/add.latte");
	$template->headline = isset($this->headline["add"]) ? $this->headline["add"] : null;
    }
    public function renderEdit($primary){
	$defaults = $this["admin"]->prepareDefaults($primary);
	$template = $this->template->setFile(__DIR__."/templates/edit.latte");
	$template->headline = isset($this->headline["edit"]) ? $this->headline["edit"] : null;
    }
    public function actionDelete($id){
	$this->repository->delete($id);
	$this->redirect("default");
    }

    protected function createComponentSubMenu($name) {
	try {
	    $control = $this['topMenu']->getMenuFromChildrenById($this->menuId, $name);
	} catch (NotFoundException $exc){
	    return $control;
	}
	return $control;
    } 

    abstract protected function createComponentAdmin($name);
}
<?php
/*
 * This file is part of the Natty CMS (http://nattycms.org), based on the Nette Framework (http://nette.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */
namespace Natty\AdminFramework;
use Natty, Nette\Application\UI\Form;
/**
 * @author Daniel Sýkora
 */
class Admin extends \Nette\Application\UI\Control {
    
    /** @var Repositories\Repository Model */
    protected $repository;
    protected $contentName;
    protected $multilingualMode = false;
    protected $multilingualFieldNames = Array();
    protected $translationsTable;
    protected $primaryKey;
    /** @var \Nette\Callback */
    protected $onFormSubmitted;


    /** @var String Following variables are used by sprintf function to produce form  message */
    protected $messages = array(
	"mandatory" => "Nevyplnili jste povinné pole '%s'.",
	"maxLength" => "Pole '%s' nesmí být delší než %d znaků.",
	
	"date" => "Chyba, pole '%s' má nesprávnou hodnout '%s'. Datum musí mít formát dd.mm.rrrr např. 31.09.1994.",
	"time" => "Chyba, pole '%s' má nesprávnou hodnout '%s'. Čas musí mít formát hh:mm například 09:30"
    );
    public $gridSettings = Array(
	"messages" => Array (
	    "delete" => "Určitě chcete smazat '%s' s '%s': '%s'"
	)
    );
    /////////////////////////////////////////////// RENDER
    public function render() {
	
    }
    /////////////////////////////////////////////// Components
    protected function createComponentDataGrid($name){
	$settings = $this->gridSettings;
	$settings["lang"] = $this->presenter->getDefaultLanguage();
	$settings["contentName"] = $this->contentName;
	$settings["defaultOrder"] = $this->primaryKey->getDatabaseName()." DESC";
	return new Natty\NiftyGridUniversal($this->repository->getAllAdmin($settings["lang"]), $this->getFields(), $settings);
    }
    /*
    protected function createComponentDataGrid($name){
	$grido = new \Grido\Grid($this, $name);
	$model = $this->repository->getAllMultilingual($this->multilingualFieldNames);
	$f = $model->fetch();
	$grido->setModel($model);
	$fields = $this->getFields();
	foreach($fields as $field) {
	    if($field->useInGrid()) {
		$column = $grido->addColumn($field->getName(), $field->getLabel(), $field->getGridType());
		//if($field->isMultilingual()) $column->setMultilingual();
		if($field->isSortable()) $column->setSortable();
		if($field->useFilter()) $column->setFilter();
	    }
	}
	$grido->addAction('edit', 'Upravit')->setIcon('wrench');
	$grido->addAction('delete', 'Smazat')->setIcon('trash');
	return $grido;
    }*/
    
    protected function createComponentAdminForm($name){
	$form = new Form;
	foreach($this->getFields() as $field){
	    if($field->useInForm()){
		//create control inside of the form with callback
		$label = $field->getLabel();
		$callback = callback(Array($form, $field->getFormFunctionName()));
		$control = $callback->invokeArgs(Array($field->getName(), $label));
		
		$control->setValue($field->getValue());
		
		$field->setupForm($control, $this->messages, $label);
	
	    }
	}
        $form->addSubmit("send", "Uložit formulář");
	$form->onSuccess[] = callback($this, "formSubmitted");
	
        return new \Natty\FormRenderer($form, $this, $name);  
    }
    public function prepareDefaults($primary){
	$result = $this->repository->getOneAdmin($this->presenter->getDefaultLanguage(), $primary);
	$row = $result->fetch();
	
	foreach($this->getFields() as $field){
	   if($field->useInForm()) {
		$value= $row[$field->getName()];
		$this["adminForm"]["form"][$field->getName()]->setValue($value);
	   }
	   
	}	
    }
    public function formSubmitted($form){
	$values = array();
	foreach($this->getFields() as $field){
	    if($field->useInForm()){
		$value = $form[$field->getName()]->getValue();
		$value = $field->formatForDb($value);
		$values[$field->getName()] = $value;
	    }	    
	}
	if($this->onFormSubmitted) {//user callback overrides this function
	    $this->onFormSubmitted->invokeArgs(array($form, $values));
	    return null;
	}

	if(isset($form["primary"]) and $form["primary"]->getValue()) {
	    $this->repository->update($form["primary"]->getValue(), $values);
	} else{
	    $this->repository->create($values);
	}
	$this->presenter->redirect("Default");
    }
    /////////////////////////////////////////////// Fields  
    /**
     * Add new field to Manager
     * Fields are used for generating administration forms and grids
     * @param String $type field types can be found in the Natty\Fields\Field class Field::TYPE_TEXT etc.
     * @param String $name     
     * @param String $label
     * @param boolean $mandatory
     * @param int $maxLength
     * @return \Natty\type
     */  
    public function addField($name, $label, $type, $useIngGrid = true, $useInForm = true){
	if(class_exists($type)){
	    $field = new $type($this, $name);
	    $field->setLabel($label);
	    $field->setUseInGrid($useIngGrid);
	    $field->setUseInForm($useInForm);
	    return $field;
	} else throw new \Nette\InvalidArgumentException("Invalid argument \$type in method addField. It has to be constant Field::TYPE_... e.g. Field::TYPE_TEXT ");
    }
    /**
     * returns array of components which are Natty\Fields\Field descendant
     * @return Array 
     */
    public function getFields($deep = true){
	return $this->getComponents($deep, "Natty\AdminFramework\Fields\Field");
    }
    /**
     * Checks wheter this component is setted up correctly
     * @return boolean
     * @throws \Exception
     */
    public function isReady()
    {
        if(false) {
            throw new \Exception("DataGrid is not setted up correctly.");
        }
        return true;
    }
    public function setOnFormSubmitted($callback){
	$this->onFormSubmitted = \Natty::validateCallback($callback);
	return $this;
    }
    public function setContentName($name) {
	$this->contentName = $name;
    }
    public function getContentName(){
	return $this->contentName;
    }
    /**
     * @param \Natty\Repositories\Repository $repository
     * @return NULL
     */
    public function setRepository(\Natty\Repositories\Repository $repository){
	$this->repository = $repository;
	return $this;
    }
    public function setPrimaryKey($key){
	$this->primaryKey = $primaryKey = new Fields\PrimaryKey($this, $key);
	return $primaryKey;
    }   
    /**
     * Sets component to multilingual mode
     * @param boolean $multi
     * @return Natty\AdminFramework\Multilingual|null 
     *	    Returns Lang component for necessary settings 1. setLanguages() 2.setDefaultLanguage())
     *	    You must keep the order of those settings
     */
    public function setMultilingualMode($multi = true) {
	$this->multilingualMode = $multi;
	if($multi = true) {
	    return new Fields\Lang($this, "lang");
	} else {
	    unset($this["lang"]);
	}
	return null;
    }
    public function registerMultilingualField(&$field){
	$this->multilingualFieldNames[] = $field->getName();
    }
    public function Multilingual($defaultLanguage, array $languages){
	$this->setMultilingualMode()
		->setDefaultLanguage($defaultLanguage)
		->setLanguages($languages);
    }
    public function setTranslationsTable($table){
	$this->translationsTable = $table;
    }
    /**
     * @param String $message
     */
    public function setMessageMandatory($message){
	$this->messageMandatory = $message;
	return $this;
    }
    
    
    /**
     * @param String $message
     */
    public function setMessageMaxLength($message){
	$this->messageMaxLength = $message;
	return $this;
    }    
}


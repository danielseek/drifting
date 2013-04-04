<?php
/*
 * This file is part of the Natty CMS (http://nattycms.org), based on the Nette Framework (http://nette.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */

namespace Natty\AdminFramework\Fields;

use Nette;
use Grido\Components\Columns\Column;
use Nette\Forms\Form;

/**
 * Description of Field
 *
 * @author Daniel Sýkora
 */
abstract class Field extends Nette\Application\UI\PresenterComponent {
    /** @var Natty\AdminFramework */
    protected $admin;
    /**
     * Name of add function in \Nette\Application\UI\Form
     * To be overridden by descendant
     * @var String
     */    
    protected $formFunctionName; 
    protected $databaseName;
    
    public $isMultilinagual = false;
    
    //dataGrid
    public $useInGrid = true;
	public $sortable = false;
	public $filter = false;
	
    //adminForm
    public $useInForm = true;
    public $isMandatory = false;
    public $label = null;
    public $value = null;
    protected $picker = null;
    
    public $isRowIdentificator = false;
    /** To be overriden
     * @var string */
    protected $formatting = null;
    /** To be overriden
     *  @var string */
    protected $dbFormatting = null;
    
    const   TYPE_TEXT = "Natty\AdminFramework\Fields\Text",
	    TYPE_TEXTAREA = "Natty\\AdminFramework\Fields\Textarea",
	    TYPE_NUMERIC = "Natty\\AdminFramework\Fields\Numeric",
	    TYPE_DATE = "Natty\\AdminFramework\Fields\Date",
	    TYPE_TIME = "Natty\\AdminFramework\Fields\Time",
	    TYPE_BOOLEAN = "Natty\\AdminFramework\Fields\Boolean",
	    TYPE_HIDDEN = "Natty\AdminFramework\Fields\Hidden";
    
    
    /**
     * 
     * @param Nette\ComponentModel\IContainer $parent
     * @param String $name
     * @param int $type
     */
    public function __construct(Nette\ComponentModel\IContainer $parent, $name) {
	$this->admin = $parent;
	$this->databaseName = $name;
	parent::__construct($parent, $name);
    }
    public function setupForm($formControl, $messages, $label){
	 if($this->isMandatory()) $formControl->addRule(Form::FILLED, sprintf($messages["mandatory"], $label));
    }
    /*public function getGridType(){
	switch (get_class($this)) {
	case Field::TYPE_TEXT : return Column::TYPE_TEXT;
		break;
	case Field::TYPE_TEXTAREA : return Column::TYPE_TEXT;
		break;
	default: return Column::TYPE_TEXT;
		break;
	}
    }*/
    public function isSortable(){
	return $this->sortable;
    }
    public function useFilter(){
	return $this->filter;
    }
    public function setLabel($label){
	$this->label = $label;
	return $this;
    }
    public function getLabel(){
	return $this->label;
    }
    public function getValue(){
	return $this->value;
    }
    public function setValue($value){
	$this->value = $value;
	return $this;
    }
    /**
     * if mandatory set to true, form will require this field to be filled
     * @param boolean $man
     * @return Provides fluent interface
     */
    public function setMandatory($man = true){
	$this->isMandatory = $man;
	return $this;
    }
    public function isMandatory(){
	return $this->isMandatory;
    }
    
    public function setUseInGrid($use = true){
	$this->useInGrid = $use;
	return $this;
    }
    public function useInGrid(){
	return $this->useInGrid;
    }
    public function setUseInForm($use = true){
	$this->useInForm = $use;
	return $this;
    }
    public function useInForm(){
	return $this->useInForm;
    }
    /**
     * Sets field as multilingual and registers it in parent component admin
     * @param boolean $isMulti
     * @return \Natty\AdminFramework\Fields\Field Fluent interface
     */
    public function setMultilingual($isMulti = true){
	$this->admin->registerMultilingualField($this);
	$this->isMultilinagual = $isMulti;
	return $this;
    }
    /**
     * @return boolean
     */
    public function isMultilingual(){
	return $this->isMultilinagual;
    }
    /**
     * Return function name for Nette\Application\UI\Form
     * @return string
     */
    public function getFormFunctionName(){
	return $this->formFunctionName;
    }
    /**
     * Sets name of the column in the database 
     * @param string $name 
     */
    public function setDatabaseName($name){
	$this->databaseName = $name;	
	return $this;
    }
    public function getDatabaseName(){
	return $this->databaseName;
    }
    public function setAsRowIdentificator(){
	$this->isRowIdentificator = true;
	$this->admin->gridSettings["rowIdentificator"] = $this;
    }
    public function isRowIdentificator(){
	return $this->isRowIdentificator;
    }
    public function setFormatting($formatting){
	$this->formatting = $formatting;
    }
    public function getFormatting(){
	return $this->formatting;
    }
     public function setDbFormatting($dbFormatting){
	$this->dbFormatting = $dbFormatting;
    }
    public function getDbFormatting(){
	return $this->dbFormatting;
    }
    public function formatForDb($value){
	return $value;
    }
    public function format($value){
	return $value;
    }
    public function setPicker($picker){
	$this->picker = $picker;
	return $this;
    }
    public function getPicker(){
	return $this->picker;
    }
}


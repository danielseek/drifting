<?php
/*
 * This file is part of the Natty CMS (http://nattycms.org), based on the Nette Framework (http://nette.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */

namespace Natty\AdminFramework\Fields;

use Nette;
use Grido\Components\Columns\Column;

/**
 * Description of Field
 *
 * @author Daniel Sýkora
 */
class Lang extends Field {
    protected $formFunctionName = "addSelect";
    
    protected $languages = Array();
    protected $defaultLanguage;
    public $label = "Jazyk";
    public $useInGrid = false;
    public function setupForm($formControl, $messages, $label) {
	parent::setupForm($formControl, $messages, $label);
	$formControl->setItems($this->getLanguages())
	->setDefaultValue($this->getDefaultLanguage());
    }
    public function setLanguages(array $languages) {
	$this->languages = $languages;
	return $this;
    }
    public function getLanguages(){
	return $this->languages;
    }
    public function setDefaultLanguage($defaultLanguage){
	if(!in_array($defaultLanguage, array_flip($this->languages))) 
		throw new \Nette\InvalidArgumentException("Language ".$defaultLanguage." is not set in languages array.");
	$this->defaultLanguage = $defaultLanguage;
	return $this;
    }
    public function getDefaultlanguage(){
	return $this->defaultLanguage;
    }
}


<?php
/*
 * This file is part of the Natty CMS (http://nattycms.org), based on the Nette Framework (http://nette.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */

namespace Natty\AdminFramework\Fields;

/**
 * Description of Textarea
 *
 * @author Daniel Sýkora <jsem@danielsykora.com>
 */
class Textarea extends Text {
    protected $formFunctionName = "addTextarea";
    public $useInGrid = false;
    /** @var boolean */
    public $useEditor = true;
    public function setupForm($formControl, $messages, $label) {
	parent::setupForm($formControl, $messages, $label);
	if($this->getUseEditor()){
	    $formControl->setAttribute('class', "ckeditor");
	}
    }
   /**
    * if set to true ckeditor class will be assigned to this element in form
    * @param boolean $use
    * @return \Natty\Fields\Textarea Provides fluent interface
    */
    public function setUseEditor($use = true) {
	$this->useEditor = $use;
	return $this;
    }
    public function getUseEditor(){
	return $this->useEditor;
    }
}


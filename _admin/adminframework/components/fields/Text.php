<?php

/*
 * This file is part of the Natty CMS (http://nattycms.org), based on the Nette Framework (http://nette.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */

namespace Natty\AdminFramework\Fields;
use Nette\Forms\Form;
use Nette;

/**
 * Description of TextField
 *
 * @author Daniel Sýkora <jsem@danielsykora.com>
 */
class Text extends Field {
    public $useInGrid = true;
    public $filter = true;
    public $sortable = true;
    public $maxLength;
    protected $formFunctionName = "addText";

    public function setupForm($formControl, $messages, $label) {
	parent::setupForm($formControl, $messages, $label);
	
	$length = $this->getMaxLength();
	if($length) $formControl->addRule(function ($control) use($length) {
	    return strlen($control->getValue()) > $length ? false : true;
		    
		    
		     
	}, sprintf($messages["maxLength"], $label,$length));
    }
    /**
     * max length for form restriction
     * @param int $len
     * @return Provides fluent interface
     */
    public function setMaxLength($len) {
	$this->maxLength = $len;
	return $this;
    }

    public function getMaxLength() {
	return $this->maxLength;
    }

}


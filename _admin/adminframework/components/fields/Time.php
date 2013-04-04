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
class Time extends Field {
    protected $formFunctionName = "addText";
    protected $picker = "timepicker";
    //For function date
    protected $formatting = "H:i";
    protected $dbFormatting = "H:i:s";
    public function setupForm($formControl, $messages, $label) {
	flog($formControl);
	parent::setupForm($formControl, $messages,$label);
	if($pickerClass = $this->getPicker()){//if not null
	    $formControl->setAttribute('class', $pickerClass);
	}
	//Check wheter is valid time
	$formControl->addRule(function ($control) {
	    $time = $control->getValue();
	    if (preg_match("~^([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$~", $time) ) {
		return true;
	     } else {
		return false;
	     }
	}, sprintf($messages["time"], $label,$formControl->getValue()));
    }

    public function format($value) {
	return date($this->getFormatting(), strtotime($value));
    }
    public function formatForDb($value){
	if(strlen($value) < 6) $value .= ":00";//otherwise minutes would be dealed as seconds
	return date($this->getDbFormatting(), strtotime($value));
    }
}


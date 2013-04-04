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
class Date extends Field {
    protected $formFunctionName = "addText";
    protected $picker = "datepicker";
    //For function date
    protected $formatting = "d.m.Y";
    protected $dbFormatting = "Ymd";
    public $sortable = true;

    public function setupForm($formControl, $messages, $label) {
	parent::setupForm($formControl, $messages,$label);
	if($pickerClass = $this->getPicker()){//if not null
	    $formControl->setAttribute('class', $pickerClass);
	}
	$formControl->addRule(function ($control) {
	    $postedDate = $control->getValue(); 
	    if ( preg_match("~^(0[1-9]|[1-2][0-9]|3[0-1]).(0[1-9]|1[0-2]).[0-9]{4}$~", $postedDate) ) {
		list($day , $month, $year) = explode('.',$postedDate); flog($control);
		return checkdate($month , $day , $year);
	     } else {
		return false;
	     }
	}, sprintf($messages["date"], $label, $formControl->getValue()));
    }
    public function format($value) {
	return date($this->getFormatting(), strtotime($value));
    }
    public function formatForDb($value){
	return date($this->getDbFormatting(), strtotime($value));
    }
}


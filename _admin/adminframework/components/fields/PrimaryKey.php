<?php

/*
 * This file is part of Natty CMS based on Nette (http://nattycms.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */
namespace Natty\AdminFramework\Fields;
use Nette\Application\UI\PresenterComponent;


/**
 * Description of PrimaryKey
 *
 * @author Daniel Sýkora <jsem@danielsykora.com>
 */
class PrimaryKey extends Field {
    const INTEGER = 1 , STRING = 2;
    protected $formFunctionName = "addHidden";
    public $useInGrid = true;
    public $sortable = true;
    public $useInForm = true;
    public $value = 0;
    public $label = "id";

}


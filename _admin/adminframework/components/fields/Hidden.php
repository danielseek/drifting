<?php

/*
 * This file is part of the Natty CMS (http://nattycms.org), based on the Nette Framework (http://nette.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */

namespace Natty\AdminFramework\Fields;

/**
 * Description of TextField
 *
 * @author Daniel Sýkora
 */
class Hidden extends Field {
    public $useInGrid = true;
    public $filter = true;
    public $sortable = true;
    
    protected $formFunctionName = "addHidden";
}


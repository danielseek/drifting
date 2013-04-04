<?php

/*
 * This file is part of Natty CMS based on Nette (http://nattycms.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */
namespace Natty;
use Natty\ContentComponent;
use Nette;
/**
 * Description of ContentComponentFactory
 *
 * @author Daniel Sýkora 
 */
class ContentFactory extends Nette\Object {
    protected $templateDir;
    public function __construct() {
	$this->templateDir = __DIR__."/templates";	
    }
    public function createArticles($articleRepository, $presenter, $name) {
	$component = new ContentComponent($articleRepository, $presenter, $name);
	$component->setTemplateFile($this->templateDir."/articles.latte");
	return $component;
    }
}


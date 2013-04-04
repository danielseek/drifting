<?php

/*
 * This file is part of Natty CMS based on Nette (http://nattycms.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */
namespace Natty;
use Nette;
/**
 * Description of NattyTranslator
 *
 * @author Daniel Sýkora 
 */
class NattyTranslator implements Nette\Localization\ITranslator
{
    /** @var array */ 
    protected $languages;
    /** @var String */ 
    protected $defaultLanguage;
    /** @var Natty\Repositories\LanguagesRepository */
    protected $repository;
    /**
     * Repository is simple no need for extra class, therefore using factory
     * @param \Natty\Natty\RepositoryFactory $factory
     */
    public function __construct(RepositoryFactory $factory) {
	$this->repository = $factory->createRepository("language");
    }
    /**
     * Translates the given string.
     * @param  string   message
     * @param  int      plural count
     * @return string
     */
    public function translate($message, $count = NULL)
    {
        return null;
    }
    public function getLanguages(){
	if(!$this->languages) $this->loadLanguages();
	return $this->languages;
    }
    protected function loadLanguages(){
	$all = $this->repository->getAll();
	$languages= array();
	foreach ($all as $language) {
	    $languages[$language->code] = $language->name;
	    if($language->is_default) $this->defaultLanguage = $language->code;
	}
	if(!$this->languages) $this->defaults();
    }
    public function getDefaultLanguage(){
	if(!$this->defaultLanguage or !$this->languages) $this->loadLanguages();
	return $this->defaultLanguage;
    }
    protected function defaults(){
	$this->languages = Array("cs"=>"Čeština");
	$this->defaultLanguage = "cs";
    }
}

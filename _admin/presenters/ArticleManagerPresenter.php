<?php
/*
 * This file is part of the Natty CMS (http://nattycms.org), based on the Nette Framework (http://nette.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */
namespace AdminModule;
use Natty;
use Nette\Application\UI\Form;
use Natty\ArticlesComponent;
use Natty\AdminFramework\Fields\Field;
/**
 * @author Daniel Sýkora
 */
class ArticleManagerPresenter extends Natty\Manager {
    /** @var \Natty\Repositories\ArticleRepository */
    protected $repository;
    public $menuId = 10;
    protected $headline = Array(
	"edit" => "Úprava článku",
	"add" => "Přidání nového článku",
	"default" => "Správa článků"
    );
    
    public function startup() {
        parent::startup();
	$this->repository = $this->context->articleRepository;
    }
    public function createComponentAdmin($name){
	$admin = new \Natty\AdminFramework\Admin($this, $name);
	
	$admin->setRepository($this->repository)
	    ->setPrimaryKey("primary")
	    ->setDatabaseName("article_translation.id");
	
	$admin->setMultilingualMode()
		->setDatabaseName("article_translation.lang")
		->setLanguages($this->languages)
		->setDefaultLanguage($this->defaultLanguage);
		
	$admin->addField("headline","Nadpis", Field::TYPE_TEXT)
		->setMandatory(true)
		->setMaxlength(200)
		->setMultilingual()
		->setAsRowIdentificator();
	$admin->addField("category","Rubrika", Field::TYPE_TEXT, true, true)
		->setMandatory(true)
		->setMultilingual();
	$admin->addField("perex","Úvod", Field::TYPE_TEXTAREA, false, true)
		->setUseEditor(true)
		->setMultilingual();
		
	$admin->addField("text", "Text článku", Field::TYPE_TEXTAREA, false, true)
		->setUseEditor(true)
		->setMultilingual();
	
	$admin->addField("created", "Vytvořeno", Field::TYPE_DATE, true, false)
		->setDatabaseName("created");
	$admin->addField("updated", "Poslední změna", Field::TYPE_DATE, true, false)
		->setDatabaseName("updated");
	
	$admin->addField("author", "Autor", Field::TYPE_TEXT, true, false)
		->setValue($this->user->id)
		->setDatabaseName("article.user.name");
	$admin->addField("user_id", "", Field::TYPE_HIDDEN, false, true)
		->setValue($this->user->id);
	$admin->addField("article_id", "", Field::TYPE_HIDDEN, false, true);
	return $admin;
    }
}
?>

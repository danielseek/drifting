<?php
namespace AdminModule;
use Nette\Security\User;
use Natty\Menu;
use Natty\DriftPanel;

/**
 * Base presenter for all frontend application presenters.
 */

abstract class BaseAdminPresenter extends \Nette\Application\UI\Presenter
{
	
	/** @persistent */
	public $backlink;
	
	/** @var \Nette\Database\Connection */
	protected $db;
	/** @var String */
	protected $languages;
	/** @var String */
	protected $defaultLanguage;
	public function getDefaultLanguage(){return $this->defaultLanguage;}


	protected $topMenuItems = Array(
	    Array(1,"Hlavní strana","Default"),

	    Array(10,"Správa článku","ArticleManager", 
		Array(
		    Array(11,"Přehled","ArticleManager:Default"),
		    Array(12,"Nový článek","ArticleManager:Add"),
		    Array(13,"Správa Rubrik","CategoryManager"),  
		)
	    ),
	    
	    Array(20,"Správa stránek","Default:maintenance"),
	    Array(25,"Správa obrázků","ImageManager:Default", 
		Array(
		    Array(26,"Přehled","ImageManager:Default"),
		    Array(27,"Nová galerie" ,"ImageManager:AddGallery"),  
		)
	    ),    
	    Array(28,"Správa videa","VideoManager"),
	    Array(60,"Kalendář","EventManager",
		Array(
		    Array(32,"Přehled" ,"EventManager"), 
		    Array(33,"Nová událost","EventManager:Add"),
 
		)
	    ),

	    
	    Array(40,"Správa pluginů","PluginManager"),
	    Array(50,"Správa bloků úvodní stránky","Default:maintenance"),
	);
	public function __call($name, $args) {
	    parent::__call($name, $args);
	}
        protected function startup()
        {
	    
            parent::startup();
	    $this->db = $this->context->database;
	    $this->languages = $this->context->nattyTranslator->getLanguages();
	    $this->defaultLanguage = $this->context->nattyTranslator->getDefaultLanguage();
	    //Authorization
	    if ($this->name != 'Admin:Auth') {
		if (!$this->user->isLoggedIn()) {
		    if ($this->user->getLogoutReason() === User::INACTIVITY) {
			$this->flashMessage('Byl jste příliš dlouho neaktivní, systém vás kvůli bezpečnosti odhlásil. Přihlašte se znovu.');
		    }
		    $this->redirect('Auth:login', array(
			'backlink' => $this->storeRequest()
		    ));

		} else {
		    if (!$this->user->isAllowed($this->name, $this->action)) {
			$this->flashMessage('Access denied');
			$this->redirect('Auth:login', array(
			'backlink' => $this->storeRequest()
			));
		    }
		}
	    }


	}

	/**
	 * Logout user
	 */
	public function handleLogout()
	{
	    $this->user->logOut();
	    $this->flashMessage('You were logged off.');
	    $this->redirect('this');
	}

        protected function createComponentTopMenu($name, $level = 0) {
	    $menu = new Menu($this,"topMenu");
	    $menu->id = "adminTopMenu";
	    $menu->minLevel = 0;
	    
	    $items = $this->topMenuItems;
	    $menu->fromArray($items, true);
	    
	    $actualUrl = $this->link('this');
	    $menu->selectByUrl($actualUrl);
	    
	    return $menu;
	}
	protected function createComponentDriftPanel($name) {
	    $p = new DriftPanel($this,$name);	  
	    return $p;
	}
	protected function createComponentSubMenu($name){
	    return new Menu($this, $name);
	}
        public function createComponentJs($name, $presenterFiles = Array()) {
            $files = new \WebLoader\FileCollection(WWW_DIR);
            // můžeme načíst i externí js
	    $files->addRemoteFile("//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js");
	    $files->addRemoteFile("//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js");
            $files->addFiles(array('js/netteForms.js', 'js/main.js', 'js/slideshow.js', "js/jquery.nette.js"));
	    $files->addFiles($presenterFiles);

            $compiler = \WebLoader\Compiler::createJsCompiler($files, WWW_DIR . '/webtemp');
	    // při development módu vypne spojování souborů
	    $dev = $this->context->parameters['developmentMode'];
	    $compiler->setJoinFiles($dev);
            return new \WebLoader\Nette\JavaScriptLoader($compiler, $this->template->basePath . '/webtemp');
        }
        public function createComponentCss($name,$presenterFiles = Array())
        {
            // připravíme seznam souborů
            // FileCollection v konstruktoru může dostat výchozí adresář, pak není potřeba psát absolutní cesty
            $files = new \WebLoader\FileCollection(WWW_DIR . '/admin/css');
            $files->addFiles(array(
                'signIn.css',
                'admin.css'
            ));
	    $files->addFiles($presenterFiles);


            // kompilátoru seznam předáme a určíme adresář, kam má kompilovat
            $compiler = \WebLoader\Compiler::createCssCompiler($files, WWW_DIR . '/webtemp');
	    // při development módu vypne spojování souborů
	    $dev = $this->context->parameters['developmentMode'];
	    $compiler->setJoinFiles($dev);
            // nette komponenta pro výpis <link>ů přijímá kompilátor a cestu k adresáři na webu
            return new \WebLoader\Nette\CssLoader($compiler, $this->template->basePath . '/webtemp');
        }
}


  
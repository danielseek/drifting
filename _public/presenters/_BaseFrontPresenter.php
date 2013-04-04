<?php
namespace FrontModule;
use Natty\Menu;
use Nette\Application\UI\Form;
/**
 * Base presenter for all frontend application presenters.
 */
/** @persistent(calendar, menu)*/
abstract class BaseFrontPresenter extends \Nette\Application\UI\Presenter
{
	/** @var \Nette\DI\Container */
	protected $config;
	/** @var Nette\Database\Connection */
	protected $db;
	protected $menusRep; 
	protected $contentFactory;
        protected $menuItems = Array(
            Array(1,"Domů","Homepage:Default"),
            Array(10,"Novinky", "Articles:Default"),
            Array(20,"Výsledky", "Drifting:Default"),  
            Array(30,"Jezdci & týmy"),  
            Array(40,"Kalendář", "Calendar:Default"),  
            Array(50,"Galerie"),  
            Array(60,"O driftu"),
            Array(70,"Fórum"),
        );
	protected $cssFiles = array(
	    "homepage.css","style.css", "sidepage.css"
	);
	protected $nblocks;
	protected $plugins;
        
	  public function formatLayoutTemplateFiles() {
	      $layout = $this->layout;
	    if($layout == "layout.public") {
		return array(ROOT_DIR.'/templates/'.$this->config["globalTemplate"].'/@layout.latte');
	    } else{
		return parent::formatLayoutTemplateFiles();
	    }
	}
        protected function startup()
        {
            parent::startup();
	    
	    $this->config = $this->context->getParameters();
	    $this->setLayout("layout.public");
	    $this->template->title = $this->config["title"];
	    
	    $this->plugins = $this->context->plugins;
	    $this->nblocks = $this->context->nblocks;
	    $this->menusRep = $this->context->menuRepository;

	    
	    $this->contentFactory = $this->context->contentFactory;
	    
        }
	protected function beforeRender() {
	}
    	protected function createComponentMenu($name) {
		$menu = new Menu($this,$name);
                //Loads menu data from model and assigns them to Menu in anonymous callback
                /*$data = $this->menusRep->getBy(Array("type"=>"mainmenu"));
                $menu->fromTable(
                    $data,
                    function($node, $row) {
                        $node->name = $row->name;
                        $node->link = $row->link;
                        $node->id = $row->id; // id polozky v menu
                        //What is the parent item, which actual item is classified to , czenglish >D
                        return $row->parent_id ? $row->parent_id : null;
                    }
                );*/
                $menu->fromArray($this->menuItems);
                $actualUrl = $this->link('this');
                $menu->selectByUrl($actualUrl);
		return $menu;
	}
	protected function createComponent($name) {
	    $component = parent::createComponent($name);
	    if ($component !== NULL) {
		return $component;
	    }
	    if($this->plugins->pluginExists($name)) {
		return $this->plugins->getComponent($this, $name);
	    }
	    if($this->nblocks->pluginExists($name)) {
		return $this->nblocks->getComponent($this, $name);
	    }
	    return NULL;
	}
        protected function createComponentLogin()
        {
            $form = new Form;
            $form->addText('name', 'Login:')
                ->addRule(Form::FILLED, 'Zadejte uživatelské jméno');
            $form->addPassword('password', 'Heslo:')
                ->addRule(Form::FILLED, 'Zadejte heslo');
            $form->addSubmit('send', 'Přihlásit se');
	    $form->addCheckbox('remember', 'Zapamatovat si mě.');
            $form->onSuccess[] = $this->processLoginForm;
            return $form;
        }
         /**
        * Process login form and login user
        * @param Nette\Application\UI\Form
        */
        public function processLoginForm(Form $form)
        {
            $values = $form->getValues(TRUE);
            try {
                $this->user->login($values['name'], $values['password']);
		if ($values["remember"]) {
			$this->getUser()->setExpiration('+ 14 days', FALSE);
		} else {
			$this->getUser()->setExpiration('+ 20 minutes', TRUE);
		}
                //$this->restoreRequest($this->backlink);
                $this->redirect('this');

            } catch (AuthenticationException $e) {
                $form->addError($e->getMessage());
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
        public function createComponentJs() {
            $files = new \WebLoader\FileCollection(WWW_DIR . '/js');
            // můžeme načíst i externí js
            $files->addRemoteFile('http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js');
            $files->addFiles(array('netteForms.js', 'main.js', 'slideshow.js'));

            $compiler = \WebLoader\Compiler::createJsCompiler($files, WWW_DIR . '/webtemp');

            return new \WebLoader\Nette\JavaScriptLoader($compiler, $this->template->basePath . '/webtemp');
        }
        public function createComponentCss()
        {
            // připravíme seznam souborů
            // FileCollection v konstruktoru může dostat výchozí adresář, pak není potřeba psát absolutní cesty
            $files = new \WebLoader\FileCollection(WWW_DIR . '/css');
            $files->addFiles($this->cssFiles);

            // kompilátoru seznam předáme a určíme adresář, kam má kompilovat
            $compiler = \WebLoader\Compiler::createCssCompiler($files, WWW_DIR . '/webtemp');

            // nette komponenta pro výpis <link>ů přijímá kompilátor a cestu k adresáři na webu
            return new \WebLoader\Nette\CssLoader($compiler, $this->template->basePath . '/webtemp');
        }
	//Registration of macro for shorter usage of homepage modules in latte templates
	public function templateRegisterFilters(Template $tpl) {
	    $tpl->registerFilter($latte = new Nette\Latte\Engine);
	    $set = Nette\Latte\Macros\MacroSet::install($latte->compiler);
	    $set->addMacro('nblock','$control->getComponent(%node.word)->render');
	}
}

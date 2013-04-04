<?php
namespace AdminModule;
/**
 * Description of AuthPresenter
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */

use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;

class AuthPresenter extends BaseAdminPresenter
{
    /** @persistent */
    public $backlink;


    /**
     * Login form factory
     * @return Nette\Application\UI\Form
     */
    protected function createComponentLoginForm()
    {
        $form = new Form;
        $form->addText('name', 'Uživatelské jméno:')
            ->addRule(Form::FILLED, 'Zadejte uživatelské jméno');
        $form->addPassword('password', 'Heslo:')
            ->addRule(Form::FILLED, 'Zadejte heslo');
        $form->addSubmit('send', 'Přihlásit se');

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
            $this->restoreRequest($this->backlink);
	    foreach(Array(
		 "Admin:ArticlesManager",
		 "Admin:GalleryManager",
		 "Admin:VideosManager",
		 'Default:default'
	     ) as $resource){
		 if($this->user->isAllowed($resource)){
		     $this->redirect($resource);  
		 }   
	     } throw new AuthenticationException("Nemáte práva pro tuto sekci administrace");

        } catch (AuthenticationException $e) {
            $form->addError($e->getMessage());
        }
    }

}
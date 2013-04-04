<?php
namespace AdminModule;
use Nette\Application\UI\Form;
use Natty\EventsComponent;
use Natty\Manager;
use Natty\AdminFramework\Fields\Field;
/**
 * Description of ArticleManager
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class EventManagerPresenter extends Manager {
    protected $repository;
    protected $eventType = Array(
	"race", "other"
    );
    protected $menuId = 60;
    public function startup() {
        parent::startup();
        $this->repository = $this->context->eventRepository;
    }
    public function createComponentAdmin($name){
	$admin = new \Natty\AdminFramework\Admin($this, $name);
	
	$admin//->setOnFormSubmitted(callback($this, 'formSubmitted'))
	    ->setRepository($this->repository)
	    ->setPrimaryKey("id")
	    ->setDatabaseName("event_translation.id");
	$admin->setMultilingualMode()
		->setLanguages($this->languages)
		->setDefaultLanguage($this->defaultLanguage);
		
	$admin->addField("name","Název akce:", Field::TYPE_TEXT)
		->setMandatory(true)
		->setMultilingual()
		->setAsRowIdentificator();
	
	$admin->addField("date_from","Datum začátku:", Field::TYPE_DATE)
		->setMandatory(true)
		->setDatabaseName("event.date_from");
	$admin->addField("time_from","Čas začátku:", Field::TYPE_TIME)
		->setMandatory(true)
		->setDatabaseName("event.time_from");
	$admin->addField("date_to","Datum konce:", Field::TYPE_DATE)
		->setMandatory(true)
		->setDatabaseName("event.date_to");

	$admin->addField("time_to","Čas konce:", Field::TYPE_TIME)
		->setMandatory(true)
		->setDatabaseName("event.time_to");
	
	$admin->addField("description","Popis akce:", Field::TYPE_TEXTAREA, false, true)
		->setMultilingual();
	
	$admin->addField("created", "Vytvořeno", Field::TYPE_DATE, true, false)
		->setDatabaseName("event.created");
	$admin->addField("updated", "Poslední změna", Field::TYPE_DATE, true, false)
		->setDatabaseName("event.updated");
	
	$admin->addField("author", "Autor", Field::TYPE_TEXT, true, false)
		->setValue($this->user->id)
		->setDatabaseName("event.user.name");
	$admin->addField("user_id", "", Field::TYPE_HIDDEN, false, true)
		->setValue($this->user->id);
	return $admin;
    }
}

?>

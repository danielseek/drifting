<?php
namespace FrontModule;
/**
 * Homepage presenter.
 */
class CalendarPresenter extends BaseFrontPresenter
{	
	protected $db;
	protected $racesRep;
	protected $eventsRep;
        protected function startup()
        {
            parent::startup();
	    $this->racesRep = $this->context->driftRacesRepository;
	    $this->eventsRep = $this->context->eventsRepository;
        }
	public function renderDefault()
	{
            $this->template->title = "Kaes praha sever";
        }
	public function renderShow(){
	    $this->renderDefault();
	}
	public function createComponentDriftRaces($name){
	    return new \Natty\DriftRacesComponent($this->racesRep, $this, $name);
	}
	public function createComponentEvents($name){
	    return new \Natty\EventsComponent($this->eventsRep, $this,$name);
	}
	//Implementation of creating components without using factory methods in the parrent class
	protected function createComponent($name) {
	    $component = parent::createComponent($name);

	    if ($component !== NULL) {
		return $component;
	    }
	    return NULL;
	}
}

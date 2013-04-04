<?php
namespace Natty;
use Natty\BaseContentComponent;
class EventsComponent extends BaseContentComponent {
    protected $eventsRepository;
    public function __construct(Repositories\EventsRepository $eventsRepository,\Nette\ComponentModel\IContainer $parent = NULL, $name = NULL) {
	parent::__construct($parent, $name);
	$this->eventsRepository = $eventsRepository;
    }    
    public function render(){
	$this->template->events = $this->eventsRepository->getAll();
	$this->template->setFile(__DIR__."/events.latte");
	parent::render();	
    }
}
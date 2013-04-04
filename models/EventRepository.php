<?php
namespace Natty\Repositories;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersRepository
 *
 * @author Daniel
 */
class EventRepository extends MultilingualRepository {
    protected $demandedKeys = "user_id, time_from, time_to, date_from, date_to";
    protected $allowedKeys = "user_id, updated, created, time_from, time_to, date_from, date_to";
    public function __construct(\Nette\Database\Connection $db){
	$table = "event";
	$translationTable = "event_translation";
	parent::__construct($db, $table,$translationTable);
	$this->setReferenceColumn("event_id");
	$this->translation->setDemandedKeys("event_id, name, lang");
	$this->translation->setAllowedKeys("event_id, lang, name, location, description");
    }
}
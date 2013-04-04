<?php
namespace Natty\Repositories;
use Nette;
/**
 * Description of MenuModel
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class DriftRaceRepository extends MultilingualRepository  {
    protected $demandedKeys = "user_id, time_from, time_to, date_from, date_to";
    protected $allowedKeys = "user_id, updated, created, time_from, time_to, date_from, date_to, status, is_current";
    public function __construct(\Nette\Database\Connection $db){
	$table = "drift_race";
	$translationTable = "drift_race_translation";
	parent::__construct($db, $table,$translationTable);
	$this->setReferenceColumn("event_id");
	$this->translation->setDemandedKeys("event_id, name, lang");
	$this->translation->setAllowedKeys("event_id, lang, name, track, location, description");
    }
}
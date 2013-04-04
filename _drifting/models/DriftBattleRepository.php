<?php
namespace Natty\Repositories;
use Nette;
/**
 * Description of MenuModel
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class DriftBattleRepository extends Repository  {
    public function __construct(\Nette\Database\Connection $db){
	$table = "drift_battles";
	    parent::__construct($db, $table);
    }
}
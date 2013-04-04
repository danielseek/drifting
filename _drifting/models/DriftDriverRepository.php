<?php
namespace Natty\Repositories;
use Nette;
/**
 * Description of MenuModel
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class DriftDriverRepository extends Repository  {
    public function __construct(\Nette\Database\Connection $db){
	$table = "drift_drivers";
	    parent::__construct($db, $table);
    }
}
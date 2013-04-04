<?php
namespace Natty\Repositories;
use Nette;
/**
 * Description of AdminMenuRepository
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class AdminMenuRepository {
    public function __construct(Nette\Database\Connection $db){
	$table = "admin_menu";
	parent::__construct($db, $table);
    }    
}

?>

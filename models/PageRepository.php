<?php
namespace Natty\Repositories;
use Nette;
/**
 * Description of MenuModel
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class PageRepository extends Repository  {
    public function __construct(\Nette\Database\Connection $db){
	$table = "pages";
	parent::__construct($db, $table);
    }
    public function createArticle($headline, $introduction, $text, $userId){
        $this->getTable()->insert(Array(
            "headline" =>$headline,
            "perex" => $introduction,
            "text" => $text,
            "user_id" => $userId
        ));
    }
}
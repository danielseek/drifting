<?php
namespace Natty\Repositories;
use Nette;
/**
 * Description of MenuModel
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class ArticleRepository extends MultilingualRepository  {
    
    protected $demandedKeys = "user_id";
    protected $allowedKeys = "user_id, image_url";
    public function __construct(\Nette\Database\Connection $db){
	$table = "article";
	$translationTable = "article_translation";
	parent::__construct($db, $table,$translationTable);
	$this->setReferenceColumn("article_id");
	$this->translation->setDemandedKeys("article_id, headline, perex");
	$this->translation->setAllowedKeys("article_id, lang, headline, perex, text");
    }
    public function getAllPublic($lang) {
	return $this->translation->getSelection()
		->select("article.*, article_translation.*, article.user.name AS author")
		->where("lang",$lang);
    }
    public function getAllAdmin($lang){
	parent::getAllPublic($lang);
    }
    /**
     * 
     * @param array $values Asociative array of values to be inserted. 
     *	    Demanded keys: lang, user_id, headline, perex. 
     *	    Accepted keys: lang, headline, perex, text, user_id, image_url
     * @return \Natty\Repositories\ArticlesRepository
     */
    public function addTranslation($lang,$articleId, $lang, $headline){
	
	return $this;
    }
}
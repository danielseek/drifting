<?php
namespace Natty\Repositories;
use Nette;

/**
 * This file is part of Natty CMS
 * @author Daniel Sykora (jsem@dsykora.cz)
 */

/* Ancestor of all models in app
 * Provides functionality to perform all basic CRUD interactions
 * 
 */

class Repository {
    const EXCEPTION_MISSING_VALUE = 1;
    /** @var Nette\Database\Connection */
    protected $db = NULL;    
    /**
     * Table name either to be overriden by child or set in constructor  
     * @var String
     */
    protected $table;
    protected $demandedKeys=Array();
    protected $allowedKeys=Array();
    protected $referencedRepositories = Array();
    public function __construct(\Nette\Database\Connection $db, $table = null) {
	$this->db = $db;
	$this->table = $table;
    }
    public function create(array $values, $checkDemandedKeys = true, $filterKeys = true){
	
	if($filterKeys and !empty($this->allowedKeys)){
	    $values = $this->filterArray($values, $this->allowedKeys);
	}
	if($checkDemandedKeys and !empty($this->demandedKeys)) {
	    $this->checkDemandedKeys($values, $this->demandedKeys);
	}
	$this->getSelection()->insert($values);
    }
    public function update($id, array $values, $checkDemandedKeys = true, $filterKeys = true){
	
	if($filterKeys and !empty($this->allowedKeys)){
	    $values = $this->filterArray($values, $this->allowedKeys);
	}
	if($checkDemandedKeys and !empty($this->demandedKeys)) {
	    $this->checkDemandedKeys($values, $this->demandedKeys);
	}
	flog($this);
	$this->getSelection()->get($id)->update($values);
    }
    
    public function setAllowedKeys($keys){
	$this->allowedKeys = $keys;
    }
    public Function getAllowedKeys(){
	return $this->allowedKeys;
    }
    public function setDemandedKeys($keys){
	if(is_string($keys)) $keys = explode (", ", $keys);
	$this->demandedKeys = $keys;
	return $this;
    }
    protected function checkDemandedKeys($values,$demanded){
	$keys = array_keys($values);
	if(is_string($demanded)) $demanded = explode (", ", $demanded);
	foreach ($demanded as $demandedKey){
	    if(!in_array($demandedKey, $keys)) throw new \ModelException("One of the demanded keys is not present:".$demandedKey,  
			Repository::EXCEPTION_MISSING_VALUE);
	}
	return true;
    }

    protected function filterArray($array, $allowedKeys) {
	if(is_string($allowedKeys)) $allowedKeys = explode (", ", $allowedKeys);
	return array_intersect_key($array, array_flip($allowedKeys));
    }
    public function getAllPublic($lang){
	return $this->getAll();
    }
	    
    /**
     * return all rows from the table
     * @return Nette\Database\Table\Selection
     */
    public function getAll()
    {
        return $this->getSelection();
	
    }
    public function getOne($id){
	return $this->getSelection()->where("id", $id)->fetch();
    }
    /**
     * Returns rows according to filter, e.g. array('name' => 'John').
     * @return Nette\Database\Table\Selection
     */
    public function getBy(array $by)
    {
        return $this->getSelection()->where($by);
    }
    public function delete($id){
	if($row = $this->getSelection()->where("id", $id)->fetch()) {
	    return $row->delete();
	}
	return null;
    }

    /**
     * Return object that represents database table 
     * @return Nette\Database\Table\Selection
     */
    public function getSelection(){
	if($this->table) {
	    return $this->db->table($this->table);
	} else throw new \MissingValueException ("Table name is not set in the model ".get_class ($this));
    }

    /**
     * Set table
     * @param String $tableName 
     */
    public function setTable($tableName){
	$this->table = $tableName;
    }
    public function getTableName(){
	return $this->table;
    }
    public function setPrefix($prefix){
	$this->prefix = $prefix;
    }
}

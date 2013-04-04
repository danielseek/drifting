<?php

/*
 * This file is part of Natty CMS based on Nette (http://nattycms.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */
namespace Natty\Repositories;
use Natty\Repositories\Relations;
/**
 * Description of MultilingualRepository
 *
 * @author Daniel Sýkora #<jsem@danielsykora.com>
 *  @todo  
 */
class RelationRepository extends Repository {
    
    /** @var Nette\Database\Table\Selection Description */
    public $translation;
    protected $referenceColumn;
    protected $related = Array();
    public function __construct(\Nette\Database\Connection $db, $table, $translationTable){
	$this->translation = New Repository($db, $translationTable);
	parent::__construct($db, $table);
    }
    public function setRelated($reference){
	$this->referencs = $reference;
    }
    public function getRelated(){
	return $this->related;
    }
    /** @todo  */
    public function getAllAdmin($lang) {
	$selection = $this->translation->getSelection();

		
    }
    /** @todo  */
    public function resolveRelations($selection) {
	foreach($this->related as $relation){
	    if($relation instanceof Relations\OneToManyRelation) {
		$relation->referenceColumn;
	    }
	}
    }
    public function create(array $values, $checkDemandedKeys = true, $filterKeys = true){
	flog($values);
	parent::create($values, $checkDemandedKeys, true);
	$values[$this->referenceColumn] = $this->db->lastInsertId();
	$this->translation->create($values, $checkDemandedKeys, $filterKeys);
	return $this;
    }
    public function update($primary,array $values,$checkDemandedKeys = true, $filterKeys = true){
	$this->translation->update($primary, $values, $checkDemandedKeys, $filterKeys);
	$row = $this->translation->getSelection()->select($this->referenceColumn)->get($primary);
	parent::update($row[$this->referenceColumn], $values, $checkDemandedKeys, $filterKeys);	
    }
    public function delete($id) {
	$selection = $this->translation->getSelection()
		->where($this->referenceColumn, $id);
	foreach($selection as $row) {
	    $row->delete();
	}
	parent::delete($id);
    }
    public function getOneAdmin($lang, $primary) {
	return $this->getAllAdmin($lang)->where($this->translation->getTableName()."."."id", $primary);
    }
      
    public function setReferenceColumn($name){
	$this->referenceColumn = $name;
    }
}


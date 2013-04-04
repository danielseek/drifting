<?php

/*
 * This file is part of Natty CMS based on Nette (http://nattycms.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */
namespace Natty;
use Natty\Repositories\Repository, Natty\Repositories\MultilingualRepository;
/**
 * Description of RepositoryFactory
 *
 * @author Daniel Sýkora 
 */
class RepositoryFactory {
    private $db;
    public function __construct(\Nette\Database\Connection $db) {
	$this->db = $db;
    }
    public function createRepository($table){
	return new Repository($this->db, $table);
    }
    public function createMultilingualRepository($table, $translationsTable){
	return new MultilingualRepository($this->db, $table, $translationsTable);
    }
}


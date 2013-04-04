<?php

/*
 * This file is part of Natty CMS based on Nette (http://nattycms.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */
namespace Natty;
use Nette\Object;
/**
 * Description of ModelFactory
 *
 * @author Daniel Sýkora <jsem@danielsykora.com>
 */
class ModelFactory extends Object  {
    /**  @var \Nette\Database\Connection */
    protected $db;
    /**
     * 
     * @param \Nette\Database\Connection $db
     */
    public function __construct(\Nette\Database\Connection $db) {
	$this->db = $db;
    }
    public function createRepository($table){
	$rep = new Repositories\Repository($db, $table);
	return $rep;
    }    
}


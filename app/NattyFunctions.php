<?php

/*
 * This file is part of Natty CMS based on Nette (http://nattycms.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */

/**
 * Statická třída implementující nejčastěji využívané funkce
 *
 * @author Daniel Sýkora <jsem@danielsykora.com>
 */
class Natty {
    static public function validateCallback($callback){
	if(!($callback instanceof \Nette\Callback)) {
            $callback = callback($callback);
        }
        return $callback;
    }
}


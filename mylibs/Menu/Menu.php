<?php

namespace Natty;
use \Nette\Application\UI\Control;
class Menu extends Control {
	public $id;
        public $separator = null;
	public $minLevel = 0;	
	protected $templateFile;
	
	protected $root = Array();
	protected $allNodes = Array();
        
        
	
	public function __construct(\Nette\ComponentModel\IContainer $parent = NULL, $name = NULL) {
		parent::__construct($parent, $name);
		$this->id = $name;
                $this->templateFile = __DIR__ . "/menu.latte";
	}
	public function __clone() {
	    parent::__clone();
	    
	}
	public function setTemplateFile($file){
	    $this->templateFile = $file;
	}
	/** @param Array multidimensional array of values, node => Array {"text", "link", "id"}*/
	public function fromArray(Array $array, $checkPermission = false){
	    $this->root = $this->arrayToNodes(null, $array, $checkPermission);
	}
	public function fromNodes($nodes){
	    $this->root = $nodes;
	    $this->findAllNodes();	    
	}
	protected function arrayToNodes ($parent, Array $array, $checkPermission = false) {
	    $nodesArray = Array();
            $i = 0; $total = count($array);
	    foreach($array as $item){
		$node = new MenuNode;
                
		$node->parent = $parent;
		$node->menu = $this;
                
                $node->isLeftest = ($i == 0) ? true : false;
                $node->isRightest = ($i == ($total-1)) ?  true : false;
                $i++;
                        
		if($checkPermission){
		    if($link = $this->checkPermission($item[2])){
			$node->link = $link;
		    } else continue;		    
		} else{
		    if(isset($item["link"])) {
			$node->link = $item["link"];
		    } elseif(isset($item[2])) {
			$node->link = $item[2];
		    }
		}
		if($node->link){
		    $node->url = $this->getUrl($node->link);
		}
		
		
                if(isset($item["id"])){
                    $node->id = $item["id"];
                } else $node->id = $item[0];
                if(isset($item["text"])) {
                    $node->text = $item["text"];  
                } else $node->text = $item[1];
		
		if(isset($item["children"])) {
		    $node->children = $this->arrayToNodes($node, $item["children"], $checkPermission);
		} elseif(isset($item["3"])) {
		    $node->children = $this->arrayToNodes($node, $item["3"], $checkPermission);
		} else $node->children = null;
		
		$nodesArray[$node->id] = $node;                
		$this->allNodes[$node->id] = $node;
                
	    }
	    return $nodesArray;
	}
        protected function checkPermission($resource){
		    if(FALSE === strpos($resource, ":")){                  
                        $module = "Admin";
                        $presenter = $resource;
                        $action = "Default";         
                        $link = $presenter.":".$action;
                    } elseif(preg_match('~(?P<presenter>[a-z0-9]+):(?P<action>[a-z0-9]+)~i', $resource, $match1)){
                        $module = "Admin";
                        $presenter = $match1["presenter"];
                        $action = $match1["action"];  
                        $link = $presenter.":".$action;
                    } elseif(preg_match('~(?P<module>[a-z0-9]+):(?P<presenter>[a-z0-9]+):(?P<action>[a-z0-9]+)~i', $resource, $match2)){
                        $module = $match2["module"];
                        $presenter = $match2["presenter"];
                        $action = $match2["action"];
                        $link = ":".$module.":".$presenter.":".$action;
                    } 

                    if($this->presenter->user->isAllowed($module.":".$presenter)){
                        return $link;                        
                    } return null;
	}
	protected function getUrl($link){
	    $param = is_array($link) ? $link : Array($link);
	    return call_user_func_array(array($this->presenter, 'link'), $param);
	}
	public function render($param = null){
	    $this->parseParam($param);
	    $template = $this->template;
            $template->id = $this->id;
            $template->separator = $this->separator;
	    $template->level = 0;
	    $template->root = $this->root;
	    $template->setFile($this->templateFile);
	    $template->render();
	}
	public function parseParam($param){
	    if(preg_match("~sep\((.*)\)~", trim($param), $matches)){
		$this->separator = $matches[1];
	    }
	}
	public function selectByUrl($url){
	    foreach($this->allNodes as $node){
            if(isset($node->url) and ($node->url == $url)){
		    $node->isSelected = true;
		}
	    }
	}
	public function getNodeById($id){
	    return isset($this->allNodes[$id]) ? $this->allNodes[$id] : null;
	}
	public function getMenuFromChildrenById($id, $name){
		if($node = $this->getNodeById($id)) {
		    
		    $menu = clone $this;
		    $menu->flush();
		    $menu->id = $name;
		    if($node->children) $menu->fromNodes($node->children);
		    return $menu;
		} else throw new \NotFoundException("Class: Natty\Menu . Node with id ".$id." not found.");
	}
	public function flush(){
	    $this->root = array();
	    $this->allNodes = Array();
	}
	public function findAllNodes($nodes = null){
	    $nodes = $nodes ? $nodes : $this->root;
	    foreach($nodes  as $node){
		$this->allNodes[$node->id] = $node;
		if($node->children){
		    $this->findAllNodes($node->children);
		}
	    }
	}
}

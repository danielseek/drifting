<?php
namespace Natty;
class MenuNode extends \Nette\Object {
	var $id;
	var $text;
	var $link; var $url;
	
	var $isSelected = false;
        var $isLeftest = false;
        var $isRightest = false;
	var $level;
	
	var $children = array();
	var $parent;
	var $menu;
}


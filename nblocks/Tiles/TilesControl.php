<?php
namespace Natty\HomeBlocks;
/**
 * Description of Tile
 *
 * @author Daniel Sykora (dunky.sykora@gmail.com)
 */
class TilesControl extends \BaseHomePlugin
{
    /**
     * @var Natty\Model
     */
    protected $model;
    
    public function __construct(\Nette\ComponentModel\IContainer $parent = NULL, $name = NULL){
	parent::__construct($parent, $name);
	$this->model = new TilesRepository($this->db);
    }
    public function render()
    {
	$template = $this->template;
	$template->tiles = $this->model->getAllOrdered();
	$template->setFile(__DIR__."/tiles.latte");
	$template->render();
    }
}

?>

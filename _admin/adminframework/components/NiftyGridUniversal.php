<?php

/*
 * This file is part of Natty CMS based on Nette (http://nattycms.org)
 *  Copyright (c) 2013 Daniel Sýkora (http://danielsykora.com)
 */
namespace Natty;
use \NiftyGrid\Grid;
use Natty\AdminFramework\Fields;
use Natty\AdminFramework\Fields\Field;

/**
 * Description of NiftyGridFactory
 *
 * @author Daniel Sýkora 
 */
class NiftyGridUniversal extends Grid {
    protected $selection;
    protected $settings;
    protected $fields;
    public function __construct($selection, $fields, $settings) {
        parent::__construct();
        $this->selection = $selection;
	$this->settings = $settings;
	$this->fields = $fields;
    }
    
    /**
     * @param Field $field
     * @param NiftyGrid\Components\Column $column
     */
    protected function assignFilter(&$field, &$column) {
	switch (get_class($field)) {
	    case Field::TYPE_TEXT: $column->setTextFilter();
		break;
	    case Field::TYPE_DATE: $column->setDateFilter();
		break;
	    case Field::TYPE_NUMERIC: $column->setNumericFilter();
		break;
	    default: $column->setTextFilter();
		break;
	}
    }
    protected function configure($presenter)
    {
	$this->templatePath = __DIR__."/NiftyGrid/templates/grid.latte";
	
	$this->setDefaultOrder($this->settings["defaultOrder"]);
	//settings for all types of columns
	foreach($this->fields as $field){
	    if($field->useInGrid()){ 
		$column = $this->addColumn($field->getName(), $field->getLabel());
		$column->setTableName($field->getDatabaseName());
		
		if(!$field->isSortable()) $column->setSortable(false);
		if($field->useFilter()) { $this->assignFilter($field, $column);}
		
		if($field->isRowIdentificator()) { 
		    $column->setRenderer(function($row) use ($presenter, $field){
			return \Nette\Utils\Html::el('a')->setText($row[$field->getName()])->href(
				$presenter->link("edit", $row['primary'])
			);	
		    });
		    
		}
		if($field->getFormatting()){//if formatting is not null
		    $column->setRenderer(function($row) use ($field) {
			return $field->format(
				$row[$field->getName()]
			);			
		    });
		}
	
	    }
	}

        //It is necessary to select id in the selection
        $source = new \NiftyGrid\DataSource\NDataSource($this->selection);
        $this->setDataSource($source);
	
	
	$self= $this; //for anonymous functions
	$presenter = $this->presenter;
	$this->addButton("edit", "Upravit")
	    ->setClass("edit")
	    ->setIcon("wrench")
	    ->setLink(function($row) use ($presenter){
		return $presenter->link("edit", $row['primary']);
	    });
	$this->addButton("delete", "Smazat")
	    ->setClass("delete")
	    ->setIcon("trash")
	    
	    ->setLink(function($row) use ($self){
		return $self->presenter->link("delete", $row['id']);
	    })->setConfirmationDialog(function($row) use($self) {
		return sprintf($self->settings["messages"]["delete"], 
			    $self->settings["contentName"],
			    $self->settings["contentName"], 
			    $row[$this->settings["rowIdentificator"]->getName()]);
	    });
	$this->addAction("delete","Smazat")
	    ->setCallback(function($id) use ($presenter){return $presenter->actionDelete($id);});
    }
}


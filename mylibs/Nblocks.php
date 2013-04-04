<?php
namespace Natty\Plugins;
/**
 * Description of HomePlugins
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class Nblocks extends Plugins {
    public function __construct($pluginsDir, $pluginList){
	$this->namespace = "\\Natty\\Nblocks\\";
	parent::__Construct($pluginsDir, $pluginList);
    }
}

?>

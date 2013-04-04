<?php
namespace Natty\Plugins;
/**
 * Description of Plugins
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class Plugins {
    /** */
    private $pluginsDir;
    protected $namespace = "\\Natty\\Plugins\\";
    /** Array of Plugin instances */
    protected $plugins = Array("whatever");
    
    public function __construct($pluginsDir, $pluginList){
	$namespace = $this->namespace;
	$this->pluginsDir = $pluginsDir;
	if(is_array($pluginList) and !empty ($pluginList)){
	    foreach($pluginList as $pluginName) {
		$pluginDir = ROOT.$pluginsDir."/";
		$className = ucfirst($pluginName);
		if(file_exists($xmlFile = $pluginDir.$pluginName.".xml")){
		    $plug = new Plugin();
		    $plug->name = $pluginName;
		    
		    $this->plugins[$pluginName] = $this->parsePluginXml($plug, $xmlFile);
		} elseif (class_exists($controlClass = $namespace.$className."Control")) {
		    $plug = new Plugin();
		    $plug->name = $pluginName;
		    $plug->controlClass = $controlClass;
		    $plug->adminControlClass = class_exists($adminControlClass = $namespace.$className."AdminControl") ? $adminControlClass : null;
		    $this->plugins[$pluginName] = $plug;
		} else {
		    throw new \PluginException("No xml file ($xmlFile) or Control class ($controlClass) found for plugin '$pluginName'.");
		}   
		
	    }
	} //else throw new \PluginException("Given list of plugins is empty or is not array. ".__CLASS__);
	
    }
    public function parsePluginXml(Plugin $plug, $filename){
	$xml = simplexml_load_file($filename);

	$plug->controlClass = $xml->install->controlClass;
	$plug->adminControlClass = $xml->install->adminControlClass;
	return $plug;
	
    }
    public function pluginExists($name){
	return isset($this->plugins[$name]);
    }
    public function getComponent($parent, $name){
	if($this->pluginExists($name)) {
	    return $this->plugins[$name]->getComponent($parent, $name);
	} throw new \PluginException("Plugin ".$name." does not exist.");
    }
    public function getAdminComponent($parent, $name){
	if(isset($this->plugins[$name])) {
	    return $this->plugins[$name]->getAdminComponent($parent, $name);
	} throw new \PluginException("Plugin ".$name." does not exist.");
    }
    public function getPluginDir(){
	
    }
    public function getPluginMenu(){
	
    }
}

?>

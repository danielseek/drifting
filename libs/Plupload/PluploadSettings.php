<?php

namespace Echo511\Plupload;

/**
 * This file is a part of Plupload component for Nette Framework.
 *
 * @author     Nikolas Tsiongas
 * @package    Plupload component
 * @license    New BSD License
 */
class PluploadSettings extends \Nette\Object
{
    //filters
    public $onlyImages = false;
    public $filters = "";
    // Runtimes we want to use
    private $runtimes = array('html5');

    // Max size of upload file
    private $maxFileSize = '10mb';

    // Max size of single chunk
    private $maxChunkSize = '5mb';


    /*********** Setters ***********/
    function setRuntimes(array $runtimes)
    {
        $possible = array('gears', 'flash', 'silverlight', 'browserplus', 'html5');
        foreach($runtimes as $runtime) {
            if(!in_array($runtime, $possible)) {
                throw new Exception('There is no runtime called: '.$runtime);
            }
        }
        $this->runtimes = $runtimes;
        return $this;
    }

    public function setMaxFileSize($expr)
    {
        $this->maxFileSize = $expr;
        return $this;
    }

    public function setMaxChunkSize($expr)
    {
        $this->maxChunkSize = $expr;
        return $this;
    }
    public function setOnlyImages($onlyImages){
	$this->onlyImages = $onlyImages;
	return $this;
    }
    public function addFilters($filters){
	$this->filters .= $filters;
	return $this;
    }
    public $token;
    public function setToken($token){
	$this->token = $token;
	return $this;
    }
    public function getToken(){
	return $this->token;
    }
    public $language;
    public function setLanguage($lang){
	$this->language = $lang;
	return $this;
    }
    public function getLanguage(){
	return $this->language;
    }
    /*********** Getters ***********/
    public function getRuntimes()
    {
        return implode(",", $this->runtimes);
    }

    public function getMaxFileSize()
    {
        return $this->maxFileSize;
    }

    public function getMaxChunkSize()
    {
        return $this->maxChunkSize;
    }
    public function getFilters(){
	if($this->onlyImages){
	    return "{ title : 'Image files', extensions : 'jpg,gif,png'}";
	} 
	return "{ title : 'Image files', extensions : '".$this->filters."'}";
    }

}
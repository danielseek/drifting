<?php
namespace api;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of apiBase
 *
 * @author Daniel
 */
class ApiBase {
    protected $apiKeys=Array("android123");
    protected $data = Array();
    public function checkApiKey($key){
	return in_array($key, $this->apiKeys) ? true : false;
    }
    public function sendHeaders(){
	header('Content-Type: application/json; charset=utf-8');	
    }
    public function setData($data){
	$this->data = $data;
    }
    public function json(){
	$this->sendHeaders();
	return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}

?>

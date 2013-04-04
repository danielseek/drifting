<?php
namespace Natty;
use Nette\Object;
class UploadedQueue extends Object
{

    
    private $session;

    public function __construct(\Nette\Http\Session $session)
    {
        $this->session = $session->getSection("uploadedQueue");
	unset($this->session->uploads);
    }

    public function addFinishedUpload($fileinfo, $token = 0)
    {
        $this->session->uploads[$token][] = $fileinfo;
        return $this;
    }

    public function getFinishedUploads($token = 0)
    {
        if(isset($this->session->uploads[$token])) return $this->session->uploads[$token] ;
	return null;
    }
    public function tokenExists($token){
	return isset($this->session->uploads[$token]);
    }
}


class PluploadProcessor extends Object
{
    const FILE_COLLISSION = 1;
    private $queue;
    public $uploadDir = "/upload/";
    public function __construct(UploadedQueue $queue)
    {
        $this->queue = $queue;
    }
    public function tokenExists($token){
	return $this->queue->tokenExists($token);
    }
    public function addFinishedUpload(\Nette\Http\FileUpload $upload, $token = 0)
    {
	if($fileinfo = $this->uploadFile($upload)) {
	    $this->queue->addFinishedUpload($fileinfo, $token);
	}
    }
    public function uploadFile(\Nette\Http\FileUpload $upload){
	$name = $upload->getSanitizedName();
	$url = $this->uploadDir.$name;
	$path = WWW_DIR.$url;
	if(!file_exists($path)){
	    try {
		$upload->move($path);
	    }catch (\Exception $e) {
		throw $e;
	    }
	} else {
	    throw new \UploadException("Soubor již existuje",PluploadProcessor::FILE_COLLISSION);
	    return null;
	}
	return Array("src"=> $path, "url"=>$url, "name" => $name);
    }
    public function fillForm(\Nette\Application\UI\Form $form, $token = 0)
    {
	$i=0;
	if($uploads = $this->queue->getFinishedUploads($token)) {
	    foreach($uploads as $fileinfo) {

		$form["files"][$i++]->setValues(Array(
		    "fileSrc"=>$fileinfo["src"],
		    "fileUrl"=>$fileinfo["url"],
		    "fileName"=>$fileinfo["name"]
		));
	    }
	}
    }
}
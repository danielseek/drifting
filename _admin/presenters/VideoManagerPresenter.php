<?php
namespace AdminModule;
use Nette\Application\UI\Form;
use Natty\ArticlesComponent;
/**
 * Description of ArticleManager
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
class VideoManagerPresenter extends BaseAdminPresenter {
    protected $articlesRepository;
    public function startup() {
        parent::startup();
        $this->galleryRepository = $this->context->articlesRepository;
    }
    //image upload
    public function createComponentPlupload()
    {
	// Main object
	$uploader = new Echo511\Plupload\Rooftop();

	// Use magic for loading Js and Css?
	// $uploader->disableMagic();

	// Configuring paths
	$uploader->setWwwDir(WWW_DIR) // Full path to your frontend directory
		 ->setBasePath($this->template->basePath) // BasePath provided by Nette
		 ->setTempLibsDir(WWW_DIR . '/tools/PluUpload'); // Full path to the location of plupload libs (js, css)

	// Configuring plupload
	$uploader->createSettings()
		 ->setRuntimes(array('html5')) // Available: gears, flash, silverlight, browserplus, html5
		 ->setMaxFileSize('1000mb')
		 ->setMaxChunkSize('1mb'); // What is chunk you can find here: http://www.plupload.com/documentation.php

	// Configuring uploader
	$uploader->createUploader()
		 ->setTempUploadsDir(WWW_DIR . '/tools/PluUpload/temp') // Where should be placed temporaly files
		 ->setToken("PU") // Resolves file names collisions in temp directory
		 ->setOnSuccess(array($this, 'fileUploaded')); // Callback when upload is successful: returns Nette\Http\FileUpload

	return $uploader->getComponent();
    }
    public function fileUploaded(Nette\Http\FileUpload $fileUpload){
	
    }
    protected function createComponentSubMenu($name) {
	return $this['topMenu']->getMenuFromChildrenById(10, $name);
    }
}

?>

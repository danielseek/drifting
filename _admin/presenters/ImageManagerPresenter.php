<?php
namespace AdminModule;
use Nette\Application\UI\Form;
use Natty\GalleriesComponent;
use Natty\PluploadProcessor;
/**
 * Description of GalleryManagerPresenter
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
/**
 * @persistent(imageForm)
 */
class ImageManagerPresenter extends BaseAdminPresenter {
    protected $galleriesRepository;
    /** @persistent */
    public $uploadedImages = Array();
    /** @persistent */
    public  $imageCounter = 1;
    public function startup() {
        parent::startup();
        $this->galleriesRepository = $this->context->galleriesRepository;
    }

    //image upload
    private $pluploadProcessor;
    public function injectPluploadProcessor(PluploadProcessor $pluploadProcessor)
    {
	$pluploadProcessor->uploadDir .= "img/";
        $this->pluploadProcessor = $pluploadProcessor;
    }
    private $token = null;
    private function getToken(){
	if($this->token === null){
	    do {
		$token = rand(0, 9999999);
	    } while($this->pluploadProcessor->tokenExists($token));
	    $this->token = $token; 
	}
	return $this->token;
    }
    public function imageFormSubmitted(Form $form){
	$vals = $form->getValues();
    }

    public function renderAddGallery(){
	$t = $this->template;
	$t->_form = $this["imageForm"];
	$t->token = $this->token;
	$this->template->uploadedImages = $this->uploadedImages;
    }
    /** @persistent(imageForm) */
    public function createComponentImageForm(){
	$f = new Form;
	$f->getElementPrototype()->addAttributes(Array("class"=>"formee"));
	$f->addText("name", "Název galerie");
	$f->addDynamic("files", function(\Nette\Forms\Container $file){
	    $file->addHidden("fileSrc");
	    $file->addHidden("fileUrl");
	    $file->addText("fileName", "Název:");
	});
	$f->addSubmit("send", "Vytvořit galerii a uložit soubory");
	$f->onSuccess[] = $this->imageFormSubmitted;
	return $f;
    }

    public function createComponentPlupload($name)
    {
	// Main object
	$uploader = new \Echo511\Plupload\Rooftop();

	// Use magic for loading Js and Css?
	$uploader->disableMagic();

	// Configuring paths
	$uploader->setWwwDir(WWW_DIR) // Full path to your frontend directory
		 ->setBasePath($this->template->basePath) // BasePath provided by Nette
		 ->setTempLibsDir(WWW_DIR . '/tools/PluUpload'); // Full path to the location of plupload libs (js, css)

	// Configuring plupload
	$token = $this->getToken();
	\flog($token);
	$uploader->createSettings()
		 ->setRuntimes(array('html5',  'flash')) // Available: gears, flash, silverlight, browserplus, html5
		 ->setMaxFileSize('1000mb')
		 ->setMaxChunkSize('2mb') // What is chunk you can find here: http://www.plupload.com/documentation.php
		 ->setOnlyImages(true)
		 ->addFilters("")
		 ->setToken($token)
		->setLanguage('cs');
	// Configuring uploader
	$uploader->createUploader()
		 ->setTempUploadsDir(WWW_DIR . '/tools/PluUpload/temp') // Where should be placed temporaly files
		 ->setToken() // Resolves file names collisions in temp directory
		 ->setOnSuccess(callback($this, 'onFileUploaded')); // Callback when upload is successful: returns Nette\Http\FileUpload

	return $uploader->loadComponent($this,$name);
    }
    public function onFileUploaded(\Nette\Http\FileUpload $upload, $token = 0)
    {	
	flog($token);
	if($upload->isImage()) {
	    try {
	    $this->pluploadProcessor->addFinishedUpload($upload, $token);
	    } catch(\UploadException $e){
		if($e->getCode() == PluploadProcessor::FILE_COLLISSION){
		    $this['imageForm']->addError('Soubor s názvem "'.$upload->getName()."\" již existuje. Pokud jej opravdu chcete nahrát, přejmenujte jej.");
		}
	    } catch(\StateException $e){
		    $this['imageForm']->addError('Soubor s názvem "'.$upload->getName()."\" nemohl být nahrán.");		
	    }
	    $this->pluploadProcessor->fillForm($this['imageForm'], $token);

	} else {
	   $this['imageForm']->addError('Soubor s názvem "'.$upload->getName()."\" není obrázek.");
	}
	$this->invalidateControl(); // ajax
    }
    public function handleFileInputDelete($id){
	unset($this["imageForm"]["files"][$id]);
	$this->invalidateControl(); // ajax
    }
    protected function createComponentGalleries($name){
	return new GalleriesComponent($this->galleriesRepository,$this,$name);
    }

    protected function createComponentSubMenu($name) {
	return $this['topMenu']->getMenuFromChildrenById(25, $name);
    }
    public function createComponentCss($name,$presenterFiles = Array()) {
	return parent::createComponentCss($name, Array());
    }
    public function createComponentJs($name,$presenterFiles = Array()) {
	return parent::createComponentJs($name, Array());
    }
}

?>

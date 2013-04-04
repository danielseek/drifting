<?php //netteCache[01]000396a:2:{s:4:"time";s:21:"0.84269200 1364925990";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:74:"C:\Users\Daniel\Documents\GitHub\drifting\templates\drifting\@layout.latte";i:2;i:1364918233;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\Users\Daniel\Documents\GitHub\drifting\templates\drifting\@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'qs12lbb1fg')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block scripts
//
if (!function_exists($_l->blocks['scripts'][] = '_lb5d8fa083ae_scripts')) { function _lb5d8fa083ae_scripts($_l, $_args) { extract($_args)
?>		<script src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.js"></script>
		<script src="<?php echo htmlSpecialChars($basePath) ?>/js/netteForms.js"></script>
		<script src="<?php echo htmlSpecialChars($basePath) ?>/js/main.js"></script>
<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="cs">
	<head>
	    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	    <meta name="description" content="" />
<?php if (isset($robots)): ?>	    <meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>" />
<?php endif ?>
	    <title><?php echo Nette\Templating\Helpers::escapeHtml($title, ENT_NOQUOTES) ?></title>

<?php $_ctrl = $_control->getComponent("css"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
	    <!--[if lte IE 7]>
		<link rel="stylesheet" href="<?php echo Nette\Templating\Helpers::escapeHtmlComment($basePath) ?>/css/ie.css" type="text/css" />
	    <![endif]-->
        </head>
	<body>	
<?php if ($user->isLoggedIn()): ?>
                    <div id="topStripe" class="" ><div class="in clearfix">
			 <div id="user">
				Přihlášený uživatel <em><?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->login, ENT_NOQUOTES) ?>
</em> (<a href="<?php echo htmlSpecialChars($_control->link("logout!")) ?>">logout</a>)
			 </div>
			  
	
                    </div></div>
<?php endif ?>
		<div id="page">
		    <span id="header"></span>
		    <h1>Czech Drift Series</h1>

		    <div class="wrapper">
				<div id="mainmenu">
<?php $_ctrl = $_control->getComponent("menu"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
				</div>
				<div id="partners">
				    <div class="in">
<?php $_ctrl = $_control->getComponent("partners"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
				    </div>
				</div>
				
				<div id="content">
				    <div class="in clearfix">
					<span id="share"></span>
<?php try { $_presenter->link("Homepage:default"); } catch (Nette\Application\UI\InvalidLinkException $e) {}; if ($_presenter->getLastCreatedRequestFlag("current")): Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ;else: ?>
					    <div id="container" class="rounded border-trans">
						<div class="in">
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
						</div>
					    </div>
<?php endif ?>
				    </div>	
					<div id="footer" class="rounded-top border-trans">
					    <div class="left">
					    <a href="<?php echo htmlSpecialChars($_control->link(":Admin:Default:default")) ?>">Vstoupit do administrace</a> | Design: <a target="_blank" href="">Daniel Sýkora</a>
					    </div>
					    <div class="right">
 <span class='st_facebook_large' displayText='Facebook'></span>
    <span class='st_googleplus_large' displayText='Google +'></span>
    <span class='st_twitter_large' displayText='Tweet'></span>
    <span class='st_email_large' displayText='Email'></span>
    <span class='st_youtube_large' displayText='Youtube Subscribe' st_username='czechdriftseries'></span>

    <div>
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "b422efba-56c8-417d-887f-1749e24c9694", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
    </div>
					    </div>
					</div>
				</div>

		    </div>
		</div>
                <!-- scripts -->
<?php $_ctrl = $_control->getComponent("js"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ;if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['scripts']), $_l, get_defined_vars())  ?>
	</body>
</html>

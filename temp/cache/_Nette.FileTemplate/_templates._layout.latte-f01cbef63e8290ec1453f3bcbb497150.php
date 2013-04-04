<?php //netteCache[01]000394a:2:{s:4:"time";s:21:"0.40083600 1365007282";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:72:"C:\Users\Daniel\Documents\GitHub\drifting\_admin\templates\@layout.latte";i:2;i:1365007166;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\Users\Daniel\Documents\GitHub\drifting\_admin\templates\@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'jszi197eug')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb98ebd9dc08_title')) { function _lb98ebd9dc08_title($_l, $_args) { extract($_args)
;
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb160afb1522_head')) { function _lb160afb1522_head($_l, $_args) { extract($_args)
;
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
<!DOCTYPE html>
<html>
	<head>
	    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	    <meta name="description" content="Administration Natty CMS" />
	    <title><?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?></title>
	    <?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>

            
	    <!-- css -->

	

	    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.8/themes/base/jquery-ui.css" type="text/css" media="all" /> 
	    <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" /> 
 	    <!--<link rel="stylesheet" href="/tools/PluUpload/css/jquery.plupload.queue.css">-->
	    <link rel="stylesheet" href="/tools/PluUpload/css/jquery.ui.plupload.css" />
	    <link rel="stylesheet" href="/tools/PluUpload/css/jquery.ui.plupload.css" />
	    <link rel="stylesheet" href="/css/universal.css" />
	    <link rel="stylesheet" href="/tools/bootstrap/css/bootstrap.min.css" />
	    <link rel="stylesheet" href="/tools/bootstrap/css/bootstrap-responsive.min.css" />
	    <link rel="stylesheet" href="/tools/grido/grido.css" />
	    <link rel="stylesheet" href="/admin/css/forms.css" />
	    
	    
		<script type="text/javascript" src="/tools/ckeditor/ckeditor.js"></script>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="/tools/PluUpload/js/plupload.full.js"></script>
		<script type="text/javascript" src="/tools/PluUpload/js/jquery.ui.plupload.js"></script>
		<script type="text/javascript" src="/tools/PluUpload/js/jquery.ui.plupload.js"></script>
		
		<script type="text/javascript" src="/tools/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/tools/grido/jquery.hashchange.min.js"></script>
		<script type="text/javascript" src="/tools/grido/typeahead.js"></script>
		<script type="text/javascript" src="/tools/grido/jquery.grido.js"></script>
		<script type="text/javascript" src="/js/utils.js"></script>
		<script type="text/javascript" src="/js/jquery.nette.js"></script>
		<script type="text/javascript" src="/js/netteForms.js"></script>
		<script type="text/javascript" src="/js/main.js"></script>
<?php $_ctrl = $_control->getComponent("css"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
	
		
	    

        </head>
	<body>


<?php if ($user->isLoggedIn()): ?>

	<div id="topPanel" class="clearfix">
	    <div id="topMenu" class="gradient-black">
<?php $_ctrl = $_control->getComponent("topMenu"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render("sep( | )") ?>
	    </div>
	    <div id="user">
		logged as <em><?php echo Nette\Templating\Helpers::escapeHtml($user->getIdentity()->login, ENT_NOQUOTES) ?>
</em> (<a href="<?php echo htmlSpecialChars($_control->link("logout!")) ?>">logout</a>)
	    </div>
	</div>
	    <div id="sideBar">
<?php $_ctrl = $_control->getComponent("driftPanel"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render() ?>
	    </div>
	<div id="content">
	    <div class="subMenu clearfix">
<?php $_ctrl = $_control->getComponent("subMenu"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->render("sep()") ?>
	    </div>
	    <div id="flashes">
<?php $iterations = 0; foreach ($flashes as $flash): ?>
		<div class="flash <?php echo htmlSpecialChars($flash->type) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach ?>
	    </div>
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParameters()) ?>
        </div>
	
<?php else: ?>
    <p>You are not logged in.</p>
<?php endif ?>
	    <!-- scripts -->

		<script type="text/javascript">

		</script>
	</body>
</html>

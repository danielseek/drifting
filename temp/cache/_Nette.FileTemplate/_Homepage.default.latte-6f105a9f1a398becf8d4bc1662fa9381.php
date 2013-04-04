<?php //netteCache[01]000404a:2:{s:4:"time";s:21:"0.02584100 1364925272";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:82:"C:\Users\Daniel\Documents\GitHub\drifting\_public\templates\Homepage\default.latte";i:2;i:1364678277;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\Users\Daniel\Documents\GitHub\drifting\_public\templates\Homepage\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'k3r4ip9w46')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb967097c163_content')) { function _lb967097c163_content($_l, $_args) { extract($_args)
?><div id="homepage">
    <div id="leftColumn" class="rounded border-trans">
	<div class="in">
	    <div class="headline"><h3>Novinky</h3></div>
	    <div id="news">
<?php $_ctrl = $_control->getComponent("news"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->validateControl(); $_ctrl->renderHome(2) ?>
	    </div>
	    <div id="left">
		<div class="headline"><h3>Kalendář závodů</h3></div>
	    </div>
	    <div id="right">
<?php if ($raceTakesPlace): ?>
		
<?php else: ?>
		    <div class="headline"><h3>Poslední závod</h3></div>
		    <div id="raceResults">
		    </div>
		    <div class="headline"><h3>Aktuální pořadí</h3></div>
		    
<?php endif ?>
	    </div>
	</div>
    </div>
    <div id="rightColumn" class="shadow">
	 <div class="login">			
<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("login") ? "login" : $_control["login"]), array()) ?>
		<h3>Přihlásit se:</h3>
		<table>
		    <tr>
			<td><?php $_input = is_object("name") ? "name" : $_form["name"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?></td>
			<td><?php $_input = (is_object("name") ? "name" : $_form["name"]); echo $_input->getControl()->addAttributes(array()) ?></td>
		    </tr>
		    <tr>
			<td><?php $_input = is_object("password") ? "password" : $_form["password"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?></td>
			<td><?php $_input = (is_object("password") ? "password" : $_form["password"]); echo $_input->getControl()->addAttributes(array()) ?></td>
		    </tr>
		    <tr>
			<td colspan=2><?php $_input = (is_object("remember") ? "remember" : $_form["remember"]); echo $_input->getControl()->addAttributes(array()) ;$_input = is_object("remember") ? "remember" : $_form["remember"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?></td>			
		    </tr>
		    <tr>
			<td><?php $_input = is_object("send") ? "send" : $_form["send"]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?></td>
			<td><?php $_input = (is_object("send") ? "send" : $_form["send"]); echo $_input->getControl()->addAttributes(array()) ?></td>
		    </tr>
		</table>	
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ?>
	</div>
	<div class="border rounded shadow">
	    <iframe src="http://player.vimeo.com/video/59300629" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" frameborder="0" height="300" width="500"></iframe>
	</div>
	<div class="headline">
	    <span class="decoration">
	    <h3>Nejaktuálější video</h3>
	</div>
	<div class="border rounded shadow">
	</div>
	<div class="headline">
	    <span class="decoration">
	    <h3>Poslední galerie</h3>
	</div>
	<div class="facebookBox">
	    <div class="fb-like-box" data-href="http://www.facebook.com/pages/Czech-Drift-Series/121883761163110?ref=ts&amp;fref=ts" data-width="300" data-height="340" data-show-faces="false" data-colorscheme="dark" data-stream="true" data-border-color="#d8731e" data-header="true"></div>
	</div>
	<div class="headline rounded-bot">
	    <span class="decoration">
	    <h3>CDS na facebooku</h3>
	</div>
	
    </div>
</div>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/cs_CZ/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 
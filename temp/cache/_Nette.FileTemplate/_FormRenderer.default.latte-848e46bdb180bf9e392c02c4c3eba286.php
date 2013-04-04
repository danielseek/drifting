<?php //netteCache[01]000424a:2:{s:4:"time";s:21:"0.43944200 1365007562";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:101:"C:\Users\Daniel\Documents\GitHub\drifting\_admin\adminframework\components\FormRenderer\default.latte";i:2;i:1365007560;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\Users\Daniel\Documents\GitHub\drifting\_admin\adminframework\components\FormRenderer\default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '8qsquaz3e6')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbb77e5bb660_content')) { function _lbb77e5bb660_content($_l, $_args) { extract($_args)
;Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = (is_object("form") ? "form" : $_control["form"]), array()) ?>
    <fieldset>
<?php if ($form->hasErrors()): ?>	<div class="formee-msg-warning">
	    <ul>
<?php $iterations = 0; foreach ($form->errors as $error): ?>		<li><?php echo Nette\Templating\Helpers::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; endforeach ?>
	    </ul>

	</div>
<?php endif ;if ($useTable): ?>
	    <table class="form-table">
<?php $iterations = 0; foreach ($form->controls as $name => $field): ?>		<tr>
		    <?php if ($form[$name]): endif ?>

		    <td class="my-label"><?php $_input = is_object($name) ? $name : $_form[$name]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?><td>
		    <td><?php $_input = (is_object($name) ? $name : $_form[$name]); echo $_input->getControl()->addAttributes(array()) ?></td>
		</tr>
<?php $iterations++; endforeach ?>
	    </table>
<?php else: $iterations = 0; foreach ($form->controls as $name => $field): ?>	<div class="form-box">
		<?php if ($form[$name]): endif ?>

		<th><?php $_input = is_object($name) ? $name : $_form[$name]; if ($_label = $_input->getLabel()) echo $_label->addAttributes(array()) ?><th>
		<td><?php $_input = (is_object($name) ? $name : $_form[$name]); echo $_input->getControl()->addAttributes(array()) ?></td>
	    </div>
<?php $iterations++; endforeach ;endif ?>
    </fieldset>
<?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form) ;
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
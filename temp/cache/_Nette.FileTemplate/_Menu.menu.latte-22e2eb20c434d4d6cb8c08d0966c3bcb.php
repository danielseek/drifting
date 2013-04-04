<?php //netteCache[01]000386a:2:{s:4:"time";s:21:"0.39154200 1364926028";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:64:"C:\Users\Daniel\Documents\GitHub\drifting\mylibs\Menu\menu.latte";i:2;i:1364678509;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\Users\Daniel\Documents\GitHub\drifting\mylibs\Menu\menu.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '5cezf35zpe')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block node
//
if (!function_exists($_l->blocks['node'][] = '_lb33ad437bf5_node')) { function _lb33ad437bf5_node($_l, $_args) { extract($_args)
;if ($node): if ($node->children): ?>
		<li class="<?php echo htmlSpecialChars($node->isSelected ? 'selected':null) ?>">
<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'link', array('node' => $node) + $template->getParameters()) ;$level++ ?>
		    <ul class="level-<?php echo htmlSpecialChars($level) ?>">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($node->children) as $subNode): call_user_func(reset($_l->blocks['node']), $_l, array('node' => $subNode) + get_defined_vars()) ;$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
		    </ul>
<?php $level-- ?>
		</li>
<?php else: ?>
		<li class="<?php echo htmlSpecialChars($node->isSelected ? 'selected':null) ?>
"><?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'link', array('node' => $node) + $template->getParameters()) ?></li>
                
<?php endif ;endif ;
}}

//
// block link
//
if (!function_exists($_l->blocks['link'][] = '_lb437746d3fe_link')) { function _lb437746d3fe_link($_l, $_args) { extract($_args)
?><a href="<?php echo htmlSpecialChars(isset($node->url) ? $node->url : "#") ?>"><?php echo Nette\Templating\Helpers::escapeHtml($node->text, ENT_NOQUOTES) ?>
</a><?php
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
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); } ?>

<ul id="<?php echo htmlSpecialChars($id) ?>">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($root) as $node): call_user_func(reset($_l->blocks['node']), $_l, array('node' => $node) + get_defined_vars()) ?>
	<?php if (!$iterator->isLast()): ?><span class="separator"><?php echo Nette\Templating\Helpers::escapeHtml($separator, ENT_NOQUOTES) ?>
</span><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
</ul>
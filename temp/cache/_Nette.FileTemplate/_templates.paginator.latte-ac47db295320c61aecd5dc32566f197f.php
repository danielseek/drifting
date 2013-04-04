<?php //netteCache[01]000433a:2:{s:4:"time";s:21:"0.70656200 1364928162";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:110:"C:\Users\Daniel\Documents\GitHub\drifting\_admin\adminframework\components\NiftyGrid\templates\paginator.latte";i:2;i:1364857646;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\Users\Daniel\Documents\GitHub\drifting\_admin\adminframework\components\NiftyGrid\templates\paginator.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'nljai3255o')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if ($paginator->pageCount > 1): ?>
<div class="grid-paginator">
<?php $iterations = 0; foreach (range($paginator->getBase(), $paginator->getPageCount()) as $page): $iterations++; endforeach ;if (!$paginator->isFirst()): ?>
		<a href="<?php echo htmlSpecialChars($_control->link("this", array('page' => $paginator->getFirstPage()))) ?>" class="grid-ajax">&lt;&lt;</a>
<?php else: ?>
		<span>&lt;&lt;</span>
<?php endif ;if ($paginator->getPage() - 1 >= $paginator->getFirstPage()): ?>
		<a href="<?php echo htmlSpecialChars($_control->link("this", array('page' => $paginator->getPage() - 1))) ?>" class="grid-ajax">&lt;</a>
<?php else: ?>
		<span>&lt;</span>
<?php endif ?>
	<span class="grid-current" data-lastpage="<?php echo htmlSpecialChars($paginator->getLastPage()) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($paginator->getPage(), ENT_NOQUOTES) ?></span>
<?php if ($paginator->getPage() + 1 <= $paginator->getLastPage()): ?>
		<a href="<?php echo htmlSpecialChars($_control->link("this", array('page' => $paginator->getPage() + 1))) ?>" class="grid-ajax">&gt;</a>
<?php else: ?>
		<span>&gt;</span>
<?php endif ;if (!$paginator->isLast()): ?>
		<a href="<?php echo htmlSpecialChars($_control->link("this", array('page' => $paginator->getLastPage()))) ?>" class="grid-ajax">&gt;&gt;</a>
<?php else: ?>
		<span>&gt;&gt;</span>
<?php endif ?>
</div>
<?php endif ;
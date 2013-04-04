<?php //netteCache[01]000395a:2:{s:4:"time";s:21:"0.40561700 1364926028";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:73:"C:\Users\Daniel\Documents\GitHub\drifting\nblocks\Partners\partners.latte";i:2;i:1362832519;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"0ce871c released on 2012-11-28";}}}?><?php

// source file: C:\Users\Daniel\Documents\GitHub\drifting\nblocks\Partners\partners.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '4ghdp0jb5m')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
$dir = WWW_DIR."/img/partners" ;$iterations = 0; foreach (Nette\Utils\Finder::findFiles('*')->in($dir) as $file): $link = str_replace("\\","/",str_replace(WWW_DIR,"",$file->getPathname())) ?>
    <img src="<?php echo htmlSpecialChars($link) ?>" alt="<?php echo htmlSpecialChars($file->getFilename()) ?>
" title="<?php echo htmlSpecialChars($file->getFilename()) ?>" />
<?php $iterations++; endforeach ?>


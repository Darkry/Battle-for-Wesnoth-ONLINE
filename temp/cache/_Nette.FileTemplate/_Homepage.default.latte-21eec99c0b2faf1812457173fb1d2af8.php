<?php //netteCache[01]000394a:2:{s:4:"time";s:21:"0.70836800 1337703047";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:72:"C:\xampp\htdocs\Wesnoth\app\FrontModule\templates\Homepage\default.latte";i:2;i:1337703046;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"bf2f6c0 released on 2011-07-13";}}}?><?php

// source file: C:\xampp\htdocs\Wesnoth\app\FrontModule\templates\Homepage\default.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'jzlf5oacw4')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbcfe27fea60_content')) { function _lbcfe27fea60_content($_l, $_args) { extract($_args)
?>
<h1><a href="<?php echo Nette\Templating\DefaultHelpers::escapeHtml($control->link("MapView:default", array(1))) ?>
">Do testovací hry</a></h1><?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extends) ? FALSE : $template->_extends; unset($_extends, $template->_extends);


if ($_l->extends) {
	ob_start();
} elseif (!empty($control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>

<?php if (!$_l->extends) { call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()); }  
// template extending support
if ($_l->extends) {
	ob_end_clean();
	Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}

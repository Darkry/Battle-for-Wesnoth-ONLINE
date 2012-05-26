<?php //netteCache[01]000423a:2:{s:4:"time";s:21:"0.16789400 1311249454";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:100:"C:\Program Files (x86)\EasyPHP-5.3.3.1\www\Wesnoth\app\FrontModule\templates\MapTester\default.latte";i:2;i:1311249450;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"bf2f6c0 released on 2011-07-13";}}}?><?php

// source file: C:\Program Files (x86)\EasyPHP-5.3.3.1\www\Wesnoth\app\FrontModule\templates\MapTester\default.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'ssi90cat7k')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbc70a2d374f_head')) { function _lbc70a2d374f_head($_l, $_args) { extract($_args)
?>
<link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/map/terrain.css" type="text/css" />
<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb7ef4264518_content')) { function _lb7ef4264518_content($_l, $_args) { extract($_args)
?>

<div id="playground">
        <div class="grass1" style="top: 0px; left: 0px;"></div>
    <div class="grass2" style="top: 36px; left: 54px;"></div>
    <div class="grass3" style="top: 0px; left: 108px;"></div>
</div>
<?php
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
if (!$_l->extends) { call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()); } ?>

<?php if (!$_l->extends) { call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()); }  
// template extending support
if ($_l->extends) {
	ob_end_clean();
	Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}

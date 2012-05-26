<?php //netteCache[01]000406a:2:{s:4:"time";s:21:"0.16643300 1312122160";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:84:"C:\Program Files\EasyPHP-5.3.3.1\www\Wesnoth\app\FrontModule\templates\@layout.latte";i:2;i:1311791665;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"bf2f6c0 released on 2011-07-13";}}}?><?php

// source file: C:\Program Files\EasyPHP-5.3.3.1\www\Wesnoth\app\FrontModule\templates\@layout.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'qz0wy1lt8d')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb3da8d6eba3_head')) { function _lb3da8d6eba3_head($_l, $_args) { extract($_args)
;
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
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta name="description" content="Nette Framework web application skeleton" />
<?php if (isset($robots)): ?>
	<meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>" />
<?php endif ?>

	<title>Nette Application Skeleton</title>

	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/screen.css" type="text/css" />
	<link rel="stylesheet" media="print" href="<?php echo htmlSpecialChars($basePath) ?>/css/print.css" type="text/css" />
        <link rel="stylesheet" media="print" href="<?php echo htmlSpecialChars($basePath) ?>/css/base.css" type="text/css" />
	<link rel="shortcut icon" href="<?php echo htmlSpecialChars($basePath) ?>/favicon.ico" type="image/x-icon" />

	<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/netteForms.js"></script>
	<?php if (!$_l->extends) { call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()); } ?>

</head>

<body>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($flashes) as $flash): ?>
	<div class="flash <?php echo htmlSpecialChars($flash->type) ?>"><?php echo Nette\Templating\DefaultHelpers::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>

<?php Nette\Latte\Macros\UIMacros::callBlock($_l, 'content', $template->getParams()) ?>
</body>
</html>
<?php 
// template extending support
if ($_l->extends) {
	ob_end_clean();
	Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}

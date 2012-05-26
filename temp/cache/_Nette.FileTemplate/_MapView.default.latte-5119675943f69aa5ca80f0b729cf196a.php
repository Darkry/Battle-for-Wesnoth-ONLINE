<?php //netteCache[01]000414a:2:{s:4:"time";s:21:"0.29907600 1320310296";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:92:"C:\Program Files\EasyPHP-5.3.3.1\www\Wesnoth\app\FrontModule\templates\MapView\default.latte";i:2;i:1320310294;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"bf2f6c0 released on 2011-07-13";}}}?><?php

// source file: C:\Program Files\EasyPHP-5.3.3.1\www\Wesnoth\app\FrontModule\templates\MapView\default.latte

?><?php list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '2b8ma1r530')
;//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb2dea4de3e3_head')) { function _lb2dea4de3e3_head($_l, $_args) { extract($_args)
?>
<link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/map/terrain.css" type="text/css" />
<link rel="stylesheet" media="screen,projection,tv" href="<?php echo htmlSpecialChars($basePath) ?>/css/map/units.css" type="text/css" />
<script type="text/javascript">
var moveUrl = <?php echo Nette\Templating\DefaultHelpers::escapeJs($control->link("move!")) ?>;
</script>
<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/map/base.js"></script>
<script type="text/javascript" src="<?php echo htmlSpecialChars($basePath) ?>/js/ajax.js"></script>
<?php
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb362bfdc4a8_content')) { function _lb362bfdc4a8_content($_l, $_args) { extract($_args)
?>

<div id="playground">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($mapgrounds) as $mapground): ?>
    <div class="<?php echo htmlSpecialChars($mapground['datName']) ?> ground <?php echo htmlSpecialChars($mapground['x']) ?>
a<?php echo htmlSpecialChars($mapground['y']) ?>" id="<?php echo htmlSpecialChars($mapground['id']) ?>
" style="top: <?php echo htmlSpecialChars(Nette\Templating\DefaultHelpers::escapeCss($mapground['top'])) ?>
px; left: <?php echo htmlSpecialChars(Nette\Templating\DefaultHelpers::escapeCss($mapground['left'])) ?>px;"></div>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
    <img src="<?php echo htmlSpecialChars($basePath) ?>/images/terrain/hover.png" style="display: none; position: absolute; z-index: 9999;" id="mapHover" />
</div>
    
    <div id="<?php echo $control->getSnippetId('units') ?>"><?php call_user_func(reset($_l->blocks['_units']), $_l, $template->getParams()) ?>
</div><?php
}}

//
// block _units
//
if (!function_exists($_l->blocks['_units'][] = '_lbc2c09f83f7__units')) { function _lbc2c09f83f7__units($_l, $_args) { extract($_args); $control->validateControl('units')
?>
<div id="units">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($units) as $color => $unit): ?>
        <div id="<?php echo htmlSpecialChars($color) ?>">
            <div class="unit <?php echo htmlSpecialChars($unit["hero"]["x"]) ?>a<?php echo htmlSpecialChars($unit["hero"]["y"]) ?>
" id="unit<?php echo htmlSpecialChars($unit["hero"]["id"]) ?>" style="top: <?php echo htmlSpecialChars(Nette\Templating\DefaultHelpers::escapeCss($unit["hero"]["top"])) ?>
px; left: <?php echo htmlSpecialChars(Nette\Templating\DefaultHelpers::escapeCss($unit["hero"]["left"])) ?>px;">
                <div>
                    <div class="unitColor-<?php echo htmlSpecialChars($color) ?>"></div>
                    <div class="unitImg hero <?php echo htmlSpecialChars($unit["hero"]["unittype"]["datName"]) ?>">
                        <div class="movement data"><?php echo Nette\Templating\DefaultHelpers::escapeHtml($unit["hero"]["unittype"]["movement"], ENT_NOQUOTES) ?></div>
                    </div>
                </div>
            </div>
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($unit['units']) as $u): ?>
            <div class="unit <?php echo htmlSpecialChars($u["x"]) ?>a<?php echo htmlSpecialChars($u["y"]) ?>
" id="unit<?php echo htmlSpecialChars($u["id"]) ?>" style="top: <?php echo htmlSpecialChars(Nette\Templating\DefaultHelpers::escapeCss($u["top"])) ?>
px; left: <?php echo htmlSpecialChars(Nette\Templating\DefaultHelpers::escapeCss($u["left"])) ?>px;">
                 <div>
                     <div class="unitColor-<?php echo htmlSpecialChars($color) ?>"></div>
                     <div class="unitImg <?php echo htmlSpecialChars($u["unittype"]["datName"]) ?>">
                        <div class="movement data"><?php echo Nette\Templating\DefaultHelpers::escapeHtml($u["unittype"]["movement"], ENT_NOQUOTES) ?></div>
                     </div>
                </div>
             </div>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
        </div>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
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

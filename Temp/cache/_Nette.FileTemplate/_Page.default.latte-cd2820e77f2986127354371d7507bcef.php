<?php //netteCache[01]000410a:2:{s:4:"time";s:21:"0.53336100 1407963934";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:96:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Page/default.latte";i:2;i:1406819413;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Page/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '7g0lwievne')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb70bfefc105_content')) { function _lb70bfefc105_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="heading"><?php print(STR_198) ?></div>
    <a href="<?php echo htmlSpecialChars($_control->link("Page:add")) ?>"><strong><?php print(STR_197) ?></strong></a>
    <img src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/images/admin/sep.gif" align="absmiddle" style="margin:0 5px">
    <a href="<?php echo htmlSpecialChars($_control->link("Page:default")) ?>"><strong><?php print(STR_198) ?></strong></a>
	<table cellpadding="0" cellspacing="0" class="mytable" id="table" style="margin-top:20px;margin-left:15px">
            <thead>
		<tr style="font-size:11px">
                    <td class="nobtl"></td>
                    <td><?php print(STR_199) ?></td>
                    <td align="right"><?php print(STR_200) ?></td>
                    <td align="center"><?php print(STR_14) ?></td>
                    <td align="center"><?php print(STR_202) ?></td>
                    <td align="center"><?php print(STR_203) ?></td>
                    <td align="center"><?php print(STR_204) ?></td>
                    <td class="nobtlr"></td>
                </tr>
            </thead>
            <tbody>
<?php $iterations = 0; foreach ($pages as $page) { ?>
		<tr>
                    <td style="background:#eee;padding:0">
                        <a href="<?php echo htmlSpecialChars($_control->link("Page:edit", array($page->id))) ?>
" style="display:block;padding:10px 6px"><img src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/images/admin/edit.gif" alt="Upravit"></a>
                    </td>
                    <td style="line-height:135%">
                        <strong><?php echo Nette\Templating\Helpers::escapeHtml($page->title, ENT_NOQUOTES) ?>
</strong><br><a href="<?php echo htmlSpecialChars($_control->link(":Front:Page:show", array($page->link))) ?>
" target="_blank" title="<?php print(STR_400) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($page->link, ENT_NOQUOTES) ?></a>
                    </td>
                    <td align="right"><?php echo Nette\Templating\Helpers::escapeHtml($page->authorObject->account, ENT_NOQUOTES) ?></td>
                    <td align="center"><?php echo Nette\Templating\Helpers::escapeHtml($page->categoryObject->name, ENT_NOQUOTES) ?></td>
                    <td align="center"><?php echo Nette\Templating\Helpers::escapeHtml($page->views, ENT_NOQUOTES) ?></td>
                    <td align="center"><?php echo Nette\Templating\Helpers::escapeHtml($page->commentCount, ENT_NOQUOTES) ?></td>
                    <td align="center"><?php echo Nette\Templating\Helpers::escapeHtml($page->createDate, ENT_NOQUOTES) ?></td>
                    <td style="background:#eee"><img src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>
/images/admin/del.gif" style="cursor:pointer" onclick="if(confirm('Opravdu chcete tuto položku smazat?')) location.href=<?php echo htmlSpecialChars(Nette\Templating\Helpers::escapeJs($_control->link("delete!", array($page->id)))) ?>"></td>
                </tr>
<?php $iterations++; } ?>
                <tr class="tfoot">
                </tr>
            </tbody>
        </table>    
<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb28088bc2cd_head')) { function _lb28088bc2cd_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/admin2.css">
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
if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>

<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars()) ; 
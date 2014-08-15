<?php //netteCache[01]000410a:2:{s:4:"time";s:21:"0.44783300 1407977565";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:96:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Menu/default.latte";i:2;i:1406818322;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Menu/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'i5qpa6wjpc')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb55358794bc_content')) { function _lb55358794bc_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="heading"><?php print(STR_223) ?></div>
    <a href="<?php echo htmlSpecialChars($_control->link("Menu:add")) ?>"><strong><?php print(STR_222) ?></strong></a>
    <img src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/images/admin/sep.gif" align="absmiddle" style="margin:0 5px">
    <a href="<?php echo htmlSpecialChars($_control->link("Menu:default")) ?>"><strong><?php print(STR_223) ?></strong></a> 
    <form action="<?php echo htmlSpecialChars($_control->link("Menu:updateAll")) ?>" method="POST">
        <table cellpadding="0" cellspacing="0" class="mytable" id="table" style="margin-top:20px;margin-left:15px">
		<thead>
		    <tr>
			<td class="nobtl"></td>
			<td><?php print(STR_276) ?></td>
			<td><?php print(STR_220) ?></td>
			<td><?php print(STR_221) ?></td>
			<td><?php print(STR_177) ?></td>
                        <td><?php print(STR_250) ?></td>
			<td align="center"><?php print(STR_251) ?></td>
			<td class="nobtlr"></td>
		    </tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($menus as $menu) { ?>
                    <tr class='subcat<?php echo htmlSpecialChars($menu->getParentIndex(), ENT_QUOTES) ?>'>
			<td style="background:#eee;padding:0">
			    <a href="<?php echo htmlSpecialChars($_control->link("Menu:edit", array($menu->id))) ?>" style="display:block;padding:7px">
                                <img src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/images/admin/edit.gif" alt="Upravit">
			    </a>
			</td>
			<td class="lh catcz">
			    <div><strong><?php echo Nette\Templating\Helpers::escapeHtml($menu->name, ENT_NOQUOTES) ?></strong></div>
			</td>
			<td align="right" style="background:#ddd"><?php echo Nette\Templating\Helpers::escapeHtml($menu->id, ENT_NOQUOTES) ?></td>
			<td style="background:#ddd">
			    <input size="2" name="parent[<?php echo htmlSpecialChars($menu->id) ?>]" type="text" value="<?php if ($menu->getParentObject() != NULL) { echo htmlSpecialChars($menu->getParentObject()->id) ;} ?>">
			</td>
			<td>
			    <a href="#" target="_blank" title="<?php print(STR_400) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($menu->link, ENT_NOQUOTES) ?></a>
			</td>
                        <td align="center"><input type="checkbox" name="visibility[<?php echo htmlSpecialChars($menu->id) ?>
]" <?php if ($menu->visibility) { ?>checked<?php } ?>></td>
			<td align="center"><input size="2" name="priority[<?php echo htmlSpecialChars($menu->id) ?>
]" value="<?php echo htmlSpecialChars($menu->priority) ?>"></td>
			<td style="background:#eee"><img src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>
/images/admin/del.gif" style="cursor:pointer" class="ajax" onclick="if(confirm('Opravdu chcete toto menu smazat?')) location.href=<?php echo htmlSpecialChars(Nette\Templating\Helpers::escapeJs($_control->link("delete!", array($menu->id)))) ?>"></td>
		    </tr>
<?php $iterations++; } ?>
<tr class="tfoot">
<td colspan="10" class="nobblr" style="padding:10px 0 30px 0;text-align:right">
<input type="submit" style="font-weight:bold" value="<?php print(STR_100) ?>">
</td>
</tr>
</tbody>
</table>
    </form>
<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbe4a96b8ed6_head')) { function _lbe4a96b8ed6_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/admin2.css">
    <style>
	    TD.lh{
		line-height:1.4;
	    }
	    TR.subcat1 TD.catcz DIV{
		padding-left:13px;border-left:1px dotted #555;margin-left:7px;
	    }
	    TR.subcat2 TD.catcz DIV{
		padding-left:13px;border-left:1px dotted #555;margin-left:20px;
	    }
	    TR.subcat3 TD.catcz DIV{
		padding-left:13px;border-left:1px dotted #555;margin-left:33px;
	    }
            TR.subcat4 TD.catcz DIV{
		padding-left:13px;border-left:1px dotted #555;margin-left:46px;
	    }
	    LABEL{
		white-space:nowrap;background:#eee;border-radius:3px;font-size:12px;padding:3px;display:inline-block;margin:2px;
	    }
	    LABEL INPUT{
		margin:0 5px 0 0;padding:0;vertical-align:middle;display:inline-block;
	    }
	    LABEL.xon{
		background:#AAF889;
	    }
	    .yel{
		float:right
	    }
	    .yel LABEL{
		background:#fff;border:1px solid #ddd;padding:2px;}
	    LABEL.xred{
		background:#ff7171;
	    }
	</style>
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
<?php //netteCache[01]000407a:2:{s:4:"time";s:21:"0.71284100 1407963959";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:93:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Auth/menu.latte";i:2;i:1407963957;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Auth/menu.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'yj8rm3qp7t')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head><title></title><link href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/admin2.css" type="text/css" rel="stylesheet"><meta http-equiv="content-Type" content="text/html; charset=windows-1250"></head><body><script type="text/javascript" src="top_data/scripts.js"></script><script type="text/javascript">
function updateExp(){
        var tmp = readCookie("export");
        if(tmp) {
                tmp = tmp.split(':');
                document.getElementById('export').innerHTML = tmp.length-1;
        }
        else {
                document.getElementById('export').innerHTML = '';
        }
        window.setTimeout("updateExp()", 2000);
}

function readCookie(name)
{
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
}
window.setTimeout("updateExp()", 2000);


var lToggleA = ''
function toggleA(o){
        if(lToggleA==o)return false;
        else if(lToggleA != '') lToggleA.className='';
        if(o.className=='mclicked')o.className='';
        else o.className='mclicked';
        lToggleA=o;
}

function sb(){
	window.setTimeout(function(){
		top.frm.document.location.reload();
		document.location.reload();
	}, 1000);
}
</script>

<style>
BODY{ background:#eee;overflow:auto;padding:0;margin:0;}
.menuwrap{ padding:15px 15px 5px 15px;}
.num{ float:right;font-weight:bold;}
</style>

<div class="menuwrap">
<div class="menu">


<div style="margin-bottom:18px">
<br>



<br>
<p><span>OBSAH WEBU</span></p>
<?php if ($user->isAllowed('Admin:Page')) { ?><a href="<?php echo htmlSpecialChars($_control->link("Page:default")) ?>
" onclick="toggleA(this);" target="frm"><?php print(STR_11) ?></a><?php } ?>

<?php if ($user->isAllowed('Admin:Article')) { ?><a href="<?php echo htmlSpecialChars($_control->link("Article:default")) ?>
" onclick="toggleA(this);" target="frm"><?php print(STR_12) ?></a><?php } ?>

<?php if ($user->isAllowed('Admin:Menu')) { ?><a href="<?php echo htmlSpecialChars($_control->link("Menu:default")) ?>
" onclick="toggleA(this);" target="frm"><?php print(STR_13) ?></a><?php } ?>

<?php if ($user->isAllowed('Admin:Category')) { ?><a href="<?php echo htmlSpecialChars($_control->link("Category:default")) ?>
" onclick="toggleA(this);" target="frm"><?php print(STR_14) ?></a><?php } ?>

<?php if ($user->isAllowed('Admin:Widget')) { ?><a href="<?php echo htmlSpecialChars($_control->link("Widget:default")) ?>
" onclick="toggleA(this)" target="frm"><?php print(STR_15) ?></a><?php } ?>

<?php if ($user->isAllowed('Admin:Panel')) { ?><a href="<?php echo htmlSpecialChars($_control->link("Panel:default")) ?>
" onclick="toggleA(this);" target="frm"><?php print(STR_16) ?></a><?php } ?>

<br>
<p><span>Systém</span></p>
<?php if ($user->isAllowed('Admin:User')) { ?><a href="<?php echo htmlSpecialChars($_control->link("User:default")) ?>
" onclick="toggleA(this);" target="frm"><?php print(STR_17) ?></a><?php } ?>

<?php if ($user->isAllowed('Admin:Task')) { ?><a href="<?php echo htmlSpecialChars($_control->link("Task:default")) ?>
" onclick="toggleA(this);" target="frm"><?php print(STR_18) ?></a><?php } ?>

<?php if ($user->isAllowed('Admin:Settings')) { ?><a href="<?php echo htmlSpecialChars($_control->link("Settings:default")) ?>
" onclick="toggleA(this);" target="frm"><?php print(STR_19) ?></a><?php } ?>

<?php if ($user->isAllowed('Admin:Settings')) { ?><a href="<?php echo htmlSpecialChars($_control->link("Settings:testdisplay")) ?>
" onclick="toggleA(this);" target="frm"><?php print(STR_22) ?></a><?php } ?>

</div>
</div>



</body></html>
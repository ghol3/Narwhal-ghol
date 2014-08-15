<?php //netteCache[01]000406a:2:{s:4:"time";s:21:"0.49968500 1407963865";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:92:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Auth/top.latte";i:2;i:1407492587;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Auth/top.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'puymkm9onh')
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
<html>
    <head>
        <title></title>
        <link href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/admin2.css" type="text/css" rel="stylesheet">
        <meta http-equiv="content-Type" content="text/html; charset=windows-1250">
    </head>
    <body>
        <style>
        BODY{ margin:0;padding:0}
        A.backup{ padding:1px;margin:0;background:#eee;color:#cc0000 !important;font-size:11px;
            border:1px solid;border-color:#fff #ccc #ccc #fff;
            -webkit-border-radius:3px;-moz-border-radius:3px;width:110px;text-align:center;
            position:absolute;top:3px;left:50%;margin-left:-55px;
        }
        .topcen{
            margin:0;text-align:center;
            position:absolute;top:6px;left:200px;right:200px;
            color:#fff;
            font-size:13px;text-shadow:1px 1px 1px #123456;
        }
        A.shopname{
            margin-left:7px;
            font-size:13px;text-shadow:1px 1px 1px #2a537c;
            display:block;float:left;
        }
    </style>
    <div class="mainhead">
        <a class="shopname" href="<?php echo htmlSpecialChars($_control->link(":Front:Homepage:default")) ?>
" target="_blank"><?php echo Nette\Templating\Helpers::escapeHtml($settings->siteurl, ENT_NOQUOTES) ?></a>
        <a href="#" target="_blank" class="backup" onclick="this.style.display='none';return true;"><img src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>
/images/admin/backup.gif" style="margin-right:8px" align="absbottom"><?php print(STR_43) ?></a>
    </div>
    </body>
</html>
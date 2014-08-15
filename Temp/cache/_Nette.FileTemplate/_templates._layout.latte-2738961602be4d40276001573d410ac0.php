<?php //netteCache[01]000405a:2:{s:4:"time";s:21:"0.55402600 1407963934";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:91:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/@layout.latte";i:2;i:1407492319;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '27oeycbax1')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb5e5d32ab0f_title')) { function _lb5e5d32ab0f_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Nette Application Skeleton<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb71cf5a66fb_head')) { function _lb71cf5a66fb_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block _flashes
//
if (!function_exists($_l->blocks['_flashes'][] = '_lb978ca5e698__flashes')) { function _lb978ca5e698__flashes($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('flashes', FALSE)
;$iterations = 0; foreach ($flashes as $flash) { ?>	<div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo $flash->message ?></div>
<?php $iterations++; } 
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb12ecd9dfd4_content')) { function _lb12ecd9dfd4_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block scripts
//
if (!function_exists($_l->blocks['scripts'][] = '_lbfc8023568c_scripts')) { function _lbfc8023568c_scripts($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	
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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
<?php if (isset($robots)) { ?>	<meta name="robots" content="<?php echo htmlSpecialChars($robots) ?>">
<?php } ?>
        <META http-equiv="cache-control" content="no-cache">
	<title><?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
ob_start(); call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()); echo $template->upper($template->striptags(ob_get_clean()))  ?></title>
	<link rel="shortcut icon" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/images/favicon.ico">
        <link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/frontend/messages.css">
        <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/jquery.js"></script>
	 <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/scripts.js"></script>
        <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/netteForms.js"></script>
        <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/ajax.js"></script>
  
        <script type="text/javascript">
            var nodiac = { 'á': 'a', 'č': 'c', 'ď': 'd', 'é': 'e', 'ě': 'e', 'í': 'i', 'ň': 'n', 'ó': 'o', 'ř': 'r', 'š': 's', 'ť': 't', 'ú': 'u', 'ů': 'u', 'ý': 'y', 'ž': 'z' };
            /** Vytvoření přátelského URL
             * @param string řetězec, ze kterého se má vytvořit URL
             * @return string řetězec obsahující pouze čísla, znaky bez diakritiky, podtržítko a pomlčku
             * @copyright Jakub Vrána, http://php.vrana.cz/
             */
            function make_url(s) {
                s = s.toLowerCase();
                var s2 = '';
                for (var i=0; i < s.length; i++) {
                    s2 += (typeof nodiac[s.charAt(i)] != 'undefined' ? nodiac[s.charAt(i)] : s.charAt(i));
                }
                return s2.replace(/[^a-z0-9_]+/g, '-').replace(/^-|-$/g, '');
            }
        </script>
        <script> $(function () {
                $.nette.init();
            });
            </script>
	<?php call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>

</head>

<body>
	<script> document.documentElement.className+=' js' </script>

<div id="<?php echo $_control->getSnippetId('flashes') ?>"><?php call_user_func(reset($_l->blocks['_flashes']), $_l, $template->getParameters()) ?>
</div>        <?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>


<?php call_user_func(reset($_l->blocks['scripts']), $_l, get_defined_vars())  ?>
</body>
</html>

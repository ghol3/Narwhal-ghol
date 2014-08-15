<?php //netteCache[01]000415a:2:{s:4:"time";s:21:"0.65518000 1407963534";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:100:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/FrontModule/templates/Homepage/default.latte";i:2;i:1405407075;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/FrontModule/templates/Homepage/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '5oh2lxpko2')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb622bd2ba91_content')) { function _lb622bd2ba91_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$iterations = 0; foreach ($widgets as $widget) { ?>
        <div class="<?php echo htmlSpecialChars($widget->class) ?>">
<?php if ($widget->type == 'latte' || $widget->type == 'php') { ?>
               <?php echo $latte->render($widget->content, array('articles' => $articles, 'basePath' => $basePath)) ?>

<?php } else { ?>
                <?php echo $widget->content ?>

<?php } ?>
        </div>
<?php $iterations++; } 
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb6490bca549_title')) { function _lb6490bca549_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;echo Nette\Templating\Helpers::escapeHtml($settings->title, ENT_NOQUOTES) ;
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

<?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()) ; 
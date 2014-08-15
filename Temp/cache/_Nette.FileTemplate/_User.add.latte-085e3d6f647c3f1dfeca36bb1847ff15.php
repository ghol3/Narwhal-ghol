<?php //netteCache[01]000406a:2:{s:4:"time";s:21:"0.64503700 1407964262";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:92:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/User/add.latte";i:2;i:1406824410;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/User/add.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'e9ohucgs7d')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb5e1a4de07a_content')) { function _lb5e1a4de07a_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>        <form<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = $_control["addform"], array (
), FALSE) ?>>
            <div class="heading"><?php print(STR_272) ?></div>
        <div style="float:right"><input type="submit" style="font-weight:bold;color:#005400;padding:7px" value="<?php print(STR_273) ?>
"<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'style' => NULL,
  'value' => NULL,
))->attributes() ?>></div>
	    <div class="btns" style="margin-bottom:12px;clear:none;float:left;width:auto"><a href="<?php echo htmlSpecialChars($_control->link("User:default")) ?>
"><strong><?php print(STR_99) ?> - <?php print(STR_259) ?></strong></a></div>
	    <div style="clear:both;font-size:0;height:0"></div>
                    

            <div class="btn">
                <div style="clear:both;font-size:0;height:0"></div>
                <div id="baseform" class="t twbg" style="width:100%;">
                        <p><span><?php print(STR_422) ?>:</span>
                    	<input type="text" size="90"<?php $_input = $_form["account"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_423) ?>:</span>
                    	<input type="password" size="90"<?php $_input = $_form["password"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_424) ?>:</span>
                    	<input type="password" size="90"<?php $_input = $_form["password1"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_399) ?>:</span>
                    	<input type="text" size="90"<?php $_input = $_form["email"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_425) ?>:</span>
                    	<input type="text" size="90"<?php $_input = $_form["username"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_426) ?>:</span>
                    	<input type="text" size="90"<?php $_input = $_form["surname"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_427) ?>:</span>
                    	<select<?php $_input = $_form["adminLevel"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->attributes() ?>
><?php echo $_input->getControl()->getHtml() ?></select></p>
                        <p><span><?php print(STR_267) ?>:</span>
                    	<input type="text" size="90"<?php $_input = $_form["facebook"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_268) ?>:</span>
                    	<input type="text" size="90"<?php $_input = $_form["skype"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_274) ?>:</span>
                    	<input type="text" size="90"<?php $_input = $_form["birthday"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
))->attributes() ?>></p>


                <?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form, FALSE) ?></form>
                </div>
<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb1de8a78454_head')) { function _lb1de8a78454_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/admin2.css">
<link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/admin.css">
<script type="text/javascript" src="scripts.js"></script>
        
        <style>
            .twbg SPAN
            {
                background:#eee;
            }
        .t
        {
            float:left;
        }
        .t P
        {
            margin:0;
            padding:0;
            clear:left;
            line-height:180%;
        }
        .t SPAN
        {
            width:230px;
            font-weight:bold;
            padding:0 5px;
            margin:0 5px 2px 0;
            display:block;
            float:left;
            -moz-box-sizing:border-box;
            box-sizing:border-box;
        }
        .t SPAN.del
        {
            width:auto;
            font-weight:normal;
            background:#fff url(../../images/admin/del.gif) no-repeat center left;
            padding:0 0 0 3px;
            display:inline;
            float:none;
        }
        .t SPAN.cprice
        {
            width:60px;
            text-align:right;
            font-weight:normal;
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
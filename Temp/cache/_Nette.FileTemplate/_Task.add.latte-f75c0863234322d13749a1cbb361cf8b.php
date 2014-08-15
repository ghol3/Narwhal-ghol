<?php //netteCache[01]000406a:2:{s:4:"time";s:21:"0.46082100 1408021325";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:92:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Task/add.latte";i:2;i:1406823379;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Task/add.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '894mqdk0d8')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbe5c86a94e3_content')) { function _lbe5c86a94e3_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	    <div class="btns" style="margin-bottom:12px;clear:none;float:left;width:auto"><a href="<?php echo htmlSpecialChars($_control->link("Task:default")) ?>
"><strong><?php print(STR_99) ?> - <?php print(STR_287) ?></strong></a></div>
	    <div style="clear:both;font-size:0;height:0"></div>
        <form<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = $_control["addForm"], array (
), FALSE) ?>>
            <div style="float:right">
            </div>
                    

            <div class="btn">
                <div style="clear:both;font-size:0;height:0"></div>
                <div id="baseform" class="t twbg" style="width:100%;">
                        <p><span><?php print(STR_394) ?>:</span>
                    	<input type="text" style="width:700px;"<?php $_input = $_form["name"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'style' => NULL,
))->attributes() ?>></p>
                        
                        <p><span><?php print(STR_295) ?>:</span>
                            <select style="width:700px;"<?php $_input = $_form["type"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'style' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></select></p>
                        
                        <input<?php $_input = $_form["author"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->attributes() ?>>
                        
                        <p><span><?php print(STR_300) ?></span><input type="checkbox"<?php $_input = $_form["phone"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_301) ?></span><input type='checkbox'<?php $_input = $_form["email"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_296) ?></span><input<?php $_input = $_form["image"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->attributes() ?>></p>
                        <p><span><?php print(STR_297) ?>:</span>
                            <textarea style="width:700px;height:300px;"<?php $_input = $_form["content"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'style' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea></p>
                        
                    <td colspan="2"><input type="submit" class="btn btn-success right" value="<?php print(STR_305) ?>
"<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'class' => NULL,
  'value' => NULL,
))->attributes() ?>></td>


                <?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form, FALSE) ?></form>
                </div>
<?php
}}

//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lb23c6435e28_head')) { function _lb23c6435e28_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/admin.css">
<script type="text/javascript" src="scripts.js"></script>
        <div class="heading"><?php print(STR_295) ?></div>
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
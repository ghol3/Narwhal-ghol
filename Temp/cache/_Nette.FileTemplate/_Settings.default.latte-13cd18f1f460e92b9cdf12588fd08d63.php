<?php //netteCache[01]000415a:2:{s:4:"time";s:21:"0.07575600 1407964765";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:100:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Settings/default.latte";i:2;i:1407074195;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Settings/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '5ks7n9c6jt')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lba906a99008_content')) { function _lba906a99008_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>        <form<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = $_control["editBasicform"], array (
), FALSE) ?>>
            <div style="float:right">
            </div>
                    

            <div class="btn">
                <div style="clear:both;font-size:0;height:0"></div>
                <div id="baseform" class="t twbg" style="width:100%;">
                    <h3><?php print(STR_308) ?></h3>
                        <p><span><?php print(STR_309) ?>:</span>
                    	<input type="text" size="90" style="width:570px;"<?php $_input = $_form["site_url"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
  'style' => NULL,
))->attributes() ?>></p>

                    	<p><span><?php print(STR_310) ?>:</span>
                    	<input type="text" size="90" class="" style="width:570px;"<?php $_input = $_form["site_name"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
  'class' => NULL,
  'style' => NULL,
))->attributes() ?>></p>
                        
                        <p><span><?php print(STR_311) ?>:</span>
                            <input type='text' size='90' class='' style='width:570px;'<?php $_input = $_form["title"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
  'class' => NULL,
  'style' => NULL,
))->attributes() ?>></p>
                        
                        <p><span><?php print(STR_312) ?>:</span>
                            <input type="text" size="90" class="" style="width:570px;"<?php $_input = $_form["phone"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
  'class' => NULL,
  'style' => NULL,
))->attributes() ?>></p>
       
                        <!--<p><span><?php print(STR_313) ?>:</span>
                    	<input type="text" n:name="username" size="90" class="" style="width:570px;"></p>
                        
                        <p><span><?php print(STR_314) ?>:</span>
                    	<input type="text" n:name="surname" size="90" class="" style="width:570px;"></p>
                        -->
                        <p><span><?php print(STR_315) ?>:</span>
                            <textarea size="90" class="" style="width:570px;height:100px"<?php $_input = $_form["sitedescription"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'size' => NULL,
  'class' => NULL,
  'style' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea></p>
                        
                        <p><span><?php print(STR_316) ?>:</span>
                            <textarea size="90" class="" style="width:570px;height:100px"<?php $_input = $_form["keywords"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'size' => NULL,
  'class' => NULL,
  'style' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea></p>

                    	<p><span><?php print(STR_317) ?>:</span>
                    	<input type="text" size="90" class="" style="width:570px;"<?php $_input = $_form["site_email"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'size' => NULL,
  'class' => NULL,
  'style' => NULL,
))->attributes() ?>></p>

                        <p><span><?php print(STR_318) ?>:</span>
                            <input type="text" style="width:570px;"<?php $_input = $_form["pagination"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'style' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_319) ?></span><input type="checkbox"<?php $_input = $_form["comment_only_user"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_320) ?></span><input type='checkbox'<?php $_input = $_form["users_can_register"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
))->attributes() ?>></p>
                        <p><span><?php print(STR_321) ?></span><input style='width:570px'<?php $_input = $_form["log_number"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'style' => NULL,
))->attributes() ?>></p>
                    <td colspan="2"><input type="submit" class="btn btn-success right" value="<?php print(STR_100) ?>
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
if (!function_exists($_l->blocks['head'][] = '_lb0a3cdabb3a_head')) { function _lb0a3cdabb3a_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/admin2.css">
<link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/admin.css">
<script type="text/javascript" src="scripts.js"></script>
        <div class="heading"><?php print(STR_307) ?></div>
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
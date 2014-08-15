<?php //netteCache[01]000408a:2:{s:4:"time";s:21:"0.83510100 1407964015";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:94:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Auth/Login.latte";i:2;i:1407964013;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Auth/Login.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'wsbtv6m92c')
;
// prolog Nette\Latte\Macros\UIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if (!$user->isLoggedIn()) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                <title><?php print(STR_390) ?></title>
                <link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/adminstyles/css/style.css">
                    <link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/frontend/messages.css">
                        <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/jquery.js" type="text/javascript"></script>
                        <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/sha512-min.js" type="text/javascript"></script>
                        <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/validateAdminForm.js" type="text/javascript"></script>
                        <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
                        </head>
                        <body>
                            <div class="wrapper">
                                <center><h1><?php print(STR_388) ?></h1></center>
                                <center><h2><?php print(STR_389) ?></h2></center>
                                <div class="content">
                                    <div id="form_wrapper" class="form_wrapper">
                                        <form onSubmit="validate()" class="login active"<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = $_control["adminLoginForm"], array (
  'onSubmit' => NULL,
  'class' => NULL,
), FALSE) ?>>
                                            <h3><?php print(STR_391) ?></h3>
                                            <div>
                                                <label><?php print(STR_392) ?>:</label>
                                                <input value="<?php echo htmlSpecialChars($acc) ?>
"<?php $_input = $_form["account"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'value' => NULL,
))->attributes() ?>>
<?php $iterations = 0; foreach ($flashes as $flash) { ?>                                                <div class="flash <?php echo htmlSpecialChars($flash->type) ?>
"><?php echo $flash->message ?></div>
<?php $iterations++; } ?>
                                            </div>
                                            <div>
                                                <label><?php print(STR_393) ?>:</label>
                                                <input<?php $_input = $_form["password"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->attributes() ?>>
                                                <span class="error">This is an error</span>
                                            </div>
                                            <div class="bottom">
                                                <div class="remember"><input <?php if ($acc != 'account') { ?>
checked<?php } $_input = $_form["remember"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'checked' => NULL,
))->attributes() ?>><span><?php print(STR_XX3)?></span></div>
                                                <input value="Login"<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'value' => NULL,
))->attributes() ?>>
                                                <a href="#" class="linkform"><?php print(STR_394) ?></a>
                                                <div class="clear"></div>
                                            </div>
                                        <?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form, FALSE) ?></form>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <a class="back" href="<?php echo htmlSpecialChars($_control->link(":Front:Homepage:default")) ?>
"><?php print(STR_395) ?></a>
                            </div>
                        </body>
                        </html>

                       

<?php } else { ?>
                                                        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//CZ" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
                                                        <html>
                                                            <head>
                                                                <title><?php print(STR_396) ?></title>
                                                                <link rel="shortcut icon" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/images/favicon.ico">
                                                                    <link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/frontend/style.css">
                                                                        <meta http-equiv="content-type" content="text/html;charset=utf-8">
                                                                            </head>
                                                                            <FRAMESET rows="30px,*" cols="100%" frameborder="0" framespacing="0">
                                                                                <FRAME frameborder="0" scrolling="no" src="<?php echo htmlSpecialChars($_control->link("Auth:top")) ?>" name="topframe" noresize>
                                                                                    <FRAMESET cols="180px,*" framespacing="0">
                                                                                        <FRAME frameborder="0" src="<?php echo htmlSpecialChars($_control->link("Auth:menu")) ?>" scrolling="auto" name="left" noresize>
                                                                                            <FRAME frameborder="0" src="<?php echo htmlSpecialChars($_control->link("Article:default")) ?>" name="frm" scrolling="auto" noresize>
                                                                                                </FRAMESET>
                                                                                                <NOFRAMES><?php print(STR_397) ?></NOFRAMES>
                                                                                                </FRAMESET>
                                                                                                </html>

<?php } 
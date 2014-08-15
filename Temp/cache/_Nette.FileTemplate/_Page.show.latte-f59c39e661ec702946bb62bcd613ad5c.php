<?php //netteCache[01]000407a:2:{s:4:"time";s:21:"0.79702800 1407963672";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:93:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/FrontModule/templates/Page/show.latte";i:2;i:1407762456;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/FrontModule/templates/Page/show.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'incf5hz0lf')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb548cf80d3d_title')) { function _lb548cf80d3d_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;echo Nette\Templating\Helpers::escapeHtml($settings->title, ENT_NOQUOTES) ?> | <?php echo Nette\Templating\Helpers::escapeHtml($page->title, ENT_NOQUOTES) ;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb6148c95f20_content')) { function _lb6148c95f20_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <section class="post-wrapper-top jt-shadow clearfix">
	<div class="container">
            <div class="col-lg-12">
		<h2><?php echo Nette\Templating\Helpers::escapeHtml($page->title, ENT_NOQUOTES) ?></h2>
                <ul class="breadcrumb pull-right">
                    <li><a href="<?php echo htmlSpecialChars($_control->link("Homepage:default")) ?>">Hlavná</a></li>
                    <li><?php echo Nette\Templating\Helpers::escapeHtml($page->title, ENT_NOQUOTES) ?></li>
                </ul>
            </div>
	</div>
    </section>
    <section class="blog-wrapper">
    	<div class="container">
            <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                   <div class="blog-masonry">
                        <div class="col-lg-12">
                            <div class="blog-carousel">
                                <div class="blog-carousel-header"></div><!-- end blog-carousel-header -->
                                <div class="blog-carousel-desc">
                                    <?php echo $page->description ?>

                                    <?php echo $page->content ?>

<?php if ($page->link == 'kontakt') { ?>
                                        <div class="contact_form">
                                            <div id="message"></div>
                                            <form id="contactform"<?php Nette\Latte\Macros\FormMacros::renderFormBegin($form = $_form = $_control["cntactForm"], array (
  'id' => NULL,
), FALSE) ?>>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="name" class="form-control" placeholder="Meno a priezvisko"<?php $_input = $_form["username"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'id' => NULL,
  'class' => NULL,
  'placeholder' => NULL,
))->attributes() ?>> 
                                                    <input type="text" id="email" class="form-control" placeholder="Váš email"<?php $_input = $_form["email"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'id' => NULL,
  'class' => NULL,
  'placeholder' => NULL,
))->attributes() ?>>
                                                    <input type="text" id="website" class="form-control" placeholder="Telefon"<?php $_input = $_form["phone"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'id' => NULL,
  'class' => NULL,
  'placeholder' => NULL,
))->attributes() ?>> 
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="subject" class="form-control" placeholder="Predmet"<?php $_input = $_form["subject"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'id' => NULL,
  'class' => NULL,
  'placeholder' => NULL,
))->attributes() ?>>  
                                                    <textarea class="form-control" id="comments" rows="6" placeholder="Telo správy"<?php $_input = $_form["body"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
  'id' => NULL,
  'rows' => NULL,
  'placeholder' => NULL,
))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea>
                                                    <button type="submit" value="SEND" id="submit" class="btn btn-lg btn-primary pull-right"<?php $_input = $_form["send"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'type' => NULL,
  'value' => NULL,
  'id' => NULL,
  'class' => NULL,
))->attributes() ?>>Odoslať správu</button>
                                                </div>
                                            <?php Nette\Latte\Macros\FormMacros::renderFormEnd($_form, FALSE) ?></form>    
                                        </div><!-- end contact-form -->
                                        <div class="clearfix"></div>
                                    </div>
                                    
                                    </section>
<?php } ?>
                                </div><!-- end blog-carousel-desc -->
                            </div><!-- end blog-carousel -->
                        </div><!-- end col-lg-12 -->
                    </div><!-- end blog-masonry -->
            	</div><!-- end row --> 
            </div><!-- end content -->
    	</div><!-- end container -->
    </section>
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
call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>


<?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 
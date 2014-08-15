<?php //netteCache[01]000410a:2:{s:4:"time";s:21:"0.62329400 1407963676";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:96:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/FrontModule/templates/Article/show.latte";i:2;i:1407335962;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/FrontModule/templates/Article/show.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'ithamm35az')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbeae7eaadb6_title')) { function _lbeae7eaadb6_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;echo Nette\Templating\Helpers::escapeHtml($settings->title, ENT_NOQUOTES) ?> | <?php echo Nette\Templating\Helpers::escapeHtml($article->title, ENT_NOQUOTES) ;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb84a80450ef_content')) { function _lb84a80450ef_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <section class="blog-wrapper">
    	<div class="container">
            <div id="content" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="row">
                   <div class="blog-masonry">
                        <div class="col-lg-12">
                            <div class="blog-carousel">
                                <div class="blog-carousel-header">
                                    <h2><?php echo Nette\Templating\Helpers::escapeHtml($article->title, ENT_NOQUOTES) ?></h2>
                                </div><!-- end blog-carousel-header -->
                                <div class="blog-carousel-desc">                             
                                    <blockquote> 
                                        <table>
                                            <tr>
                                                <td>
<?php if ($article->image != '') { ?>
                                                        <img src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>
/<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($article->image)) ?>
" alt="<?php echo htmlSpecialChars($article->image) ?>" class="wd-150">
<?php } ?>
                                                </td>
                                                <td class="pd-10 valign-top"><?php echo $article->description ?> </td>
                                            </tr>
                                        </table>
                                    </blockquote>
                                    <?php echo $article->content ?>

                                </div><!-- end blog-carousel-desc -->
                            </div><!-- end blog-carousel -->
                        </div><!-- end col-lg-12 -->
                    </div><!-- end blog-masonry -->
            	</div><!-- end row --> 
            </div><!-- end content -->
            <div id="sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="widget">
                    <div class="title"><h3 class="panel-title-20">Kategorie</h3></div>
                    <ul class="nav nav-tabs nav-stacked">
<?php $iterations = 0; foreach ($categories as $ctg) { if ($ctg->name != '' || $ctg->link != '') { ?>
                                <li><a href="<?php echo htmlSpecialChars($_control->link("Category:show", array($ctg->link))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($template->truncate($ctg->name, 40), ENT_NOQUOTES) ?></a></li>
<?php } $iterations++; } ?>
                    </ul>                              
                </div><!-- end widget -->
                <div class="widget">
                    <div class="title"><h3 class="panel-title-20">Zaujímavosti o antiradaroch</h3></div>
                    <ul class="nav nav-tabs nav-stacked">
<?php $iterations = 0; foreach ($rarticles as $rartc) { if ($rartc->title != '' || $rartc->link != '') { ?>
                                <li><a <?php if ($rartc->link == $article->link) { ?>
class="selected-item"<?php } ?> href="<?php echo htmlSpecialChars($_control->link("Article:show", array($rartc->link))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($template->truncate($rartc->title, 46), ENT_NOQUOTES) ?></a></li>
<?php } $iterations++; } ?>
                    </ul>                              
                </div><!-- end widget -->
            </div><!-- end left-sidebar -->
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
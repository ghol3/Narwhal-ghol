<?php //netteCache[01]000405a:2:{s:4:"time";s:21:"0.08283500 1407965044";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:91:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/FrontModule/templates/@layout.latte";i:2;i:1407965042;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/FrontModule/templates/@layout.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '2t3a40zvgv')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block head
//
if (!function_exists($_l->blocks['head'][] = '_lbb38bb0e8bd_head')) { function _lbb38bb0e8bd_head($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lbc3c1a66a0a_title')) { function _lbc3c1a66a0a_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb69ce04e8f0_content')) { function _lb69ce04e8f0_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
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
<html lang="en" class="csstransforms csstransforms3d csstransition js video audio"> 
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/jquery.js"></script>
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/netteForms.js"></script>
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/ajax.js"></script>
    <!-- Bootstrap Styles -->
    <link href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/frontend/bootstrap.css" rel="stylesheet">
    <!-- Styles -->
    <link href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/frontend/style.css" rel="stylesheet">
    <!-- Carousel Slider -->
    <link href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/frontend/owl-carousel.css" rel="stylesheet">
    <!-- CSS Animations -->
    <link href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/frontend/animate.min.css" rel="stylesheet">
    <!-- SLIDER ROYAL CSS SETTINGS -->
    <link href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/frontend/royalslider/royalslider.css" rel="stylesheet">
    <link href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/frontend/royalslider/skins/default-inverted/rs-default-inverted.css" rel="stylesheet">
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/frontend/rs-plugin/css/settings.css" media="screen">
    <link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/frontend/prettyPhoto.css" type="text/css">
    <!-- Support for HTML5 -->
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['head']), $_l, get_defined_vars())  ?>

    <title><?php ob_start(); call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars()); echo $template->upper($template->striptags(ob_get_clean()))  ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlSpecialChars($settings->sitedescription) ?>">
    <meta name="keywords" content="<?php echo htmlSpecialChars($settings->keywords) ?>">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Antiradary.SK">
    <link rel="shortcut icon" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/images/favicon.ico">
    <script>
$(function () {
    $.nette.init();
});
</script>
</head>
<body>
    <div class="animationload">
        <h1 class="loader">Antiradary.SK</h1>
    </div>
    <div id="topbar" class="clearfix">
    	<div class="container">
            <div class="col-lg-6">
                <div class="social-icons">
                    <span class="topbar-email"><?php echo Nette\Templating\Helpers::escapeHtml($settings->sitename, ENT_NOQUOTES) ?></span>
                </div><!-- end social icons -->
            </div><!-- end columns -->
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
            	<div class="callus">
                    <span class="topbar-email"><span class="fa fa-envelope clr"></span> <a href="mailto:name@yoursite.com"><?php echo Nette\Templating\Helpers::escapeHtml($settings->site_email, ENT_NOQUOTES) ?></a></span>
                    <span class="topbar-phone"><span class="fa fa-phone clr"></span> <?php echo Nette\Templating\Helpers::escapeHtml($settings->phone, ENT_NOQUOTES) ?></span>
                </div><!-- end callus -->
            </div><!-- end columns -->
        </div><!-- end container -->
    </div>
    
    <header id="header-style-1" class="header-fix">
        <div class="container">
            <div class="navbar yamm navbar-default">
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php echo htmlSpecialChars($_control->link("Homepage:default")) ?>
"><img src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/images/frontend/logo/logo.jpg" width="280" height="50" alt="logo"></a>
        	</div><!-- end navbar-header -->
                
		<div id="navbar-collapse-1" class="navbar-collapse collapse navbar-right">
                    <ul class="nav navbar-nav">  
<?php $iterations = 0; foreach ($menu as $menuItem) { ?>
                            
<?php if (count($menuItem->submenus) == 0) { ?>
                                    <li class="dropdown yamm-fw">
<?php if ($menuItem->link == 'informacie-o-antiradaroch') { ?>
                                        <a data-toggle="dropdown" <?php if ($menuItem->link == $activePage) { ?>
class="selected-item dropdown-toggle" <?php } ?> onclick="location.href=<?php echo htmlSpecialChars(Nette\Templating\Helpers::escapeJs($_control->link("Article:default"))) ?>
" class="dropdown-toggle" href="<?php echo htmlSpecialChars($_control->link("Article:default")) ?>
"> <?php echo Nette\Templating\Helpers::escapeHtml($menuItem->name, ENT_NOQUOTES) ?><div class="arrow-up"></div></a>
                                        <ul class="dropdown-menu" role="menu">
<?php $iterations = 0; foreach ($allarticles as $artc) { ?>
                                            <li>
                                                <a href="<?php echo htmlSpecialChars($_control->link("Article:show", array($artc->link))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($artc->title, ENT_NOQUOTES) ?></a>
                                            </li>
<?php $iterations++; } ?>
                                    </ul>
<?php } elseif ($menuItem->link == 'homepage') { ?>
                                        <a <?php if ($menuItem->link == $activePage) { ?>
class="selected-item"<?php } ?> title="<?php echo htmlSpecialChars($menuItem->description) ?>
" href="<?php echo htmlSpecialChars($_control->link("Homepage:default")) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($menuItem->name, ENT_NOQUOTES) ?></a>
<?php } elseif ($menuItem->url) { ?>
                                        <a <?php if ($menuItem->link == $activePage) { ?>
class="selected-item"<?php } ?> title="<?php echo htmlSpecialChars($menuItem->description) ?>
" href="<?php echo htmlSpecialChars($_control->link($menuItem->url, array($menuItem->link))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($menuItem->name, ENT_NOQUOTES) ?></a>
<?php } else { ?>
                                        <a href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($menuItem->link)) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($menuItem->name, ENT_NOQUOTES) ?></a>
<?php } ?>
                                    </li>
                                    
<?php } else { ?>
                                    <li class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle <?php if ($menuItem->link == $activePage) { ?>
selected-item<?php } ?>"> <?php echo Nette\Templating\Helpers::escapeHtml($menuItem->name, ENT_NOQUOTES) ?><div class="arrow-up"></div></a>
                                    <ul class="dropdown-menu" role="menu">
<?php $iterations = 0; foreach ($menuItem->submenus as $sub) { ?>
                                            <li>
<?php if ($sub->link == 'homepage') { ?>
                                                    <a title="<?php echo htmlSpecialChars($sub->description) ?>
" href="<?php echo htmlSpecialChars($_control->link("Homepage:default")) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($sub->name, ENT_NOQUOTES) ?></a>
<?php } elseif ($sub->url) { ?>
                                                    <a title="<?php echo htmlSpecialChars($sub->description) ?>
" href="<?php echo htmlSpecialChars($_control->link($sub->url, array($sub->link))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($sub->name, ENT_NOQUOTES) ?></a>
<?php } else { ?>
                                                    <a href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($sub->link)) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($sub->name, ENT_NOQUOTES) ?></a>
<?php } ?>
                                            </li>
<?php $iterations++; } ?>
                                    </ul>
                                    </li>
<?php } $iterations++; } ?>

                        
                    </ul><!-- end navbar-nav -->
		</div><!-- #navbar-collapse-1 -->
            </div><!-- end navbar yamm navbar-default -->
	</div><!-- end container -->
    </header><!-- end header-style-1 -->
    <?php call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars())  ?>

<?php $iterations = 0; foreach ($bottom as $bot) { ?>
        <?php echo $bot->content ?>

<?php $iterations++; } ?>
    
<?php $iterations = 0; foreach ($menu as $menuItem) { if (count($menuItem->getSubmenus()) == 0) { ?>
            <li>
<?php if ($menuItem->link == 'informacie-o-antiradaroch') { ?>
                     <a title="<?php echo htmlSpecialChars($menuItem->description) ?>
" href="<?php echo htmlSpecialChars($_control->link("Article:default")) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($menuItem->name, ENT_NOQUOTES) ?></a>
<?php } elseif ($menuItem->link == 'homepage') { ?>
                    <a title="<?php echo htmlSpecialChars($menuItem->description) ?>
" href="<?php echo htmlSpecialChars($_control->link("Homepage:default")) ?>"><?php echo Nette\Templating\Helpers::escapeHtml($menuItem->name, ENT_NOQUOTES) ?></a>
<?php } elseif ($menuItem->url) { ?>
                    <a title="<?php echo htmlSpecialChars($menuItem->description) ?>
" href="<?php echo htmlSpecialChars($_control->link($menuItem->url, array($menuItem->link))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($menuItem->name, ENT_NOQUOTES) ?></a>
<?php } else { ?>
                    <a href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($menuItem->link)) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($menuItem->name, ENT_NOQUOTES) ?></a>
<?php } ?>
            </li>
<?php } $iterations++; } ?>
                    </ul>
                </div>
            </div><!-- end large-7 --> 
        </div><!-- end container -->
    </div><!-- end copyrights -->
    
    <div class="dmtop" id="totop">Scroll to Top</div>          
    <!-- Enable media queries on older bgeneral_rowsers -->
    <!--[if lt IE 9]>
    <script src="<?php echo Nette\Templating\Helpers::escapeHtmlComment($basePath) ?>js/respond.min.js"></script>  <![endif]-->
    <!-- Main Scripts-->
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/owl.carousel.min.js"></script>
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/jquery.parallax-1.1.3.js"></script>
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/jquery.simple-text-rotator.js"></script>
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/wow.min.js"></script>
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/custom.js"></script>
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/jquery.isotope.min.js"></script>
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/custom-portfolio-masonry.js"></script>
    
    <!-- Fullwidth Video Div  -->
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/menu.js"></script>
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/jquery.prettyPhoto.js"></script>
    <script src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/main.js"></script>
  </body>
</html>
<?php //netteCache[01]000419a:2:{s:4:"time";s:21:"0.14429900 1407977494";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:104:"/Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Settings/testdisplay.latte";i:2;i:1405701866;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2014-03-17";}}}?><?php

// source file: /Applications/XAMPP/xamppfiles/htdocs/Narwhal/Blacklist/AdminModule/templates/Settings/testdisplay.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'grjups1x2j')
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
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Jolly Themes | Item : Jollyany</title>

<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS Style -->
<link rel="stylesheet" href="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/css/admin/switcher.css"> 
 
<!-- Favicons -->
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

<!-- Used Fonts -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700" rel="stylesheet" type="text/css">

<!-- JavaScript -->
<script type="text/javascript" src="<?php echo htmlSpecialChars(Nette\Templating\Helpers::safeUrl($basePath)) ?>/js/jquery.js"></script>

<script >
	var theme_list_open=false;
		$(document).ready(function(){ function e(){ var e=$("#switcher")
		.height();$("#iframe")
		.attr("height",
		$(window).height()-e+"px")}
		IS_IPAD=navigator.userAgent.match(/iPad/i)!=null;
		$(window).resize(function(){ e()}).resize();
			$("#theme_select").click(function(){ if(theme_list_open==true){
			$(".center ul li ul").hide();theme_list_open=false}else{
			$(".center ul li ul").show();theme_list_open=true}return false});
			$("#theme_list ul li a").click(function(){ var e=$(this).attr("rel").split(",");
			$("li.purchase a").attr("href",e[1]);
			$("li.remove_frame a").attr("href",e[0]);
			$("#iframe").attr("src",e[0]);
			window.location.href = "?theme="+e[2]+""
			$("li.close a").attr("src",e[0]);
			$("#theme_list a#theme_select").text($(this).text());
			$(".center ul li ul").hide();theme_list_open=false;return false});
			$("#header-bar").hide();clicked="desktop";var t={ desktop:"100%",tabletlandscape:1040,tabletportrait:788,mobilelandscape:500,mobileportrait:340,placebo:0};jQuery(".responsive a").on("click",function(){ var e=jQuery(this);for(device in t){ console.log(device);console.log(t[device]);if(e.hasClass(device)){ clicked=device;jQuery("#iframe").width(t[device]);if(clicked==device){ jQuery(".responsive a").removeClass("active");e.addClass("active")}}}return false});if(IS_IPAD){ 
			$("#iframe").css("padding-bottom","60px")
		}}
	)
</script>

</head>

<body>

    <div id="switcher">
		<div class="center">
                <div class="responsive">
                    <a href="#" class="desktop active" title="View Desktop Version"></a> 
                    <a href="#" class="tabletlandscape" title="View Tablet Landscape (1024x768)"></a> 
                    <a href="#" class="tabletportrait" title="View Tablet Portrait (768x1024)"></a> 
                    <a href="#" class="mobilelandscape" title="View Mobile Landscape (480x320)"></a>
                    <a href="#" class="mobileportrait" title="View Mobile Portrait (320x480)"></a>
                </div>
                
                <div class="share" style="color:white;background-color:black;">
                    <h1><?php echo Nette\Templating\Helpers::escapeHtml($settings->siteurl, ENT_NOQUOTES) ?> - display switcher</h1>
                </div>
                
        </div>
    </div>
    <iframe id="iframe" src="<?php echo htmlSpecialChars($_control->link(":Front:Homepage:default")) ?>" frameborder="0" width="100%" style="height:800px;"></iframe>

    <!-- Place this tag after the last +1 button tag. -->
    <script type="text/javascript">
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>

	<div style="display:none">
		<script id="_wau13x">var _wau = _wau || []; _wau.push(["small", "xkkq2g7eoz4g", "13x"]);
    (function() { var s=document.createElement("script"); s.async=true;
    s.src="http://widgets.amung.us/small.js";
    document.getElementsByTagName("head")[0].appendChild(s);
    })();</script>
	</div>
    
</body>
</html>
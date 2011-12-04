<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
<script type="text/javascript" src="js/jquery-1.4.3.min.js" ></script>
<script type="text/javascript" src="js/slide.js" ></script>
	<title>Informame.pe</title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<?php if(in_array($_GET['r'],array('forum','forum/view','forum/thread','forum/newthread'))): ?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/forum.css" />
	<?php endif; ?>
	<?php if($_GET['r'] == 'forum/newthread'): ?>
	<script type="text/javascript" src="js/tiny_mce/tiny_mce.js" ></script>
	<script type="text/javascript">
      tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        theme_advanced_buttons1 : "bold,italic,underline,undo,redo,link,unlink,image,forecolor,removeformat,cleanup,example",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        thme_advanced_styles : "Code=codeStyle;Quote=quoteStyle",
        entity_encoding : "raw",
        add_unload_trigger : false,
        remove_linebreaks : false,
        inline_styles : false,
        convert_fonts_to_spans : false,
      });
	</script>
	<?php endif; ?>
	
	<style type="text/css">
body {
	background-color: #C0C0C0;
	background-image: url('images/background.png');
}

.rounded
{
border-radius: 10px 10px 10px 10px;
-ms-border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
-khtml-border-radius: 10px 10px 10px 10px;
background-color: #dfe1e3;
width:40%;
margin-left:30%;
margin-bottom:15px;
}

.rounded_two
{
height:35px;
border-radius: 10px 10px 10px 10px;
-ms-border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
-khtml-border-radius: 10px 10px 10px 10px;
background-color: #3673a1;
border: 1px solid white;
width:40%;
margin-left:30%;
}

.rounded_three
{
border-radius: 10px 10px 10px 10px;
-ms-border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
-khtml-border-radius: 10px 10px 10px 10px;
background-color: #3673a1;
border: 1px solid white;
width:60%;
margin-left:20%;
padding:20px;
background-color:white;
}

.rounded_two a {
	margin-left : 20px;
	display:inline;
	color:white;
	text-decoration: none;
	font-weight:bold;
	font-size:15px;
}

.rounded_two a:hover{
	color:white;
	font-size:17px;
	font-weight:bold;
	text-decoration:underline;
	
}

.rounded_two a:visited{
	color:white;
	font-size:15px;
	font-weight:bold;
}

/*VISOR*/
#slideshow {
    position:relative;
    height:125px;
}

#slideshow IMG {
	position:absolute;
	top:-1px;
	left:33px;
	z-index:8;
}

#slideshow IMG.active {
    z-index:10;
}

#slideshow IMG.last-active {
    z-index:9;
}


#slideshow2 {
    position:relative;
    height:125px;
}

#slideshow2 IMG {
	position:absolute;
	top:-146px;
	left:-435px;
	z-index:8;
}

#slideshow2 IMG.active {
    z-index:10;
}

#slideshow2 IMG.last-active {
    z-index:9;
}

#slideshow3 {
    position:relative;
    height:125px;
}

#slideshow3 IMG {
	position:absolute;
	top:-120px;
	left:-201px;
	z-index:8;
}

#slideshow3 IMG.active {
    z-index:10;
}

#slideshow3 IMG.last-active {
    z-index:9;
}


</style>
</head>


<body>
<h1 align="center"><img src="images/PaginaPrincipal3.png" width="800" height="125" /></h1>
<div class="rounded">
<p align="center"><i>&quot;Un ciudadano informado es un ciudadano con un paso adelante&quot; </i></p>
</div>

<div class="rounded_two">
<p align="center"><a href="./">INICIO</a><a href="./?r=user/create">REGISTRO</a><a href="./?r=site/login">LOGIN</a><a href="./?r=forum">FORUM</a>
<?php if(Yii::app()->user->isGuest): ?> Welcome, <?php echo Yii::app()->user->name?>  <?php endif; ?>

</p>

</div>
<br><br>
<?php if(!isset($_GET['r']) || $_GET['r'] == 'site/index'): ?>
<table  cellspacing="0" cellpadding="0" align="center">
				   <tr>
                   <td>
                        <a href="mapa.php" target="_blank" >
                        <div id="slideshow">
			  			<img src="images/btn_menu1.png" alt="" class="active" />
                        </div>
                     </a>
                        <br>
                     <div id="slideshow2"> <a href="tabs.php" target="_blank"><img src="images/btn_menu2.png" alt="" class="active"/></a><br>
					 </div>
                     <div id="slideshow3"><a href=""><img src="images/btn_menu3.png" alt="" class="active" /></a></div>	    
                     </td> 
  </tr>
</table>
<?php else: ?>
<div class="rounded_three">
<?php echo $content; ?>
</div>
<?php endif; ?>
<div class="rounded">
<p align="center"><i>CopyLeft 2011 - Yachaysoft Lima - Per&uacute; </i></p>
</div>
</body>
</html>
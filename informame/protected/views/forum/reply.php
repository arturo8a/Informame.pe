<?php
$this->breadcrumbs=array(
	'Forum'=>array('/forum'),
	'Reply',
);?>
<div class="gridfo" style="min-height:100px;">
<div class="headfor"><a href="#" style="color:#000000"> </a></div> 
<div class="black1"></div>
<div id="main">
<div class="rockcontent2" style="background-color:black;">
<div class="opciones" style="height:15px;">
</div>
<div class="foro_cabecera_centro"> 
<div class="foro_cabecera_izq"> 
<div class="foro_cabecera_drch"> 
<div style="padding-top:8px;text-align:center;"> 
<a href="#"><font class="la_cabecera">Forum Reply</font></a> 
</div> 
</div> 
</div> 
</div>
<div class="foro_contenido_centro"> 
<div class="foro_contenido_izq"> 
<div class="foro_contenido_drch"> 
<div class="form" style="text-align:left;margin-top: 0px;padding:10px;">

<b><?php echo $post->from->username; ?></b> said :
<div class="post_reply" style="background-color:#808080;border:1px dashed black;padding:5px;color:white;margin-top:5px;" id="quoted">
<?php
  $this->beginWidget('CMarkdown', array('purifyOutput'=>true));
  echo $post->content;
  $this->endWidget();
?>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'post-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>
<br>
    <div class="row">
        <?php echo $form->textArea($model,'content',array('rows'=>10, 'cols'=>90, 'value' => 'holaperu')); ?>
        <?php echo $form->error($model,'content'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Reply' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/tiny_mce/tiny_mce.js');?>
<?php Yii::app()->clientScript->registerScript(
    'formcheckLanguage',
    '
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
        setup : function(ed) {
          ed.addButton("example", {
            title : "Quote",
            image : "js/tiny_mce/plugins/example/img/quote.png",
            onclick : function() {
              tinyMCE.activeEditor.setContent("<div class=\"quote\">"+ document.getElementById("quoted").innerHTML + "</div><br/><br/>", {format : "raw"});
            }
          
          });
        }
      });
');?>
</div>
</div>
</div> 
</div>
<div class="foro_pie_centro"> 
<div class="foro_pie_izq"> 
<div class="foro_pie_drch">&nbsp;</div> 
</div> 

</div>
<br>
<div class="opciones">

</div>
</div>
</div>
</div>
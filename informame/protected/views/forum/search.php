<?php
$this->breadcrumbs=array(
	"Forum"=>array("/forum"),$forum->title=>"./?r=forum/view&id={$forum->id}",
);?>
<div class="gridfo" style="min-height:100px;">
<div class="headfor"><a href="#" style="color:#000000"> </a></div> 
<div class="black1"></div>
<div id="main">
<div class="rockcontent2" style="background-color:black;">
<div class="opciones" style="height:15px;">

</div>
<div class="marco">
<div class="bloque">
<div class="foro_cabecera_centro">
<div class="foro_cabecera_izq">
<div class="foro_cabecera_drch">
<div style="padding-top:8px;">
SEARCH RESULTS</div>
</div>
</div>
</div>
<div class="foro_contenido_centro">
<div class="foro_contenido_izq">
<div class="foro_contenido_drch">
<!-- Begin Threads -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
      array('name'=>'content','type'=>'html','header'=>'Post Content'),
      array('name'=>'time','header'=>'Minuto'),
      array('name'=>'date_time'),
    ),
));

?>
<!-- End Threads -->

</div>
</div>
</div>
<div class="foro_pie_centro">
<div class="foro_pie_izq">
<div class="foro_pie_drch">
&nbsp;</div>
</div>
</div>
<br/>
<div class="opciones">

</div>
</div>
</div>
</div>
</div>
</div>
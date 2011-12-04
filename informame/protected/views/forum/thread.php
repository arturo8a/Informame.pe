<?php
$this->breadcrumbs=array(
	'Forum'=>array('/forum'),
  $thread->forum->title=>'./?r=forum/view&id='.$thread->forum->id,
  $thread->title=>'./?r=forum/thread&id='.$thread->id,
	'Posts',
);?>
<div class="gridfo" style="min-height:100px;">
<div class="headfor"><a href="#" style="color:#000000"> </a></div> 
<div class="black1"></div>
<div id="main">
<div class="rockcontent2" style="background-color:black;">
<div class="opciones" style="height:15px;">
</div>

<div class="forum_navigation">
  <div class="forum_navigation_links">
  <?php $this->widget('zii.widgets.CBreadcrumbs', array(
      'links'=>$this->breadcrumbs,
    )); ?>
  </div>
</div>
<br>
<div class="forum_content">
<div class="forum_header">
<h3>
<?php echo $thread->title;?>
</h3>
</div>
<div class="forum_header_bottom"></div>

<div class="forum_legend"> 
<div class="foro_contenido_centro"> 
<div class="foro_contenido_izq"> 
<div class="foro_contenido_drch"> 
<div class="forum_paginator">
<?php
$thread->getPosts(1);
$this->widget('CLinkPager', array(
  'id'=>'linkspage',
	'currentPage'=>(intval($_GET['page'])-1),
	'itemCount'=>$thread->getTotalItems(),
	'pageSize'=>10,
	'maxButtonCount'=>6,
	'nextPageLabel'=>'Next &gt;',
	'prevPageLabel'=>'&lt; Prev',
	'header'=>'',
));
?>
</div>

<!-- Begin Posts -->
<?php foreach($thread->getPosts($_GET['page']) as $post): ?>
<div class="post_container">
<div class="post_avatar_column">
<font style="color:#434A55;font-weight:bold;">&nbsp;<?php echo $post->from->username; ?></font> 
<br>
<hr> 
<div style="text-align:left;"> 
<b>Posts:</b>  <?php echo $post->from->getTotalPosts(); ?>
<br> 
<b>Registered:</b>  <?php echo date("Y-m-d",$post->from->register_time); ?>
</div> 
<hr>
</div>
<div class="post_content_column">
<a href="#">#<?php echo $thread->id; ?>.<?php echo $post->number; ?></a>
 To : </b>
 <?php if($post->to->username==''):?>All <?php else : ?><?php echo $post->to->username; ?> <?php endif; ?><?php echo $post->date_time; ?>
&nbsp;&nbsp;
<hr> 
<div class="post_message">
<?php
  $this->beginWidget('CMarkdown', array('purifyOutput'=>true));
  echo $post->content;
  $this->endWidget();
?>
</div>
</div>
<div style="clear:both;"></div>

<?php if(!Yii::app()->user->isGuest):?>
<div class="forum_post_options">
<div class="forum_button" style="width:30px;float:left;"><a href="./?r=forum/reply&amp;id=<?php echo $post->id; ?>">Reply</a></div>
<?php if($post->from->id == Yii::app()->user->id): ?>
<div class="forum_button" style="width:30px;float:left; margin-left:10px;"><a href="./?r=forum/edit&amp;id=<?php echo $post->id; ?>">Edit</a></div>
<?php endif; ?>
</div>
<div style="clear:both;"></div>
<?php endif; ?>
</div>
<?php endforeach; ?>
<div class="forum_paginator">
<?php
$this->widget('CLinkPager', array(
  'id'=>'linkspage',
	'currentPage'=>(intval($_GET['page'])-1),
	'itemCount'=>$thread->getTotalItems(),
	'pageSize'=>10,
	'maxButtonCount'=>6,
	'nextPageLabel'=>'Next &gt;',
	'prevPageLabel'=>'&lt; Prev',
	'header'=>'',
));
?>
</div>


</div> 
</div> 
</div> 
</div>
<div class="forum_bottom"></div>
</div>

</div>
</div>
</div>
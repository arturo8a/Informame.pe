<?php
$this->breadcrumbs=array(
	"Forum"=>array("/forum"),$forum->title=>"./?r=forum/view&id={$forum->id}",
);?>
<div class="headfor"><a href="#" style="color:#000000"> </a></div> 
<div class="forum_container">
<div class="forum_navigation">
  <div class="forum_navigation_links">
  <?php $this->widget('zii.widgets.CBreadcrumbs', array(
      'links'=>$this->breadcrumbs,
    )); ?>
  </div>
</div>

<div class="forum_content">
<div class="forum_header">
<h3>
<?php echo $forum->title; ?>
</h3>
</div>
<div class="forum_header_bottom"></div>
<table class="forum_body">
<thead>
<tr>
<th class="forum_threads_col1">&nbsp;</th>
<th class="forum_threads_col2">Thread</th>
<th class="forum_threads_col3">Answers</th>
<th class="forum_threads_col4">Author</th>
<th class="forum_threads_col5">Readed</th>
<th class="forum_threads_col6">Last Post</th>
</tr>
</thead>
<tbody>
<?php $i=1; ?>
<?php foreach($forum->getThreads($_GET['page']) as $thread): ?>
<tr class="row<?php echo (($i%2==0)? 2 : 1); ?>">
<td class="forum_threads_col1">
<img src="images/forum/category/<?php
if($thread->thread_type_id == 3){
echo '3.gif';
}else if($thread->thread_type_id == 2){
echo '2.png';
}else{
echo '1.png';
}
?>" alt="" title="" />
</td>
<td class="forum_threads_col2">
<div class="col_content">
<h4><a href="./?r=forum/thread&id=<?php echo $thread->id; ?>"><?php echo $thread->title; ?></a></h4>
</div>
</td>
<td class="forum_threads_col3">
<ul>
<li><?php echo ($thread->getNumberPosts()-1); ?> Replies</li>
</ul>
</td>
<td class="forum_threads_col4">
<?php echo $thread->user->username; ?>
</td>
<td class="forum_threads_col5">
<?php echo $thread->readed; ?>
</td>
<td class="forum_threads_col6">
<ul>
<li><a href="#"><img src="images/last_post.png"></a> <a href="./?r=forum/thread&id=<?php echo $thread->id; ?>"><?php echo $thread->getLastPost()->date_time; ?></a></li>
<li>
<strong>By:</strong> 
<a href="#"><?php echo $thread->getLastPost()->from->username; ?></a>&nbsp;
</li>
</ul>
</td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>

<!-- End Category -->
</tbody>
</table>
<div class="forum_bottom"></div>
</div>
<?php if($forum->getTotalItems()>25): ?>
<div class="forum_paginator">
<?php
$this->widget('CLinkPager', array(
  'id'=>'linkspage',
	'currentPage'=>(intval($_GET['page'])-1),
	'itemCount'=>$forum->getTotalItems(),
	'pageSize'=>25,
	'maxButtonCount'=>6,
	'nextPageLabel'=>'Next &gt;',
	'prevPageLabel'=>'&lt; Prev',
	'header'=>'',
));
?>
</div>
<?php endif; ?>
<?php if(!Yii::app()->user->isGuest): ?>

<div class="forum_content">
<div class="forum_header">
<h3>
Options
</h3>
</div>
<div class="forum_header_bottom"></div>
<div class="forum_legend">
<a href="./?r=forum/newthread&amp;id=<?php echo $forum->id; ?>">
<div class="forum_button">
 New Thread 
</div>
</a>
</div> 
<div class="forum_bottom"></div>
</div>
<?php endif; ?>

<div class="forum_content">
<div class="forum_header">
<h3>
Legend
</h3>
</div>
<div class="forum_header_bottom"></div>
<div class="forum_legend"> 
<div style="float:left;width:25%;text-align:left;"> 
<img src="images/forum/category/1.png" alt="&nbsp;Thread" title="&nbsp;Thread"> 
&nbsp;&nbsp;&nbsp;Thread
</div> 
<div style="float:left;width:25%;"> 
<img src="images/forum/anuncio.gif" alt="&nbsp;Anouncements" title="&nbsp;Anouncements"> 
&nbsp;&nbsp;&nbsp;Anouncements
</div> 
<div style="float:left;width:25%;"> 
<img src="images/forum/category/3.gif" alt="&nbsp;Post-It" title="&nbsp;Post-It"> 
&nbsp;&nbsp;&nbsp;Post-It
</div> 
<div style="float:left;width:25%;"> 
<img src="images/forum/encuesta.gif" alt="&nbsp;Survey" title="&nbsp;Survey">&nbsp;&nbsp;&nbsp;Survey
</div> 
<div style="clear:both;"></div> 
</div> 
<div class="forum_bottom"></div>
</div>
<div class="opciones">

</div>
</div>
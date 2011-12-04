<?php
$this->breadcrumbs=array(
	"Forum"=>array("/forum"),
);?>
<div class="gridfo" style="min-height:100px;">
<div class="headfor"><a href="#" style="color:#000000"> </a></div> 
<div class="black1"></div>
<div id="main">
<div class="rockcontent2" style="background-color:black;">
<div class="marco">
<div class="bloque">
<br/>
<div class="forum_navigation">
  <div class="forum_navigation_links">
  <?php $this->widget('zii.widgets.CBreadcrumbs', array(
      'links'=>$this->breadcrumbs,
    )); ?>
  </div>
</div>
<!-- Categories -->
<?php foreach($categories as $category): ?>
<div class="forum_content">
<div class="forum_header">
<h3>
<?php echo $category->title; ?>
</h3>
</div>
<div class="forum_header_bottom"></div>
<table class="forum_body">
<thead>
<tr>
<th class="forum_body_col1">&nbsp;</th><th class="forum_body_col2">Forum</th><th class="forum_body_col3">Stats</th><th class="forum_body_col4">Last Post Info</th>
</tr>
</thead>
<tbody>
<?php $i=1; ?>
<?php foreach($category->forums as $forum): ?>
<tr class="row<?php echo (($i%2==0)? 2 : 1); ?>">
<td class="forum_body_col1">
<img src="images/forum.gif">
</td>
<td class="forum_body_col2">
<div class="col_content">
<h4><a href="./?r=forum/view&amp;id=<?php echo $forum->id; ?>"><?php echo $forum->title; ?></a></h4>
<p class="desc"><?php echo $forum->description; ?></p>
</div>
</td>
<td class="forum_body_col3">
<ul>
<li><?php echo $forum->getNumberThreads(); ?> Topics</li>
<li><?php echo $forum->getNumberPosts(); ?> Replies</li>
</ul>
</td>
<td class="forum_body_col4">
<?php if($forum->getLastPost()->from->username != ''): ?>
<ul>
<li><a href="#"><img src="images/last_post.png"></a> <a href="#"><?php echo $forum->getLastPost()->date_time; ?></a></li>
<!--<li><strong>In:</strong> <a href="#" >Thread</a></li>-->
<li>
<strong>By:</strong> 
<a href="#"><?php echo $forum->getLastPost()->from->username; ?></a>&nbsp;
</li>
</ul>
<?php endif; ?>
</td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>

<!-- End Category -->
</tbody>
</table>
<div class="forum_bottom"></div>
</div>
<?php endforeach; ?>
<br/>
<div class="forum_content">
<div class="forum_header">
<h3>
INFORMATION
</h3>
</div>

<div class="forum_header_bottom"></div>
<table class="forum_body">
<tbody>
<tr class="row1">
<td class="forum_body_col4" colspan="3">
<table cellpadding="4" width="100%">
<tr>
<th rowspan="3" align="center">
<img src="images/avatar/nofoto.gif" />
</th>
<td rowspan=3>
<b>
Total Threads:</b>
<?php echo $totalThreads; ?> || <b>
Total Answers:</b>
<?php echo $totalPosts; ?></td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>
<div class="forum_bottom"></div>
</div>
<br/>

</div>
</div>
</div>
</div>
</div>
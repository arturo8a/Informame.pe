<?php

class ForumController extends Controller
{

  
	public function actionDelete()
	{
		$this->render('delete');
	}

	public function actionEdit()
	{
		$this->render('edit');
	}

	public function actionIndex()
	{
    $categories = ForumCategory::model()->with('forums')->findAll();
    $totalThreads = Thread::model()->count();
    $totalPosts = Post::model()->count();
    $logged = User::model()->findByPk(Yii::app()->user->id);
		$this->render('index',array('categories'=>$categories,'totalThreads'=>$totalThreads,'totalPosts'=>$totalPosts,'logged'=>$logged));
	}

	public function actionNewthread()
	{
		if(is_numeric($_GET['id']) && $_GET['id'] > 0 && !Yii::app()->user->isGuest)
		{
			$idForum = intval($_GET['id']);
			$forum = Forum::model()->findByPk($idForum);
			if($forum)
			{
        $model = new Post;
        $threadModel = new Thread;
        $p = new CHtmlPurifier();
        if(isset($_POST['Thread']) && isset($_POST['Post']))
        {
          
          $threadModel->attributes = $_POST['Thread'];
          $threadModel->date_time = new CDbExpression('NOW()');
          $threadModel->time = time();
          $threadModel->title = $p->purify($threadModel->title);
          $threadModel->readed = 0;
          $threadModel->status = 1;
          $threadModel->thread_type_id = 1;
          $threadModel->forum_id = $forum->id;
          $threadModel->user_id = Yii::app()->user->id;
          if($threadModel->save()){
            $model->attributes = $_POST['Post'];
            $model->date_time = new CDbExpression('NOW()');
            $model->time = time();
            $model->deleted = 0;
            $model->thread_id = $threadModel->id;
            $model->from_id = Yii::app()->user->id;
            $model->number = 1;
            $model->to_id = NULL;
            if($model->save())
              $this->redirect('./?r=forum/thread&id='.$threadModel->id);
            else
              $threadModel->delete();
              $threadModel = new Thread;
          }
        }
        $this->render('newthread',array('model'=>$model,'forum'=>$forum,'threadModel'=>$threadModel));
			}
			else
			{
        $this->redirect('./?r=forum');
			}
		}else{
			$this->redirect('./?r=forum');
		}
	}

	public function actionReply()
	{
		if(is_numeric($_GET['id']) && $_GET['id'] > 0 && !Yii::app()->user->isGuest)
		{
			$idPost = intval($_GET['id']);
			$post = Post::model()->with('from')->findByPk($idPost);
			if($post)
			{
        $model = new Post;
        $p = new CHtmlPurifier();
        if(isset($_POST['Post']))
        {
          $model->attributes = $_POST['Post'];
          $model->date_time = new CDbExpression('NOW()');
          $model->time = time();
          $model->deleted = 0;
          $model->thread_id = $post->thread_id;
          $model->from_id = Yii::app()->user->id;
          $model->to_id = $post->from_id;
          $model->content = $p->purify($model->content);
          $lastPost = Thread::model()->findByPk($post->thread_id)->getLastPost();
          $model->number = $lastPost->number + 1;
          if($model->save())
            $this->redirect('./?r=forum/thread&id='.$post->thread_id);
        }
        
        $purified = $p->purify($post->content);
        $this->render('reply',array('model'=>$model,'post'=>$post,'purified'=>$purified));
			}
			else
			{
        $this->redirect('./?r=forum');
			}
		}else{
			$this->redirect('./?r=forum');
		}
	}

	public function actionThread()
	{
		if(is_numeric($_GET['id']) && $_GET['id'] > 0)
		{
			$idThread = intval($_GET['id']);
			$thread = Thread::model()->findByPk($idThread);
			if($thread)
			{
        $this->render('thread',array('thread'=>$thread));
			}
			else
			{
        $this->redirect('./?r=forum');
			}
		}else{
			$this->redirect('./?r=forum');
		}
	}

	public function actionView()
	{
		if(is_numeric($_GET['id']) && $_GET['id'] > 0)
		{
			$idForum = intval($_GET['id']);
			$forum = Forum::model()->findByPk($idForum);
			if($forum)
			{
        $this->render('view',array('forum'=>$forum));
			}
			else
			{
        $this->redirect('./?r=forum');
			}
		}else{
			$this->redirect('./?r=forum');
		}

		
	}
  
  
  public function actionSearch()
  {

    $rawData=Yii::app()->db->createCommand('SELECT tbl_thread.title,tbl_post.content,tbl_post.time,tbl_post.date_time FROM tbl_post JOIN tbl_thread ON thread_id = tbl_thread.id WHERE title LIKE "%'.$_GET['q'].'%" OR content LIKE "%'.$_GET['q'].'%"');
    $allData = $rawData->queryAll();
    // or using: $rawData=User::model()->findAll();
    $dataProvider=new CArrayDataProvider($allData, array(
        'sort'=>array(
            'attributes'=>array(
                 'title', 'content', 'time' ,'date_time', 'Title Post'
            ),
        ),
        'pagination'=>array(
            'pageSize'=>10,
        ),
    ));
    $this->render('search',array('dataProvider'=>$dataProvider));
  }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
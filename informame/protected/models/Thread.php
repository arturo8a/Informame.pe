<?php

/**
 * This is the model class for table "tbl_thread".
 *
 * The followings are the available columns in table 'tbl_thread':
 * @property string $id
 * @property string $title
 * @property string $readed
 * @property integer $status
 * @property string $thread_type_id
 * @property string $forum_id
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property Post[] $posts
 * @property ThreadType $threadType
 * @property Forum $forum
 * @property User $user
 * @property Viewed[] $vieweds
 */
class Thread extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Thread the static model class
	 */
   
  public $results = 0;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_thread';
	}
	
  public function getNumberPosts()
  {
    $criteria=new CDbCriteria;
    $criteria->condition = 'thread_id=:threadID';
    $criteria->params=array(':threadID'=>$this->id);
    return Post::model()->with('forum')->count($criteria->condition,$criteria->params);
  }
	
	public function getLastPost()
  {
  
	  $criteria=new CDbCriteria;
		$criteria->condition = 'thread_id=:threadID';
		$criteria->order = 't.time DESC';
		$criteria->params=array(':threadID'=>$this->id);
		return Post::model()->with('forum','from')->find($criteria);
	}
  
  public function getTotalItems()
  {
    return $this->results;
  }
  
  public function getPosts($page = 1){

  /*
	  $criteria=new CDbCriteria;
	  $criteria->condition = 'thread_id=:threadID';
	  $criteria->order = 'number  ASC';
	  $criteria->params=array(':threadID'=>$this->id);
	  return Post::model()->with('from','to')->findAll($criteria);
    */
    
    if(!is_numeric($page)) $page = 1;
    if($page < 1) $page = 1;

    $dataProvider=new CActiveDataProvider('Post', array(
        'criteria'=>array(
            'condition'=>'thread_id=:threadID',
            'order'=>'number  ASC',
            'params'=>array(':threadID' => $this->id),
            'with'=>array('from','to'),
        ),
        'pagination'=>array(
            'pageSize'=>10,
            'currentPage'=>($page-1),
        ),
    ));
    $this->results = $dataProvider->totalItemCount;
    return $dataProvider->getData();
  }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, thread_type_id, forum_id, user_id', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('readed, thread_type_id, forum_id, user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, readed, status, thread_type_id, forum_id, user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'posts' => array(self::HAS_MANY, 'Post', 'thread_id'),
			'threadType' => array(self::BELONGS_TO, 'ThreadType', 'thread_type_id'),
			'forum' => array(self::BELONGS_TO, 'Forum', 'forum_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'vieweds' => array(self::HAS_MANY, 'Viewed', 'thread_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'readed' => 'Readed',
			'status' => 'Status',
			'thread_type_id' => 'Thread Type',
			'forum_id' => 'Forum',
			'user_id' => 'User',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('readed',$this->readed,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('thread_type_id',$this->thread_type_id,true);
		$criteria->compare('forum_id',$this->forum_id,true);
		$criteria->compare('user_id',$this->user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
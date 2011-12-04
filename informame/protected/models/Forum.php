<?php

/**
 * This is the model class for table "tbl_forum".
 *
 * The followings are the available columns in table 'tbl_forum':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $date_time
 * @property integer $time
 * @property string $category_id
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property ForumCategory $category
 * @property User $user
 * @property Thread[] $threads
 */
class Forum extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Forum the static model class
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
		return 'tbl_forum';
	}
  
  public function getNumberThreads(){
      $criteria=new CDbCriteria;
      $criteria->condition = 'forum_id=:forumID';
      $criteria->params=array(':forumID'=>$this->id);
      return Thread::model()->count($criteria->condition,$criteria->params);
  }
  
  public function getNumberPosts(){
      $criteria=new CDbCriteria;
      $criteria->condition = 'forum_id=:forumID';
      $criteria->params=array(':forumID'=>$this->id);
      return Post::model()->with('forum')->count($criteria->condition,$criteria->params);
  }
  
  public function getLastPost(){

      $criteria=new CDbCriteria;
      $criteria->condition = 'forum_id=:forumID';
      $criteria->order = 't.time DESC';
      $criteria->params=array(':forumID'=>$this->id);
      return Post::model()->with('forum')->find($criteria);
  }
  
  public function getTotalItems(){
    return $this->results;
  }
  
  public function getThreads($page = 1){
    if(!is_numeric($page)) $page = 1;
    if($page < 1) $page = 1;
    
    
    $dataProvider=new CActiveDataProvider('Thread', array(
        'criteria'=>array(
            'condition'=>'forum_id=:forumID',
            'order'=>'t.date_time DESC',
            'params'=>array(':forumID' => $this->id),
            'with'=>array('forum'),
        ),
        'pagination'=>array(
            'pageSize'=>25,
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
			array('title, description, date_time, time, category_id, user_id', 'required'),
			array('time', 'numerical', 'integerOnly'=>true),
			array('title, description', 'length', 'max'=>45),
			array('category_id, user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, date_time, time, category_id, user_id', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'ForumCategory', 'category_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'threads' => array(self::HAS_MANY, 'Thread', 'forum_id'),
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
			'description' => 'Description',
			'date_time' => 'Date Time',
			'time' => 'Time',
			'category_id' => 'Category',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('date_time',$this->date_time,true);
		$criteria->compare('time',$this->time);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('user_id',$this->user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
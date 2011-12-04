<?php

/**
 * This is the model class for table "tbl_post".
 *
 * The followings are the available columns in table 'tbl_post':
 * @property string $id
 * @property string $number
 * @property string $content
 * @property string $date_time
 * @property string $time
 * @property integer $deleted
 * @property string $thread_id
 * @property string $from_id
 * @property string $to_id
 *
 * The followings are the available model relations:
 * @property Thread $thread
 * @property User $from
 * @property User $to
 */
class Post extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, content, date_time, time, deleted, thread_id, from_id', 'required'),
			array('deleted', 'numerical', 'integerOnly'=>true),
			array('number, thread_id, from_id, to_id', 'length', 'max'=>10),
			array('date_time, time', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, content, date_time, time, deleted, thread_id, from_id, to_id', 'safe', 'on'=>'search'),
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
			'thread' => array(self::BELONGS_TO, 'Thread', 'thread_id'),
			'from' => array(self::BELONGS_TO, 'User', 'from_id'),
			'to' => array(self::BELONGS_TO, 'User', 'to_id'),
			'forum' => array(self::HAS_MANY, 'Forum', 'forum_id','through'=>'thread'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => 'Number',
			'content' => 'Content',
			'date_time' => 'Date Time',
			'time' => 'Time',
			'deleted' => 'Deleted',
			'thread_id' => 'Thread',
			'from_id' => 'From',
			'to_id' => 'To',
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
		$criteria->compare('number',$this->number,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('date_time',$this->date_time,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('thread_id',$this->thread_id,true);
		$criteria->compare('from_id',$this->from_id,true);
		$criteria->compare('to_id',$this->to_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
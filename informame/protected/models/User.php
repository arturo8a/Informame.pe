<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $register_ip
 * @property string $register_date
 * @property string $register_time
 * @property integer $status
 * @property integer $category_id
 * @property string $country_id
 * @property string $name
 * @property string $surname
 *
 * The followings are the available model relations:
 * @property Forum[] $forums
 * @property Log[] $logs
 * @property Post[] $posts
 * @property Post[] $posts1
 * @property SystemPreferences[] $systemPreferences
 * @property Thread[] $threads
 * @property Country $country
 * @property UserCategory $category
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	  public function getTotalPosts()
  {
      $criteria=new CDbCriteria;
      $criteria->condition = 'from_id=:userID';
      $criteria->params=array(':userID'=>$this->id);
      return Post::model()->count($criteria->condition,$criteria->params);
  }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, register_ip, register_date, register_time, category_id, country_id', 'required'),
			array('status, category_id', 'numerical', 'integerOnly'=>true),
			array('username, register_time', 'length', 'max'=>20),
			array('password, email, register_ip', 'length', 'max'=>45),
			array('country_id', 'length', 'max'=>2),
			array('name, surname', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, register_ip, register_date, register_time, status, category_id, country_id, name, surname', 'safe', 'on'=>'search'),
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
			'forums' => array(self::HAS_MANY, 'Forum', 'user_id'),
			'logs' => array(self::HAS_MANY, 'Log', 'user_id'),
			'posts' => array(self::HAS_MANY, 'Post', 'from_id'),
			'posts1' => array(self::HAS_MANY, 'Post', 'to_id'),
			'systemPreferences' => array(self::HAS_MANY, 'SystemPreferences', 'tbl_user_id'),
			'threads' => array(self::HAS_MANY, 'Thread', 'user_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'category' => array(self::BELONGS_TO, 'UserCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'register_ip' => 'Register Ip',
			'register_date' => 'Register Date',
			'register_time' => 'Register Time',
			'status' => 'Status',
			'category_id' => 'Category',
			'country_id' => 'Country',
			'name' => 'Name',
			'surname' => 'Surname',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('register_ip',$this->register_ip,true);
		$criteria->compare('register_date',$this->register_date,true);
		$criteria->compare('register_time',$this->register_time,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
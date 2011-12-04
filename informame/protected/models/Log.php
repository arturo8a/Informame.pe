<?php

/**
 * This is the model class for table "tbl_log".
 *
 * The followings are the available columns in table 'tbl_log':
 * @property string $id
 * @property string $date_time
 * @property integer $time
 * @property string $ip_address
 * @property string $information
 * @property string $log_type_id
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property LogType $logType
 * @property User $user
 */
class Log extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Log the static model class
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
		return 'tbl_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_time, time, ip_address, log_type_id, user_id', 'required'),
			array('time', 'numerical', 'integerOnly'=>true),
			array('ip_address', 'length', 'max'=>45),
			array('information', 'length', 'max'=>255),
			array('log_type_id', 'length', 'max'=>20),
			array('user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date_time, time, ip_address, information, log_type_id, user_id', 'safe', 'on'=>'search'),
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
			'logType' => array(self::BELONGS_TO, 'LogType', 'log_type_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date_time' => 'Date Time',
			'time' => 'Time',
			'ip_address' => 'Ip Address',
			'information' => 'Information',
			'log_type_id' => 'Log Type',
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
		$criteria->compare('date_time',$this->date_time,true);
		$criteria->compare('time',$this->time);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('information',$this->information,true);
		$criteria->compare('log_type_id',$this->log_type_id,true);
		$criteria->compare('user_id',$this->user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
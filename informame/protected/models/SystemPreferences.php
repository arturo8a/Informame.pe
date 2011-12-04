<?php

/**
 * This is the model class for table "tbl_system_preferences".
 *
 * The followings are the available columns in table 'tbl_system_preferences':
 * @property string $name
 * @property string $value
 * @property string $tbl_user_id
 *
 * The followings are the available model relations:
 * @property User $tblUser
 */
class SystemPreferences extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SystemPreferences the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
  
  public static function get($variable){
    $className = __CLASS__;
    return parent::model($className)->findByPk($variable)->value;
  }
  
  public static function set($variable,$value){
    $className = __CLASS__;
    $model = parent::model($className)->findByPk($variable);
    $model->value = $value;
    $model->save();
  }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_system_preferences';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, tbl_user_id', 'required'),
			array('name, value', 'length', 'max'=>45),
			array('tbl_user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, value, tbl_user_id', 'safe', 'on'=>'search'),
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
			'tblUser' => array(self::BELONGS_TO, 'User', 'tbl_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'value' => 'Value',
			'tbl_user_id' => 'Tbl User',
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('tbl_user_id',$this->tbl_user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
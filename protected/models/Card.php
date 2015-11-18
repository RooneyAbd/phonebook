<?php

/**
 * This is the model class for table "cards".
 *
 * The followings are the available columns in table 'cards':
 * @property integer $id
 * @property string $name
 * @property string $last_name
 * @property string $fathers_name
 * @property integer $office
 * @property integer $department
 * @property integer $phone
 * @property string $other
 * @property integer $owner_id
 *
 * The followings are the available model relations:
 * @property Users[] $users
 * @property Users $owner
 * @property Department $department0
 * @property Office $office0
 */
class Card extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cards';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, last_name', 'required'),
			array('office, department, phone, owner_id', 'numerical', 'integerOnly'=>true),
			array('name, last_name, fathers_name, other', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, last_name, fathers_name, office, department, phone, other, owner_id', 'safe', 'on'=>'search'),
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
			'owner' => array(self::BELONGS_TO, 'Users', 'owner_id'),
			'department0' => array(self::BELONGS_TO, 'Department', 'department'),
			'office0' => array(self::BELONGS_TO, 'Office', 'office'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'last_name' => 'Last Name',
			'fathers_name' => 'Fathers Name',
			'office' => 'Office',
			'department' => 'Department',
			'phone' => 'Phone',
			'other' => 'Other',
			'owner_id' => 'Owner',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('fathers_name',$this->fathers_name,true);
		$criteria->compare('office',$this->office);
		$criteria->compare('department',$this->department);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('other',$this->other,true);
		$criteria->compare('owner_id',$this->owner_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Card the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

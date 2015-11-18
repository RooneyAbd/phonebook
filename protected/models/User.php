<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $user_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $create_time
 * @property string $update_time
 * @property string $role
 *
 * The followings are the available model relations:
 * @property AuthItem[] $authItems
 * @property Cards[] $cards
 * @property Cards[] $cards1
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    public $password_repeat;
	public function tableName()
	{
		return 'users';
	}

    public function behaviors()
    {
        return array(
            'CtimestampBehavior'=>array(
                'class'=>'zii.behaviors.CtimestampBehavior',
                'createAttribute'=>'create_time',
                'updateAttribute'=>'update_time',
                'setUpdateOnCreate'=>true,
            ),
        );
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('username, email, password, role', 'length', 'max'=>45),
			array('create_time, update_time', 'safe'),
            array('email, username', 'unique'),
            array('email', 'email'),
            
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, username, email, password, create_time, update_time, role', 'safe', 'on'=>'search'),
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
			'authItems' => array(self::MANY_MANY, 'AuthItem', 'auth_assignment(userid, itemname)'),
			'cards1' => array(self::HAS_MANY, 'Cards', 'owner_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'role' => 'Role',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('role',$this->role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public function afterSave() {
        $assignments = Yii::app()->authManager->getAuthAssignments($this->user_id);
        if (!empty($assignments)) {
            foreach ($assignments as $key => $assignment) {
                Yii::app()->authManager->revoke($key, $this->user_id);
            }
        }
        Yii::app()->authManager->assign($this->role, $this->user_id);
        return parent::afterSave();
    }

    protected function afterValidate()
    {
        parent::afterValidate();
        if (!$this->hasErrors())
            $this->password=$this->hashPassword($this->password);
    }

    public function hashPassword($password)
    {
        return md5($password);
    }

    public function validatePassword($password)
    {
        return $this->hashPassword($password)===$this->password;
    }




}

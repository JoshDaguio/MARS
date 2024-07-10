<?php

/**
 * This is the model class for table "{{account}}".
 *
 * The followings are the available columns in table '{{account}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email_address
 * @property string $salt
 * @property integer $account_type_id
 * @property integer $status_id
 * @property string $date_created
 * @property string $date_updated
 * @property string $expiration_date
 *
 * The followings are the available model relations:
 * @property AccountType $accountType
 * @property Status $status
 * @property BirthHistory[] $birthHistories
 * @property ClinicAssignment[] $clinicAssignments
 * @property ConsultationRecord[] $consultationRecords
 * @property ConsultationRecord[] $consultationRecords1
 * @property ImmunizationRecord[] $immunizationRecords
 * @property Prescription[] $prescriptions
 * @property Prescription[] $prescriptions1
 * @property User[] $users
 */
class Account extends CActiveRecord
{
	public $retypepassword;
	public $oldpassword;
	public $newpassword;
	public $confirmnew;
	public $retypeemail;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{account}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email_address', 'length', 'max'=>255),
			array('email_address', 'validateNewEmailAddress', 'on'=>'createNewDoctor'),
			array('email_address', 'validateNewEmailAddress', 'on'=>'createNewPatient'),
			array('username', 'validateNewUsername', 'on'=>'createNewDoctor'),
			array('username', 'validateNewUsername', 'on'=>'createNewPatient'),
			array('email_address', 'validateAccountEmailAddress', 'on'=>'updateDoctor'),
			array('email_address', 'validateAccountEmailAddress', 'on'=>'updatePatient'),
			array('email_address', 'validateAccountEmailAddress', 'on'=>'updateSecretary'),
			array('username', 'validateAccountUsername', 'on'=>'updateDoctor'),
			array('username', 'validateAccountUsername', 'on'=>'updatePatient'),
			array('username', 'validateAccountUsername', 'on'=>'updateSecretary'),
			array('username', 'length', 'max'=>128),
			array('username', 'length', 'min'=>4),
			array('password', 'length', 'max'=>255),
			array('retypepassword, oldpassword, newpassword', 'length', 'max'=>255),
			array('password, retypepassword, newpassword', 'length', 'min'=>8),			
			array('username, password, retypepassword', 'required', 'on'=>'createNewDoctor'),
			array('username, password, retypepassword', 'required', 'on'=>'createNewPatient'),
			array('username', 'match', 'pattern'=>'/^[A-Za-z0-9]+$/u', 'message'=>Yii::t('default','Special characters are not permitted on Username.')),
			array('password, retypepassword', 'match', 'pattern'=>'/^[A-Za-z0-9]+$/u', 'message'=>Yii::t('default', 'Special characters are not permitted on Password.')),
			array('password', 'compare', 'compareAttribute'=>'retypepassword', 'on'=>'createNewDoctor'),
			array('password', 'compare', 'compareAttribute'=>'retypepassword', 'on'=>'createNewPatient'),
			array('password', 'compare', 'compareAttribute'=>'retypepassword', 'on'=>'createNewSecretary'),
			array('username, account_type_id', 'required'),
			array('account_type_id, status_id', 'numerical', 'integerOnly'=>true),
			array('username, password, salt', 'length', 'max'=>128),
			array('email_address', 'length', 'max'=>255),
			array('email_address', 'email'),
			array('expiration_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email_address, salt, account_type_id, status_id, date_created, date_updated, expiration_date', 'safe', 'on'=>'search'),
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
			'accountType' => array(self::BELONGS_TO, 'AccountType', 'account_type_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
			'birthHistory' => array(self::HAS_ONE, 'BirthHistory', 'account_id'),
			'birthHistories' => array(self::HAS_MANY, 'BirthHistory', 'account_id'),
			'clinicAssignments' => array(self::HAS_MANY, 'ClinicAssignment', 'account_id'),
			'consultationRecords' => array(self::HAS_MANY, 'ConsultationRecord', 'doctor_account_id'),
			'consultationRecords1' => array(self::HAS_MANY, 'ConsultationRecord', 'patient_account_id'),
			'immunizationRecords' => array(self::HAS_MANY, 'ImmunizationRecord', 'account_id'),
			'prescriptions' => array(self::HAS_MANY, 'Prescription', 'doctor_account_id'),
			'prescriptions1' => array(self::HAS_MANY, 'Prescription', 'patient_account_id'),
			'users' => array(self::HAS_MANY, 'User', 'account_id'),
			'user' => array(self::HAS_ONE, 'User', 'account_id'),
			'DoctorSchedule' => array(self::HAS_ONE, 'DoctorSched', 'account_id'),
			'DoctorSchedules' => array(self::HAS_MANY, 'DoctorSched', 'account_id'),
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
			'email_address' => 'Email Address',
			'salt' => 'Salt',
			'account_type_id' => 'Account Type',
			'status_id' => 'Status',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('account_type_id',$this->account_type_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->salt=$this->generateSalt();
				$this->password=$this->hashPassword($this->password,$this->salt);
				$this->date_created = date('Y-m-d H:i:s');
				$this->date_updated = date('Y-m-d H:i:s');
				$this->status_id = 1;
				$this->expiration_date = date('Y-m-d H:i:s', strtotime(' + 3 months'));
			}
			else
			{
				$this->date_updated = date('Y-m-d H:i:s');
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Validates user login password entered
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}
	
	/*
	 * Generate salt
	 */
	public function generateSalt()
	{
		// Simple timestamp. Needs to be worked on to make site more secure
		return time();
	}
	
	/*
	 * Create hashed password
	 */
	public function hashPassword($password,$salt)
	{
		// Use sha1
		return sha1($password.$salt);
	}

	public function actionCalendarEvents()
	{
		$items[]=array(
			'title'=>'Meeting',
			'start'=>'2012-11-23',
			'color'=>'#CC0000',
			'allDay'=>true,
			'url'=>'http://anyurl.com'
		);
		$items[]=array(
			'title'=>'Meeting reminder',
			'start'=>'2012-11-19',
			'end'=>'2012-11-22',

			// can pass unix timestamp too
			// 'start'=>time()

			'color'=>'blue',
		);

		echo CJSON::encode($items);
		Yii::app()->end();
	}
	
	/**
	 * Validates username entry in plant a vine.
	 * Only usernames not found in database allowed
	 */
	public function validateNewUsername($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if($this->username==$this->password)
			{
				$this->addError('password', 'Username and password should not be the same!');
			}
			else
			{
				$account=Account::model()->find('username=?',array($this->username));
				if($account !== null)
					$this->addError('username','Username entered is already in use.');
			}
		}
	}
	
	/**
	 * Validates username when updating your account.
	 */
	public function validateAccountUsername($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if($this->hashPassword($this->username,$this->salt)==$this->password)
			{
				$this->addError('username', 'Username and password should not be the same!');
			}
			else
			{
				$account=Account::model()->find(array(
					'condition'=>'username=:username AND id<>:id',
					'params'=>array(
						':username'=>$this->username,
						':id'=>$this->id,
					)
				));
				//print_r($account->attributes);
				//exit;
				if($account !== null)
					$this->addError('username','Username entered is already in use.');
			}
		}
	}
	
	/**
	 * Validate your old account password when updating account
	 */
	public function validateAccountPassword($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if(trim($this->oldpassword)!='' || trim($this->password)!='')
			{
				$hashed_password=$this->hashPassword($this->oldpassword,$this->salt);
				$account=Account::model()->find(array(
					'condition'=>'password=:password AND id=:id',
					'params'=>array(
						':password'=>$hashed_password,
						':id'=>Yii::app()->user->id,
					)
				));
				if($account===null)
					$this->addError('oldpassword','You have entered your account password incorrectly.');
				else
				{
					if($this->password==='')
						$this->addError('password','Please do not leave the new password field empty.');
				}
			}
		}
	}
	

	/**
	 * Validates email entry.
	 * Only email addresses not found in database allowed
	 */
	public function validateNewEmailAddress($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if($this->email_address!=='')
			{
				if(!filter_var($this->email_address,FILTER_VALIDATE_EMAIL))
				{
					$this->addError('email_address','Please use a valid email address.');
				}
				else
				{
					$account=Account::model()->find(array(
						'condition'=>'email_address=:email_address',
						'params'=>array(
							':email_address'=>$this->email_address
						)
					));
					if($account !== null)
						$this->addError('email_address','Email address entered is already in use.');	
				}
			}
		}
	}
	
	public function validateAccountEmailAddress($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if($this->email_address!=='')
			{
				if(!filter_var($this->email_address,FILTER_VALIDATE_EMAIL))
				{
					$this->addError('email_address','Please use a valid email address.');
				}
				else
				{
					$account=Account::model()->find(array(
						'condition'=>'email_address=:email_address AND id<>:id',
						'params'=>array(
							':email_address'=>$this->email_address,
							':id'=>$this->id,
						)
					));
					if($account !== null)
						$this->addError('email_address','Email address entered is already in use.');	
				}
			}
			/*
			else
			{
				$account=Account::model()->find(array(
					'condition'=>'email_address=:email_address AND id=:id',
					'params'=>array(
						':email_address'=>$this->email_address,
						':id'=>Yii::app()->user->id,
					)
				));
				if($account===null)
					$this->addError('email_address','Please retype your new email address correctly.');
			}*/
		}
	}

	public function getAccountStatus($id)
	{
		$model=$this->find(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			)
		));
		
		if($model!==null) 
		{
			switch($model->status_id)
			{
				case '1':
					return "Active";
					break;
				case '2':
					return "Inactive";
					break;
				case '3':
					return "Deleted";
					break;
			}
		}
	}

	public function getAccountType($id)
	{
		$model=$this->find(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			)
		));
		
		if($model!==null) 
		{
			switch($model->account_type_id)
			{
				case '1':
					return "Super Admin";
					break;
				case '2':
					return "Admin";
					break;
				case '3':
					return "Doctor";
					break;
				case '4':
					return "Patient";
					break;
				case '5':
					return "Secretary";
					break;
			}
		}
	}
			// Count Total Super Admin
			public static function countTotalSuperAdmin()
			{
			return self::model()->count(array(
				'condition' => 'account_type_id = :account_type_id',
				'params' => array(
					':account_type_id' => 1,
				),
			));
			}
			// Count Total Admin
				public static function countTotalAdmin()
				{
				return self::model()->count(array(
					'condition' => 'account_type_id = :account_type_id',
					'params' => array(
						':account_type_id' => 2,
					),
				));
				}
			// Count Total Doctors
				public static function countTotalDoctors()
				{
				return self::model()->count(array(
					'condition' => 'account_type_id = :account_type_id',
					'params' => array(
						':account_type_id' => 3,
						),
					));
				}
			// Count Total Patient
				public static function countTotalPatients()
				{
				return self::model()->count(array(
					'condition' => 'account_type_id = :account_type_id',
					'params' => array(
						':account_type_id' => 4,
						),
					));
				}
			// Count Total Patient
				public static function countTotalSecretary()
				{
				return self::model()->count(array(
					'condition' => 'account_type_id = :account_type_id',
					'params' => array(
						':account_type_id' => 5,
						),
					));
				}

	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Account the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

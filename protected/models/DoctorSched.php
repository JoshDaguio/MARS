<?php

/**
 * This is the model class for table "{{doctor_sched}}".
 *
 * The followings are the available columns in table '{{doctor_sched}}':
 * @property integer $id
 * @property integer $account_id
 * @property string $working_days
 * @property string $start_time
 * @property string $end_time
 * @property integer $status_id
 * @property integer $clinic_assignment
 *
 * The followings are the available model relations:
 * @property ClinicAssignment $clinicAssignment
 * @property Account $account
 * @property Status $status
 */
class DoctorSched extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{doctor_sched}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('working_days, start_time, end_time, status_id, clinic_assignment', 'required'),
			array('account_id, status_id, clinic_assignment', 'numerical', 'integerOnly'=>true),
			array('working_days', 'length', 'max'=>50),
			array('clinic_assignment', 'validateUniqueCombination', 'on' => 'createForm'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, account_id, working_days, start_time, end_time, status_id, clinic_assignment', 'safe', 'on'=>'search'),
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
			'clinicAssignment' => array(self::BELONGS_TO, 'ClinicAssignment', 'clinic_assignment'),
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'account_id' => 'Account',
			'working_days' => 'Working Days',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'status_id' => 'Status',
			'clinic_assignment' => 'Clinic Assignment',
		);
	}

	public function getStatus($id)
	{
		$model=$this->find(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			)
		));
		
		if($model!==null)
		{
			if($model->status_id == 1)
				return 'Active';
			else
				return 'Inactive';
		}
	}
	public function validateUniqueCombination($attribute, $params)
    {
        $existingRecord = self::model()->findByAttributes(array(
            'account_id' => $this->account_id,
            'status_id' => 1,
            'clinic_assignment' => $this->clinic_assignment,
        ));

        if ($existingRecord !== null) {
            $this->addError($attribute, 'The combination already exists.');
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
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('working_days',$this->working_days,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('clinic_assignment',$this->clinic_assignment);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DoctorSched the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

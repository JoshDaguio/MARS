<?php

/**
 * This is the model class for table "{{appointment}}".
 *
 * The followings are the available columns in table '{{appointment}}':
 * @property integer $id
 * @property string $title
 * @property string $appointment_date
 * @property string $appointment_time
 * @property string $description
 * @property integer $doctor_id
 * @property integer $patient_id
 * @property integer $status_id
 * @property integer $clinic_id
 *
 * The followings are the available model relations:
 * @property Account $doctor
 * @property Clinic $clinic
 * @property Status $status
 * @property Account $patient
 */
class Appointment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{appointment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, appointment_date, appointment_time, status_id, clinic_id', 'required'),
			array('doctor_id, patient_id, status_id, clinic_id', 'numerical', 'integerOnly'=>true),
			array('appointment_date', 'checkOverlap' , 'on' => 'createAppointment'),
			array('title', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, appointment_date, appointment_time, description, doctor_id, patient_id, status_id, clinic_id', 'safe', 'on'=>'search'),
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
			'doctorAccount' => array(self::BELONGS_TO, 'Account', 'doctor_id'),
			'clinic' => array(self::BELONGS_TO, 'Clinic', 'clinic_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
			'patientAccount' => array(self::BELONGS_TO, 'Account', 'patient_id'),
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
			'appointment_date' => 'Appointment Date',
			'appointment_time' => 'Appointment Time',
			'description' => 'Description',
			'doctor_id' => 'Doctor',
			'patient_id' => 'Patient',
			'status_id' => 'Status',
			'clinic_id' => 'Clinic',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('appointment_date',$this->appointment_date,true);
		$criteria->compare('appointment_time',$this->appointment_time,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('doctor_id',$this->doctor_id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('clinic_id',$this->clinic_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function checkOverlap($attribute, $params)
	{
    $existingAppointments = $this->findAll(
        'doctor_id = :doctor_id AND appointment_date = :appointment_date AND appointment_time = :appointment_time AND status_id = 1 AND clinic_id=:clinic_id',
        array(
            ':doctor_id' => $this->doctor_id,
            ':appointment_date' => $this->appointment_date,
            ':appointment_time' => $this->appointment_time, 
			':clinic_id' => $this->clinic_id, 
        )
    );

    if (!empty($existingAppointments)) {
        $message = 'Appointment date and time slot overlap with existing appointment.';
        $this->addError($attribute, $message);
    }
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
	public static function getTotalAppointments()
    {
        return self::model()->count();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Appointment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

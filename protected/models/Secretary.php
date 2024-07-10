<?php

/**
 * This is the model class for table "{{secretary}}".
 *
 * The followings are the available columns in table '{{secretary}}':
 * @property integer $id
 * @property integer $secretary_id
 * @property integer $doctor_id
 * @property integer $status_id
 *
 * The followings are the available model relations:
 * @property Status $status
 * @property Account $secretary
 * @property Account $doctor
 */
class Secretary extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{secretary}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('secretary_id, doctor_id, status_id', 'required'),
			array('secretary_id, doctor_id, status_id', 'numerical', 'integerOnly'=>true),
			array('secretary_id', 'uniqueAccount'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, secretary_id, doctor_id, status_id', 'safe', 'on'=>'search'),
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
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
			'secretary' => array(self::BELONGS_TO, 'Account', 'secretary_id'),
			'doctor' => array(self::BELONGS_TO, 'Account', 'doctor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'secretary_id' => 'Secretary',
			'doctor_id' => 'Doctor',
			'status_id' => 'Status',
		);
	}

	public function uniqueAccount($attribute, $params)
	{
		// Check if there is already a row with the same combination of secretary_id and doctor_id
		$existingRow = self::model()->findByAttributes(array(
			'secretary_id' => $this->secretary_id,
			'doctor_id' => $this->doctor_id,
			'status_id' => 1,
		));

		if ($existingRow !== null) {
            $this->addError($attribute, 'The combination already exists.');
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
		$criteria->compare('secretary_id',$this->secretary_id);
		$criteria->compare('doctor_id',$this->doctor_id);
		$criteria->compare('status_id',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Secretary the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "{{immunization_record}}".
 *
 * The followings are the available columns in table '{{immunization_record}}':
 * @property integer $id
 * @property integer $account_id
 * @property integer $immunization_id
 * @property string $date
 * @property string $remarks
 * @property integer $status_id
 *
 * The followings are the available model relations:
 * @property Account $account
 * @property Immunization $immunization
 * @property Status $status
 */
class ImmunizationRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{immunization_record}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id, immunization_id, date', 'required'),
			array('account_id, immunization_id, status_id', 'numerical', 'integerOnly'=>true),
			array('remarks', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, account_id, immunization_id, date, remarks, status_id', 'safe', 'on'=>'search'),
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
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
			'immunization' => array(self::BELONGS_TO, 'Immunization', 'immunization_id'),
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
			'account_id' => 'Patient',
			'immunization_id' => 'Immunization',
			'date' => 'Date',
			'remarks' => 'Remarks',
			'status_id' => 'Status',
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
		$criteria->compare('immunization_id',$this->immunization_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('status_id',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ImmunizationRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

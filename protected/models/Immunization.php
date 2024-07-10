<?php

/**
 * This is the model class for table "{{immunization}}".
 *
 * The followings are the available columns in table '{{immunization}}':
 * @property integer $id
 * @property string $immunization
 * @property string $description
 * @property integer $status_id
 *
 * The followings are the available model relations:
 * @property Status $status
 * @property ImmunizationRecord[] $immunizationRecords
 */
class Immunization extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{immunization}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('immunization', 'required'),
			array('status_id', 'numerical', 'integerOnly'=>true),
			array('immunization', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, immunization, description, status_id', 'safe', 'on'=>'search'),
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
			'immunizationRecords' => array(self::HAS_MANY, 'ImmunizationRecord', 'immunization_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'immunization' => 'Immunization',
			'description' => 'Description',
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
		$criteria->compare('immunization',$this->immunization,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status_id',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Immunization the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

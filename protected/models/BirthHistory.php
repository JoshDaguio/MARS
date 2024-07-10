<?php

/**
 * This is the model class for table "{{birth_history}}".
 *
 * The followings are the available columns in table '{{birth_history}}':
 * @property integer $id
 * @property integer $account_id
 * @property integer $blood_type
 * @property integer $term
 * @property integer $type_of_delivery
 * @property double $birth_weight
 * @property double $birth_length
 * @property double $birth_head_circumference
 * @property double $birth_chest_circumference
 * @property double $birth_abdominal_circumference
 *
 * The followings are the available model relations:
 * @property Account $account
 */
class BirthHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{birth_history}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id', 'required'),
			array('account_id, blood_type, term, type_of_delivery', 'numerical', 'integerOnly'=>true),
			array('birth_weight, birth_length, birth_head_circumference, birth_chest_circumference, birth_abdominal_circumference', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, account_id, blood_type, term, type_of_delivery, birth_weight, birth_length, birth_head_circumference, birth_chest_circumference, birth_abdominal_circumference', 'safe', 'on'=>'search'),
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
			'blood_type' => 'Blood Type',
			'term' => 'Term',
			'type_of_delivery' => 'Type Of Delivery',
			'birth_weight' => 'Birth Weight',
			'birth_length' => 'Birth Length',
			'birth_head_circumference' => 'Birth Head Circumference',
			'birth_chest_circumference' => 'Birth Chest Circumference',
			'birth_abdominal_circumference' => 'Birth Abdominal Circumference',
		);
	}

	public function BloodType($id)
	{
		$model=$this->find(array(
			'condition'=>'account_id=:id',
			'params'=>array(
				':id'=>$id,
			)
		));
		
		if($model!==null) 
		{
			switch($model->blood_type)
			{
				case '1':
					return "O+";
				case '2':
					return "O-";
				case '3':
					return "A+";
				case '4':
					return "A-";
				case '5':
					return "B+";
				case '6':
					return "B-";
				case '7':
					return "AB+";
				case '8':
					return "AB-";
			}
		}
		return 'others';
	}

	public function Term($id)
	{
		$model=$this->find(array(
			'condition'=>'account_id=:id',
			'params'=>array(
				':id'=>$id,
			)
		));
		
		if($model!==null) 
		{
			switch($model->term)
			{
				case '1':
					return "Early Term";
				case '2':
					return "Full Term";
				case '3':
					return "Late Term";
				case '4':
					return "Post-Term";

			}
		}
		return 'others';
	}
	public function ToD($id)
	{
		$model=$this->find(array(
			'condition'=>'account_id=:id',
			'params'=>array(
				':id'=>$id,
			)
		));
		
		if($model!==null) 
		{
			switch($model->term)
			{
				case '1':
					return "Vaginal Delivery";
				case '2':
					return "Assisted Vaginal Delivery";
				case '3':
					return "C-Section";
				case '4':
					return "VBAC(Vaginal Birth After Cesarean)";

			}
		}
		return 'others';
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
		$criteria->compare('blood_type',$this->blood_type);
		$criteria->compare('term',$this->term);
		$criteria->compare('type_of_delivery',$this->type_of_delivery);
		$criteria->compare('birth_weight',$this->birth_weight);
		$criteria->compare('birth_length',$this->birth_length);
		$criteria->compare('birth_head_circumference',$this->birth_head_circumference);
		$criteria->compare('birth_chest_circumference',$this->birth_chest_circumference);
		$criteria->compare('birth_abdominal_circumference',$this->birth_abdominal_circumference);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BirthHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

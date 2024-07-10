<?php

class ImmunizationRecordController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('listPatientImmunization', 'createImmunizationRecordDoc'),
				'users'=>array('doctor'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('ListImmunizationForPatient'),
				'users'=>array('patient'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'ListImmunizationRecord'),
				'users'=>array('super admin', 'admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionViewImmunization($id)
	{
		$immunizations = ImmunizationRecord::model()->findAll(array(
			'condition' => 'id=:id',
			'params' => array(
				':id' => $id,
			),
		));

		$this->render('ViewImmunizationRecord',array(
			'immunizations'=>$immunizations,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ImmunizationRecord;

		$list = ImmunizationRecord::model()->findAll();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ImmunizationRecord']))
		{
			$model->attributes=$_POST['ImmunizationRecord'];
			$model->status_id=1;
			if($model->save())
				$this->redirect(array('immunizationRecord/listImmunizationRecord'));
		}

		$this->render('create',array(
			'model'=>$model,
			'list' => $list,
		));
	}

	public function actionCreateImmunizationRecordDoc($patientId)
	{
		$model=new ImmunizationRecord;


		if(isset($_POST['ImmunizationRecord']))
		{
			$model->account_id= $patientId;
			$model->attributes=$_POST['ImmunizationRecord'];
			$model->status_id=1;
			if($model->save())
				$this->redirect(array('immunizationRecord/listPatientImmunization'));
		}

		$this->render('createImmunizationRecordDoc',array(
			'model'=>$model,
			'patientId' => $patientId
		));
	}

	public function actionListPatientImmunization()
	{
    	$id = Yii::app()->user->id;


			$listOfAccounts = ImmunizationRecord::model()->findAll(array(
				'condition'=>' account_id IN (
					SELECT patient_account_id FROM tbl_consultation_record WHERE doctor_account_id=:id
				)',
				'params'=>array(
					':id'=>$id,
				),
			));
				
				

    	$this->render('listPatientImmunization', array(
        	'listOfAccounts' => $listOfAccounts,
   		));
	}

	public function actionListImmunizationForPatient()
	{
    	$id = Yii::app()->user->id;

    	$listOfImmunization = ImmunizationRecord::model()->findAll(array(
			'condition'=>'account_id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

    	$this->render('listImmunizationForPatients', array(
        	'listOfImmunization' => $listOfImmunization,
   		));
	}

	

	public function actionListImmunizationRecord()
	{
		$list = ImmunizationRecord::model()->findAll();

		$this->render('ListImmunizationRecord',array(
			'list'=>$list,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ImmunizationRecord']))
		{
			$model->attributes=$_POST['ImmunizationRecord'];
			if($model->save())
				$this->redirect(array('immunizationRecord/listImmunizationRecord'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ImmunizationRecord');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ImmunizationRecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ImmunizationRecord']))
			$model->attributes=$_GET['ImmunizationRecord'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ImmunizationRecord the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ImmunizationRecord::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ImmunizationRecord $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='immunization-record-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

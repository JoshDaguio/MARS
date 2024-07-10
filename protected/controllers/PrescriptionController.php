<?php

class PrescriptionController extends Controller
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
				'actions'=>array('ListPrescriptionHistory', 'ViewPatient'),
				'users'=>array('patient'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'ListPrescriptionArchivesSec', 'ChangeStatus'),
				'users'=>array('secretary'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'ListPrescriptionArchives', 'ChangeStatus'),
				'users'=>array('doctor'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'listPrescription', 'ChangeStatus', 'ViewAdmin'),
				'users'=>array('admin', 'super admin'),
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
		$prescriptionInfo = Prescription::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		$this->render('view',array(
			'prescriptionInfo'=>$prescriptionInfo,
		));
	}

	public function actionViewAdmin($id)
	{
		$prescriptionInfo = Prescription::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		$this->render('viewAdmin',array(
			'prescriptionInfo'=>$prescriptionInfo,
		));
	}

	public function actionViewPatient($id)
	{
		$prescriptionInfo = Prescription::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		$this->render('viewPatient',array(
			'prescriptionInfo'=>$prescriptionInfo,
		));
	}

	public function actionListPrescriptionHistory()
	{
		$id = Yii::app()->user->id;
		$listOfPrescriptionHistory = Prescription::model()->findAll(array(
			'condition'=>'patient_account_id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		$this->render('listPrescriptionHistory',array(
			'listOfPrescriptionHistory'=>$listOfPrescriptionHistory,
		));
	}

	public function actionListPrescriptionArchives()
	{
		$id = Yii::app()->user->id;
		$listOfPrescriptionArchives = Prescription::model()->findAll(array(
			'condition'=>'doctor_account_id=:id AND status_id=:status_id',
			'params'=>array(
				':id'=>$id,
				':status_id'=>1,
			),

		));

		$this->render('listPrescriptionArchives',array(
			'listOfPrescriptionArchives'=>$listOfPrescriptionArchives,
		));
	}

	public function actionListPrescriptionArchivesSec()
	{
		$id = Yii::app()->user->id;
		$listOfDoctors = Secretary::model()->findAll(array(
			'condition'=>'secretary_id=:id and status_id=1',
			'params'=>array(
				':id'=>$id,
			),
		));
		if(!empty($listOfDoctors)){
		foreach($listOfDoctors as $doctors)
		$listOfPrescriptionArchives = Prescription::model()->with('patientAccount')->findAll(array(
			'condition'=>'doctor_account_id=:id',
			'params'=>array(
				':id'=>$doctors->doctor_id,
			),

		));

		$this->render('listPrescriptionArchives',array(
			'listOfPrescriptionArchives'=>$listOfPrescriptionArchives,
		));

		} else {
			// Render the error view
			$this->render('//site/error', array('message' => 'No records found, Please be assigned to a doctor'));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Prescription;
		$listPrescription= Prescription::model()->findAll();
		$PatientTable = Account::model()->with('user')->findAll(array('condition' => 'account_type_id = 4'));
		$DoctorTable = Account::model()->with('user')->findAll(array('condition' => 'account_type_id = 3'));
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Prescription']))
		{
			$model->attributes=$_POST['Prescription'];
			$model->status_id = 1;
			if($model->save())
				$this->redirect(array('listPrescription'));
		}

		$this->render('create',array(
			'model'=>$model,
			'listPrescription'=>$listPrescription,
			'PatientTable' => $PatientTable,
			'DoctorTable' => $DoctorTable
		));
	}
	public function actionListPrescription()
    {
        $listPrescription= Prescription::model()->findAll();

        $this->render('listPrescription',array(
            'listPrescription'=>$listPrescription,
			
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

		if(isset($_POST['Prescription']))
		{
			$model->attributes=$_POST['Prescription'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionChangeStatus($id)
    {
        $model = Prescription::model()->findByPk($id); 

        if ($model !== null) {
			Prescription::model()->updateByPk($id, array('status_id' => 2));
			

            if (Yii::app()->user->name == 'doctor'){
            	$this->redirect(array('listPrescriptionArchives')); // Redirect to the view page, adjust as needed
			} elseif (Yii::app()->user->name == 'secretary') {
				$this->redirect(array('listPrescriptionArchivesSec'));
			} elseif (Yii::app()->user->name == 'super admin' || Yii::app()->user->name == 'admin') {
				$this->redirect(array('listPrescription'));
			};
        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
        }
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
		$dataProvider=new CActiveDataProvider('Prescription');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Prescription('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Prescription']))
			$model->attributes=$_GET['Prescription'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Prescription the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Prescription::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Prescription $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='prescription-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

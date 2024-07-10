<?php

class ConsultationRecordController extends Controller
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
				'actions'=>array('ListConsultationHistory', 'ViewPatient'),
				'users'=>array('patient'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('ListConsultationHistory','ListConsultationArchives', 'CreateConsultationAndPrescription', 'NewPatientConsultationAndPrescription', 'changeStatus'),
				'users'=>array('doctor'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('ListConsultationHistory'),
				'users'=>array('secretary'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'listConsultation', 'changeStatus', 'ViewAdmin'),
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
		$consultationInfo = ConsultationRecord::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		$this->render('view',array(
			'consultationInfo'=>$consultationInfo,
		));
	}
	public function actionViewAdmin($id)
	{
		$consultationInfo = ConsultationRecord::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		$this->render('viewAdmin',array(
			'consultationInfo'=>$consultationInfo,
		));
	}
	public function actionViewPatient($id)
	{
		$consultationInfo = ConsultationRecord::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		$this->render('viewPatient',array(
			'consultationInfo'=>$consultationInfo,
		));
	}
	public function actionChangeStatus($id)
    {
        $model = ConsultationRecord::model()->findByPk($id); 

        if ($model !== null) {
            ConsultationRecord::model()->updateByPk($id, array('status_id' => 2));
			

            if (Yii::app()->user->name == 'super admin' || Yii::app()->user->name == 'admin'){
            	$this->redirect(array('listConsultation')); // Redirect to the view page, adjust as needed
			} 
        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

	public function actionListConsultationArchives()
	{
		$id = Yii::app()->user->id;
		$listOfConsultationArchives = ConsultationRecord::model()->findAll(array(
			'condition'=>'doctor_account_id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		$this->render('listConsultationArchives',array(
			'listOfConsultationArchives'=>$listOfConsultationArchives,
		));
	}

	public function actionListConsultationHistory()
	{
		$id = Yii::app()->user->id;
		$listOfConsultationHistory = ConsultationRecord::model()->findAll(array(
			'condition'=>'patient_account_id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		$this->render('listConsultationHistory',array(
			'listOfConsultationHistory'=>$listOfConsultationHistory,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
    {
        $model=new ConsultationRecord;
        $listConsultation= ConsultationRecord::model()->findAll();
		$PatientTable = Account::model()->with('user')->findAll(array('condition' => 'account_type_id = 4'));
		$DoctorTable = Account::model()->with('user')->findAll(array('condition' => 'account_type_id = 3'));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ConsultationRecord']))
        {
            $model->attributes=$_POST['ConsultationRecord'];
            if($model->save())
                $this->redirect(array('listConsultation'));
        }

        $this->render('create',array(
            'model'=>$model,
            'listConsultation'=>$listConsultation,
			'PatientTable' => $PatientTable,
			'DoctorTable' => $DoctorTable
        ));
    }

	public function actionCreateConsultationAndPrescription($patientId)
	{
	$id = Yii::app()->user->id;
    $consultationRecord = new ConsultationRecord;
    $prescription = new Prescription;
	$PatientTable = Account::model()->with('user')->findAll(array('condition' => 'account_type_id = 4'));
	$DoctorTable = Account::model()->with('user')->findAll(array('condition' => 'account_type_id = 3'));

	//$patId = Account::model()->find(array('condition' =>'id=:id', 'params' => array(':id' => $patientId)));

    if (isset($_POST['ConsultationRecord'])) {
		$consultationRecord->patient_account_id = $patientId;
        $consultationRecord->attributes = $_POST['ConsultationRecord'];
		$consultationRecord->status_id = 1;
		$consultationRecord->doctor_account_id = $id;
        $valid = $consultationRecord->validate();

        // Check if the consultation form is valid
        if ($valid) {
			
            $connection = Yii::app()->db;
            $transaction = $connection->beginTransaction();

            try {
                // Save consultation record
                if ($consultationRecord->save()) {
                    // Get the primary key of the saved consultation record
                    $consultationId = $consultationRecord->getPrimaryKey();
					$prescriptionPatientId = $consultationRecord->patient_account_id;
                    // Set consultation_id for prescription
                    

                    // Check if prescription data is provided
                    if (!empty($_POST['Prescription']) && array_filter($_POST['Prescription'])) {
						
						$prescription->attributes = $_POST['Prescription'];
						$prescription->consultation_id = $consultationId;
						$prescription->patient_account_id = $prescriptionPatientId;
						$prescription->doctor_account_id = $id;
						$prescription->status_id = 1;
                        $validPrescription = $prescription->validate();

                        if ($validPrescription) {
                            
                            if ($prescription->save()) {
                                $transaction->commit();
                                Yii::app()->user->setFlash('success', 'Consultation and Prescription added successfully!');
                                $this->redirect(array('account/ViewAccountForDoctor/' . $patientId)); // Redirect to desired page
                            }
                        }
                    } else {
                        // If no prescription data provided, commit the transaction for consultation only
                        $transaction->commit();
                        Yii::app()->user->setFlash('success', 'Consultation added successfully!');
                        $this->redirect(array('account/ViewAccountForDoctor/' . $patientId)); // Redirect to desired page
                    }
                }
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('error', 'An error occurred while saving data. Please try again.');
                $this->redirect(array('/consultation/index')); // Redirect to desired page
            }
        }
    }
    $this->render('createConsultationAndPrescription', array(
        'consultationRecord' => $consultationRecord,
        'prescription' => $prescription,
		'PatientTable' => $PatientTable,
		'DoctorTable' => $DoctorTable,
		'patientId' => $patientId
    ));
	}

	public function actionNewPatientConsultationAndPrescription($patientId)
	{
	$id = Yii::app()->user->id;
    $consultationRecord = new ConsultationRecord;
    $prescription = new Prescription;
	$PatientTable = Account::model()->with('user')->findAll(array('condition' => 'account_type_id = 4'));
	$DoctorTable = Account::model()->with('user')->findAll(array('condition' => 'account_type_id = 3'));

	$NewPatient = Account::model()->findAll(array(
		'condition'=>'id=:id',
		'params'=>array(
			':id'=>$patientId,
		),
	));

	//$patId = Account::model()->find(array('condition' =>'id=:id', 'params' => array(':id' => $patientId)));

    if (isset($_POST['ConsultationRecord'])) {
		$consultationRecord->patient_account_id = $patientId;
        $consultationRecord->attributes = $_POST['ConsultationRecord'];
		$consultationRecord->status_id = 1;
		$consultationRecord->doctor_account_id = $id;
        $valid = $consultationRecord->validate();

        // Check if the consultation form is valid
        if ($valid) {
			
            $connection = Yii::app()->db;
            $transaction = $connection->beginTransaction();

            try {
                // Save consultation record
                if ($consultationRecord->save()) {
                    // Get the primary key of the saved consultation record
                    $consultationId = $consultationRecord->getPrimaryKey();
					$prescriptionPatientId = $consultationRecord->patient_account_id;
                    // Set consultation_id for prescription
                    

                    // Check if prescription data is provided
                    if (!empty($_POST['Prescription']) && array_filter($_POST['Prescription'])) {
						
						$prescription->attributes = $_POST['Prescription'];
						$prescription->consultation_id = $consultationId;
						$prescription->patient_account_id = $prescriptionPatientId;
						$prescription->doctor_account_id = $id;
						$prescription->status_id = 1;
                        $validPrescription = $prescription->validate();

                        if ($validPrescription) {
                            
                            if ($prescription->save()) {
                                $transaction->commit();
                                Yii::app()->user->setFlash('success', 'Consultation and Prescription added successfully!');
                                $this->redirect(array('account/ViewAccountForDoctor/' . $patientId)); // Redirect to desired page
                            }
                        }
                    } else {
                        // If no prescription data provided, commit the transaction for consultation only
                        $transaction->commit();
                        Yii::app()->user->setFlash('success', 'Consultation added successfully!');
                        $this->redirect(array('account/ViewAccountForDoctor/' . $patientId)); // Redirect to desired page
                    }
                }
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('error', 'An error occurred while saving data. Please try again.');
                $this->redirect(array('/consultation/index')); // Redirect to desired page
            }
        }
    }
    $this->render('NewPatientConsultationAndPrescription', array(
        'consultationRecord' => $consultationRecord,
        'prescription' => $prescription,
		'PatientTable' => $PatientTable,
		'DoctorTable' => $DoctorTable,
		'patientId' => $patientId,
		'NewPatient' => $NewPatient
    ));
	}

	
	public function actionlistConsultation()
    {
        $listConsultation= ConsultationRecord::model()->findAll();

        $this->render('listConsultation',array(
            'listConsultation'=>$listConsultation,

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

		if(isset($_POST['ConsultationRecord']))
		{
			$model->attributes=$_POST['ConsultationRecord'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('ConsultationRecord');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ConsultationRecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ConsultationRecord']))
			$model->attributes=$_GET['ConsultationRecord'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public static function getTotalConsultations()
    {
        return self::model()->count();
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ConsultationRecord the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ConsultationRecord::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ConsultationRecord $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='consultation-record-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

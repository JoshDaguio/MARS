<?php

class AccountController extends Controller
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
				'actions'=>array('index','view','ViewPatient'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'ViewPatProfile', 'UpdatePatientProfile'),
				'users'=>array('patient'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('createPatient', 'ListPatientSec', 'CheckAge','listPatient', 'calculateAge','ViewSecProfile', 'UpdateSecretaryProfile',),
				'users'=>array('secretary'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('createPatient', 'listPatient', 'CheckAge', 'ListPatientDoc', 'ListActivePatients', 'ViewAccountForDoctor', 'ChangeStatusActivePat', 
				'changeStatus', 'ViewNewPatientDoc', 'calculateAge', 'SearchPatient', 'ViewDocProfile', 'UpdateDoctorProfile', 'ViewAccount' ),
				'users'=>array('doctor'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','createDoctor','updateDoctor','listDoctor','listPatient', 'CheckAge','CreateSecretary', 'ListSecretary', 
				'changeStatusDoc', 'ChangeStatusSec', 'updateSecretary', 'CreatePatientAdmin', 'changeStatus', 'UpdatePatient', 'calculateAge', 'ViewDoctor', 'ViewSecretaryAdmin', 
				'ViewPatientAdmin', 'ViewAccount', 'ViewSAProfile', 'UpdateSuperAdmin'),
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
	public function actionViewSAProfile()
    {
        $listofAccounts = Account::model()->findAll(array(
            'condition'=>'id=:id',
            'params'=>array(
                ':id'=>1,
            ),
        ));

        $this->render('viewSAProfile',array(
            'listofAccounts'=>$listofAccounts,
        ));
    }
	public function actionViewDocProfile($id)
    {
        $listofAccounts = Account::model()->findAll(array(
            'condition'=>'id=:id',
            'params'=>array(
                ':id'=>$id,
            ),
        ));

        $this->render('viewDocProfile',array(
            'listofAccounts'=>$listofAccounts,
        ));
    }
	public function actionViewPatProfile($id)
    {
        $listofAccounts = Account::model()->findAll(array(
            'condition'=>'id=:id',
            'params'=>array(
                ':id'=>$id,
            ),
        ));

        $this->render('viewPatProfile',array(
            'listofAccounts'=>$listofAccounts,
        ));
    }
	public function actionViewSecProfile($id)
    {
        $listofAccounts = Account::model()->findAll(array(
            'condition'=>'id=:id',
            'params'=>array(
                ':id'=>$id,
            ),
        ));

        $this->render('viewSecProfile',array(
            'listofAccounts'=>$listofAccounts,
        ));
    }
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCheckAge() {
		if (Yii::app()->request->isAjaxRequest) {
			$dob = Yii::app()->request->getPost('dob');
			$age = $this->calculateAge($dob);
	
			echo CJSON::encode(array('age' => $age));
			Yii::app()->end();
		}
	}
	function calculateAge($dob) {
		$today = new DateTime();
		$birthdate = new DateTime($dob);
		$interval = $today->diff($birthdate);
		return $interval->y;
	}

	public function actionViewNewPatientDoc($id) {
		$account = Account::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		$this->render('viewNewPatientDoc',array(
			'account'=>$account,
		));
    }

	public function actionViewAccountForDoctor($id) {
		$accounts = Account::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));

		foreach ($accounts as $account) {
			$accountTypeId = $account->account_type_id;
	
			switch ($accountTypeId) {
				case 4: // Patient
					$view = 'viewPatient';
					break;
				case 5: // Secretary
					$view = 'viewSecretary';
					break;
				default:
					// Handle other account types or errors
					break;
			}
	
			$this->render($view, array('account' => $accounts));
		}
    }

	public function actionViewAccount($id) {
		$accounts = Account::model()->findAll(array(
			'condition' => 'id=:id',
			'params' => array(
				':id' => $id,
			),
		));
	
		foreach ($accounts as $account) {
			$accountTypeId = $account->account_type_id;
	
			switch ($accountTypeId) {
				case 3: // Doctor
					$view = 'viewDoctor';
					break;
				case 4: // Patient
					$view = 'ViewPatientAdmin';
					break;
				case 5: // Secretary
					$view = 'ViewSecretaryAdmin';
					break;
				default:
					// Handle other account types or errors
					break;
			}
	
			$this->render($view, array('account' => $accounts));
		}
	}
	
    protected function loadAccountAndUser($id) {
		
    }

	public function actionListDoctor()
	{
		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'account_type_id=:account_type_id',
			'params'=>array(
				':account_type_id'=>3,
			),
		));

		$this->render('listDoctor',array(
			'listOfAccounts'=>$listOfAccounts,
		));
	}
	public function actionSearchPatient()
	{
		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'account_type_id=:account_type_id',
			'params'=>array(
				':account_type_id'=>4,
			),
		));

		$this->render('SearchPatient',array(
			'listOfAccounts'=>$listOfAccounts,
		));
	}

	public function actionListPatient()
	{
		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'account_type_id=:account_type_id',
			'params'=>array(
				':account_type_id'=>4,
			),
		));

		$this->render('listPatient',array(
			'listOfAccounts'=>$listOfAccounts,
		));
	}
	public function actionListPatientSec()
	{
		$id = Yii::app()->user->id;
		$listOfDoctor = Secretary::model()->findAll(array(
			'condition'=>'secretary_id=:id and status_id=1',
			'params'=>array(
				':id'=>$id,
			),
		));
		foreach($listOfDoctor as $doctor){
		$listOfAccounts = ConsultationRecord::model()->with('patientAccount')->findAll(array(
			'select' => 'doctor_account_id, patient_account_id',
			'group' => 'doctor_account_id, patient_account_id',
			'condition'=>'doctor_account_id=:id',
			'params'=>array(
				':id'=>$doctor->doctor_id,
			),
		));
			}
		if(!empty($listOfAccounts)){
		$this->render('listPatientSec',array(
			'listOfAccounts'=>$listOfAccounts,
		));
		} else {
			// Render the error view
			$this->render('//site/error', array('message' => 'No records found, Please be assigned to a doctor'));
		}
	}
	public function actionListPatientDoc()
	{
    	$id = Yii::app()->user->id;

    	$listOfAccounts = ConsultationRecord::model()->findAll(array(
        	'select' => 'DISTINCT doctor_account_id, patient_account_id',
        	'condition' => 'doctor_account_id = :id',
        	'params' => array(
            	':id' => $id,
        	),
    	));

    	$this->render('listPatientDoc', array(
        	'listOfAccounts' => $listOfAccounts,
   	 ));
	}


	public function actionListActivePatients()
	{
		$id = Yii::app()->user->id;
		$listOfAccounts = ConsultationRecord::model()->with('patientAccount')->findAll(array(
			'select' => 'doctor_account_id, patient_account_id',
			'group' => 'doctor_account_id, patient_account_id',
			'condition'=>'doctor_account_id=:id AND patientAccount.status_id=:status',
			'params'=>array(
				':id'=>$id,
				':status' => 1,
			),

		));

		$this->render('listActivePatients',array(
			'listOfAccounts'=>$listOfAccounts,
		));
	}
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateDoctor()
	{
		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'account_type_id=:account_type_id',
			'params'=>array(
				':account_type_id'=>3,
			),
		));
		$account = new Account;
		$user = new User;
		$account->setScenario('createNewDoctor');
		$user->setScenario('createNewDoctor');

		
		if ((isset($_POST['Account'])) AND (isset($_POST['User'])))
		{
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
			$account->account_type_id = 3;
			$valid = $account->validate();
			$valid = $user->validate() && $valid;
			
			if ($valid)
			{	
				$connection = Yii::app()->db;
				$transaction = $connection->beginTransaction();

				try
				{
					if ($account->save())
					{
						$account_id = $account->getPrimaryKey();
						$user->account_id = $account_id;

						if ($user->save(false))
						{
							$transaction->commit();
							Yii::app()->user->setFlash('success','You have successfully registered for an account!');
							$this->redirect(array('/account/listDoctor'));
						}
					}
				}
				catch (Exception $e)
				{
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'An error occured while trying to add an account! Please try again later');
					$this->redirect(array('/account/listDoctor'));
				}
			}
		}
		

		$this->render('create',array(
			'account' => $account,
			'user' => $user,
			'listOfAccounts' => $listOfAccounts,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateSuperAdmin($id)
	{
		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'account_type_id=:account_type_id',
			'params'=>array(
				':account_type_id'=>1,
			),
		));
		$account = $this->loadModel($id);
		$user = $account->user;
		$account->setScenario('updateSuperAdmin');
		$user->setScenario('updateSuperAdmin');

		if ((isset($_POST['Account'])) AND (isset($_POST['User'])))
		{
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
			$account->account_type_id = 1;
			$valid = $account->validate();

			if ($valid)
			{	
				$connection = Yii::app()->db;
				$transaction = $connection->beginTransaction();

				try
				{
					if ($account->save())
					{
						if ($user->save(false))
						{
							$transaction->commit();
							Yii::app()->user->setFlash('success','You have successfully updated the account!');
							$this->redirect(array('/account/viewSAProfile'));
						}
					}
				}
				catch (Exception $e)
				{
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'An error occured while trying to update the account! Please try again later');
				}
			}
		}

		$this->render('updateSAProfile',array(
			'account' => $account,
			'user' => $user,
			'listOfAccounts' => $listOfAccounts,
		));
	}
	public function actionUpdateDoctorProfile($id)
	{
		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				'id'=>$id,
			),
		));
		$account = $this->loadModel($id);
		$user = $account->user;
		$account->setScenario('UpdateDoctorProfile');
		$user->setScenario('UpdateDoctorProfile');

		if ((isset($_POST['Account'])) AND (isset($_POST['User'])))
		{
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
			$account->account_type_id = 3;
			$valid = $account->validate();

			if ($valid)
			{	
				$connection = Yii::app()->db;
				$transaction = $connection->beginTransaction();

				try
				{
					if ($account->save())
					{
						if ($user->save(false))
						{
							$transaction->commit();
							Yii::app()->user->setFlash('success','You have successfully updated the account!');
							$this->redirect(array('/account/viewDocProfile/' . Yii::app()->user->id));
						}
					}
				}
				catch (Exception $e)
				{
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'An error occured while trying to update the account! Please try again later');
				}
			}
		}

		$this->render('updateDocProfile',array(
			'account' => $account,
			'user' => $user,
			'id'=> $id,
			'listOfAccounts' => $listOfAccounts,
		));
	}
	public function actionUpdatePatientProfile($id)
	{
		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));
		$account = $this->loadModel($id);
		$user = $account->user;
		$account->setScenario('UpdatePatientProfile');
		$user->setScenario('UpdatePatientProfile');

		if ((isset($_POST['Account'])) AND (isset($_POST['User'])))
		{
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
			$account->account_type_id = 4;
			$valid = $account->validate();

			if ($valid)
			{	
				$connection = Yii::app()->db;
				$transaction = $connection->beginTransaction();

				try
				{
					if ($account->save())
					{
						if ($user->save(false))
						{
							$transaction->commit();
							Yii::app()->user->setFlash('success','You have successfully updated the account!');
							$this->redirect(array('/account/viewPatProfile/' . Yii::app()->user->id));
						}
					}
				}
				catch (Exception $e)
				{
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'An error occured while trying to update the account! Please try again later');
				}
			}
		}

		$this->render('updatePatProfile',array(
			'account' => $account,
			'user' => $user,
			'listOfAccounts' => $listOfAccounts,
		));
	}
	public function actionUpdateSecretaryProfile($id)
	{
		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));
		$account = $this->loadModel($id);
		$user = $account->user;
		$account->setScenario('UpdateSecretatyProfile');
		$user->setScenario('UpdateSecretatyProfile');

		if ((isset($_POST['Account'])) AND (isset($_POST['User'])))
		{
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
			$account->account_type_id = 5;
			$valid = $account->validate();

			if ($valid)
			{	
				$connection = Yii::app()->db;
				$transaction = $connection->beginTransaction();

				try
				{
					if ($account->save())
					{
						if ($user->save(false))
						{
							$transaction->commit();
							Yii::app()->user->setFlash('success','You have successfully updated the account!');
							$this->redirect(array('/account/viewSecProfile/'. Yii::app()->user->id));
						}
					}
				}
				catch (Exception $e)
				{
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'An error occured while trying to update the account! Please try again later');
				}
			}
		}

		$this->render('updateSecProfile',array(
			'account' => $account,
			'user' => $user,
			'id' => $id,
			'listOfAccounts' => $listOfAccounts,
		));
	}
	public function actionUpdateDoctor($id)
	{
		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'account_type_id=:account_type_id',
			'params'=>array(
				':account_type_id'=>3,
			),
		));
		$account = $this->loadModel($id);
		$user = $account->user;
		$account->setScenario('updateDoctor');
		$user->setScenario('updateDoctor');

		if ((isset($_POST['Account'])) AND (isset($_POST['User'])))
		{
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
			$account->account_type_id = 3;
			$valid = $account->validate();
			
			if ($valid)
			{	
				$connection = Yii::app()->db;
				$transaction = $connection->beginTransaction();

				try
				{
					if ($account->save())
					{
						if ($user->save(false))
						{
							$transaction->commit();
							Yii::app()->user->setFlash('success','You have successfully updated the account!');
							$this->redirect(array('/account/listDoctor'));
						}
					}
				}
				catch (Exception $e)
				{
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'An error occured while trying to update the account! Please try again later');
				}
			}
		}

		$this->render('update',array(
			'account' => $account,
			'user' => $user,
			'listOfAccounts' => $listOfAccounts,
		));
	}

	public function actionUpdateSecretary($id)
	{
		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'account_type_id=:account_type_id',
			'params'=>array(
				':account_type_id'=>5,
			),
		));
		$account = $this->loadModel($id);
		$user = $account->user;
		$account->setScenario('updateSecretary');
		$user->setScenario('updateSecretary');

		if ((isset($_POST['Account'])) AND (isset($_POST['User'])))
		{
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
			$account->account_type_id = 5;
			$valid = $account->validate();
			
			if ($valid)
			{	
				$connection = Yii::app()->db;
				$transaction = $connection->beginTransaction();

				try
				{
					if ($account->save())
					{
						if ($user->save(false))
						{
							$transaction->commit();
							Yii::app()->user->setFlash('success','You have successfully updated the account!');
							$this->redirect(array('/account/listSecretary'));
						}
					}
				}
				catch (Exception $e)
				{
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'An error occured while trying to update the account! Please try again later');
				}
			}
		}

		$this->render('updateSec',array(
			'account' => $account,
			'user' => $user,
			'listOfAccounts' => $listOfAccounts,
		));
	}
	public function actionUpdatePatient($id)
	{
    $listOfAccounts = Account::model()->findAll(array(
        'condition' => 'account_type_id=:account_type_id',
        'params' => array(
            ':account_type_id' => 4,
        ),
    ));
    $account = $this->loadModel($id);
    $user = $account->user;
    $birthhistory = $account->birthHistory;
	if($birthhistory == null){
		$birthhistory = new BirthHistory;
	}
    $account->setScenario('updatePatient');
    $user->setScenario('updatePatient');

    if (isset($_POST['Account']) && isset($_POST['User'])) {
        $account->attributes = $_POST['Account'];
        $user->attributes = $_POST['User'];

        $account->account_type_id = 4;
        $valid = $account->validate();
        $valid = $user->validate() && $valid;

        if ($valid) {
            $connection = Yii::app()->db;
            $transaction = $connection->beginTransaction();

            try {
                if ($account->save()) {
                    $account_id = $account->getPrimaryKey();
                    $user->account_id = $account_id;

                    if ($user->save(false)) {

                        if (!empty($_POST['BirthHistory']) && array_filter($_POST['BirthHistory'])) {
                            $birthhistory->attributes = $_POST['BirthHistory'];
                            $birthhistory->account_id = $account_id;

                            if ($birthhistory->save(false)) {
                                $transaction->commit();
                                Yii::app()->user->setFlash('success', 'You have successfully updated the account!');
                                $this->redirect(array('/account/listPatient'));
                            }
                        } else {
                            // No existing BirthHistory
                            $transaction->commit();
                            Yii::app()->user->setFlash('success', 'You have successfully updated the account!');
                            $this->redirect(array('/account/listPatient'));
                        }
                    }
                }
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('error', 'An error occurred while trying to add an account! Please try again later');
                $this->redirect(array('/account/listPatient'));
            }
        }
    }

    $this->render('updatePat', array(
        'account' => $account,
        'user' => $user,
        'birthhistory' => $birthhistory,
        'listOfAccounts' => $listOfAccounts,
    ));
}

		

	public function actionCreatePatient()
	{
		$id = Yii::app()->user->id;
		$listOfdoctor = Secretary::model()->findAll(array(
			'condition'=>'secretary_id=:id and status_id=1',
			'params'=>array(
				':id'=>$id,
			),
		));
		foreach($listOfdoctor as $doctor){
		$listOfPatientSec = ConsultationRecord::model()->with('doctorAccount')->findAll(array(
			'group' => 'doctor_account_id, patient_account_id',
			'condition'=>'doctor_account_id=:id',
			'params'=>array(
				':id'=>$doctor->doctor_id,
			),
		));
		}
		$listOfPatient = ConsultationRecord::model()->with('doctorAccount')->findAll(array(
			'group' => 'doctor_account_id, patient_account_id',
			'condition'=>'doctor_account_id=:id',
			'params'=>array(
				':id'=>$id,
			),
		));
		$account = new Account;
		$user = new User;
		$birthhistory = new BirthHistory;
		$account->setScenario('createNewPatient');
		$user->setScenario('createNewPatient');

		if ((isset($_POST['Account'])) AND (isset($_POST['User'])))
		{
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
			
			$account->account_type_id = 4;
			$valid = $account->validate();
			$valid = $user->validate() && $valid;
			
			if ($valid) {   
				$connection = Yii::app()->db;
				$transaction = $connection->beginTransaction();
		
				try {
					if ($account->save()) {
						$account_id = $account->getPrimaryKey();
						$user->account_id = $account_id;
						
		
						if ($user->save(false)) {
		
							if (!empty($_POST['BirthHistory']) && array_filter($_POST['BirthHistory'])) {
								$birthhistory->attributes = $_POST['BirthHistory'];
								$birthhistory->account_id = $account_id;
							
								if ($birthhistory->save(false)) {
									$transaction->commit();
									Yii::app()->user->setFlash('success', 'You have successfully registered for an account!');
									if(Yii::app()->user->name == 'doctor'){
										$this->redirect(array('consultationRecord/NewPatientConsultationAndPrescription/', 'patientId' => $account_id));
									} elseif (Yii::app()->user->name == 'secretary'){
										$this->redirect(array('listPatientSec'));
									}
								}
							} else {
								$transaction->commit();
								Yii::app()->user->setFlash('success', 'You have successfully registered for an account!');
								if(Yii::app()->user->name == 'doctor'){
									$this->redirect(array('consultationRecord/NewPatientConsultationAndPrescription/', 'patientId' => $account_id));
								} elseif (Yii::app()->user->name == 'secretary'){
									$this->redirect(array('listPatientSec'));
								}
							}
						}
					}
				} catch (Exception $e) {
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'An error occurred while trying to add an account! Please try again later');
					$this->redirect(array('/account/listPatient'));
				}
			}
		}
		
		if (Yii::app()->user->name == 'doctor'){
		$this->render('createPatient',array(
			'account' => $account,
			'user' => $user,
			'birthhistory' => $birthhistory,
			'listOfPatient' => $listOfPatient
		));
		} elseif (Yii::app()->user->name == 'secretary'){
			if(!empty($listOfPatientSec)){
				$this->render('createPatientSec',array(
					'account' => $account,
					'user' => $user,
					'birthhistory' => $birthhistory,
					'listOfPatientSec' => $listOfPatientSec
				));
				} else {
					// Render the error view
					$this->render('//site/error', array('message' => 'No records found, Please be assigned to a doctor'));
				}
			
		}
	}


	public function actionCreatePatientAdmin()
	{

		$listOfPatient = Account::model()->findAll(array(
			'condition'=>'account_type_id=:account_type_id',
			'params'=>array(
				':account_type_id'=>4,
			),
		));
		$account = new Account;
		$user = new User;
		$birthhistory = new BirthHistory;
		$account->setScenario('createNewPatient');
		$user->setScenario('createNewPatient');

		if ((isset($_POST['Account'])) AND (isset($_POST['User'])))
		{
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
			
			$account->account_type_id = 4;
			$valid = $account->validate();
			$valid = $user->validate() && $valid;
			
			if ($valid) {   
				$connection = Yii::app()->db;
				$transaction = $connection->beginTransaction();
		
				try {
					if ($account->save()) {
						$account_id = $account->getPrimaryKey();
						$user->account_id = $account_id;
						
		
						if ($user->save(false)) {
		
							if ((isset($_POST['BirthHistory'])) AND array_filter($_POST['BirthHistory'])) {
								$birthhistory->attributes = $_POST['BirthHistory'];
								$birthhistory->account_id = $account_id;
								if ($birthhistory->save(false)) {
									$transaction->commit();
									Yii::app()->user->setFlash('success', 'You have successfully registered for an account!');
									$this->redirect(array('/account/listPatient'));
								}
							} else {
								$transaction->commit();
								Yii::app()->user->setFlash('success', 'You have successfully registered for an account!');
								$this->redirect(array('/account/listPatient'));
							}
						}
					}
				} catch (Exception $e) {
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'An error occurred while trying to add an account! Please try again later');
					$this->redirect(array('/account/listPatient'));
				}
			}
		}
		

		$this->render('createPatientAdmin',array(
			'account' => $account,
			'user' => $user,
			'birthhistory' => $birthhistory,
			'listOfPatient' => $listOfPatient
		));
	}
	public function actionListSecretary()
    {
        $listOfAccounts = Account::model()->findAll(array(
            'condition'=>'account_type_id=:account_type_id',
            'params'=>array(
                ':account_type_id'=>5,
            ),
        ));

        $this->render('listSecretary',array(
            'listOfAccounts'=>$listOfAccounts,
        ));
    }

	
	public function actionCreateSecretary()
	{
		$listOfAccounts = Account::model()->findAll(array(
			'condition'=>'account_type_id=:account_type_id',
			'params'=>array(
				':account_type_id'=>5,
			),
		));
		$account = new Account;
		$user = new User;
		$account->setScenario('createNewSecretary');
		$user->setScenario('createNewSecretary');

		
		if ((isset($_POST['Account'])) AND (isset($_POST['User'])))
		{
			$account->attributes = $_POST['Account'];
			$user->attributes = $_POST['User'];
			$account->account_type_id = 5;
			$valid = $account->validate();
			$valid = $user->validate() && $valid;
			
			if ($valid)
			{	
				$connection = Yii::app()->db;
				$transaction = $connection->beginTransaction();

				try
				{
					if ($account->save())
					{
						$account_id = $account->getPrimaryKey();
						$user->account_id = $account_id;

						if ($user->save(false))
						{
							$transaction->commit();
							Yii::app()->user->setFlash('success','You have successfully registered for an account!');
							$this->redirect(array('/account/listSecretary'));
						}
					}
				}
				catch (Exception $e)
				{
					$transaction->rollback();
					Yii::app()->user->setFlash('error', 'An error occured while trying to add an account! Please try again later');
					$this->redirect(array('/account/listSecretary'));
				}
			}
		}
		

		$this->render('createSecretary',array(
			'account' => $account,
			'user' => $user,
			'listOfAccounts' => $listOfAccounts,
		));
	}

	// Inside your controller


	
	// Helper function to calculate age
	
	
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
		$dataProvider=new CActiveDataProvider('Account');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Account('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Account']))
			$model->attributes=$_GET['Account'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	public function actionChangeStatusActivePat($id)
    {
        $model = Account::model()->findByPk($id); 

        if ($model !== null) {
            Account::model()->updateByPk($id, array('status_id' => 2));
			

            if (Yii::app()->user->name == 'doctor'){
            	$this->redirect(array('ListActivePatients')); // Redirect to the view page, adjust as needed
			} 
        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

	public function actionChangeStatus($id)
    {
        $model = Account::model()->findByPk($id); 

        if ($model !== null) {
            Account::model()->updateByPk($id, array('status_id' => 2));
			

            if (Yii::app()->user->name == 'doctor'){
            	$this->redirect(array('listPatientDoc')); // Redirect to the view page, adjust as needed
			} elseif (Yii::app()->user->name == 'super admin' || Yii::app()->user->name == 'admin') {
				$this->redirect(array('listPatient'));
			}
        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }
	public function actionChangeStatusDoc($id)
    {
        $model = Account::model()->findByPk($id); 

        if ($model !== null) {
            Account::model()->updateByPk($id, array('status_id' => 2));
			

            if (Yii::app()->user->name == 'super admin' || Yii::app()->user->name == 'admin'){
            	$this->redirect(array('listDoctor')); // Redirect to the view page, adjust as needed
			} 
        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

	public function actionChangeStatusSec($id)
    {
        $model = Account::model()->findByPk($id); 

        if ($model !== null) {
            Account::model()->updateByPk($id, array('status_id' => 2));
			

            if (Yii::app()->user->name == 'super admin' || Yii::app()->user->name == 'admin'){
            	$this->redirect(array('listSecretary')); // Redirect to the view page, adjust as needed
			} 
        } else {
            // Handle the case when the model is not found
            throw new CHttpException(404, 'The requested page does not exist.');
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Account the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Account::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Account $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
